<?php
    function renderMenuToHTML($currentPageId, $langID) {
        if ($langID=='fr') {
            $mymenu = array(
                'accueil' => 'Accueil',
                'cv' => 'Cv',
                'projets' => 'Mes Projets',
                'contact' => 'Me contacter',
                'lang' => 'en'
                );
            $title = "Portfolio professionnel";
        } else {
            $mymenu = array(
                'accueil' => 'Homepage',
                'cv' => 'Cv',
                'projets' => 'My Projects',
                'contact' => 'Contact me',
                'lang' => 'fr'
                );
            $title = "Professional portfolio";
        }


        echo '<div class="menu">';
        echo    "<h1><a href=\"index.php?lang=" . $langID . "\">" . $title . "</a></h1>";
        echo        '<nav>';
        echo            '<ul>';
                            foreach($mymenu as $pageId => $pageParameters) {
                                if ($currentPageId == $pageId) {
                                    echo "<li class=\"current_page\"><a href=\"?page=" . $pageId . "&lang=" . $langID . "\">" . $pageParameters . "</a></li>";
                                } else if ($pageId == 'lang') {
                                    echo "<li><a href=\"?page=" . $currentPageId . "&lang=" . $pageParameters . "\">" . $pageParameters . "</a></li>";
                                } else {
                                    echo "<li><a href=\"?page=" . $pageId . "&lang=" . $langID . "\">" . $pageParameters . "</a></li>";
                                }
                            }
        echo            '</ul>';
        echo        '</nav>';
        echo '</div>';
    }
?>