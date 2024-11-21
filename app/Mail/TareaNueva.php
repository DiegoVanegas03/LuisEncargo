<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TareaNueva extends Mailable
{
    use Queueable, SerializesModels;

    public $titulo;
    public $descripcion;
    public $fecha_entrega;
    public $url;
    /**
     * Create a new message instance.
     */
    public function __construct($titulo, $descripcion, $fecha_entrega, $url)
    {
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->fecha_entrega = $fecha_entrega;
        $this->url = $url;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tarea Nueva Asignada',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.tarea-nueva',
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
