
<?php
    include_once('database/connection.php');
    include_once('database/news.php');

    saveEditNews($_POST['id'], $_POST['title'], $_POST['introduction'], $_POST['fulltext']);

    header('Location:http://localhost:8080/news_item.php?id=' . $_POST['id']);
    die;
?>