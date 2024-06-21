<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResponseSolicitudMail extends Mailable
{
    use Queueable, SerializesModels;

    public $solicitud;
    public $usuario;
    public $loginUrl;
    public $year;

    /**
     * Create a new message instance.
     */
    public function __construct($solicitud, $usuario)
    {
        $this->solicitud = $solicitud;
        $this->usuario = $usuario;
        $this->loginUrl = env('APP_URL') . '/login';
        $this->year = date('Y');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'IPUC Distrito 13 - Respondio su solicitud',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.respuesta_solicitud',
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
