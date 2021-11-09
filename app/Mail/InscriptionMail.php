<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InscriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->user['role'] == 4) {
            return $this->from('info@invest--partners.com')
                ->view('emails.inscription')
                ->subject('Bienvenue chez Invest & Partners');
                // ->attach('/path/to/file', [
                //     'as' => 'name.pdf',
                //     'mime' => 'application/pdf',
                // ]);
        }
        return $this->from('info@invest--partners.com')->view('emails.inscription')->subject('Bienvenue chez Invest & Partners');
    }
}
