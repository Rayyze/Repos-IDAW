<?php
    if(isset($_GET['css'])) {
        setcookie('style', $_GET['css'], time() + (1800), "/");
    }
    header('Location: index.php');
?>