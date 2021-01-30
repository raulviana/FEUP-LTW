
<?php
    if(! isset($_SESSION['username'])){
        header('Location: login.php');
        die;
    } 
    else{

$pet = (getPet($_GET['id'])); ?>

<div id="proposal-card">
   <center> <?php printPetCard($pet[0]); ?> </center>
</div>

<section id="register-form">
    <div class="register-card">
        <h2 class="form-h2">Make Proposal to Adopt <u> <?=$pet[0]['name']?> </u></h2>
       
        <form id="proposal-form" action="action_proposal.php" method="post" enctype="multipart/form-data">
            
            
            <input id="proponent-location" type="text" name="location" placeholder="Your Location" required>
         
            <textarea id="proposal-content" class="addpet-input-box" form="proposal-form" name="content" rows="10" placeholder="Present your proposal"></textarea>
            
            <input type="hidden" id="poster_id" name="poster_id" value="<?=$_SESSION['user_id']?>">
            <input type="hidden" id="pet-id" name="pet-id" value="<?=$_GET['id']?>">
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">

            <label id="addpet-files" class="addpet-input-box" title="Add pet&apos;s future home images" for="files">Images: <input type="file" id="files" name="files[]" multiple></label>

            <input id="send-proposal-btn" class="input-btn" type="submit" value="Send Proposal">

        </form>
</section>
<?php 
    }
?>
