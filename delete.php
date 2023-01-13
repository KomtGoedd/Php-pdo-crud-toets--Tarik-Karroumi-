<?php
// voeg de verbindingsgegevens toe
require('config.php');

// Maak een data sourcename string voor de pdo constructor
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    if ($pdo) {
        // echo "Verbinding is gelukt";
    } else {
        echo "Interne server-error";
    }
} catch(PDOException $e) {
    $e->getMessage();
}

// Maak een delete query voor het verwijderen van een record
$sql = "DELETE FROM DureAuto
        WHERE Id = :Id";

// Bereid de query voor om de placeholder te vervangen voor een id-waarde
$statement = $pdo->prepare($sql);

// Vervang de placeholder voor een id-waarde
$statement->bindValue(':Id', $_GET['Id'], PDO::PARAM_INT);

// Voer de query uit op de mysql-database
$result = $statement->execute();

if ($result) {
    echo "Het record is succesvol verwijderd";
    header('Refresh:3; url=read.php');
} else {
    echo "Het record is niet verwijderd";
    header('Refresh:3; url=read.php');
}


