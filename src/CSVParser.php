<?php

namespace csvparser\src;

use Exception;

class CSVParser
{
    private string $filePath;
    private array $data;
    private array $headers = [];

    /**
     * @param string $filePath
     * @param array $data
     * @throws Exception
     */
    public function __construct(string $filePath, array $data)
    {
        $this->filePath = $filePath;
        $this->data = $this->parse();
    }

    /**
     * @throws Exception
     */
    public function parse(): array
    {
        $result = [];

        if (($handle = fopen(filename: $this->filePath, mode: 'rb')) !== false) {
            $this->headers = fgetcsv($handle);

            while (($data = fgetcsv($handle)) !== false) {
                $row = array_combine($this->headers, $data);
                if ($row !== false) {
                    $result[] = $row;
                }
            }

            fclose($handle);
        } else
            throw new Exception('Cant open file for parsing');

        return $result;
    }

    public function getHeaders(): array
    {
        return [];
    }

    public function getColumn(string $columnName): array
    {
        return [];
    }

    public function getRow(int $index): ?array
    {
        return null;
    }

    public function countRows(): int
    {
        return 0;
    }

    public function searchByValue(string $columnName, string $value): array
    {
        return [];
    }

    public function filterByColumn(string $columnName, callable $callback): array
    {
        return [];
    }

}