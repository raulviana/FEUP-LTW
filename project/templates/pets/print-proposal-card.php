<?php

function printProposalCard($proposal)
{
    echo '<article ';

    if (!$proposal['adopted'] == 0) {
        echo 'class="proposal-frame-inactive frame">';
        echo '<center><p class="pet-adopted">This pet is already adopted.</p></center>';
    } else {
        echo 'class="proposal-frame frame">';
        echo '<p>&nbsp;</p>';
    }

?>

    <p class="proposal-header proposal-left">Proposal from <span class="proposal-poster"><?= $proposal['username'] ?></span> about <span class="proposal-poster"><?= $proposal['name'] ?></span>:</p>
    <p class="proposal-content proposal-left"><?= $proposal['content'] ?></p>


    <div class="proposal-info">
        <img src="images/proposal/<?= $proposal['path']?>.jpg">

        <p class="proposal-location proposal-left">
            <?= $proposal['location'] ?>
        </p>
        <p id="last-proposal-line">
            <span class="proposal-date proposal-left"><?= date('Y-m-d', strtotime($proposal['date'])) ?></span>
                <?php
                if($proposal['poster'] === $_SESSION['user_id']){
                    if ($proposal['adopted'] != 1) {
                    echo '<div class="accept-container">
                          <button data-proposal-id="' . $proposal['id'] . '" class="accept-proposal-btn">Accept Proposal</button></span>
                          </div>';
                    } else {
                        echo '<div class="accept-container">
                            <span class="unavailable-info">Pet Taken</span>
                            </div>';
                    }
                }
                
                ?>
        </p>
    </div>
    </article>

<?php
}

?>