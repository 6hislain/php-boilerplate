<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= isset($head['title']) ? $head['title'] : '' ?>PHP Boilerplate</title>
<link rel="shortcut icon" href="<?= is_file('img/favicon.ico') ? 'img/favicon.ico' : '../img/favicon.ico' ?>" />
<?php
if (isset($head['styles'])) :
  foreach ($head['styles'] as $style) :
?>
    <link rel="stylesheet" href="<?= $style ?>">
  <?php
  endforeach;
endif;
if (isset($head['scripts'])) :
  foreach ($head['scripts'] as $script) :
  ?>
    <script src="<?= $script ?>"></script>
<?php
  endforeach;
endif;
?>