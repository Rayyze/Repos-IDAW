<?php
    $currentPageId = 'accueil';
    $langID = 'fr';

    if(isset($_GET['page'])) {
        $currentPageId = $_GET['page'];
    }
    if(isset($_GET['lang'])) {
        $langID = $_GET['lang'];
    }

    require_once($langID . "/template_header.php");
    require_once($langID . "/template_menu.php");

    renderMenuToHTML($currentPageId);
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