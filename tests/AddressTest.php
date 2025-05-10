<?php 
use PHPUnit\Framework\TestCase;


include_once "../project_root/Models/Addresses.php";



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