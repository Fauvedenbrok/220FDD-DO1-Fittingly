<?php 
use PHPUnit\Framework\TestCase;
use Models\Addresses;
use SebastianBergmann\Type\VoidType;

use function PHPUnit\Framework\once;


require_once dirname(__DIR__) . '/project_root/Controllers/admin_searchwords_controller.php';
require_once dirname(__DIR__) . '/project_root/Models/Addresses.php';



class AddressTest extends TestCase
{
    private $address;

    function setUp(): void
    {
        $this->address = new Addresses("1234AB", "12", "Main Street", "Amsterdam", "Netherlands");
    }

    public function testtoString()
    {
        $this->assertEquals("1234AB, 12, Main Street, Amsterdam, Netherlands", 
        (string)$this->address);
    }
}

