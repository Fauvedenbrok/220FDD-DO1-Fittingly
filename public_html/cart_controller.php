<?php
// cart_controller.php in public_html/

// Juiste paden naar Core, Database, etc. in project_root
require_once __DIR__ . '/../project_root/Core/Session.php';
require_once __DIR__ . '/../project_root/Core/Database.php';
require_once __DIR__ . '/../project_root/Repositories/ArticlesRepository.php';

// CartHandler staat in public_html zelf
require_once __DIR__ . '/CartHandler.php';

use Core\Session;
use Core\Database;
use Repositories\ArticlesRepository;

// 1) Check login
if (!Session::exists('user_email')) {
    header('Location: inloggen.php');
    exit;
}

// 2) Bootstrap handler met repo en partnerId=1
$pdo         = Database::getConnection();
$repo        = new ArticlesRepository($pdo);
$cartHandler = new CartHandler($repo, 1);

// 3) Afhandelen van POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Toevoegen
    if (isset($_POST['add_to_cart'], $_POST['product_id'], $_POST['quantity'])) {
        $cartHandler->add((int)$_POST['product_id'], (int)$_POST['quantity']);
        echo json_encode(['status'=>'ok']);
        exit;
    }
    // Verwijderen
    if (isset($_POST['remove_product_id'])) {
        $cartHandler->remove((int)$_POST['remove_product_id']);
        echo json_encode(['status'=>'ok']);
        exit;
    }
    // Hoeveelheden updaten
    if (isset($_POST['quantities']) && is_array($_POST['quantities'])) {
        // keys en values casten naar int
        $updated = array_map('intval', $_POST['quantities']);
        $cartHandler->update($updated);
        echo json_encode(['status'=>'ok']);
        exit;
    }
}

// 4) Bij GET: render view of JSON teruggeven naar JS?
if (isset($_GET['format']) && $_GET['format']==='json') {
    header('Content-Type: application/json');
    echo json_encode([
        'items' => $cartHandler->getItems(),
        'total' => $cartHandler->getTotal(),
    ]);
    exit;
}



