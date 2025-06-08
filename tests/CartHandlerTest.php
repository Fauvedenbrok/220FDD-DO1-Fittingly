<?php

use PHPUnit\Framework\TestCase;

chdir(__DIR__ . '/../public_html');

require_once 'CartHandler.php';

class CartHandlerTest extends TestCase
{
    protected function setUp(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['cart'] = [];
    }

    public function testAddToCartAddsNewProduct()
    {
        $handler = new CartHandler();
        $handler->addToCart(1, 2);

        $this->assertArrayHasKey(1, $_SESSION['cart']);
        $this->assertEquals(2, $_SESSION['cart'][1]);
    }

    public function testAddToCartUpdatesQuantity()
    {
        $_SESSION['cart'] = [1 => 2];
        $handler = new CartHandler();
        $handler->addToCart(1, 3);

        $this->assertEquals(5, $_SESSION['cart'][1]);
    }

    public function testRemoveFromCart()
    {
        $_SESSION['cart'] = [1 => 2, 2 => 3];
        $handler = new CartHandler();
        $handler->removeFromCart(1);

        $this->assertArrayNotHasKey(1, $_SESSION['cart']);
        $this->assertArrayHasKey(2, $_SESSION['cart']);
    }

    public function testGetCartItems()
    {
        $_SESSION['cart'] = [1 => 2, 2 => 3];
        $handler = new CartHandler();
        $cartItems = $handler->getCartItems();

        $this->assertEquals([1 => 2, 2 => 3], $cartItems);
    }


    public function testRemoveNonExistentProductDoesNothing()
    {
        $_SESSION['cart'] = [1 => 2];
        $handler = new CartHandler();
        $handler->removeFromCart(99);

        $this->assertArrayHasKey(1, $_SESSION['cart']);
        $this->assertCount(1, $_SESSION['cart']);
    }

    public function testGetCartItemsReturnsEmptyArrayWhenCartIsEmpty()
    {
        $_SESSION['cart'] = [];
        $handler = new CartHandler();
        $cartItems = $handler->getCartItems();

        $this->assertEmpty($cartItems);
    }

    public function testMultipleAdditionsOfDifferentProducts()
    {
        $handler = new CartHandler();
        $handler->addToCart(1, 1);
        $handler->addToCart(2, 2);
        $handler->addToCart(3, 3);

        $this->assertCount(3, $_SESSION['cart']);
        $this->assertEquals(1, $_SESSION['cart'][1]);
        $this->assertEquals(2, $_SESSION['cart'][2]);
        $this->assertEquals(3, $_SESSION['cart'][3]);
    }
}
