<?php
require 'config.php';

$ip = $_SERVER['REMOTE_ADDR'];


// Adding new access
$sql = $pdo->prepare("INSERT INTO access (ip, hour) VALUES (:ip, :hour)");
$sql->bindValue(":ip", $ip);
$sql->bindValue(":hour", date('H:i:s'));
$sql->execute();


//Deleting old access
$sql = "DELETE FROM access WHERE hour < :hour";
$sql = $pdo->prepare($sql);
$sql->bindValue(":hour", date("H:i:s", strtotime("-3 minutes")));
$sql->execute(); 

//Checking access online in range of 3 minutes
$sql = "SELECT *FROM access WHERE hour > :hour GROUP BY ip";
$sql = $pdo->prepare($sql);
$sql->bindValue(":hour", date("H:i:s", strtotime("-3 minutes")));
$sql->execute();
$count = $sql->rowCount();

echo "Online: ". $count;


?>