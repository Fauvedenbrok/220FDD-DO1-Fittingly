<?php 
use PHPUnit\Framework\TestCase;
use Models\Addresses;
use Tests\CrudModel;

require_once __DIR__ . '/../project_root/Models/Addresses.php';
require_once 'CrudModel.php';
require_once 'Database.php'; // Assuming Database.php is in the tests directory

class AddressTest extends TestCase
{
    private static $pdo;

    public static function setUpBeforeClass(): void
    {
        // Get PDO connection from CrudModel (assuming Database::getConnection() is used inside CrudModel)
        self::$pdo = \Tests\Database::getConnection();
        // Create a test table for addresses
        self::$pdo->exec("
            CREATE TABLE IF NOT EXISTS Addresses (
                PostalCode VARCHAR(20),
                HouseNumber VARCHAR(20),
                StreetName VARCHAR(255),
                City VARCHAR(255),
                Country VARCHAR(255),
                PRIMARY KEY (PostalCode, HouseNumber)
            )
        ");
    }


    protected function setUp(): void
    {
        self::$pdo->exec("SET FOREIGN_KEY_CHECKS=0");
        self::$pdo->exec("DELETE FROM customers"); // or any table referencing Addresses
        self::$pdo->exec("DELETE FROM Addresses");
        self::$pdo->exec("SET FOREIGN_KEY_CHECKS=1");
    }

    public function testCreateAssociativeArrayReturnsCorrectArray()
    {
        $address = new Addresses('1234AB', '10', 'Main Street', 'Amsterdam', 'Netherlands', new \Tests\CrudModel());
        $expected = [
            'PostalCode' => '1234AB',
            'HouseNumber' => '10',
            'StreetName' => 'Main Street',
            'City' => 'Amsterdam',
            'Country' => 'Netherlands'
        ];
        $this->assertEquals($expected, $address->createAssociativeArray());
    }

    public function testSaveAddressInsertsIntoDatabase()
    {
        $address = new Addresses('5678CD', '20', 'Second Street', 'Rotterdam', 'Netherlands', new \Tests\CrudModel());
        $result = $address->saveAddress();
        $this->assertTrue($result);

        $stmt = self::$pdo->prepare("SELECT * FROM Addresses WHERE PostalCode = ? AND HouseNumber = ?");
        $stmt->execute(['5678CD', '20']);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotFalse($row);
        $this->assertEquals('Second Street', $row['StreetName']);
        $this->assertEquals('Rotterdam', $row['City']);
        $this->assertEquals('Netherlands', $row['Country']);
    }

    public function testToStringReturnsCorrectFormat()
    {
        $address = new Addresses('9999ZZ', '99', 'Testlaan', 'Utrecht', 'Nederland', new \Tests\CrudModel());
        $expected = '9999ZZ, 99, Testlaan, Utrecht, Nederland';
        $this->assertEquals($expected, (string)$address);
    }

    public function testSaveAddressWithEmptyFields()
    {
        $address = new Addresses('', '', '', '', '', new \Tests\CrudModel());
        $result = $address->saveAddress();
        $this->assertTrue($result);

        $stmt = self::$pdo->prepare("SELECT * FROM Addresses WHERE PostalCode = ? AND HouseNumber = ?");
        $stmt->execute(['', '']);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotFalse($row);
        $this->assertEquals('', $row['StreetName']);
        $this->assertEquals('', $row['City']);
        $this->assertEquals('', $row['Country']);
    }


    public function testDuplicateAddressPrimaryKey()
    {
        $address1 = new Addresses('1111AA', '1', 'First', 'City', 'Country', new \Tests\CrudModel());
        $address2 = new Addresses('1111AA', '1', 'Second', 'OtherCity', 'OtherCountry', new \Tests\CrudModel());
        $this->assertTrue($address1->saveAddress());
        $result = true;
        try {
            $address2->saveAddress();
        } catch (\Exception $e) {
            $result = false;
        }
        $this->assertFalse($result);
    }

    public function testSaveAddressWithLongStrings()
    {
        $longString = str_repeat('a', 255);
        $address = new Addresses($longString, $longString, $longString, $longString, $longString, new \Tests\CrudModel());
        $result = $address->saveAddress();
        // Dit is waar omdat maar een deel van de strings wordt opgeslagen in de database
        // vanwege de lengtebeperkingen van de kolommen.
        $this->assertTrue($result);

    }
}

