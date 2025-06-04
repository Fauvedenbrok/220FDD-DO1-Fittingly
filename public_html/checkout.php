<?php
require_once '../project_root/Core/Session.php';
use Core\Session;
if (!Session::exists('user_email')) {
    header('Location: inloggen.php');
    exit;
}
require_once 'CartHandler.php';

$cartHandler = new CartHandler();
$userId = $_SESSION['user_email'] ?? null; // Or however you store the logged-in user
$orderId = $_SESSION['order_id'] ?? null; // Assuming you have an order ID in the session
$checkoutData = $cartHandler->getCheckoutViewData($orderId);
?>

<h1>Bestelling Overzicht</h1>

<h2>Klantgegevens</h2>
<ul>
    <li>Naam: <?= htmlspecialchars(($checkoutData['customer']['FirstName'] ?? '') . ' ' . ($checkoutData['customer']['LastName'] ?? '')) ?></li>
    <li>Email: <?= htmlspecialchars($checkoutData['user']['EmailAddress'] ?? '') ?></li>
    <li>Adres: <?= htmlspecialchars(($checkoutData['customer']['PostalCode'] ?? '') . ' ' . ($checkoutData['customer']['HouseNumber'] ?? '')) ?></li>
</ul>

<h2>Artikelen in winkelwagen</h2>
<table>
    <tr>
        <th>Artikel ID</th>
        <th>Naam</th>
        <th>Aantal</th>
        <th>Categorie</th>
        <th>Kleur</th>
    </tr>
    <?php foreach ($checkoutData['articles'] as $article): ?>
        <tr>
            <td><?= htmlspecialchars($article['ArticleID']) ?></td>
            <td><?= htmlspecialchars($article['Name'] ?? '') ?></td>
            <td><?= htmlspecialchars($quantity) ?></td>
            <td><?= htmlspecialchars($article['Category'] ?? '') ?></td>
            <td><?= htmlspecialchars($article['Color'] ?? '') ?></td>
        </tr>
    <?php endforeach; ?>
</table>