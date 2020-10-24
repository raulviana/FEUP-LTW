
<?php
echo '<body>
    <article>
    <header>
    <h1>' . $article['title'] . '<h1>
    </header>
    <p>' . $article['introduction'] . '</p>
    <footer>
    <span class="author">' . $article['name'] . '</span>';
$tags = $article['tags'];
foreach($tags as $tags){
    echo '<span class="tags"><a href="index.html">'. $tag . '</a></span>';
}
echo '<a class="comments" href="#">'. $article['comments'] . '</a>
    </article>

    <section id="comments">
    <h2>Comments</h2>';

foreach($comments as $comment){
    echo '<article class="comment">
        <span class="user">' . $comment['username'] . '</span>
        <span class="date">' . date("Y-m-d H:i:s", $comment['published']) . '</span>
        <p>' . $comment["text"] . '</p>';
    

}

echo "</article>
    </section>";

?>