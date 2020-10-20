
<?php
   
    include_once('database/connection.php');
    include_once('database/news.php');
    include_once('templates/common/header.php');

  
    $articles = getNews();

   
    

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

    include_once('templates/common/footer.php');
?>
