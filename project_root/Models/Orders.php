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

}