

<?php
function printPetCard($pet)
{
    $pet_photos = getPetPhotos($pet);
?>
    <a href="pet_page.php?pet-id=<?= $pet['id'] ?>">
        <?php
        if ($pet['owner'] == null) {
            echo '<div class="pet-card card-color-available">';
        } else echo '<div class="pet-card card-color-unavailable">';
        ?>
        <div class="card-info">
            <img src="images/pets/<?= $pet_photos[0]['id'] ?>.jpg">

            <p id="pet-name-card" class="pet-name"><?= $pet['name'] ?></p>
            <p class="general-info">
                <span class="pet-age"><?php if($pet['age'] == 1){echo $pet['age'] . ' year';} else echo $pet['age']. ' years'; ?></span>
                <span class="pet-location"><?= $pet['location'] ?></span>
            </p>
            <p class="pet-date"><?= date('Y-m-d', strtotime($pet['date'])) ?></p>
        </div>
        </div>
    </a>
<?php
}
?>
