<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email = "jeep456@yandex.ru",$message = "Hello jeep")
    {
        $this->email = $email;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $to = $this->email;
        $subj = "New Event";
        $message = $this->message;
        mail($to,$subj,$message);

        //$mail = new SendEmail();
        new SendEmail();
        //$mail->later(now());
        //return $this->to(['jeep456@yandex.ru'])->text("email.some");
        //return $this->view('view.name');
    }
}
