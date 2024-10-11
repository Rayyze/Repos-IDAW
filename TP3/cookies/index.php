<!DOCTYPE html>
<html>
    <head>
        <?php
            if(isset($_COOKIE['style'])) {
                echo "<link rel=\"stylesheet\" href=\"" . $_COOKIE['style'] . ".css\">";
            }
        ?>
    </head>
    <body>
        <form id="style_form" action="cookie.php" method="GET">
            <select name="css">
                <option value="style1">style1</option>
                <option value="style2">style2</option>
            </select>
            <input type="submit" value="Appliquer" />
        </form>
        <br>
        <br>
        <p>Bienvenu sur le site cookie</p>
    </body>
</html>