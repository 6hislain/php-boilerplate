<?php
include_once('../../app/authenticate.php');
auth();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $head = ['styles' => ['../css/style.css']];
  include_once('../partials/head.php');
  ?>
</head>

<body>
  <div class="container my-4">
    <div class="columns is-centered is-multiline">
      <div class="column is-9">
        <?php
        $hero = ['title' => 'Dashboard', 'subtitle' => 'Keep calm and write epic code'];
        include_once('../partials/hero.php');
        ?>
      </div>
      <div class="column is-3">
        <?php include_once('../partials/menu.php') ?>
      </div>
    </div>
  </div>
</body>

</html>