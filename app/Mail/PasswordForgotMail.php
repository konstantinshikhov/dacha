<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordForgotMail extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $hashed_random_password;
    public function __construct($url, $hashed_random_password)
    {
        $this->url = $url;
        $this->hashed_random_password= $hashed_random_password;
    }

    public function build()
    {
        return $this->from('liger800kg@gmail.com', 'ОГОРОД!')
            ->subject('Восстановление пароля!')
            ->view('mail.password_forgot');
    }
}