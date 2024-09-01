<?php

class CSVParser
{
    private string $filePath;
    private array $data = [];

    public function __construct(string $filePath, array $data)
    {
        $this->filePath = $filePath;
        $this->data = $this->parse();
    }

    public function parse(): array
    {
        return [];
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