<?php
// CartHandler.php
// Object-georiënteerde cart-handler, met BCMath en zonder floats
require_once(__DIR__ . '/../project_root/Core/Session.php');
require_once __DIR__ . '/../project_root/Core/Database.php';            
require_once __DIR__ . '/../project_root/Repositories/ArticlesRepository.php';
require_once __DIR__ . '/../project_root/Models/CrudModel.php';

use Models\CrudModel;
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


public function checkout(string $postalCode, string $houseNumber): int
{
    Session::start();
    $cart = Session::get('cart') ?: [];
    if (empty($cart)) {
        throw new \Exception("Winkelwagen is leeg.");
    }

    // Haal CustomerID op
    $customerId = CrudModel::getForeignKeyValue(
        'UserAccounts', 'EmailAddress', Session::get('user_email'), 'CustomerID'
    );
    if (!$customerId) {
        throw new \Exception("Geen klant gekoppeld.");
    }

    // 1) Zorg dat adres bestaat

$exists = CrudModel::checkRecordExists('Addresses', [
  'PostalCode'  => $postalCode,
  'HouseNumber' => $houseNumber,
]);

if (!$exists) {
    // Alleen als nog niet bestaat, toevoegen
    CrudModel::createData('Addresses', [
        'PostalCode'   => $postalCode,
        'HouseNumber'  => $houseNumber,
        'StreetName'   => '',
        'City'         => '',
        'Country'      => 'Nederland',
    ]);
}


    // 2) Insert order
    CrudModel::createData('Orders', [
        'OrderDate'      => date('Y-m-d'),
        'PaymentStatus'  => 0,
        'PostalCode'     => $postalCode,
        'HouseNumber'    => $houseNumber,
        'OrderStatus'    => 'Pending',
        'CustomerID'     => $customerId,
    ]);

    // Haal nieuw OrderID (PDO nodig hiervoor)
    $pdo = Database::getConnection();
    $orderId = (int)$pdo->lastInsertId();

    // 3) Insert orderregels én update stock
    foreach ($cart as $articleId => $qty) {
        // OrderLine
        CrudModel::createData('OrderLines', [
            'OrderID'              => $orderId,
            'PartnerID'            => 1,
            'ArticleID'            => $articleId,
            'Quantity'             => $qty,
            'StartDateReservation' => date('Y-m-d'),
            'EndDateReservation'   => date('Y-m-d', strtotime('+7 days')),
            'OrderLinePrice'       => 0.00,
        ]);

        // Stock bijwerken (aftrekken)
        // Stel dat Stock-tabel kolommen: ArticleID, PartnerID, QuantityOfStock, Price, DateAdded, InternalReference
        // Lees huidige stock
        $stockRow = CrudModel::readAllById('Stock', 'ArticleID', $articleId);
        if ($stockRow) {
            $newStock = max(0, $stockRow['QuantityOfStock'] - $qty);
            CrudModel::updateData('Stock', [
                'ArticleID'       => $articleId,
                'PartnerID'       => $stockRow['PartnerID'],
                'QuantityOfStock' => $newStock,
                'Price'           => $stockRow['Price'],
                'DateAdded'       => $stockRow['DateAdded'],
                'InternalReference'=> $stockRow['InternalReference'],
            ]);
        }
    }

    // 4) Leeg cart
    Session::remove('cart');

    return $orderId;
}
}
