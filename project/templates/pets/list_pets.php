


<?php 
    include_once('print_card.php'); 
?>

<section id="pets-cards">
    <?php 
     
        foreach ($pets as $pet) {
            printPetCard($pet);
        }
    ?>
</section>
