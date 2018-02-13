<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationKeyMail extends Mailable
{
    use Queueable, SerializesModels;

    private $key;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                ->view('mails.reservation-mail', ['key' => $this->key])
                ->from([
                    'address' => 'pistestsmtp@gmail.com',
                    'Potvrzení rezervace v restauraci Kukačka'
                ]);
    }
}
