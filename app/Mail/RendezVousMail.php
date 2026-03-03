<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RendezVousMail extends Mailable 
{
    public $rendezvous;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($rendezvous)
    {
        $this->rendezvous = $rendezvous;
    }
    public function build()
    {
        return $this->view('emails.rendezvous')
                    ->with([
                        'rendezvous' => $this->rendezvous
                    ]);

    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Rendez Vous Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.rendezvous',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
