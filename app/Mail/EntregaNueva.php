<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EntregaNueva extends Mailable
{
    use Queueable, SerializesModels;
    public $nombre_alumno;
    public $fecha_entrega;
    public $hora_entrega;
    public $url;


    /**
     * Create a new message instance.
     */
    public function __construct($nombre_alumno, $fecha_entrega, $hora_entrega, $url)
    {
        $this->nombre_alumno = $nombre_alumno;
        $this->fecha_entrega = $fecha_entrega;
        $this->hora_entrega = $hora_entrega;
        $this->url = $url;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Entrega Nueva',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.entrega-nueva',
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
