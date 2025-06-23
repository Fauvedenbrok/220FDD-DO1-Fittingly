<?php

/**
 * Class Message
 *
 * Represents an email or message with a salutation, contents, and signature.
 * Provides methods to build the complete message, send it, and convert it to a string.
 */
class Message
{
    /**
     * @var string The salutation (e.g., recipient's name or greeting).
     */
    private $salutation;

    /**
     * @var string The main contents of the message.
     */
    private $contents;

    /**
     * @var string The signature of the message.
     */
    private $signature;

    /**
     * @var string The complete message, built from the salutation, contents, and signature.
     */
    private $completeMessage;

    /**
     * Message constructor.
     *
     * @param string $salutation The salutation for the message.
     * @param string $contents The main contents of the message.
     * @param string $signature The signature for the message.
     */
    public function __construct(string $salutation, string $contents, string $signature){
        $this->salutation = $salutation;
        $this->contents = $contents;
        $this->signature = $signature;
        // Build the complete message upon construction.
        $this->completeMessage = $this->setCompleteMessage();
    }

    /**
     * Builds the complete message string from the salutation, contents, and signature.
     *
     * @return string The complete message.
     */    
    private function setCompleteMessage(){
        $completeMessage = "Dear $this->salutation, <br><br> $this->contents <br><br> $this->signature";
        $this->completeMessage = $completeMessage;
        return $this->completeMessage;
    }

    /**
     * Sends the message to the specified receiver using PHP's mail() function.
     *
     * @param string $receiver The recipient's email address.
     * @param string $subject The subject of the email.
     * @return void
     */
    public function sendMessage($receiver, $subject){
        // Uses PHP's mail() function to send the message.
        // Note: This is a placeholder and may not work without proper mail server configuration.
        mail($receiver, $subject, $this->completeMessage);
    }

    /**
     * Returns the complete message as a string.
     *
     * @return string The complete message.
     */
    public function __toString()
    {
        return "$this->completeMessage";
    }
}