<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AlertaEstoqueBoloMail extends Mailable
{
    use Queueable, SerializesModels;

    public $bolo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($bolo)
    {
        $this->bolo = $bolo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.mensagem-bolo')
        ->subject("O bolo {$this->bolo->nome} voltou ao estoque!")
        ->with(['bolo' => $this->bolo]);
    }
}
