<?php
try{
    $pdo = new PDO("mysql:dbname=online_user;host=localhost", 'root','');

}catch(PDOExcepetion $e){
    echo "ERROR: ".$e-getMessage();
    exit;

}

?>