
<?php
   
    include_once('database/connection.php');
    include_once('database/news.php');

    include_once('templates/common/header.php');

  
    $articles = getNews();

    include_once('templates/common/printAllNews.php');

    include_once('templates/common/footer.php');
?>
