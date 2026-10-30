<?php

namespace App\Auth\Mail;

use App\User\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    public function __construct(
        public string $resetUrl,
        public string $name,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Запрос на сброс пароля.',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'auth::Emails.reset-password',
        );
    }
}
