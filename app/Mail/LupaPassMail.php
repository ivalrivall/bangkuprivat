<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LupaPassMail extends Mailable
{
    use Queueable, SerializesModels;
    public $details;

    public function __construct($details)
    {
        $this->details = $details;

    }

    public function build()
    {
        // return $this->view( view: 'lupapass.lupa_pass' );
        return $this->subject('Verifikasi Kode Lupa Kata Sandi')
                    ->view('lupapass.lupa_pass');
    }
    // public function build()
    // {
    //     $data = $this->details;
    //     return $this->subject('Mail from websitepercobaan.com')
    //                 ->view('lupapass.lupa_pass');
    // }
}
