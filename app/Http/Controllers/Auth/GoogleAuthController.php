<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirectResponse;
use Throwable;

class GoogleAuthController extends Controller
{
    /**
     * Send the user to Google's OAuth consent screen.
     */
    public function redirect(): RedirectResponse|SymfonyRedirectResponse
    {
        if (! config('services.google.client_id') || ! config('services.google.client_secret')) {
            return redirect()->route('home')->with('error', 'Google sign-in is not configured.');
        }

        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle the OAuth callback from Google for frontend (nursing) users.
     */
    public function callback(): RedirectResponse
    {
        if (! config('services.google.client_id') || ! config('services.google.client_secret')) {
            return redirect()->route('home')->with('error', 'Google sign-in is not configured.');
        }

        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (InvalidStateException $e) {
            return redirect()->route('home')->with('error', 'Google sign-in session expired. Please try again.');
        } catch (Throwable $e) {
            return redirect()->route('home')->with('error', 'Google sign-in was cancelled or failed.');
        }

        $email = $googleUser->getEmail();
        if (! is_string($email) || $email === '') {
            return redirect()->route('home')->with('error', 'Google did not provide an email address.');
        }

        $normalizedEmail = Str::lower(trim($email));
        $googleId = $googleUser->getId();

        $user = User::query()->where('google_id', $googleId)->first();

        if (! $user) {
            $user = $this->findUserByNormalizedEmail($normalizedEmail);
        }

        if ($user) {
            if ($user->role_type !== 'user') {
                return redirect()->route('home')->with('error', 'This Google account is already associated with a staff login. Please use the staff sign-in page.');
            }

            if (! $user->active_status) {
                return redirect()->route('home')->with('error', 'Your account is deactivated. Please contact support.');
            }

            if ($user->google_id && $user->google_id !== $googleId) {
                return redirect()->route('home')->with('error', 'This email is linked to a different Google account.');
            }

            if (! $user->google_id) {
                $user->forceFill(['google_id' => $googleId])->save();
            }
        } else {
            $user = User::query()->create([
                'name' => $googleUser->getName() ?: Str::before($normalizedEmail, '@'),
                'email' => $normalizedEmail,
                'google_id' => $googleId,
                'password' => Hash::make(Str::random(64)),
                'role_type' => 'user',
                'active_status' => true,
                'email_verified_at' => now(),
            ]);
        }

        Auth::login($user, true);
        request()->session()->regenerate();

        return redirect()->intended(route('home', absolute: false));
    }

    /**
     * Match email the same way as other frontend auth (encrypted column).
     */
    private function findUserByNormalizedEmail(string $normalizedEmail): ?User
    {
        return User::query()
            ->get()
            ->first(function (User $user) use ($normalizedEmail): bool {
                return Str::lower(trim((string) $user->email)) === $normalizedEmail;
            });
    }
}
