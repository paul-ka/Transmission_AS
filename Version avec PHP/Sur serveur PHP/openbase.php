<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transmission AS</title>
    <link rel="stylesheet" href="./style.css">
</head>
<?php
// ##############################################################################
//       Remplacer par les informations de connexion à votre base My SQL
// ##############################################################################
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PSWD', 'root');
define('DB_PORT', 3306);
define('DB_NAME', 'ma_table');

$conn = new mysqli(DB_HOST, DB_USER, DB_PSWD, DB_NAME, DB_PORT);
if( $conn->connect_error ) {
    die("Erreur : 1conn->connect_error");
}
