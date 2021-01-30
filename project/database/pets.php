
<?php

    function getAllPets(){
        global $db;
        $stm = $db->prepare('SELECT * FROM pets ORDER BY "date" DESC LIMIT 14');
        $stm->execute();
        return $stm->fetchAll();
    }

    function getPetPhotos($pet){
        global $db;
        $stm = $db->prepare('SELECT id FROM photo WHERE pet_id = ?');
        $stm->execute(array($pet['id']));
        return $stm->fetchAll();
    }

    function getPet($id){
        global $db;
      
        $stm = $db->prepare('SELECT * FROM pets WHERE id = ?');
        $stm->execute(array($id));
        return $stm->fetchAll();
    }

    function getPetUser($user_id){
        global $db;
        $stm = $db->prepare('SELECT id, username, email FROM user WHERE id = ?');
        $stm->execute(array($user_id));
        return $stm->fetch(); 
    }

    function getPetPosts($pet_id){
        global $db;
        $stm = $db->prepare('SELECT posts.id, posts.text, posts.date, posts.parent_id, user.username, user.id AS userID
                            FROM posts
                            INNER JOIN user 
                            ON user.id = posts.poster 
                            WHERE posts.pet = ? AND posts.parent_id IS NULL
                            ORDER BY "date" ASC');
        $stm->execute(array($pet_id));
        return $stm->fetchAll();
    }

    function getPostReplies($post_id){
        global $db;
        $stm = $db->prepare('SELECT  posts.id, posts.text, posts.date, posts.parent_id, user.username, user.id AS userID
                             FROM posts
                             INNER JOIN user
                             ON user.id = posts.poster 
                             WHERE parent_id = ? 
                             ORDER BY "date" ASC');
        $stm->execute(array($post_id));
        return $stm->fetchAll();
    }

    function add_pet($name, $location, $age, $description, $sizes, $tags, $poster_id, $files){
 
        global $db;
        $stm = $db->prepare('SELECT id FROM tags WHERE "name" = ?');
        $stm->execute(array($tags));
        $tag_id = $stm->fetch();
        $date = date('Y:m:d h:i:s');

        $stm = $db->prepare('INSERT INTO pets VALUES(NULL, ?, ?, ?, 0, ?, ?, ? ,NULL, ?, ?)');
        $stm->execute(array($name, $description, $age, $location, $date, $sizes, $poster_id, $tag_id['id']));

        $id = $db->lastInsertId();
        
        $number_files = count($files['files']['name']);
      
        $photo_ids = array();
        for($i = 0; $i < $number_files; $i++){
            $stm = $db->prepare('INSERT INTO photo VALUES(NULL, ?, ?)');
            $stm->execute(array($files['files']['name'][$i], $id));
            array_push($photo_ids, $db->lastInsertId());
        }
        return $photo_ids;
    }

    function getWishlist($user_id){
        global $db;
        $stm = $db->prepare('SELECT pets.id, pets.name, pets.description, pets.age, pets.adopted, pets.location, pets.date, pets.size, pets.owner, pets.poster, wishlist.name AS wish_name FROM pets
                             INNER JOIN wish_pets ON pets.id = wish_pets.pet_id
                             INNER JOIN wishlist ON wishlist.id = wish_pets.wish_id 
                             INNER JOIN user ON wishlist.user_id = user.id AND user.id = ?');
        $stm ->execute(array($user_id));
        return $stm->fetchAll();
    }

    function addWishlist($name, $pet_id, $user_id){    
        global $db;
        $stm = $db->prepare('INSERT INTO wishlist VALUES(NULL, ?, ?)');
        $stm ->execute(array($name, $user_id));
        $new_id = $db->lastInsertId();
        addPetToWishlist($new_id, $pet_id);
    }

    function addPetToWishlist($wishlist_id, $pet_id){
        global $db;
        $stm = $db->prepare('INSERT INTO wish_pets VALUES(?, ?)');
        $stm ->execute(array($wishlist_id, $pet_id));
    }

    function getMyPets($user_id){
        global $db;
        $stm = $db->prepare('SELECT * FROM pets WHERE poster = ?');
        $stm ->execute(array($user_id));
        return $stm->fetchAll();
    }

    function addPetPost($text, $poster_id, $pet_id, $date){

        global $db;

        $stm = $db->prepare('INSERT INTO posts VALUES(NULL, ?, ?, ?, ?, NULL)');
        $stm->execute(array($text, $poster_id, $pet_id, $date));
        return $db->lastInsertId();
    }

    function deletePetPost($post_id){

        global $db;

        $stm = $db->prepare('DELETE FROM posts WHERE id = ?');
        $stm->execute(array($post_id));
        return $db->lastInsertId();
    }

    function getWishIdByName($wish_name){
        global $db;

        $stm = $db->prepare('SELECT id FROM wishlist WHERE "name" = ?');
        $stm->execute(array($wish_name));
        return $stm->fetch();
    }

    function deletePhotos($ids){
      
        global $db;

        foreach($ids as $id){
            $stm = $db->prepare('DELETE FROM photo WHERE id = ?');
            $stm->execute(array($id));
        }

    }

?>