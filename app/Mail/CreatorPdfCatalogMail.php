<?php

namespace App\Mail;

use App\Models\Creator;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreatorPdfCatalogMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public Creator $creator;
    private string $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Creator $creator, string $pdf)
    {
        $this->creator = $creator;
        $this->pdf = $pdf;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.send-pdf-catalog')
            ->subject(__('creators.send-pdf-catalog.mail-subject') . '"' . $this->creator->name . '"')
            ->attachData($this->pdf, $this->creator->name . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
