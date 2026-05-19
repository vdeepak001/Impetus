<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FrontendUserPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public string $generatedPassword,
        public string $type = 'register'
    ) {
    }

    public function envelope(): Envelope
    {
        $subject = $this->type === 'forgot' ? 'Your Temporary Password' : 'Welcome to Ventura Learning Solutions';
        return new Envelope(
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.frontend-user-password',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
