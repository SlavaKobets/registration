<?php

namespace App\Channels;

class SmsMessage
{
    protected $message = '';
    protected $phone;


    public function phone(string  $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function message(string  $message = ''): self
    {
        $this->message = $message;

        return $this;
    }
}
