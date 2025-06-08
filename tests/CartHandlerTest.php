<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../public_html/CartHandler.php';

class CartHandlerTest extends TestCase
{
    protected function setUp(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['cart'] = [];
    }

    public function testAddItemToCart()
    {
        $handler = new CartHandler();
        $handler->addToCart(1, 2);

        $this->assertArrayHasKey(1, $_SESSION['cart']);
        $this->assertEquals(2, $_SESSION['cart'][1]);
    }

    public function testUpdateQuantityInCart()
    {
        $_SESSION['cart'] = [1 => 2];
        $handler = new CartHandler();
        $handler->addToCart(1, 3);

        $this->assertEquals(5, $_SESSION['cart'][1]);
    }

    public function testRemoveItemFromCart()
    {
        $_SESSION['cart'] = [1 => 2, 2 => 3];
        $handler = new CartHandler();
        $handler->removeFromCart(1);

        $this->assertArrayNotHasKey(1, $_SESSION['cart']);
        $this->assertArrayHasKey(2, $_SESSION['cart']);
    }
}

