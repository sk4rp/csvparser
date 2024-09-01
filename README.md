# CSV Parser на PHP 7.4+

Этот проект представляет собой CSV парсер на PHP, который позволяет загружать, разбирать и извлекать данные из
CSV файлов. Парсер предоставляет методы для получения строк, колонок, поиска значений и фильтрации данных по колонкам.

## Установка

1. Клонируйте репозиторий:
   ```bash
   git clone https://github.com/sk4rp/csvparser.git

2. Перейдите в директорию проекта:
   ```bash
   cd csvparser

3. Установите нужные зависимости:
   ```bash
   composer require --dev phpunit/phpunit ^9

## Использование

1. Создание экземпляра парсера:
   <h3>Создайте объект CSVParser, передав путь к вашему CSV файлу:

    ```php
    use csvparser\src\CSVParser;

    $parser = new CSVParser('path/to/your/file.csv');

## Тестирование

1. Необходимо запустить тесты с помощью команды:

   ```bash
   ./vendor/bin/phpunit testing/CSVParserTest.php

## Пример CSV-файла

  ```csv
  id,name,age
  1,Maxim,21
  2,Anton,25
  3,Andrey,30
