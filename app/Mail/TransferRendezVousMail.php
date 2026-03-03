<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\RendezVous;
use App\Models\Medecin;

class TransferRendezVousMail extends Mailable
{
    use Queueable, SerializesModels;
    public $rendezvous;
    public $ancienMedecin;
    public $nouveauMedecin;
    /**
     * Create a new message instance.
     */
    public function __construct(RendezVous $rendezvous, Medecin $ancienMedecin, Medecin $nouveauMedecin)
    {
         $this->rendezvous = $rendezvous;
        $this->ancienMedecin = $ancienMedecin;
        $this->nouveauMedecin = $nouveauMedecin;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Transfer Rendez Vous Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.transfer_rendezvous',
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
    public function build()
    {
        return $this->subject('Transfert de votre rendez-vous médical')
                    ->view('emails.transfer_rendezvous');
    }
}
