<?php 
use PHPUnit\Framework\TestCase;
use Models\CrudModel;
use Core\Database;

require_once __DIR__ . '/../project_root/Models/CrudModel.php';
require_once __DIR__ . '/../project_root/Core/Database.php';

class CrudModelTest extends TestCase
{
    private static $pdo;

    public static function setUpBeforeClass(): void
    {
        self::$pdo = Database::getConnection();
        // Create a test table
        self::$pdo->exec("
            CREATE TABLE IF NOT EXISTS TestTable (
                id INT PRIMARY KEY,
                name VARCHAR(255),
                value VARCHAR(255)
            )
        ");
    }

    public static function tearDownAfterClass(): void
    {
        // Drop the test table
        self::$pdo->exec("DROP TABLE IF EXISTS TestTable");
    }

    protected function setUp(): void
    {
        // Clean up before each test
        self::$pdo->exec("DELETE FROM TestTable");
    }

    public function testCreateData()
    {
        $data = ['id' => 1, 'name' => 'foo', 'value' => 'bar'];
        $result = CrudModel::createData('TestTable', $data);
        $this->assertTrue($result);

        $stmt = self::$pdo->query("SELECT * FROM TestTable WHERE id = 1");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals($data, $row);
    }

    public function testReadAllById()
    {
        $data = ['id' => 2, 'name' => 'baz', 'value' => 'qux'];
        CrudModel::createData('TestTable', $data);

        $result = CrudModel::readAllById('TestTable', 'id', 2);
        $this->assertEquals($data, $result);
    }

    public function testReadAll()
    {
        $data1 = ['id' => 3, 'name' => 'a', 'value' => 'b'];
        $data2 = ['id' => 4, 'name' => 'c', 'value' => 'd'];
        CrudModel::createData('TestTable', $data1);
        CrudModel::createData('TestTable', $data2);

        $all = CrudModel::readAll('TestTable');
        $this->assertCount(2, $all);
        $this->assertContains($data1, $all);
        $this->assertContains($data2, $all);
    }

    public function testReadAllByColumn()
    {
        $data1 = ['id' => 5, 'name' => 'x', 'value' => 'y'];
        $data2 = ['id' => 6, 'name' => 'x', 'value' => 'z'];
        $data3 = ['id' => 7, 'name' => 'w', 'value' => 'y'];
        CrudModel::createData('TestTable', $data1);
        CrudModel::createData('TestTable', $data2);
        CrudModel::createData('TestTable', $data3);

        $results = CrudModel::readAllByColumn('TestTable', 'name', 'x');
        $this->assertCount(2, $results);
        $this->assertContains($data1, $results);
        $this->assertContains($data2, $results);
    }

    public function testUpdateData()
    {
        $data = ['id' => 8, 'name' => 'old', 'value' => 'oldval'];
        CrudModel::createData('TestTable', $data);

        $update = ['id' => 8, 'name' => 'new', 'value' => 'newval'];
        $result = CrudModel::updateData('TestTable', $update);
        $this->assertTrue($result);

        $row = CrudModel::readAllById('TestTable', 'id', 8);
        $this->assertEquals($update, $row);
    }

    public function testCheckRecordExists()
    {
        $data = ['id' => 9, 'name' => 'exists', 'value' => 'yes'];
        CrudModel::createData('TestTable', $data);

        $exists = CrudModel::checkRecordExists('TestTable', ['id' => 9]);
        $this->assertEquals(1, $exists);

        $notExists = CrudModel::checkRecordExists('TestTable', ['id' => 999]);
        $this->assertEquals(0, $notExists);
    }

    public function testGetForeignKeyValue()
    {
        $data = ['id' => 10, 'name' => 'foreign', 'value' => 'val'];
        CrudModel::createData('TestTable', $data);

        $result = CrudModel::getForeignKeyValue('TestTable', 'name', 'foreign', 'id');
        $this->assertEquals(10, $result);

        $resultNull = CrudModel::getForeignKeyValue('TestTable', 'name', 'notfound', 'id');
        $this->assertNull($resultNull);
    }
}