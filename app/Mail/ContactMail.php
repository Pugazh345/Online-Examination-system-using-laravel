<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
public $name,$phone,$email,$course,$location;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$phone,$email,$course,$location)
    {
        $this->name = $name; 
        $this->phone = $phone;   
        $this->email = $email;   
        $this->course = $course;   
        $this->location = $location; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contactmail');
    }
}
