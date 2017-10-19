<!doctype html>
<?php
  require_once "init.php";
  use Libs\Base\Bootstrap;
  $app = Bootstrap::getInstance();
  $app->sessionInit();
?>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>JGA Portal</title>
  <meta name="description" content="JGA">
  <meta name="author" content="IsoSub5">

  <script src="<?= URL ?>vendor/bower/jquery/dist/jquery.min.js"></script>
	<script src="<?= URL ?>vendor/bower/bootstrap/dist/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="<?= URL ?>vendor/bower/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= URL ?>vendor/bower/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= URL ?>web/css/main.css">

	<link rel='shortcut icon' type='image/x-icon' href='http://www.favicon.cc/logo3d/898887.png' />
	<link rel="stylesheet" href="/app/web/css/style.css">

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>
  <?php
    $app->initTemplate();
  ?>
</body>
</html>
