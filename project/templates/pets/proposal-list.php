
<?php
    if(! isset($_SESSION['username'])){
        header('Location: login.php');
        die;
    } 

?>
<?php 
    include_once('print-proposal-card.php'); 
    include_once('./database/proposal.php');
    $pet_id = preg_replace ("/[^0-9\s]/", '', $_GET['petID']);

    $proposals = getProposalsByPet($pet_id);
?>

<section id="proposal-cards">
    <?php 
        if(count($proposals) == 0){
            echo '<div class="no-proposal">You don&apos;t have any proposals.</div>';
        }
        else{
            foreach ($proposals as $proposal) {
                printProposalCard($proposal);
            }
        }
       
    ?>
</section>