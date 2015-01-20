<div id ="activematches">
    <?php if(!$activegames == false) {
        echo '<ul>';
        foreach($activegames as $x) {
            echo '<li><a href="/match/show/'.$x['id'].'">Show!</a><li>';
        }
        echo '</ul>';
        } ?>
</div>
