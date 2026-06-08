<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class NewsletterOwnerNotification extends Mailable
{
    use Queueable;

    public function __construct(
        public string $email,
        public string $ipText,
    ) {}

    public function envelope(): Envelope
    {
        $inboxAddress = (string) config('contact.inbox.address');
        $inboxName = (string) config('contact.inbox.name');

        return new Envelope(
            subject: 'Newsletter — Salman Waria',
            replyTo: [
                new Address($inboxAddress, $inboxName),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.newsletter-owner',
            text: 'mail.newsletter-owner-text',
        );
    }
}
