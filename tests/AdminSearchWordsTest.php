<?php
use PHPUnit\Framework\TestCase;
use SebastianBergmann\Type\VoidType;

use function PHPUnit\Framework\once;

require_once dirname(__DIR__) . '/project_root/Controllers/admin_searchwords_controller.php';
require_once dirname(__DIR__) . '/project_root/Models/Addresses.php';

class AdminSearchWordsTest extends TestCase
{
    public function testGetSearchWords(): void
    {
        $searchwords = getSearchWords();
        $this->assertIsArray($searchwords);
        $this->assertNotEmpty($searchwords);

        foreach ($searchwords as $item) {
    $this->assertIsArray($item);
    $this->assertArrayHasKey('SearchWord', $item);
    $this->assertArrayHasKey('Count', $item);
        }
        
    }
}