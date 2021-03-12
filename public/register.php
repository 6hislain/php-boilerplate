<?php
include_once('../app/utility.php');
guest();

if (
  $_SERVER["REQUEST_METHOD"] == "POST" &&
  checkToken(isset($_POST['token']) ? post('token') : '')
) :
  $first_name = post('first_name');
  $last_name = post('last_name');
  $email = post('email');
  $password = md5(post('password'));
  $confirm_password = md5(post('confirm_password'));

  keepData(['first_name', 'last_name', 'email']);
  isRequired(['first_name', 'last_name', 'email', 'password']);
  isUnique('users', ['email']);
  if ($password !== $confirm_password) array_push($_SESSION['message'], "passwords do not match");

  if (count($_SESSION['message'])) : // * display errors (if any)
    header('location: register');
  else :
    include_once('../app/database.php');

    $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$password')";

    if (dbQuery($sql)) :
      array_push($_SESSION['message'], 'account created! login to continue');
      header('location: login');
    endif;
  endif;
else :
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <?php
    $head = ['title' => 'Register - ', 'scripts' => ['./js/script.js'], 'styles' => ['./css/style.css']];
    include_once('./partials/head.php');
    ?>
  </head>

  <body>
    <?php
    include_once('./partials/navbar.php');
    $hero = ['title' => 'Register', 'subtitle' => 'Open a free account'];
    include_once('./partials/hero.php');
    ?>
    <div class="container">
      <div class="columns is-centered is-multiline">
        <div class="column is-7">
          <?php include_once('./partials/notification.php') ?>
          <div class="box">
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
              <div class="columns is-centered is-multiline">
                <div class="column is-6">
                  <input type="text" name="first_name" placeholder="First name" class="input" value="<?= oldData('first_name') ?>">
                </div>
                <div class="column is-6">
                  <input type="text" name="last_name" placeholder="Last name" class="input" value="<?= oldData('last_name') ?>">
                </div>
                <div class="column is-12">
                  <input class="input" type="email" name="email" placeholder="Email address" value="<?= oldData('email') ?>">
                </div>
                <div class="column is-6">
                  <input type="password" name="password" placeholder="Password" class="input">
                </div>
                <div class="column is-6">
                  <input type="password" name="confirm_password" placeholder="Confirm password" class="input">
                </div>
                <div class="column is-6">
                  <input type="hidden" name="token" value="<?= token() ?>">
                  <button type="submit" class="button is-primary is-fullwidth">Continue</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>

  </html>
<?php
  $_SESSION['data'] = [];
  $_SESSION['message'] = [];
endif;
?>
