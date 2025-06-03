<?php
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
}
?>
