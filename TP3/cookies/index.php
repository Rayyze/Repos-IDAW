<html>
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
        <?php
            if(!isset($_COOKIE['style'])) {
                echo "<p>Aucun style n'est selectioné";
            } else {
                echo "<p>Le " . $_COOKIE['style'] . " est selectioné";
            }
        ?>
    </body>
</html>