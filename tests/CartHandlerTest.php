<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../project_root/Controllers/CartHandler.php';

class CartHandlerTest extends TestCase
{
    private $handler;

    protected function setUp(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['cart'] = [];
        $this->handler = new CartHandler();
    }

    public function testAddItemToCart()
    {
        $this->handler->addToCart(1, 2);

        $this->assertArrayHasKey(1, $_SESSION['cart']);
        $this->assertEquals(2, $_SESSION['cart'][1]);
    }

    public function testUpdateQuantityInCart()
    {
        $_SESSION['cart'] = [1 => 2];
        $this->handler->addToCart(1, 3);

        $this->assertEquals(5, $_SESSION['cart'][1]);
    }

    public function testRemoveItemFromCart()
    {
        $_SESSION['cart'] = [1 => 2, 2 => 3];
        $this->handler->removeFromCart(1);

        $this->assertArrayNotHasKey(1, $_SESSION['cart']);
        $this->assertArrayHasKey(2, $_SESSION['cart']);
    }
}
