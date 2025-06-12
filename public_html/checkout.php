<?php
require_once __DIR__ . '/../project_root/Core/Session.php';
require_once __DIR__ . '/../project_root/Core/Database.php';
require_once __DIR__ . '/../project_root/Repositories/ArticlesRepository.php';
require_once __DIR__ . '/CartHandler.php';

use Core\Session;
use Core\Database;
use Repositories\ArticlesRepository;

// 1) Start sessie & login-check
Session::start();
if (!Session::exists('user_email')) {
    header('Location: inloggen.php');
    exit;
}

// 2) Maak repository & handler
$pdo         = Database::getConnection();
$repo        = new ArticlesRepository($pdo);
$cartHandler = new CartHandler($repo, 1);

// 3) Verwerk checkout-formulier
$success      = false;
$errorMessage = '';
$orderId      = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postalCode  = trim($_POST['PostalCode']  ?? '');
    $houseNumber = trim($_POST['HouseNumber'] ?? '');

    try {
        // Gebruik hier wél de bestaande handler
        $orderId = $cartHandler->checkout($postalCode, $houseNumber);
        $success = true;
    } catch (\Exception $e) {
        $errorMessage = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Afrekenen</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <header><?php include 'header.php'; ?></header>
  <main class="checkout-container">
    <?php if ($success): ?>
      <h1>Bedankt! Je bestelling #<?= htmlspecialchars($orderId) ?> is geplaatst.</h1>
      <p>Je ontvangt per e-mail een bevestiging van je bestelling.</p>
      <a href="index.php">Verder winkelen</a>
    <?php else: ?>
      <?php if ($errorMessage): ?>
        <div class="error">
          <?= htmlspecialchars($errorMessage) ?>
        </div>
      <?php endif; ?>
      <h2>Bevestig je gegevens</h2>
      <form method="post" class="checkout-form">
        <label>
          Postcode:
          <input type="text" name="PostalCode" value="<?= htmlspecialchars($postalCode ?? '') ?>" required>
        </label>
        <label>
          Huisnummer:
          <input type="text" name="HouseNumber" value="<?= htmlspecialchars($houseNumber ?? '') ?>" required>
        </label>
        <button type="submit"><?= $translator->get('checkout_place_order_button') ?? 'Bestelling plaatsen' ?></button>
      </form>
    <?php endif; ?>
  </main>
  <footer><?php include 'footer.php'; ?></footer>
</body>
</html>
