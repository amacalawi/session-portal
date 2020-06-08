<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $contents;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content, $user)
    {
        $this->contents = $content;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {      
        if (!empty($this->contents)) {
            // foreach ($this->contents as $content) {
                return $this->from('aranfure@patent.com', 'Patent')
                ->subject($this->contents->subject)
                ->markdown('mails.notification')
                ->with([
                    'name' => $this->user,
                    'link' => $this->contents->url,
                    'message' => $this->contents->messages
                ]);
            // } 
        }
    }
}
