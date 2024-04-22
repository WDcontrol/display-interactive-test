<?php

require_once __DIR__ . '/vendor/autoload.php';

use Doctrine\DBAL\DriverManager;

$connectionParams = [
    'url' => 'sqlite:///var/data.db',
];

$connection = DriverManager::getConnection($connectionParams);

function importDataFromCsv($filename, $connection, $tableName)
{
    $filePath = __DIR__ . '/data/' . $filename;

    if (!file_exists($filePath)) {
        throw new Exception("Le fichier $filename n'existe pas dans le dossier 'data'");
    }

    $file = fopen($filePath, 'r');

    if (!$file) {
        throw new Exception("Impossible d'ouvrir le fichier $filename");
    }

    $header = fgetcsv($file, 0, ';');
    $columns = implode(', ', $header);
    $params = implode(', ', array_fill(0, count($header), '?'));

    $stmt = $connection->prepare("INSERT INTO $tableName ($columns) VALUES ($params)");

    while ($data = fgetcsv($file, 0, ';')) {
        $stmt->execute($data);
    }

    fclose($file);
}

importDataFromCsv('customers.csv', $connection, 'customer');

importDataFromCsv('purchases.csv', $connection, 'purchase');

echo "Les données ont été importées avec succès !\n";
