<?php


include_once('print_card.php');
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    die;
}

$user_id = preg_replace ("/[^a-zA-Z0-9_\-\s]/", '', $_SESSION['user_id']);
if(isset($_GET['id'])){
    $pet_id = preg_replace ("/[^0-9]/", '', $_GET['id']);
}

try {
    $lists = getWishlist($user_id);
} catch (PDOException $e) {
    $e->getMessage();
    print_r($e);
    die;
}

$wish_names = array();
$length = count($lists);

for ($i = 0; $i < $length; $i++) {
    array_push($wish_names, $lists[$i]['wish_name']);
}

$wish_names = array_unique($wish_names);


echo '<p class="wish-title">Wishlists</p>';

echo '<section id="pets-cards">';

if (count($lists) === 0) {
    echo '<p class="no-wishlists"><i class="fas fa-info-circle fa-sm"></i> You don&apos;t have any wishlist.</p>';

?>
  
            <?php }

if (isset($_GET['id'])) {
    echo ' <div class="wish-frame">
    <form id="new-wishlist" action="action-new-wishlist.php" method="post">
        <input id="input-wishlist-name" type="text" name="name" placeholder="Wishlist name" required> 
        <input type="hidden" name="pet-id" value="' . $pet_id . '">
        <input type="hidden" name="id" value="' . $user_id . '">
        <input type="hidden" name="csrf" value="' . $_SESSION['csrf'] . '">
        <button title="Create a new wishlist with this pet" class="create-new-wishlist">Create new<i class="fas fa-plus fa-sm add-icon"></i></button>
    </form>

</div>';
}


foreach ($wish_names as $wish_name) {

    $wish_id = getWishIdByName($wish_name);
 

    echo '<div class="wish-frame" id="' . $wish_id['id'] . '">
              <p class="wish-header">
              <span class="wish-header-name">';
    echo $wish_name;
    echo '</span>';
    if (isset($_GET['id'])) {
        echo '<span class="wish-header-add-btn">
                 <a title="Add pet to this Wishlist" href="action-add-pet-wishlist.php?pet-id=' . $_GET['id'] . '&wish-id='. $wish_id['id'] . '" class="add-wishlist-pet"> <i class="fas fa-plus fa-lg add-icon"></i> </button>
                 </span>';
    }
    echo '</p>';

    for ($i = 0; $i < count($lists); $i++) {
        if ($lists[$i]['wish_name'] === $wish_name) {
            printPetCard($lists[$i]);
        }
    }
    echo '</div>';
}

echo '</section>';
unset($_SESSION['print']);
?>