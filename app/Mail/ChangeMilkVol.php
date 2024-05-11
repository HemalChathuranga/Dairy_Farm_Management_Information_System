<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ChangeMilkVol extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $editedBy;
    public $recordOld;
    public $recordNew;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $editedBy, $recordOld, $record)
    {
        
        $this->subject = $subject;
        $this->editedBy = $editedBy;
        $this->recordOld = $recordOld;
        $this->recordNew = $record;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mailTemplates.changeMilkingInfo',
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
