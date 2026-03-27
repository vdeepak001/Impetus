<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\FrontendUserPasswordMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class FrontendAuthenticatedSessionController extends Controller
{
    /**
     * Handle frontend user authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $normalizedEmail = Str::lower(trim((string) $request->input('email')));
        $user = User::query()
            ->get()
            ->first(function (User $user) use ($normalizedEmail) {
                return Str::lower(trim((string) $user->email)) === $normalizedEmail;
            });

        if (! $user || ! Hash::check((string) $request->input('password'), $user->password)) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        if ($user->role_type !== 'user') {
            throw ValidationException::withMessages([
                'email' => 'This login is only for frontend user accounts.',
            ]);
        }

        if (! $user->active_status) {
            throw ValidationException::withMessages([
                'email' => 'Your account is deactivated. Please contact support.',
            ]);
        }

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        return redirect()->intended(route('home', absolute: false));
    }

    /**
     * Resend a new frontend login password by email.
     */
    public function resendPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        $normalizedEmail = Str::lower(trim((string) $request->input('email')));
        $user = User::query()
            ->get()
            ->first(function (User $user) use ($normalizedEmail) {
                return Str::lower(trim((string) $user->email)) === $normalizedEmail;
            });

        if (! $user || $user->role_type !== 'user') {
            throw ValidationException::withMessages([
                'email' => 'Frontend user account not found for this email.',
            ]);
        }

        $generatedPassword = Str::random(10);
        $user->forceFill([
            'password' => Hash::make($generatedPassword),
        ])->save();

        Mail::to($user->email)->send(new FrontendUserPasswordMail($user, $generatedPassword));

        return back()->with('success', 'A new login password has been sent to your email.');
    }
}
