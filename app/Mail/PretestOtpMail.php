<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PretestOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public string $otpCode,
        public string $courseName
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verification OTP for ' . $this->courseName . ' Pretest',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.pretest-otp',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
