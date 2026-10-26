<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactFormRequest;
use App\Http\Requests\StoreNewsletterSubscriptionRequest;
use App\Mail\ContactOwnerNotification;
use App\Mail\ContactVisitorConfirmation;
use App\Mail\NewsletterOwnerNotification;
use App\Mail\NewsletterSubscriberWelcome;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function store(StoreContactFormRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $payload = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'company' => trim((string) ($validated['company'] ?? '')),
            'subject' => trim((string) ($validated['subject'] ?? '')),
            'message' => $validated['message'],
        ];

        $inboxAddresses = $this->inboxAddresses();

        try {
            Mail::to($inboxAddresses)
                ->send(new ContactOwnerNotification($payload));
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'ok' => false,
                'error' => 'Could not deliver your message email right now. Please try again later.',
                'csrf_token' => csrf_token(),
            ], 502);
        }

        dispatch(function () use ($payload, $inboxAddresses): void {
            if (in_array(strtolower(trim($payload['email'])), $inboxAddresses, true)) {
                return;
            }
            try {
                Mail::to($payload['email'], $payload['name'])->send(new ContactVisitorConfirmation($payload));
            } catch (\Throwable $e) {
                report($e);
            }
        })->afterResponse();

        return response()->json([
            'ok' => true,
            'csrf_token' => csrf_token(),
        ]);
    }

    public function newsletter(StoreNewsletterSubscriptionRequest $request): JsonResponse
    {
        $email = $request->validated()['email'];
        $ip = $request->header('X-Forwarded-For');
        if (is_string($ip) && str_contains($ip, ',')) {
            $ip = trim(explode(',', $ip)[0]);
        }
        $ipText = is_string($ip) && $ip !== '' ? $ip : ($request->ip() ?? 'Unknown');

        try {
            Mail::to($this->inboxAddresses())
                ->send(new NewsletterOwnerNotification($email, $ipText));
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'ok' => false,
                'error' => 'Could not send your subscription email right now. Please try again later.',
            ], 502);
        }

        dispatch(function () use ($email): void {
            try {
                Mail::to($email)->send(new NewsletterSubscriberWelcome($email));
            } catch (\Throwable $e) {
                report($e);
            }
        })->afterResponse();

        return response()->json([
            'ok' => true,
            'message' => 'Subscribed successfully.',
        ]);
    }

    /**
     * @return list<string>
     */
    private function inboxAddresses(): array
    {
        $addresses = config('contact.inbox.addresses');

        if (is_array($addresses) && $addresses !== []) {
            return array_values(array_filter($addresses, 'is_string'));
        }

        $fallback = trim((string) config('contact.inbox.address', ''));

        return $fallback !== '' ? [$fallback] : ['hello@salmanwaria.com'];
    }
}
