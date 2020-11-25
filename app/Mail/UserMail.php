<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class UserMail extends Mailable
{
    use Queueable, SerializesModels;


    public $content;
    public $subject;
    public $ruta;
   
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content, $subject,$ruta)
    {
        $this->content=$content;
        $this->subject=$subject;
         $this->ruta=$ruta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.email')
        ->subject($this->subject)
         ->attach($this->ruta)
       ->from(Auth::user()->email);
       //->from('coordinador@unab.edu.pe');
    }
}
