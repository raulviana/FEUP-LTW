<?php


    echo "<section id=news>";
    foreach($articles as $article){
        echo '<article>
            <header>
            <h1><a href=news_item.php?id=' . $article['id'] . '>' . $article['title'] . '</a><h1>
            </header>
            <p>' . $article['introduction'] . '</p>
            <footer>
            <span class="author">' . $article['name'] . '</span>
            <a class="comments" href="#">'. $article['comments'] . '</a>
            <span class="edit_link"><a href="edit_form.php?id=' . $article['id'] . '">Edit</a></span>   
            </footer>
            </article>';     
    }
    echo '</section>
    </body>';


?>