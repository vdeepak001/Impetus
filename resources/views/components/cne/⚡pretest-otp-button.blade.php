<?php

use Livewire\Component;
use App\Models\CourseDetail;
use App\Mail\PretestOtpMail;
use Illuminate\Support\Facades\Mail;

new class extends Component
{
    public CourseDetail $course;
    public string $btnClass = '';
    public string $testType = 'pre';
    public string $btnLabel = 'Pretest';

    public bool $showModal = false;
    public string $otpInput = '';
    public string $errorMessage = '';
    public string $successMessage = '';
    public bool $otpSent = false;
    public bool $isSending = false;

    public function mount(CourseDetail $course, string $btnClass = '', string $testType = 'pre', string $btnLabel = 'Pretest')
    {
        $this->course = $course;
        $this->btnClass = $btnClass;
        $this->testType = $testType;
        $this->btnLabel = $btnLabel;
    }

    public function openModal()
    {
        $this->resetState();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetState();
    }

    public function resetState()
    {
        $this->otpInput = '';
        $this->errorMessage = '';
        $this->successMessage = '';
        $this->otpSent = false;
        $this->isSending = false;
    }

    public function getSessionOtpKey(): string
    {
        return $this->testType . 'test_otp_' . $this->course->id;
    }

    public function getSessionVerifiedKey(): string
    {
        return $this->testType . 'test_otp_verified_' . $this->course->id;
    }

    public function getTestLabel(): string
    {
        return match ($this->testType) {
            'mock' => 'Mock Test',
            'final' => 'Final Test',
            default => 'Pretest',
        };
    }

    public function getModalTitle(): string
    {
        return $this->getTestLabel() . ' Security Gate';
    }

    public function sendOtp()
    {
        $this->errorMessage = '';
        $this->successMessage = '';
        $this->isSending = true;

        try {
            $otp = (string) rand(100000, 999999);
            session()->put($this->getSessionOtpKey(), [
                'code' => $otp,
                'expires_at' => now()->addMinutes(10),
                'attempts' => 0,
            ]);

            Mail::to(auth()->user()->email)->send(new PretestOtpMail(auth()->user(), $otp, $this->course->couse_name, $this->testType));

            $this->otpSent = true;
            $this->successMessage = 'Verification code sent successfully to your email.';
        } catch (\Exception $e) {
            $this->errorMessage = 'Failed to send verification code: ' . $e->getMessage();
        } finally {
            $this->isSending = false;
        }
    }

    public function verifyOtp()
    {
        $this->errorMessage = '';
        $this->successMessage = '';

        if (empty($this->otpInput)) {
            $this->errorMessage = 'Please enter the 6-digit verification code.';
            return;
        }

        $sessionKey = $this->getSessionOtpKey();
        $stored = session()->get($sessionKey);

        if (!$stored || now()->greaterThan($stored['expires_at'])) {
            $this->errorMessage = 'The verification code has expired. Please request a new one.';
            return;
        }

        // Increment attempts and update session
        $stored['attempts']++;
        session()->put($sessionKey, $stored);

        if ($stored['attempts'] > 3) {
            session()->forget($sessionKey);
            $this->otpSent = false;
            $this->otpInput = '';
            $this->errorMessage = 'Too many incorrect attempts. This code has been invalidated. Please request a new one.';
            return;
        }

        if (trim($stored['code']) !== trim($this->otpInput)) {
            $left = 3 - $stored['attempts'];
            if ($left <= 0) {
                session()->forget($sessionKey);
                $this->otpSent = false;
                $this->otpInput = '';
                $this->errorMessage = 'Too many incorrect attempts. This code has been invalidated. Please request a new one.';
            } else {
                $this->errorMessage = 'Invalid verification code. ' . $left . ' ' . ($left === 1 ? 'attempt' : 'attempts') . ' remaining.';
            }
            return;
        }

        // Successfully verified! Save in session and redirect to test
        session()->put($this->getSessionVerifiedKey(), true);
        session()->forget($sessionKey);

        return redirect()->route('cne.modules.test', [$this->course->couse_name, $this->testType]);
    }

    public function getMaskedEmail()
    {
        $email = auth()->user()->email;
        $parts = explode('@', $email);
        if (count($parts) !== 2) return $email;

        $name = $parts[0];
        $domain = $parts[1];
        $len = strlen($name);

        if ($len > 3) {
            $maskedName = substr($name, 0, 1) . str_repeat('*', $len - 2) . substr($name, -1);
        } else {
            $maskedName = str_repeat('*', $len);
        }

        return $maskedName . '@' . $domain;
    }
};
?>

