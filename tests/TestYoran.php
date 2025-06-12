<?php use PHPUnit\Framework\TestCase;

class SearchLoggerTest extends TestCase
{
    public function testCheckRecordExists()
    {
        $tableName = "searchlog";
        $searchword = "test";

        $result = CrudModel::checkRecordExists($tableName, ['SearchWord' => $searchword]);

        $this->assertTrue($result); // Test of het record bestaat
    }
}
?>
