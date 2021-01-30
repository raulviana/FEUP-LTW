
<?php 
    include_once('print-proposal-card.php'); 
    include_once('./database/proposal.php');

    $proposals = getProposalsByUser($_SESSION['user_id']);
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