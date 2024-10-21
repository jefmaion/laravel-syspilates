<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InstructorWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $instructor;
    protected $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($instructor, $password)
    {
        $this->instructor = $instructor;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('vendor.mail.instructor_welcome')
            ->with([
                'user' => $this->instructor,
                'instructorName' => $this->instructor->name,
                'password' => $this->password,
            ]);
    }
}
