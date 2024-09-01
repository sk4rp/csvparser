<?php

namespace csvparser\src;
use RuntimeException;

class CSVParser
{
    private string $filePath;
    private array $data;
    private array $headers = [];

    /**
     * @param string $filePath
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
        $this->data = $this->parse();
    }


    /**
     * @return array
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
        } else {
            throw new RuntimeException('Cant open file for parsing');
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param string $columnName
     * @return array
     */
    public function getColumn(string $columnName): array
    {
        $column = [];

        foreach ($this->data as $row) {
            if (isset($row[$columnName])) {
                $column[] = $row[$columnName];
            }
        }

        return $column;
    }

    /**
     * @param int $index
     * @return array|null
     */
    public function getRow(int $index): ?array
    {
        return $this->data[$index] ?? null;
    }

    /**
     * @return int
     */
    public function countRows(): int
    {
        return count($this->data);
    }

    /**
     * @param string $columnName
     * @param string $value
     * @return array
     */
    public function searchByValue(string $columnName, string $value): array
    {
        $result = [];

        foreach ($this->data as $row) {
            if (isset($row[$columnName]) && $row[$columnName] === $value) {
                $result[] = $row;
            }
        }

        return $result;
    }

    /**
     * @param string $columnName
     * @param callable $callback
     * @return array
     */
    public function filterByColumn(string $columnName, callable $callback): array
    {
        $result = [];

        foreach ($this->data as $row) {
            if (isset($row[$columnName]) && $callback($row[$columnName])) {
                $result[] = $row;
            }
        }

        return $result;
    }
}