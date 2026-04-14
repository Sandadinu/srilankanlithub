<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubmissionAccepted extends Mailable
{
    use Queueable, SerializesModels;

    public $submission;
    public $essay;

    /**
     * Create a new message instance.
     */
    public function __construct($submission, $essay)
    {
        $this->submission = $submission;
        $this->essay = $essay;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: 'editors@srilankanlithub.com',
            subject: 'Selected for Publication: ' . $this->essay->title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.submission-accepted',
            with: [
                'name' => $this->submission->name,
                'title' => $this->essay->title,
                'slug' => $this->essay->slug,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
