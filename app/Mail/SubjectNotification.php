<?php

namespace App\Mail;

use App\Subject;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubjectNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $smt_application;
    public $post;
    public $examDetailsUrl;

    public function __construct(Subject $subject)
    {
        $this->smt_application = $subject;
        $this->post = $subject->post;

        $this->examDetailsUrl = $this->examDetailsUrl();
    }

    public function build()
    {
        $this->from(env('MAIL_FROM_ADDRESS'), 'SMT');

        /* Todo: Move subject to i18n */
        $this->subject('The appointment is finishedメール ' . $this->post->title);

        /* Todo: i18n */
        return $this->view('mail.subject_notification');
    }

    private function examDetailsUrl()
    {
        /* Todo: Add base url to configuration file */
        $baseUrl = config('app.env') == 'production' ? 'https://searchmytrial.com' : 'http://dev.searchmytrial.com';
        return $baseUrl . '/search-sheet-post/?post-' . $this->post->id;
    }
}
