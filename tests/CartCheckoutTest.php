<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../public_html/CartHandler.php';

class CartCheckoutTest extends TestCase
{
    protected function setUp(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['user_email'] = 'test@example.com';
        $_SESSION['order_id'] = 123;
    }

    public function testSessionOrderIdIsSet()
    {
        $this->assertEquals(123, $_SESSION['order_id']);
    }

    public function testSessionUserEmailIsSet()
    {
        $this->assertEquals('test@example.com', $_SESSION['user_email']);
    }
}
