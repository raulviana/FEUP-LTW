
<?php
    if(! isset($_SESSION['username'])){
        header('Location: login.php');
        die;
    } 
    else{
?>

<?php
$pet_photos = getPetPhotos($pet[0]);
$pet_poster = getPetUser($pet[0]['poster']);
$pet_owner = getPetUser($pet[0]['owner']);
$posts = getPetPosts($pet[0]['id']);
$number_proposals = getNumberProposals($pet[0]['id']);

echo '<div id="pet-container">';
if ($pet_owner == null) {
    echo '<article id="pet-box" class="card-color-available">';
} else echo '<article id="pet-box" class="card-color-unavailable">
            <p id="pet-unavailable-info">This pet has already been adopted! <i class="far fa-thumbs-up"></i></p>';
?>

<div class="card-background">
    <p class="pet-header">
        <span>
            <?php
                if($pet_poster['id'] === $_SESSION['user_id']){
                    echo '<a href="proposal-list.php?petID=' . $pet[0]['id'] . '" class="proposal-list-link">
                            ' . $number_proposals['proposals'] . ' Proposal(s)
                            </a>';
                }
            if($pet_poster['id'] !== $_SESSION['user_id']){
                echo '<a href="proposal.php?id=' .  $pet[0]['id'] . '" class="make-proposal">Make Proposal</a>';
            }
         
            ?>
        </span>
        <span class="pet-name"><?= $pet[0]['name'] ?></span>
        <span class="add-pet-wishlist"><a title="Add pet to wishlist" href="wishlist.php?id=<?=$pet[0]['id']?>"><i class="fas fa-plus-square add-pet-btn"></i></a></span>
    </p>
    <?php
    foreach ($pet_photos as $photo) {
        echo '<img class="pet-image" src="images/pets/';
        echo $photo['id'] . '.jpg';
        echo '">';
    }
    ?>

    <hr>

    <div id="pet-info">
        <p class="description">
            <?= $pet[0]['description'] ?>
        </p>
        <p class="general-info">
            <span class="pet-age">Age: <?= $pet[0]['age'] ?> years</span>
            <span class="pet-size">Size:
                <?php
                switch ($pet[0]['size']) {
                    case 'S':
                        echo 'Small';
                        break;
                    case 'M':
                        echo 'Medium';
                        break;
                    case 'L':
                        echo 'Large';
                        break;
                    default:
                        break;
                }
                ?>
            </span>

            <span class="pet-location"><i class="fas fa-map-marker-alt fa-xs pet-location-icon"></i><?= $pet[0]['location'] ?></span>
        </p>
        <p class="pet-date">Posted by <span class="pet-card-poster"><?= $pet_poster['username'] ?></span> at <?= date('Y-m-d', strtotime($pet[0]['date'])) ?></p>
    </div>
</div>

</article>
<aside id="posts-column">

    <?php      
    foreach ($posts as $post) {
    ?>
        <div class="pet-post" id="<?=$post['id']?>">
            <p class="pet-post-poster">
                <span>In <?= date('Y-m-d', strtotime($post['date'])) ?>, <b><?= $post['username'] ?>: </b></span>
                <span>
                    <?php
                        if ($_SESSION['user_id'] === $post['userID']) {
                        echo '<button class="post-button edit-btn" data-id="' . $post['id'] . '" id="edit-' . $post['id'] . '" type="button"><i class="far fa-edit fa-xs edit-post-icon"></i></button>
                                    <button class="post-button del-btn" data-id="' . $post['id'] . '" id="del-' . $post['id'] . '" type="button"><i class="far fa-trash-alt fa-xs delete-post-icon"></i></button>';
                        }
                    ?>      
                </span>
            </p>
            <p class="pet-post-content"><?= $post['text'] ?></p>

            <?php
            $replies = getPostReplies($post['id']);
            if (count($replies) != 0) {
            ?>
                <div class="replies-container">
                    <?php
                    foreach ($replies as $reply) {
                    ?>
                        <div class="post-reply">
                            <p class="pet-post-poster">
                                <span>In <?= date('Y-m-d', strtotime($reply['date'])) ?>, <b><?= $reply['username'] ?></b> says: </span>
                                <span>
                                    <?php
                                    
                                        if ($_SESSION['user_id'] === $reply['userID']) {
                                            echo '<button class="post-button edit-btn" data-id="' . $post['id'] . '" id="edit-' . $post['id'] . '" type="button"><i class="far fa-edit fa-xs edit-post-icon"></i></button>
                                            <button class="post-button del-btn" data-id="' . $post['id'] . '" id="del-' . $post['id'] . '" type="button"><i class="far fa-trash-alt fa-xs delete-post-icon"></i></button>';
                                }
                                    ?>
                                </span>
                            </p>
                            <p class="pet-post-content"><?= $reply['text'] ?></p>
                        </div>
                    <?php }
                    ?></div><?php
                        }
                            ?>
        </div>
    <?php } ?>
    <div class="add-post" id="add-new-post">
        <center><textarea id="new-post" name="new-post" row="6" placeholder="Add Post here.."></textarea></center>
        <center><button id="send-post-btn" data-pet-id="<?=$pet[0]['id']?>" data-user-id="<?=$_SESSION['user_id']?>" type="button"><i class="fas fa-step-forward send-btn" id="send-post-icon"></i></button></center>
    </div>

</aside>
</div>
<div hidden id="username_session" data-user-id=<?=$_SESSION['username']?>></div>
<?php } ?>