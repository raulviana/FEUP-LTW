<?php

function getAllTags(){
    global $db;
    $stm = $db->prepare('SELECT * FROM tags');
    $stm->execute();
    return $stm->fetchAll();
}

?>