<?php
include_once 'openbase.php';

$date = $_GET['date'];

$sql = "DELETE FROM `plateforme_as` WHERE `date`= '$date'";

$res = $conn->query($sql);

echo "Les données du $date ont été supprimées.<br>";
echo "<a href='./extraire.php'> Retour </a>";