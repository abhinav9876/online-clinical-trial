<?php

namespace App;

class MailUser
{
    public $name;
    public $email;
    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }
}
