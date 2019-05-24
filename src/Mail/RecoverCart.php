<?php

namespace timramseyjr\CartRecovery\Mail;

use Illuminate\Mail\Mailable;

class RecoverCart extends Mailable
{
    public $content, $app_name, $app_email, $subject;
    /**
     * Create a new message instance.
     * @message string
     * @subject string
     * @return void
     */
    public function __construct($message, $app_name, $app_email, $subject)
    {
        $this->content = $message;
        $this->app_name = $app_name;
        $this->app_email = $app_email;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('cartrecovery::email')
            ->subject($this->subject)
            ->from($this->app_email, $this->app_name);
    }
}
