<?php
    $currentPageId = 'accueil';
    $langID = 'fr';

    if(isset($_GET['lang'])) {
        $langID = $_GET['lang'];
    }
    if(isset($_GET['page'])) {
        $currentPageId = $_GET['page'];
    }

    require_once("template_header.php");
    require_once("template_menu.php");

    renderMenuToHTML($currentPageId, $langID);
?>
<section class="corps">
    <?php
        $pageToInclude = $langID . "/" . $currentPageId . ".php";
        if(is_readable($pageToInclude))
            require_once($pageToInclude);
        else
            require_once("error.php");
    ?>
</section>
<?php
    require_once("template_footer.php");
?>