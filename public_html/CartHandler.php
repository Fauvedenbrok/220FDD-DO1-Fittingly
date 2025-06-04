<?php
    use Models\CrudModel;
    use Core\Database;
    use Models\Customers;
    use Models\UserAccounts;
    use Models\Articles;

    require_once '../project_root/Core/Database.php';
    require_once '../project_root/Models/CrudModel.php';
    require_once '../project_root/Models/Customers.php';
    require_once '../project_root/Models/UserAccounts.php';
    require_once '../project_root/Models/Articles.php';
    require_once '../project_root/Models/Orders.php';
    require_once '../project_root/Models/OrderLines.php';

class CartHandler {
    public function addToCart(int $productId, int $quantity): void {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $_SESSION['cart'][$productId] = ($_SESSION['cart'][$productId] ?? 0) + $quantity;
    }

    public function removeFromCart(int $productId): void {
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }
    }

    public function getCartItems(): array {
        return $_SESSION['cart'] ?? [];
    }

    // Voorlopig geen prijs, dus total altijd 0
    public function calculateTotal(array $artikelen): float {
        return 0.0;
    }
    

    function getCheckoutData($userId, $customerId, $articleIds) {
        $user = new UserAccounts(...array_values(CrudModel::readAllById('UserAccounts', 'EmailAddress', $userId)));
        // change this to get the customer data based on the foreign key in UserAccounts
        $customerId = CrudModel::getForeignKeyValue('UserAccounts', 'EmailAddress', $user->getUserEmail(), 'CustomerID');
        $customer = new Customers(...array_values(CrudModel::readAllById('UserAccounts', 'CustomerID', $customerId)));

        $articles = [];
        foreach ($articleIds as $articleId) {
            $article = new Articles(...array_values(CrudModel::readAllById('Articles', 'ArticleID', $articleId)));
            if ($article) {
                $articles[] = $article;
            }
        }

        return ['user' => $user, 'customer' => $customer, 'articles' => $articles];
    }



    function processOrder($checkoutData, $articleQuantities) {
        // Prepare order data
        $user = $checkoutData['user']->createAssociativeArray();
        $customer = $checkoutData['customer']->createAssociativeArray();

        $orderData = [
            'OrderDate' => date('Y-m-d'), // Current date
            'PaymentStatus' => false, // Default payment status
            'PostalCode' => "5152RL",
            'HouseNumber' => "27",
            'OrderStatus' => 'Pending', // Default order status
            'CustomerID' => "c4b239a3-a9d4-422f-9b5b-3d195bb7ba54"
        ];

        // Insert into Orders table
        CrudModel::createData('Orders', $orderData);
        $pdo = Database::getConnection();
        $orderId = $pdo->lastInsertId(); // Retrieve the last inserted OrderID

        
        // Insert order lines
        foreach ($checkoutData['articles'] as $articles) {
            $article = $articles->createAssociativeArray();
            
                // Assuming articleQuantities is an associative array with ArticleID as key and quantity as value
                if (isset($articleQuantities[$article['ArticleID']])) {
                    $quantity = $articleQuantities[$article['ArticleID']];
                } else {
                    $quantity = 1; // Default quantity if not specified
                }
                
                // 
                $orderLineData = [
                    'OrderID' => $orderId,
                    'ArticleID' => $article['ArticleID'],
                    'PartnerID' => 1, // Assuming articles have partner data
                    'Quantity' => $quantity,
                    'StartDateReservation' => date('Y-m-d'), // Placeholder start date
                    'EndDateReservation' => date('Y-m-d', strtotime('+7 days')), // Placeholder end date (7-day reservation)
                    'OrderLinePrice' => 0.0 // Assuming articles have price data
                ];
                CrudModel::createData('OrderLines', $orderLineData);
            }
            return $_SESSION['order_id'] = $orderId; // Return the OrderID for further processing or confirmation
        
    }


    // fix this function to return the data needed for the checkout view
    //
    //
    //
    //
    public function getCheckoutViewData($orderId): array {
        // 1. Get order info
        $orderData = new Orders(...array_values(CrudModel::readAllById('Orders', 'OrderID', $orderId)));
        $orderData = $orderData->createAssociativeArray();
        // 2. Get customer info
        $customerId = $orderData['CustomerID'];
        $customerData = new Customers(...array_values(CrudModel::readAllById('Customers', 'CustomerID', $customerId)));
        $customerData = $customerData->createAssociativeArray();

        // 3. Get user info (from UserAccounts)

        if ($customerId) {
            $userData = new UserAccounts(...array_values(CrudModel::readAllById('UserAccounts', 'CustomerID', $customerId)));
            $userData = $userData->createAssociativeArray();
        }

        // 4. Get order lines
        $orderLines = CrudModel::readAllByColumn('OrderLines', 'OrderID', $orderId);

        // 5. Get article info for each order line
        $articles = [];
        $quantity = [];
        $orderLineData = [];
        foreach ($orderLines as $orderLine) {
            $orderLine = new OrderLines(...array_values($orderLine));
            $orderLine = $orderLine->createAssociativeArray();
            $articleId = $orderLine['ArticleID'];
            $articleData = new Articles(...array_values(CrudModel::readAllById('Articles', 'ArticleID', $articleId)));
            $articleData = $articleData->createAssociativeArray();
            if (!empty($articleData)) {
                $quantity[] = $orderLine['Quantity'];
                $orderLineData[] = $orderLine;
                $articles[] = $articleData;

            }
        }

        return [
            'order' => $orderData,
            'user' => $userData,
            'customer' => $customerData,
            'quantity' => $quantity,
            'orderLines' => $orderLineData,
            'articles' => $articles
        ];
    }
}

