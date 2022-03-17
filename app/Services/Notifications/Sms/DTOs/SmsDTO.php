<?php

namespace App\Services\Notifications\Sms\DTOs;

class SmsDTO
{
    private string $from;
    private string $to;
    private string $body;

    public function __construct(string $from, string $to, string $body)
    {
        $this->from = $from;
        $this->to = $to;
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }


}
