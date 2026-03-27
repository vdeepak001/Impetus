<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\FrontendUserPasswordMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class FrontendRegisteredUserController extends Controller
{
    /**
     * Display the frontend (nursing) registration form.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle frontend user registration without touching admin register flow.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('frontendRegister', [
            'name' => ['required', 'string', 'max:255'],
            'state' => [
                'required',
                'string',
                Rule::exists('states', 'name')->where(function ($query) {
                    $query->where('status', 'active')->whereNull('deleted_at');
                }),
            ],
            'qualification' => ['required', 'string', Rule::in([
                'GNM',
                'ANM',
                'PB BSC Nursing',
                'BSC Nursing',
                'MSC Nursing',
                'PHD Nursing',
            ])],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'rn_number' => ['required', 'string', 'max:100'],
        ]);

        $generatedPassword = Str::random(10);
        $normalizedEmail = Str::lower(trim($validated['email']));

        $emailAlreadyExists = User::query()
            ->get()
            ->contains(function (User $user) use ($normalizedEmail): bool {
                return Str::lower(trim((string) $user->email)) === $normalizedEmail;
            });

        if ($emailAlreadyExists) {
            return back()
                ->withErrors([
                    'email' => 'This email is already registered.',
                ], 'frontendRegister')
                ->withInput();
        }

        $user = User::query()->create([
            'name' => $validated['name'],
            'email' => $normalizedEmail,
            'password' => Hash::make($generatedPassword),
            'role_type' => 'user',
            'active_status' => true,
            'state' => $validated['state'],
            'qualification' => $validated['qualification'],
            'phone' => $validated['phone'],
            'rn_number' => $validated['rn_number'],
            'date_of_birth' => $validated['date_of_birth'],
        ]);

        Mail::to($user->email)->send(new FrontendUserPasswordMail($user, $generatedPassword));

        return back()->with('success', 'Your account has been created. We sent a login password to your email.');
    }
}
