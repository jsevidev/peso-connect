<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $formType,
        public string $applicantName,
        public string $summary,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'PESO Connect: New '.$this->formType.' submission',
        );
    }

    public function content(): Content
    {
        return new Content(
            htmlString: '<p>A new <strong>'.e($this->formType).'</strong> was submitted by <strong>'.e($this->applicantName).'</strong>.</p><p>'.e($this->summary).'</p><p>Review it in the PESO admin portal.</p>',
        );
    }
}
