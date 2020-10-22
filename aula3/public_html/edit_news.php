
<?php

include_once('database/connection.php');
include_once('database/news.php');

include_once('templates/common/header.php');

$article = getArticle($_GET['id']);

include_once('templates/common/edit_form.php');

include_once('templates/common/footer.php');

?>