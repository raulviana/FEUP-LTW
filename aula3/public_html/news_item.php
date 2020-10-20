<?php

$db = new PDO('sqlite:news.db');

$stmt = $db->prepare('SELECT * FROM news JOIN users USING (username) WHERE id = ?');
$stmt->execute(array($_GET['id']));
$article = $stmt->fetch();

$stmt = $db->prepare('SELECT * FROM comments JOIN users USING (username) WHERE news_id = ?');
$stmt->execute(array($_GET['id']));
$comments = $stmt->fetchAll();

// print_r($article);
// echo "<hr>";
// print_r($comments);

echo "<head>";
echo "<title>Super Legit News</title>";    
echo '<meta charset="UTF-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<link href="style.css" rel="stylesheet">';
echo '<link href="layout.css" rel="stylesheet">';
echo "</head>";

echo "<body>";
echo "<article>";
echo "<header>";
echo '<h1>' . $article['title'] . '<h1>';
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

echo '<section id="comments">';
echo "<h2>Comments</h2>";

foreach($comments as $comment){
    echo '<article class="comment">';
    echo '<span class="user">' . $comment['username'] . '</span>';
    echo '<span class="date">' . date("Y-m-d H:i:s", $comment['published']) . '</span>';
    echo '<p>' . $comment["text"] . '</p>';
    echo "</article>";
}

echo "</section>";

echo "</body>";

?>