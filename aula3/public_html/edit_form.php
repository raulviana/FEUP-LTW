
<?php
    include_once('database/connection.php');
    include_once('database/news.php');

    include_once('templates/common/header.php');

    $article = getArticle($_GET['id']);

    echo '<form id="edit-form" action="edit_action.php" method="post">
     <label class="edit-fields"> Title: <input class="edit-inputs" type="text" name="title" placeholder="' . $article['title'] . '">
     </label>
     <label class="edit-fields"> Introduction: <input class="edit-inputs" type="textarea" name="introduction" placeholder="' . $article['introduction'] . '">
     </label>
     <label class="edit-fields"> FullText: <input class="edit-inputs" type="textarea" name="fulltext" placeholder="' . $article['fulltext'] . '">
     </label>
     <input type="submit" id="edit_btn" value="Submit" form="edit-form">
     <input type="hidden" form="edit-form" name="id" value="' . $article['id'] . '">
     </form>';

?>