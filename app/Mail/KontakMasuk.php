<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KontakMasuk extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly array $data) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[PSMPD] Pesan Baru: ' . ($this->data['subjek'] ?? '-'),
            replyTo: [
                new \Illuminate\Mail\Mailables\Address(
                    $this->data['email'],
                    $this->data['nama']
                ),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.kontak-masuk',
        );
    }
}
