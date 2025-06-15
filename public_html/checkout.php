<?php
require_once '../project_root/Core/Session.php';
use Core\Session;
/**
 * Checkout page for displaying the order summary to the user.
 *
 * - Checks if the user is logged in.
 * - Loads the CartHandler and retrieves checkout data.
 * - Displays customer and order information.
 *
 * @package Public
 */

// Check if the user is logged in; if not, redirect to login page.
if (!Session::exists('user_email')) {
    header('Location: inloggen.php');
    exit;
}
require_once 'CartHandler.php';

/** @var CartHandler $cartHandler Handles cart and checkout operations. */
$cartHandler = new CartHandler();
/** @var string|null $userId The email address of the logged-in user. */
$userId = $_SESSION['user_email'] ?? null;
/** @var int|null $orderId The ID of the current order. */
$orderId = $_SESSION['order_id'] ?? null;

/**
 * Retrieve all data needed for the checkout view.
 * @var array $checkoutData Contains 'order', 'user', 'customer', 'quantity', 'orderLines', and 'articles'.
 */
$checkoutData = $cartHandler->getCheckoutViewData($orderId);

/**
 * Verstuur bestelbevestiging per e-mail met behulp van de Mailer class.
 */
require_once '../project_root/send_mail.php';
require_once '../project_root/Lang/translator.php';

$config = require '../project_root/config.php';
$translator = init_translator();

$mailer = new Mailer($config, $translator);

/**
 * Stel de data samen die nodig is voor de orderbevestiging
 * - Dit bevat e-mailadres, klantnaam, orderId, artikelen en hoeveelheden
 */
$orderMailData = [
    'email' => $checkoutData['user']['EmailAddress'] ?? '',
    'name' => ($checkoutData['customer']['FirstName'] ?? '') . ' ' . ($checkoutData['customer']['LastName'] ?? ''),
    'orderId' => $orderId,
    'articles' => $checkoutData['articles'],
    'quantities' => $checkoutData['quantity']
];

// Verzend de e-mail
$mailer->sendOrderConfirmationMail($orderMailData);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Overzicht Bestelling</title>
   <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="css/product.css">
</head>
<body>

<header>
    <?php require_once 'header.php'; ?>
</header>

<main>
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
            <td><?= htmlspecialchars($checkoutData['quantity'][$article['ArticleID']]) ?></td>
            <td><?= htmlspecialchars($article['Category'] ?? '') ?></td>
            <td><?= htmlspecialchars($article['Color'] ?? '') ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</main>
<footer>
    <?php require_once 'footer.php' ?>
</footer>
</body>
</html>

<?php
/**
 * Clear the cart after checkout.
 */
Session::remove('cart'); // Clear the cart after checkout
?>
