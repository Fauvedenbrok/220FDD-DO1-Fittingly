<?php

class OrderLines{
    
    private $quantity;
    private $startDateReservation;
    private $endDateReservation;
    private $orderLinePrice;
    private $orderID;
    private $articleID;
    private $partnerID;

    public function __construct(int $quantity, string $startDateReservation, string $endDateReservation, float $orderLinePrice, int $orderID, int $articleID, int $partnerID){
        $this->quantity = $quantity;
        $this->startDateReservation = $startDateReservation;
        $this->endDateReservation = $endDateReservation;
        $this->orderLinePrice = $orderLinePrice;
        $this->orderID = $orderID;
        $this->articleID = $articleID;
        $this->partnerID = $partnerID;
    }
    public function __toString(){
        return "$this->quantity, $this->startDateReservation, $this->endDateReservation, $this->orderLinePrice, $this->orderID, $this->articleID, $this->partnerID";
    }

    // prepared statement nog voor het toevoegen van een orderline
    public function addOrderLine($conn){
        $sql = "INSERT INTO orderlines (quantity, startDateReservation, endDateReservation, orderLinePrice, orderID, articleID, partnerID) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        // issiiii moet nog veranderd worden naar de juiste types
        // s = string, i = integer, d = double, b = blob
        $stmt->bind_param("issiiii", $this->quantity, $this->startDateReservation, $this->endDateReservation, $this->orderLinePrice, $this->orderID, $this->articleID, $this->partnerID);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}