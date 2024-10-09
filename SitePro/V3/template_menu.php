<?php
    function renderMenuToHTML($currentPageId) {
        $mymenu = array(
        'accueil' => 'Accueil',
        'cv' => 'Cv',
        'projets' => 'Mes Projets',
        'contact' => 'Me contacter'
        );

        echo '<div class="menu">';
        echo    '<h1><a href="index.php">Accueil</a></h1>';
        echo        '<nav>';
        echo            '<ul>';
                            foreach($mymenu as $pageId => $pageParameters) {
                                if ($currentPageId == $pageId) {
                                    echo "<li class=\"current_page\"><a href=\"?page=" . $pageId . "\">" . $pageParameters . "</a></li>";
                                } else {
                                    echo "<li><a href=\"?page=" . $pageId . "\">" . $pageParameters . "</a></li>";
                                }
                            }
        echo            '</ul>';
        echo        '</nav>';
        echo '</div>';
    }
?>