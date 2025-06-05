<?php 
use PHPUnit\Framework\TestCase;

use Models\Database;
use Models\CrudModel;
use Models\Addresses;


require_once __DIR__ . '/../project_root/Models/CrudModel.php';
require_once __DIR__ . '/../project_root/Models/Database.php';
require_once __DIR__ . '/../project_root/Models/Addresses.php';



class CrudModelTest extends TestCase
{

    function setUp(): void
    {
        $this->address = new Addresses("1234AB", "12", "Main Street", "Amsterdam", "Netherlands");
    }

    public function testToString()
    {
        $this->assertEquals("1234AB, 12, Main Street, Amsterdam, Netherlands", $this->address->ToString());
    }
}