<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class NewsletterSubscriberWelcome extends Mailable
{
    use Queueable;

    public function __construct(public string $email) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'You are subscribed — Salman Waria',
            replyTo: [
                new Address(
                    (string) config('contact.inbox.address'),
                    (string) config('contact.inbox.name'),
                ),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.newsletter-welcome',
            text: 'mail.newsletter-welcome-text',
        );
    }
}
