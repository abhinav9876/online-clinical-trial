<?php

namespace App\Mail;

use App\Post;
use Illuminate\{
    Bus\Queueable,
    Mail\Mailable,
    Queue\SerializesModels
};


class ProjectAlert extends Mailable
{
    use Queueable, SerializesModels;

    public $post;
    public $alertSubjects;

    public function __construct(Post $post, $alertSubjects)
    {
        $this->post = $post;
        $this->alertSubjects = $alertSubjects;
    }

    public function build()
    {
        $this->subject($this->post->title . ' Application Noticeメール');
        return $this->text('mail.project_alert');
    }
}
