<?php

class Message
{
    private $salutation;
    private $contents;
    private $signature;
    private $completeMessage;


    public function __construct(string $salutation, string $contents, string $signature){
        $this->salutation = $salutation;
        $this->contents = $contents;
        $this->signature = $signature;
        $this->completeMessage = $this->setCompleteMessage();
    }

    private function setCompleteMessage(){
        $completeMessage = "Dear $this->salutation, <br><br> $this->contents <br><br> $this->signature";
        $this->completeMessage = $completeMessage;
        return $this->completeMessage;
    }

    public function sendMessage($receiver, $subject){
        mail($receiver, $subject, $this->completeMessage);
    }

    public function __toString()
    {
        return "$this->completeMessage";
    }
}