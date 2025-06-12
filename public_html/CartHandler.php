<?php
// CartHandler.php
// Object-georiënteerde cart-handler, met BCMath en zonder floats
require_once(__DIR__ . '/../project_root/Core/Session.php');
require_once __DIR__ . '/../project_root/Core/Database.php';            
require_once __DIR__ . '/../project_root/Repositories/ArticlesRepository.php';

use Core\Database;  
use Core\Session;
use Repositories\ArticlesRepository;
use Models\Articles;
 
class CartItem
{
    private Articles $article;
    private int $quantity;

    public function __construct(Articles $article, int $quantity)
    {
        $this->article  = $article;
        $this->quantity = $quantity;
    }

    public function getArticle(): Articles
    {
        return $this->article;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return string Price as decimal string, e.g. "12.34"
     */
    public function getPrice(): string
    {
        return $this->article->getPrice();
    }

    /**
     * @return string Subtotal = price * quantity
     */
    public function getSubtotal(): string
    {
        return bcmul($this->getPrice(), (string)$this->quantity, 2);
    }
}

class CartHandler
{
    private ArticlesRepository $repo;
    private int $partnerId;

    public function __construct(ArticlesRepository $repo, int $partnerId = 1)
    {
        $this->repo      = $repo;
        $this->partnerId = $partnerId;

        if (!Session::exists('cart')) {
            Session::set('cart', []);
        }
    }

       public function add(int $articleId, int $qty): void
    {
        $cart = Session::get('cart');
        $cart[$articleId] = ($cart[$articleId] ?? 0) + $qty;
        Session::set('cart', $cart);
    }

    public function remove(int $articleId): void
    {
        $cart = Session::get('cart');
        unset($cart[$articleId]);
        Session::set('cart', $cart);
    }

    public function update(array $quantities): void
    {
        $cart = Session::get('cart');
        foreach ($quantities as $id => $qty) {
            $qty = (int)$qty;
            if ($qty <= 0) {
                unset($cart[$id]);
            } else {
                $cart[$id] = $qty;
            }
        }
        Session::set('cart', $cart);
    }

    public function clear(): void
    {
        Session::set('cart', []);
    }

    /**
     * @return CartItem[]
     */
    public function getItems(): array
    {
        $items = [];
        $cart = Session::get('cart');
        
        foreach ($cart as $id => $qty) {
            $article = $this->repo->findById($id, $this->partnerId);
            if ($article instanceof Articles) {
                $items[] = new CartItem($article, $qty);
            }
        }
        return $items;
    }

    /**
     * @return string Total as decimal string
     */
    public function getTotal(): string
    {
        $total = '0.00';
        foreach ($this->getItems() as $item) {
            $total = bcadd($total, $item->getSubtotal(), 2);
        }
        return $total;
    }


/**
 * Plaatst een order en orderregels in de database, en leegt daarna de cart.
 *
 * @param string $postalCode   De postcode van de klant
 * @param string $houseNumber  Het huisnummer van de klant
 * @return int                 De nieuw aangemaakte OrderID
 * @throws Exception           Bij fouten in de database-operaties
 */
public function checkout(string $postalCode, string $houseNumber): int
{
    // Zorg dat de sessie loopt en cart beschikbaar is
    Session::start();
    $cart = Session::get('cart') ?: [];
    if (empty($cart)) {
        throw new \Exception("Winkelwagen is leeg.");
    }

    $pdo = Database::getConnection();
    // Haal CustomerID op uit de ingelogde user
    $emailStmt = $pdo->prepare("SELECT CustomerID FROM UserAccounts WHERE EmailAddress = ?");
    $emailStmt->execute([Session::get('user_email')]);
    $customerId = $emailStmt->fetchColumn();
    if (!$customerId) {
        throw new \Exception("Geen klant gekoppeld aan deze gebruiker.");
    }

    // Start transactie
    $pdo->beginTransaction();
    try {
        // Insert order
        $orderStmt = $pdo->prepare("
            INSERT INTO Orders
            (OrderDate, PaymentStatus, PostalCode, HouseNumber, OrderStatus, CustomerID)
            VALUES (NOW(), 0, ?, ?, 'Pending', ?)
        ");
        $orderStmt->execute([$postalCode, $houseNumber, $customerId]);
        $orderId = (int)$pdo->lastInsertId();

        // Insert orderregels
        $lineStmt = $pdo->prepare("
            INSERT INTO OrderLines
            (OrderID, PartnerID, ArticleID, Quantity, StartDateReservation, EndDateReservation, OrderLinePrice)
            VALUES (?, 1, ?, ?, NOW(), DATE_ADD(NOW(), INTERVAL 7 DAY), 0)
        ");
        foreach ($cart as $articleId => $quantity) {
            $lineStmt->execute([$orderId, $articleId, $quantity]);
        }

        // Commit en cart legen
        $pdo->commit();
        Session::remove('cart');

        return $orderId;
    } catch (\Exception $e) {
        $pdo->rollBack();
        throw $e;
    }
}
}
