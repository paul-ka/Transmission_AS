<?php
// ##############################################################################
//       Remplacer par les informations de connexion à votre base My SQL
// ##############################################################################

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PSWD', 'root');
define('DB_PORT', 3306);
define('DB_NAME', 'ma_table');

// Décommentez les lignes ci dessous si vous avez besoin de diagnostique sur votre requète
// print_r($_POST);
// print_r("<br>");

$nom = $_POST['nom'];
$reponse = str_replace("'", "\'", $_POST['reponse']);
$reponse = str_replace('"', '\"', $reponse);
$conn = new mysqli(DB_HOST, DB_USER, DB_PSWD, DB_NAME, DB_PORT);
if( $conn->connect_error ) {
    die("Erreur : 1conn->connect_error");
}
$sql = 'INSERT INTO `plateforme_as`(`date`, `nom`, `reponse`) VALUES ("'.date("d/m/Y").'", "'.$nom.'", "'.$reponse.'")';
$res = $conn->query($sql);
echo 'La réponse a été mémorisée';


?>