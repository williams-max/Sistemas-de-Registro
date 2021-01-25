<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class correoEnviado extends Mailable
{
    use Queueable, SerializesModels;

    public $pass;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pass)
    {
        $this->pass= $pass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.mensage-enviado');
    }
}
