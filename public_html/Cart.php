<?php
require_once '../project_root/Core/Session.php';
require_once '../project_root/Models/Stock.php';
require_once '../project_root/Models/CrudModel.php';

use Core\Session;
use Models\Stock;
use Models\CrudModel;

/**
 * Check if the user is logged in; if not, redirect to login page.
 */
if (!Session::exists('user_email')) {
    header('Location: inloggen.php');
    exit;
}

require_once 'CartHandler.php';
$cartHandler = new CartHandler();

require_once 'Lang/translator.php';
/** @var object $translator Translator object for multi-language support. */
$translator = init_translator();

require_once '../project_root/Helpers/ViewHelper.php';

use Helpers\ViewHelper;

require_once '../project_root/Models/CrudModel.php';
require_once '../project_root/Core/Database.php';

/**
 * Handle adding a product to the cart.
 */
// Verwerken winkelwagen toevoeging via CartHandler
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $productId = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT, ['options' => ['default' => 1, 'min_range' => 1]]);

    if ($productId && $quantity > 0) {
        $cartHandler->addToCart($productId, $quantity);;
        exit();
    }
}
/**
 * Handle checkout: process the order if the cart is not empty.
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    if (!empty($_SESSION['cart'])) {
        $checkoutData = $cartHandler->getCheckoutData(Session::get('user_email'), array_keys($_SESSION['cart']));
        $cartHandler->processOrder($checkoutData, $_SESSION['cart']);
    }
    header('Location: checkout.php');
    exit();
}
/**
 * Load the product list controller and extract articles.
 * @var array $data Data returned from the controller.
 * @var array $artikelen List of article objects.
 */
$data = require __DIR__ . '/../project_root/Controllers/product_list_controller.php';
$artikelen = $data['artikelen'] ?? [];

/**
 * Get the current cart items.
 * @var array $cartItems Associative array of productId => quantity.
 */
$cartItems = $cartHandler->getCartItems();

/**
 * Handle removing a product from the cart or updating quantities.
 */
// Verwerken verwijderen product uit winkelwagen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remove_product_id'])) {
        $productIdToRemove = filter_input(INPUT_POST, 'remove_product_id', FILTER_VALIDATE_INT);
        if ($productIdToRemove) {
            $cartHandler->removeFromCart($productIdToRemove);
            header('Location: Cart.php');
            exit();
        }
    }

    if (isset($_POST['update_quantities'])) {
        foreach ($_POST['quantities'] as $productId => $quantity) {
            $productId = (int)$productId;
            $quantity = (int)$quantity;
            if ($quantity <= 0) {
                $cartHandler->removeFromCart($productId);
            } else {
                // Voor nu verwijderen en opnieuw toevoegen:
                $cartHandler->removeFromCart($productId);
                $cartHandler->addToCart($productId, $quantity);
            }
        }
        header('Location: Cart.php');
        exit();
    }
}

/**
 * Calculate the total price of the cart.
 * @var decimal $totaalPrijs The total price of all items in the cart.
 */
// Bereken totaal (prijs staat nu op 0 omdat die nog niet is gedefinieerd)

$totaalPrijs = 0.00;
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title> <?= $translator->get('cart_title'); ?> </title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <header><?php include 'header.php'; ?></header>

    <main class="cart-container">
        <h2><?= $translator->get('cart_title'); ?></h2>

        <?php if (empty($cartItems)): ?>
            <p><?= $translator->get('cart_empty'); ?></p>
        <?php else: ?>
            <form method="post" action="Cart.php" class="cart-form">
                <table>
                    <thead>
                        <tr>
                            <th><?= $translator->get('cart_table_product'); ?></th>
                            <th><?= $translator->get('cart_table_price'); ?></th>
                            <th><?= $translator->get('cart_table_quantity'); ?></th>
                            <th><?= $translator->get('cart_table_subtotal'); ?></th>
                            <th><?= $translator->get('cart_table_actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartItems as $productId => $quantity): ?>
                            <?php
                            $stock = new Stock(...array_values(CrudModel::readAllByTwoKeys('Stock', 'ArticleID', $productId, 'PartnerID', 1)));
                            $stock = $stock->createAssociativeArray();
                            $prijs = $stock['Price']; 
                            $totaalPrijs += $prijs * $quantity;
                            $artikel = null;
                            foreach ($artikelen as $a) {
                                if ($a->getArticleID() == $productId) {
                                    $artikel = $a;
                                    break;
                                }
                            }
                            if (!$artikel) continue; // Product bestaat niet meer
                            
                            $subtotal = $prijs * $quantity;
                            ?>
                            <tr>
                                <td><?= ViewHelper::e($artikel->getArticleName()); ?></td>
                                <td>€<?= number_format($prijs, 2, ',', '.'); ?></td>
                                <td>
                                    <input
                                        type="number"
                                        name="quantities[<?= ViewHelper::e($productId); ?>]"
                                        value="<?= ViewHelper::e($quantity); ?>"
                                        min="0" max="99"
                                        required>
                                </td>
                                <td>€<?= number_format($subtotal, 2, ',', '.'); ?></td>
                                <td>

                                            <button type="submit" name="remove_product_id" value="<?= ViewHelper::e($productId); ?>" onclick="return confirm('<?= addslashes($translator->get('remove_product_confirmation')); ?>')">

                                                <?= $translator->get('cart_remove_button'); ?>
                                            </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr><td class="totalamount" colspan="4">Totaalprijs:</td>
                        <td><?= htmlspecialchars($totaalPrijs ?? '') ?></td>
                        </tr>
                    </tbody>
                </table>

                <p><strong><?= $translator->get('cart_total'); ?>:</strong> €<?= number_format($totaalPrijs, 2, ',', '.'); ?></p>

                <button type="submit" name="update_quantities"><?= $translator->get('cart_update_button'); ?></button>
                <button type="submit" name="checkout"><?= $translator->get('cart_checkout_button'); ?></button>
            </form>
        <?php endif; ?>

        <!-- Deze knop is altijd zichtbaar -->
        <a href="productpagina.php" class="button-back"><?= $translator->get('cart_continue_shopping'); ?></a>
    </main>

    <footer><?php include 'footer.php'; ?></footer>

    <script src="js/scripts.js"></script>




</body>

</html>