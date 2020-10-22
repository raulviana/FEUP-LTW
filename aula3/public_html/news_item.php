<?php

include_once('database/news.php');


$article = getArticle($_GET['id']);
$comments = getComments($_GET['id']);

include_once('templates/common/header.php');

include_once('templates/common/print1news.php');

include_once('templates/common/footer.php');

?>

