<?php
/**
 * checkout.php
 *
 * Checkout page for displaying the order summary to the user.
 * - Checks if the user is logged in.
 * - Loads the CartHandler and retrieves checkout data.
 * - Displays customer and order information.
 * - Sends an order confirmation email to the customer.
 * - Shows a table with all ordered articles, their quantities, and total price.
 * - Clears the cart after checkout.
 *
 * Variables:
 * @var CartHandler $cartHandler Handles cart and checkout operations.
 * @var string|null $userId      The email address of the logged-in user.
 * @var int|null $orderId        The ID of the current order.
 * @var array $checkoutData      Contains 'order', 'user', 'customer', 'quantity', 'orderLines', and 'articles'.
 * @var object $translator       Translator object for multilingual support.
 * @var array $orderMailData     Data for the order confirmation email.
 * @var float $totalamount       The total price of all items in the order.
 */

use Core\Session;
use Models\Articles;

require_once '../project_root/Core/Session.php';
require_once __DIR__ . '/../project_root/Models/Articles.php';

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
 * Send order confirmation email using the Mailer class.
 */
require_once '../project_root/Controllers/Mailer.php';
require_once '../public_html/Lang/Translator.php';

$config = require '../project_root/config.php';
$translator = init_translator();

$mailer = new Mailer($config, $translator);

/**
 * Prepare the data needed for the order confirmation email.
 * - Includes email address, customer name, orderId, articles, and quantities.
 * @var array $orderMailData
 */
$orderMailData = [
    'email' => $checkoutData['user']['EmailAddress'] ?? '',
    'name' => ($checkoutData['customer']['FirstName'] ?? '') . ' ' . ($checkoutData['customer']['LastName'] ?? ''),
    'orderId' => $orderId,
    'articles' => $checkoutData['articles'],
    'quantities' => $checkoutData['quantity']
];

// Send the email
$mailer->sendOrderConfirmationMail($orderMailData);

$totalamount = 0;
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

<main class="checkout-container">
<h1>Bestelling Overzicht</h1>

<h2>Klantgegevens</h2>
<ul>
    <li>Naam: <?= htmlspecialchars(($checkoutData['customer']['FirstName'] ?? '') . ' ' . ($checkoutData['customer']['LastName'] ?? '')) ?></li>
    <li>Email: <?= htmlspecialchars($checkoutData['user']['EmailAddress'] ?? '') ?></li>
    <li>Adres: <?= htmlspecialchars(($checkoutData['customer']['PostalCode'] ?? '') . ' ' . ($checkoutData['address']['City'] ?? '')) ?> <br>
    <?= htmlspecialchars(($checkoutData['address']['StreetName'] ?? '') . ' ' . ($checkoutData['customer']['HouseNumber'] ?? '')) ?></li>
</ul>

<h2>Artikelen in winkelwagen</h2>
<table>
    <tr>
        <th>Artikel ID</th>
        <th>Naam</th>
        <th>Aantal</th>
        <th>Categorie</th>
        <th>Kleur</th>
        <th>Prijs</th>
        <th>Afbeelding</th>
    </tr>
    <?php foreach ($checkoutData['articles'] as $item): 
            $article = new Articles(...array_values($item));
            $articleInfo = $article->createAssociativeArray();
            $quantity = $checkoutData['quantity'][$articleInfo['ArticleID']];
            $price = $checkoutData['price'][$articleInfo['ArticleID']] * $quantity;
            $totalamount += $price;
            ?>
        <tr>
            <td><?= htmlspecialchars($articleInfo['ArticleID']) ?></td>
            <td><?= htmlspecialchars($articleInfo['Name'] ?? '') ?></td>
            <td><?= htmlspecialchars($quantity ?? '') ?></td>
            <td><?= htmlspecialchars($articleInfo['Category'] ?? '') ?></td>
            <td><?= htmlspecialchars($articleInfo['Color'] ?? '') ?></td>
            <td><?= htmlspecialchars($price ?? '') ?></td>
            <td>
                <?php if($article->imageExists()): ?>
                        <img src="/public_html/<?= $article->getImageUrl(); ?>" alt="Afbeelding van <?= htmlspecialchars($article->getArticleName()); ?>">
                        <!--
                        /** Loads placeholder if no image is available. */
                        -->
                        <?php else: ?>
                        <img src="/Images/productImages/1.jpg" alt="Geen afbeelding beschikbaar">
                        <!--
                        /** Shows article availability. */
                        -->
                        <?php endif; ?></td>
        </tr>
    <?php endforeach; ?>
    <tr><td class="totalamount" colspan="6">Totaalprijs:</td>
    <td><?= htmlspecialchars($totalamount ?? '') ?></td>
    </tr>
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
Session::remove('cart'); 
?>
