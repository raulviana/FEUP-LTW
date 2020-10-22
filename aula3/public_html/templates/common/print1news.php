
<?php
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
    

}

echo "</article>";
echo "</section>";

?>