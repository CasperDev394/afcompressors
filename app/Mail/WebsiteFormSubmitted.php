<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WebsiteFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly string $formType,
        public readonly array $submission,
    ) {}

    public function envelope(): Envelope
    {
        $name = isset($this->submission['firstName'], $this->submission['lastName'])
            ? trim($this->submission['firstName'].' '.$this->submission['lastName'])
            : $this->submission['email'];

        return new Envelope(
            replyTo: [new Address($this->submission['email'], $name)],
            subject: match ($this->formType) {
                'quote' => 'Новый запрос ценового предложения с afcompressors.ru',
                'newsletter' => 'Новая подписка на рассылку с afcompressors.ru',
                default => 'Новое сообщение с afcompressors.ru',
            },
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.website-form-submitted');
    }
}
