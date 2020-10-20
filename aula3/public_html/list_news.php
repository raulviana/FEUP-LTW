
<?php
    $db = new PDO('sqlite:news.db');

    $stmt = $db->prepare('SELECT news.*, users.*, COUNT(comments.id) AS comments
    FROM news JOIN
         users USING (username) LEFT JOIN
         comments ON comments.news_id = news.id
    GROUP BY news.id, users.username
    ORDER BY published DESC');
    
    $stmt->execute();
    $articles = $stmt->fetchAll();

    echo "<head>";
    echo "<title>Super Legit News</title>";    
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<link href="style.css" rel="stylesheet">';
    echo '<link href="layout.css" rel="stylesheet">';
    echo "</head>";
    

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
