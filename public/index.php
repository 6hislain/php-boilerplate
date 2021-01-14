<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $head = ['title' => 'Home - ', 'scripts' => ['./js/script.js'], 'styles' => ['./css/style.css']];
  include_once('./partials/head.php');
  ?>
</head>

<body>
  <section class="hero is-medium is-bold">
    <div class="hero-body">
      <div class="container has-text-centered">
        <h1 class="title">PHP Boilerplate</h1>
        <h2 class="subtitle">A simple boilerplate for small PHP projects</h2>
        <a href="register" class="button is-rounded is-info">Sign up</a>
        <a href="login" class="button is-rounded is-primary">Log in</a>
      </div>
    </div>
  </section>
</body>

</html>