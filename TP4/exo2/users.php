<?php
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

    echo "<!DOCTYPE html><html><head></head><body>";
    echo '<table border="1"><tr><td>ID</td><td>Nom</td><td>e-mail</td></tr>';
    $request = $pdo->prepare("select * from users");
    $request->execute();
    while($user_row = $request->fetch(PDO::FETCH_OBJ)) {
        echo '<tr>';
          echo "<td>" . $user_row->id . "</td>";
          echo "<td>" . $user_row->login . "</td>";
          echo "<td>" . $user_row->email . "</td>";
        echo '<tr>';
    }
    echo '<table>';

    /*** close the database connection ***/
    $pdo = null;
?>
</body></html>