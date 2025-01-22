<?php

class Message
{
    private $salutation;
    private $contents;
    private $signature;
    // Deze variabele zit in de Klasse zodat er een compleet bericht wordt gemaakt van de waardes die bij de contructor zijn ingevuld.
    private $completeMessage;


    public function __construct(string $salutation, string $contents, string $signature){
        $this->salutation = $salutation;
        $this->contents = $contents;
        $this->signature = $signature;
        // Hier wordt de returnvalue van de functie setCompleteMessage() gestopt in de variabele $this->completeMessage. 
        // $this geeft aan dat het om deze instantie/object van de Klasse gaat.
        $this->completeMessage = $this->setCompleteMessage();
    }

    // Hier wordt een string gemaakt van alle waardes die zijn ingevuld bij het maken van een object van deze Klasse.
    private function setCompleteMessage(){
        $completeMessage = "Dear $this->salutation, <br><br> $this->contents <br><br> $this->signature";
        $this->completeMessage = $completeMessage;
        return $this->completeMessage;
    }

    public function sendMessage($receiver, $subject){
        // mail() is een standaard php functie die ik nog niet goed weet hoe die werkt. 
        // Dit is dus een soort van 'placeholder' omdat we ook nog geen mail aan de site hebben gekoppeld.
        mail($receiver, $subject, $this->completeMessage);
    }

    public function __toString()
    {
        return "$this->completeMessage";
    }
}