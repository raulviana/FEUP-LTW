<!DOCTYPE html>
<html>

<head>
  <title><?= $title ?></title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" data-auto-a11y="true"></script>
  <script src="javascript/main.js" defer></script>
</head>

<body>
  <header>
    <nav class="navbar">
      <img src="images/logo.png">
      <a id="home-link" href="index.php">Home</a>

      <div class="log-register">
        <?php
        if (isset($_SESSION['username'])) {
          echo '<a id="my-proposals" href="my-proposals.php">My Proposals</a>
                <a id="my-pets" href="my-pets.php">My Pets</a>
                <a id="wishlist" href="wishlist.php">Wishlist</a>
                <a id="add-pet" href="add_pet.php">Add Pet</a>
                <a id="log-out" href="action_logout.php">Log Out</a>';
        } else {
          echo '<a id="log-in" href="login.php">LogIn</a>
                  <a id="register" href="register.php">Register</a>';
        }
        ?>

      </div>
    </nav>

  </header>

  <form id="search-form" action="search.php" method="post">
    <input id="search-bar" name="search" type="text" placeholder="Search...">
    <input type="submit" id="search-btn" value="Go"></input>
  </form>

  <nav id="tags">
    <ul>
      <?php
      $tags = getAllTags();
      foreach ($tags as $tag) {
        echo '<li><a href="search.php?tag=' . $tag['id'] . '">' . $tag['name'] . '</a></li>';
      }
      ?>
    </ul>
  </nav>