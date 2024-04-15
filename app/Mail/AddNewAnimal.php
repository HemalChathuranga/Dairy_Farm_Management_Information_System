<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AddNewAnimal extends Mailable
{
    use Queueable, SerializesModels;

    public $mailMessage;
    public $subject;
    public $animalID;
    public $animalBreed;
    public $birthDate;
    public $gender;
    public $createdBy;
    public $dtStamp;
   

    /**
     * Create a new message instance.
     */
    public function __construct($mailMessage, $subject, $animalID, $animalBreed, $birthDate, $gender, $createdBy, $dtStamp)
    {
        $this->mailMessage = $mailMessage;
        $this->subject = $subject;
        $this->animalID = $animalID;
        $this->animalBreed = $animalBreed;
        $this->birthDate = $birthDate;
        $this->gender = $gender;
        $this->createdBy = $createdBy;
        $this->dtStamp = $dtStamp;

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
            view: 'mailTemplates.addNewAnimalMail',
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
