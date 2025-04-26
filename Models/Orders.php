<?php

class Orders{
   
    private $orderID;
    private $orderDate;
    private $paymentStatus;
    private $postalCode;
    private $houseNumber;
    private $orderStatus;
    private $customerID;

    public function __construct(int $orderID, string $orderDate, bool $paymentStatus, string $postalCode, string $houseNumber, string $orderStatus, int $customerID){
        $this->orderID = $orderID;
        $this->orderDate = $orderDate;
        $this->paymentStatus = $paymentStatus;
        $this->postalCode = $postalCode;
        $this->houseNumber = $houseNumber;
        $this->orderStatus = $orderStatus;
        $this->customerID = $customerID;
    }
    public function __toString(){
        return "$this->orderID, $this->orderDate, $this->paymentStatus, $this->postalCode, $this->houseNumber, $this->orderStatus, $this->customerID";
    }

    // prepared statement nog voor het toevoegen van een order
    public function addOrder($conn){
        $sql = "INSERT INTO orders (orderID, orderDate, paymentStatus, postalCode, houseNumber, orderStatus, customerID) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        // isssssi moet nog veranderd worden naar de juiste types
        // s = string, i = integer, d = double, b = blob
        $stmt->bind_param("isssssi", $this->orderID, $this->orderDate, $this->paymentStatus, $this->postalCode, $this->houseNumber, $this->orderStatus, $this->customerID);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}