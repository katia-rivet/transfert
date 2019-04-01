<?php
/*****************************************************
* 
* Author :
* Version :
* 
* Description : Interface de connexion à la base de données
* 
*/


function connectionBase(){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "wetransfer";
    $conn = NULL;



    try {
        $pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = 'SET NAMES utf8';
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, $pdo_options);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
    
    return $conn;
}


