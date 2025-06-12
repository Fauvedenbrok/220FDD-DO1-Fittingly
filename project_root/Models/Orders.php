<?php

/**
 * Class Orders
 *
 * Represents an order and provides methods to interact with the database.
 */
class Orders{
   
    private $orderID;
    private $orderDate;
    private $paymentStatus;
    private $postalCode;
    private $houseNumber;
    private $orderStatus;
    private $customerID;
    private $orderInfo;
    
    private $crudModel;

    /**
     * Orders constructor.
     *
     * @param int $orderID The unique ID of the order.
     * @param string $orderDate The date of the order.
     * @param bool $paymentStatus The payment status of the order.
     * @param string $postalCode The postal code for the order delivery.
     * @param string $houseNumber The house number for the order delivery.
     * @param string $orderStatus The status of the order (e.g., pending, completed).
     * @param string $customerID The ID of the customer who placed the order.
     */
    public function __construct(int $orderID, string $orderDate, bool $paymentStatus, string $postalCode, string $houseNumber, string $orderStatus, string $customerID, $crudModel = null) {
        $this->orderID = $orderID;
        $this->orderDate = $orderDate;
        $this->paymentStatus = $paymentStatus;
        $this->postalCode = $postalCode;
        $this->houseNumber = $houseNumber;
        $this->orderStatus = $orderStatus;
        $this->customerID = $customerID;
        $this->orderInfo = $this->createAssociativeArray();
        $this->crudModel = $crudModel ?? new \Models\CrudModel();
    }
    /**
     * Returns a string representation of the order.
     *
     * @return string
     */
    public function __toString(){
        return "$this->orderID, $this->orderDate, $this->paymentStatus, $this->postalCode, $this->houseNumber, $this->orderStatus, $this->customerID";
    }

    /**
     * Creates an associative array of the order properties.
     *
     * @return array Associative array with order data.
     */
    public function createAssociativeArray(): array {
        $orderArray = array(
            'OrderID' => $this->orderID,
            'OrderDate' => $this->orderDate,
            'PaymentStatus' => $this->paymentStatus,
            'PostalCode' => $this->postalCode,
            'HouseNumber' => $this->houseNumber,
            'OrderStatus' => $this->orderStatus,
            'CustomerID' => $this->customerID
        );
        return $orderArray;
    }

}