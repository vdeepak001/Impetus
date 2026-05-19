<?php

namespace App\Mail;

use App\Models\CourseDetail;
use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ModuleActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public CourseDetail $course,
        public Order $order
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your CPD Module "' . $this->course->couse_name . '" Has Been Activated!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.module-activation',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