<div class="inline-block">
    {{-- Button --}}
    <button 
        type="button" 
        wire:click="openModal" 
        class="{{ $btnClass }}"
    >
        {{ $btnLabel }}
    </button>

    {{-- Modal --}}
    @if($showModal)
        <div 
            class="fixed inset-0 z-[100] flex items-center justify-center p-4"
            role="dialog"
            aria-modal="true"
        >
            {{-- Backdrop --}}
            <div 
                class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" 
                wire:click="closeModal"
            ></div>
            
            {{-- Content --}}
            <div class="relative w-full max-w-md transform overflow-hidden rounded-3xl border border-white/20 bg-white shadow-2xl transition-all ring-1 ring-slate-900/10">
                
                {{-- Header --}}
                <div class="flex items-center justify-between border-b border-slate-100 bg-white/95 px-6 py-4 rounded-t-3xl">
                    <div class="flex items-center gap-2.5">
                        <div class="flex size-9 items-center justify-center rounded-xl bg-logo-blue/10 text-logo-blue animate-pulse">
                            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h2 class="font-serif text-lg font-bold text-slate-900">{{ $this->getModalTitle() }}</h2>
                    </div>
                    <button 
                        type="button"
                        wire:click="closeModal"
                        class="rounded-xl p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600 focus:outline-none"
                    >
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Body --}}
                <div class="px-6 py-6 sm:px-8">
                    <div class="text-center mb-6">
                        <p class="text-xs font-bold uppercase tracking-[0.15em] text-logo-blue/80 mb-1">Verification Required</p>
                        <h3 class="text-base font-bold text-slate-800 leading-snug">{{ $course->couse_name }}</h3>
                        <p class="mt-2 text-sm text-slate-500">
                            For security purposes, we need to verify your identity before you start the {{ strtolower($this->getTestLabel()) }}. We will send a One-Time Password (OTP) to your registered email:
                            <span class="block mt-1 font-semibold text-slate-800 text-base tracking-wide">{{ $this->getMaskedEmail() }}</span>
                        </p>
                    </div>

                    {{-- Messages --}}
                    @if($errorMessage)
                        <div class="mb-4 rounded-xl border border-rose-100 bg-rose-50/50 p-3.5 text-center">
                            <p class="text-sm font-semibold text-rose-700">{{ $errorMessage }}</p>
                        </div>
                    @endif

                    @if($successMessage)
                        <div class="mb-4 rounded-xl border border-emerald-100 bg-emerald-50/50 p-3.5 text-center">
                            <p class="text-sm font-semibold text-emerald-700">{{ $successMessage }}</p>
                        </div>
                    @endif

                    {{-- Form --}}
                    @if(!$otpSent)
                        {{-- Send OTP Button --}}
                        <div class="mt-6">
                            <button
                                type="button"
                                wire:click="sendOtp"
                                wire:loading.attr="disabled"
                                class="flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-logo-blue to-brand-900 py-3.5 text-sm font-bold uppercase tracking-wide text-white shadow-xl shadow-logo-blue/20 transition hover:from-logo-blue hover:to-logo-blue/90 disabled:opacity-50"
                            >
                                <span wire:loading wire:target="sendOtp" class="inline-block border-2 border-white border-t-transparent rounded-full size-4 animate-spin"></span>
                                <span wire:loading.remove wire:target="sendOtp">Send OTP Code</span>
                                <span wire:loading wire:target="sendOtp">Sending Code...</span>
                            </button>
                        </div>
                    @else
                        {{-- Verification Input --}}
                        <div class="space-y-4">
                            <div>
                                <label for="otpCode" class="block text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-2 text-center">
                                    Enter 6-Digit Code
                                </label>
                                <input
                                    type="text"
                                    id="otpCode"
                                    maxlength="6"
                                    placeholder="000000"
                                    wire:model="otpInput"
                                    class="block w-full rounded-2xl border border-slate-200 bg-slate-50/50 px-4 py-3.5 text-center text-2xl font-bold tracking-[0.25em] text-slate-800 focus:border-logo-blue focus:bg-white focus:outline-none focus:ring-2 focus:ring-logo-blue/20"
                                    required
                                    autofocus
                                />
                            </div>

                            <div class="flex flex-col gap-2 pt-2">
                                <button
                                    type="button"
                                    wire:click="verifyOtp"
                                    wire:loading.attr="disabled"
                                    class="flex w-full items-center justify-center gap-2 rounded-2xl bg-emerald-600 py-3.5 text-sm font-bold uppercase tracking-wide text-white shadow-xl shadow-emerald-600/20 transition hover:bg-emerald-700 disabled:opacity-50"
                                >
                                    <span wire:loading wire:target="verifyOtp" class="inline-block border-2 border-white border-t-transparent rounded-full size-4 animate-spin"></span>
                                    <span>Verify & Proceed</span>
                                </button>

                                <button
                                    type="button"
                                    wire:click="sendOtp"
                                    wire:loading.attr="disabled"
                                    class="mt-2 text-center text-xs font-bold uppercase tracking-wider text-logo-blue hover:text-brand-900 transition focus:outline-none disabled:opacity-50"
                                >
                                    Resend Verification Code
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>