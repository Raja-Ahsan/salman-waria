<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ContactVisitorConfirmation extends Mailable
{
    use Queueable;

    /**
     * @param  array{name: string, company: string, email: string, subject: string, message: string}  $payload
     */
    public function __construct(public array $payload) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thanks — we received your message',
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
            view: 'mail.contact-visitor',
            text: 'mail.contact-visitor-text',
        );
    }
}
