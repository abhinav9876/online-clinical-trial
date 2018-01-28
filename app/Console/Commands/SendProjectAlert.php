<?php

namespace App\Console\Commands;

use App;

use App\{
    Post,
    Mail\ProjectAlert
};

use Illuminate\{
    Support\Facades\Mail,
    Console\Command
};


class SendProjectAlert extends Command
{
    protected $signature = 'project-alert:send';
    protected $description = 'Send project alert email';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $posts = Post::all();
        foreach ($posts as $post) {
            $subjects = $post->alertSubjects();
            if (count($subjects)) {
                Mail::bcc($post->alertTargetEmails())->send(new ProjectAlert($post, $subjects));
            }
        }
    }
}
