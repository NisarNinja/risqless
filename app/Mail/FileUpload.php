<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FileUpload extends Mailable
{
    use Queueable, SerializesModels;

    public $data = array();
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data['file_name'] = $data['file_name'];
        $this->data['email'] = $data['email'];
        $this->data['name'] = $data['name'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $data = array();

        $data['file_name'] = $this->data['file_name'];
        $data['email'] = $this->data['email'];
        $data['name'] = $this->data['name'];

        return $this->from($data['email'])->replyTo($data['email'], $data['name'])->markdown('email.file-upload',compact('data'))
                ->attach($data['file_name']);

        // return $this->from('admin@konnectus.io')->markdown('email.file-upload')-> attachFromStorageDisk('files/'.$this->file_name, 'uploads');




         // return $this->view('emails.deputyheadteachersendalll')-> attachFromStorageDisk('files/'.$this->data['name'], 's3');

    }
}
