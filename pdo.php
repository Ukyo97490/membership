<?php
session_start();

try{
$db=new PDO('mysql:host=localhost;dbname=members','root','',[
    pdo::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_PERSISTENT => true,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
]);
}
catch(Exception $e){
    die('Erreur :'.$e->getMessage());
}

