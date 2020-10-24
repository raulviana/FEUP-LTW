
<?php

    include_once('database/connection.php');

    function getNews(){
    
        global $db; 
        $stmt = $db->prepare('SELECT news.*, users.*, COUNT(comments.id) AS comments
        FROM news JOIN
            users USING (username) LEFT JOIN
            comments ON comments.news_id = news.id
        GROUP BY news.id, users.username
        ORDER BY published DESC');

        $stmt->execute();

        return $stmt->fetchAll();
    }

    function getArticle($id){
        global $db;
        $stmt = $db->prepare('SELECT * FROM news JOIN users USING (username) WHERE id = ?');
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

    function getComments($id){
        global $db;
        $stmt = $db->prepare('SELECT * FROM comments JOIN users USING (username) WHERE news_id = ?');
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }

    function saveEditNews($id, $title, $introduction, $fulltext){
        global $db;
        try{ 
            
            $stmt = $db->prepare("UPDATE news SET title = ?, 
                                              introduction = ?,
                                              `fulltext` = ?
                                        WHERE id = ?");
       
        $stmt->execute(array($title, $introduction, $fulltext, $id));
    
    }
    catch(Exception $e){
        var_dump($e->getMessage());
    }
}
  

?>