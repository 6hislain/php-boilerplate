<?php if (isset($_SESSION['message']) && count($_SESSION['message'])) : ?>
  <div class="notification is-warning">
    <button class="delete"></button>
    <ul>
      <?php foreach ($_SESSION['message'] as $message) : ?>
        <li><?= ucfirst($message) ?></li>
      <?php endforeach ?>
    </ul>
  </div>
<?php endif ?>