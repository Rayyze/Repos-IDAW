<?php
    header("Location: users.php");
    require_once('../config.php');
    $connectionString = "mysql:host=". _MYSQL_HOST;

    if(defined('_MYSQL_PORT'))
        $connectionString .= ";port=". _MYSQL_PORT;

    $connectionString .= ";dbname=" . _MYSQL_DBNAME;
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' );

    $pdo = NULL;
    try {
        $pdo = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD,$options);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $erreur) {
        echo 'Erreur : '.$erreur->getMessage();
    }

    $stmt = $pdo->prepare("INSERT INTO users (login, email) VALUES (:login, :email)");

    $stmt->bindParam(':login', $_POST['login']);
    $stmt->bindParam(':email', $_POST['email']);

    $stmt->execute();

    $pdo = null;
?>