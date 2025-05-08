<?php 
use PHPUnit\Framework\TestCase;
include "Models\Addresses.php"; // Assuming the class is in the Models namespace

class AddressTest extends TestCase
{
    private $address;

    protected function setUp(): void
    {
        $this->address = new Addresses("1234AB", "12", "Main Street", "Amsterdam", "Netherlands");
    }

    public function testToString()
    {
        $this->assertEquals("1234AB, 12, Main Street, Amsterdam, Netherlands", (string)$this->address);
    }
}