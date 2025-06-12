<?php
require_once __DIR__ . '/Lang/translator.php';
require_once __DIR__ . '/../project_root/Core/Session.php';
require_once __DIR__ . '/../project_root/Core/Database.php';
require_once __DIR__ . '/../project_root/Repositories/ArticlesRepository.php';
require_once __DIR__ . '/../project_root/Helpers/ViewHelper.php';
require_once __DIR__ . '/CartHandler.php'; 

use Helpers\ViewHelper;
use Repositories\ArticlesRepository;
use Core\Database;
use Core\Session;


// Check login
if (!Session::exists('user_email')) {
    header('Location: inloggen.php');
    exit;
}

// Initializeer CartHandler
$pdo = Database::getConnection();
$repo = new ArticlesRepository($pdo);
$cartHandler = new CartHandler($repo, 1);

// Haal winkelwagen data direct op
$viewData = [
    'items' => $cartHandler->getItems(),
    'total' => $cartHandler->getTotal(),
];

$translator = init_translator();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title><?= $translator->get('cart_title'); ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <header><?php include 'header.php'; ?></header>

    <main class="cart-container">
        <h2><?= $translator->get('cart_title'); ?></h2>

        <?php if (empty($viewData['items'])): ?>
            <p><?= $translator->get('cart_empty'); ?></p>
        <?php else:
// echo "<pre>SESSIE DEBUG:\n";
// var_dump($_SESSION);
// echo "\nWAGEN DEBUG:\n";
// var_dump($viewData);
// exit; ?>
            
            <form id="cart-form" class="cart-form">
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
<?php foreach ($viewData['items'] as $item): 
    $article = $item->getArticle();
    $articleId = $article->getArticleID();
?>
    <tr data-article-id="<?= ViewHelper::e($articleId); ?>">
        <td><?= ViewHelper::e($article->getArticleName()); ?></td>
        <td>€<?= number_format($item->getPrice(), 2, ',', '.'); ?></td>
        <td>
            <input
                type="number"
                name="quantities[<?= ViewHelper::e($articleId); ?>]"
                value="<?= ViewHelper::e($item->getQuantity()); ?>"
                min="0" max="99" required>
        </td>
        <td>€<?= number_format($item->getSubtotal(), 2, ',', '.'); ?></td>
        <td>
            <button
                type="button"
                class="remove-btn"
                data-remove-id="<?= ViewHelper::e($articleId); ?>">
                <?= $translator->get('cart_remove_button'); ?>
            </button>
        </td>
    </tr>
<?php endforeach; ?>
                    </tbody>
                </table>

                <p><strong><?= $translator->get('cart_total'); ?>:</strong>
                   €<?= number_format($viewData['total'], 2, ',', '.'); ?></p>

                <button type="button" id="update-btn">
                    <?= $translator->get('cart_update_button'); ?>
                </button>
                <button type="button" id="checkout-btn">
                    <?= $translator->get('cart_checkout_button'); ?>
                </button>
            </form>
        <?php endif; ?>

        <a href="productpagina.php" class="button-back">
            <?= $translator->get('cart_continue_shopping'); ?>
        </a>
    </main>

    <footer><?php include 'footer.php'; ?></footer>

    <script src="js/cart-popup.js"></script>
</body>
</html>
