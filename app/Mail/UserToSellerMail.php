<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserToSellerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $seller_name;
    public $user_email;
    public $user_message;
    public $article_title;
    /**
     * Create a new message instance.
     */
    public function __construct($seller_name, $user_email, $user_message, $article_title)
    {
        $this->seller_name = $seller_name;
        $this->user_email = $user_email;
        $this->user_message = $user_message;
        $this->article_title = $article_title;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Richiesta informazioni per l\'annuncio ' . $this->article_title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.user-to-seller-mail',
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
