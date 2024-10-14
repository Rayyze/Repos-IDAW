<?php
    session_start();
    echo "<h1>Bienvenu ". $_SESSION['login'] ."</h1>";
    echo "<a href=\"disconnect.php\">deconnexion</a>";
?>