<?php
    session_start();
    // on simule une base de données
    $users = array(
    // login => password
    'riri' => 'fifi',
    'yoda' => 'maitrejedi' );
    $login = "anonymous";
    $errorText = "";
    $successfullyLogged = false;
    if(isset($_POST['login']) && isset($_POST['password'])) {
        $tryLogin=$_POST['login'];
        $tryPwd=$_POST['password'];
        // si login existe et password correspond
        if( array_key_exists($tryLogin,$users) && $users[$tryLogin]==$tryPwd ) {
            $successfullyLogged = true;
            $login = $tryLogin;
        } else
            $errorText = "Erreur de login/password";
    } else {
        if (isset($_SESSION['login'])) {
            $successfullyLogged = true;
        } else {
            $errorText = "Merci d'utiliser le formulaire de login";
        }
    }
    if(!$successfullyLogged) {
        echo $errorText;
    } else {
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $_SESSION['login'] = $login;
        }
        echo "<h1>Bienvenu ". $_SESSION['login'] ."</h1>";
        echo "<a href=\"autre-page.php\">autre page</a>";
    }
?>