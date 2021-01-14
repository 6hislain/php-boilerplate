<?php
include_once('../app/authenticate.php');
guest();

if (
  $_SERVER["REQUEST_METHOD"] == "POST" &&
  checkToken(isset($_POST['token']) ? post('token') : '')
) :
  $email = post('email');
  $password = md5(post('password'));

  keepData(['email']);
  isRequired(['email', 'password']);

  if (count($_SESSION['message'])) : // * display errors (if any)
    header('location: login');
  else :
    include_once('../app/database.php');

    $sql = "SELECT id, first_name, last_name, email, role, deleted FROM users WHERE email='$email' AND password='$password' LIMIT 1";
    $user = dbSelect($sql)[0];

    if (count($user)) :
      if ($user['deleted'] == 1) {
        array_push($_SESSION['message'], 'your account has been blocked, contact the admin for more information');
        header('location: login');
      } else {
        $_SESSION['user'] = $user;
        header('location: dashboard');
      } else :
      array_push($_SESSION['message'], 'wrong password or email');
      header('location: login');
    endif;
  endif;
else :
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <?php
    $head = ['title' => 'Login - ', 'scripts' => ['./js/script.js'], 'styles' => ['./css/style.css']];
    include_once('./partials/head.php');
    ?>
  </head>

  <body>
    <?php
    include_once('./partials/navbar.php');
    $hero = ['title' => 'Login', 'subtitle' => 'To start using the app'];
    include_once('./partials/hero.php');
    ?>
    <div class="container">
      <div class="columns is-centered is-multiline">
        <div class="column is-7">
          <?php include_once('./partials/notification.php') ?>
          <div class="box">
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
              <div class="columns is-centered is-multiline">
                <div class="column is-12">
                  <input class="input" type="email" name="email" placeholder="Email address" value="<?= oldData('email') ?>">
                </div>
                <div class="column is-12">
                  <input type="password" class="input" name="password" placeholder="Password">
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