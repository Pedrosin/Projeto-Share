<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmarProjeto extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $nm_projeto;

    public function __construct($nm_projeto)
    {
        $this->nm_projeto = $nm_projeto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Confirmar novo projeto')->markdown('emails.confirmar.projeto',[
            'nm_projeto' => $this->nm_projeto,
            'url'   => route('projetos'),
        ]);
    }
}
