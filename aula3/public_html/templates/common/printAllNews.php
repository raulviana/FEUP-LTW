<?php


    echo "<section id=news>";
    foreach($articles as $article){
        echo "<article>";
        echo "<header>";
        echo '<h1><a href=news_item.php?id=' . $article['id'] . '>' . $article['title'] . '</a><h1>';
        echo "</header>";
        echo '<p>' . $article['introduction'] . '</p>';
        echo '<footer>';
        echo '<span class="author">' . $article['name'] . '</span>';
        $tags = $articles['tags'];
        foreach($tags as $tags){
            echo '<span class="tags"><a href="index.html">'. $tag . '</a></span>';
        }
        echo '<a class="comments" href="#">'. $article['comments'] . '</a>';
       
        echo "</article>";
    }
    echo "</section>";


?>