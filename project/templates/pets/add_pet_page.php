
<?php

    if(! isset($_SESSION['username'])){
        header('Location: login.php');
        die;
    } 
    else{
?>
<section id="register-form">
    <div class="register-card">
        <h2 class="form-h2">Add Pet</h2>
        <form id="add-pet-form" action="action_add_pet.php" method="post" enctype="multipart/form-data">
             <input class="addpet-input-box" tpe="text" name="pet-name" placeholder="Name" required>

            <div id="age-location-container">
                <input id="pet-location" type="text" name="location" placeholder="Location" required>
                <input id="pet-age" class="addpet-input-box" type="number" name="age" placeholder="Age" min="0" max="100">   
            </div>

            <textarea class="addpet-input-box" form="add-pet-form" name="description" rows="4" placeholder="Describe pet"></textarea>
            
            <label class="addpet-input-box" for="sizes">Size: <select class="add-pet-checkbox" name="sizes" id="sizes-input" required>
                    <option value="S">Small</option>
                    <option value="M">Medium</option>
                    <option value="L">Large</option>
                </select>
            </label>


            <label class="addpet-input-box" for="tags">Type: <select name="tags" id="tags-input" required>
                    <option value="dog">Dog</option>
                    <option value="cat">Cat</option>
                    <option value="bird">Bird</option>
                    <option value="rabbit">Rabbit</option>
                    <option value="hamster">Hamster</option>
                    <option value="horse">Horse</option>
                    <option value="turtle">Turtle</option>
                    <option value="pig">Pig</option>
                </select>
            </label>

            <input type="hidden" id="poster_id" name="poster_id" value="<?=$_SESSION['user_id']?>">


            <label id="addpet-files" class="addpet-input-box" for="files">Images: <input type="file" id="files" name="files[]" multiple>
            </label>

            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">

            <input class="input-btn" type="submit" value="Add Pet">

        </form>
</section>
<?php 
    }
?>
