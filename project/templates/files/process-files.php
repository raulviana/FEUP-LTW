
<?php

    include_once('includes/session.php');

    include_once('database/connection.php');
    include_once('database/pets.php');

    function process_files($db_file_ids, $upload_FILE, $image_type){
        
        $length = count($upload_FILE['files']['name']);

        for($i=0; $i < $length; $i++){
            if($upload_FILE['files']['size'][$i] > 50000000){
                $_SESSION['error_messages'][] = "Image must have less than 5Mb";
                $_SESSION['print'] = 'error';
                deletePhotos($db_file_ids);
                header('Location:add_pet.php');
                die;
            }
            //file extension can be manipulaed, but it's just another layer of precaution
            $extension = pathinfo($upload_FILE['files']['name'][$i], PATHINFO_EXTENSION);
            if($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg' && $extension != 'gif'){
                $_SESSION['error_messages'][] = "File is not an image";
                deletePhotos($db_file_ids);
                
                header('Location:add_pet.php');
                die;
            }
        }
        for($i=0; $i < $length; $i++){
            
            $user_file_path = $upload_FILE['files']['tmp_name'][$i];
            switch($image_type){
                case 'pets':
                    $server_file_path = './images/pets/' . $db_file_ids[$i] . '.jpg';
                break;
                case 'proposal':
                    $server_file_path = './images/proposal/' . $db_file_ids[$i] . '.jpg';
                break;
            }
            move_uploaded_file($user_file_path, $server_file_path);
            
        //resize image
            
            $type = exif_imagetype($server_file_path);

            switch ($type) {
                case 1 :
                    $original = imageCreateFromGif($server_file_path);
                break;
                case 2 :
                    $original = imageCreateFromJpeg($server_file_path);
                break;
                case 3 :
                    $original = imageCreateFromPng($server_file_path);
                break;
                case 6 :
                    $original = imageCreateFromBmp($user_file_path);
                break;
            }

            $width = imagesx($original);
            $heigth = imagesy($original);
            $square = min($width, $heigth);   
            $final_size =  imagecreatetruecolor(134, 100);
            imagecopyresized($final_size, $original, 0, 0, ($width > $heigth) ? ($width-$square)/2 : 0, ($heigth > $square) ? ($heigth - $square)/2 : 0, 134, 100, $square, $square);
            imagejpeg($final_size, $server_file_path);
        }
        
    }



?>