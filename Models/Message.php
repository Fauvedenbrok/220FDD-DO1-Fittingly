<?php

class Message
{
    private $salutation;
    private $message;
    private $signature;
    private $completeMessage;


    public function __construct(string $salutation, string $message, string $signature){
        $this->salutation = $salutation;
        $this->message = $message;
        $this->signature = $signature;
        $this->completeMessage = $this->setCompleteMessage();
    }
    public function getSalutation(): string{
        return $this->salutation;
    }
    public function getMessage(): string{
        return $this->message;
    }
    public function getSignature(): string{
        return $this->signature;
    }
    public function getCompleteMessage(): string{
        return $this->completeMessage;
    }

    private function setCompleteMessage(){
        $completeMessage = "Dear $this->salutation, <br><br> $this->message <br><br> $this->signature";
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