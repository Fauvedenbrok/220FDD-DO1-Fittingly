<?php

use PHPUnit\Framework\TestCase;

// Verander naar de juiste werkdirectory
chdir(__DIR__ . '/../public_html');

// Laad CartHandler
require_once 'CartHandler.php';

class CartCheckoutTest extends TestCase
{
    protected function setUp(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Zet testdata in de sessie
        $_SESSION['user_email'] = 'test@example.com';
        $_SESSION['order_id'] = 123;
    }

    public function testGetCheckoutViewDataStructure()
    {
        $handler = $this->getMockBuilder(CartHandler::class)
                        ->onlyMethods(['getCheckoutViewData'])
                        ->getMock();

        $expected = [
            'order' => ['id' => 123],
            'user' => ['EmailAddress' => 'test@example.com'],
            'customer' => ['FirstName' => 'Test', 'LastName' => 'Gebruiker'],
            'quantity' => [1 => 2],
            'orderLines' => [],
            'articles' => [
                ['ArticleID' => 1, 'Name' => 'Test Artikel', 'Category' => 'Test', 'Color' => 'Zwart']
            ]
        ];

        $handler->method('getCheckoutViewData')->willReturn($expected);

        $data = $handler->getCheckoutViewData($_SESSION['order_id']);

        $this->assertArrayHasKey('order', $data);
        $this->assertArrayHasKey('user', $data);
        $this->assertArrayHasKey('customer', $data);
        $this->assertArrayHasKey('quantity', $data);
        $this->assertArrayHasKey('articles', $data);
        $this->assertEquals('test@example.com', $data['user']['EmailAddress']);
        $this->assertEquals(2, $data['quantity'][1]);
        $this->assertEquals('Test Artikel', $data['articles'][0]['Name']);
    }

    public function testGetCheckoutViewDataWithoutOrderId()
    {
    // Zet order_id niet in de sessie
    unset($_SESSION['order_id']);

    // Mock CartHandler zodat het geen echte Orders probeert te laden
    $handler = $this->getMockBuilder(CartHandler::class)
                    ->onlyMethods(['getCheckoutViewData'])
                    ->getMock();

    $handler->method('getCheckoutViewData')->willReturn([
        'order' => null,
        'user' => null,
        'customer' => null,
        'quantity' => [],
        'orderLines' => [],
        'articles' => [],
    ]);

    $data = $handler->getCheckoutViewData(null);

    $this->assertNull($data['order']);
    $this->assertEmpty($data['articles']);
    }

    public function testCustomerDataStructure()
    {
        $handler = $this->getMockBuilder(CartHandler::class)
                        ->onlyMethods(['getCheckoutViewData'])
                        ->getMock();

        $handler->method('getCheckoutViewData')->willReturn([
            'customer' => ['FirstName' => 'Jan', 'LastName' => 'Jansen'],
            'user' => [], 'order' => [], 'quantity' => [], 'articles' => [], 'orderLines' => []
        ]);

        $data = $handler->getCheckoutViewData(123);
        $this->assertEquals('Jan', $data['customer']['FirstName']);
    }

    public function testMultipleArticlesWithQuantities()
    {
        $handler = $this->getMockBuilder(CartHandler::class)
                        ->onlyMethods(['getCheckoutViewData'])
                        ->getMock();

        $mockData = [
            'order' => [],
            'user' => ['EmailAddress' => 'multi@test.com'],
            'customer' => ['FirstName' => 'Multi', 'LastName' => 'Tester'],
            'quantity' => [1 => 1, 2 => 2],
            'orderLines' => [],
            'articles' => [
                ['ArticleID' => 1, 'Name' => 'Artikel Eén', 'Category' => 'Cat1', 'Color' => 'Rood'],
                ['ArticleID' => 2, 'Name' => 'Artikel Twee', 'Category' => 'Cat2', 'Color' => 'Blauw']
            ]
        ];

        $handler->method('getCheckoutViewData')->willReturn($mockData);

        $data = $handler->getCheckoutViewData(123);

        $this->assertCount(2, $data['articles']);
        $this->assertEquals('Artikel Eén', $data['articles'][0]['Name']);
        $this->assertEquals(2, $data['quantity'][2]);
    }
}
