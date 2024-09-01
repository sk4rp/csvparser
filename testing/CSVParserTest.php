<?php
require __DIR__ . '/../vendor/autoload.php';

use csvparser\src\CSVParser;
use PHPUnit\Framework\TestCase;

class CSVParserTest extends TestCase
{
    private CSVParser $parser;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $filePath = __DIR__ . '/test.csv';

        file_put_contents($filePath, "id,name,age\n1,Maxim,21\n2,Anton,25\n3,Andrey,30");

        $this->parser = new CSVParser($filePath);
    }

    /**
     * @return void
     */
    protected function tearDown(): void
    {
        $filePath = __DIR__ . '/test.csv';
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    /**
     * @return void
     * @throws Exception
     */
    public function testParse(): void
    {
        $data = $this->parser->parse();
        $this->assertCount(3, $data);
        $this->assertArrayHasKey('name', $data[0]);
        $this->assertEquals('Maxim', $data[0]['name']);
    }

    /**
     * @return void
     */
    public function testGetHeaders(): void
    {
        $headers = $this->parser->getHeaders();
        $this->assertEquals(['id', 'name', 'age'], $headers);
    }

    /**
     * @return void
     */
    public function testGetColumn(): void
    {
        $ages = $this->parser->getColumn('age');
        $this->assertCount(3, $ages);
        $this->assertContains('21', $ages);
    }

    /**
     * @return void
     */
    public function testGetRow(): void
    {
        $row = $this->parser->getRow(0);
        $this->assertEquals(['id' => '1', 'name' => 'Maxim', 'age' => '21'], $row);
    }

    /**
     * @return void
     */
    public function testCountRows(): void
    {
        $count = $this->parser->countRows();
        $this->assertEquals(3, $count);
    }

    /**
     * @return void
     */
    public function testSearchByValue(): void
    {
        $rows = $this->parser->searchByValue('age', '21');
        $this->assertCount(1, $rows);
        $this->assertEquals('Maxim', $rows[0]['name']);
    }

    /**
     * @return void
     */
    public function testFilterByColumn(): void
    {
        $rows = $this->parser->filterByColumn('age', fn($age) => $age === '21');
        $this->assertCount(1, $rows);
        $this->assertEquals('Maxim', $rows[0]['name']);
    }
}
