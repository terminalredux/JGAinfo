<?php
  use Libs\Base\Bootstrap;
  use Libs\Session\Session;
  $app = Bootstrap::getInstance();
?>
<div class="main_template">
  <a href="<?= URL ?>site" class="btn btn-default" role="button">Strona główna <i class="fa fa-home" aria-hidden="true"></i></a>
	<a href="<?= URL ?>about" class="btn btn-default" role="button">O stronie <i class="fa fa-info-circle" aria-hidden="true"></i></a>
	<a href="<?= URL ?>news" class="btn btn-default" role="button">Wiadomości <i class="fa fa-newspaper-o" aria-hidden="true"></i></a>
  <?php if (Session::get('logged')): ?>
    <a href="<?= URL ?>dashboard" class="btn btn-default" role="button">Panel administracyjny <i class="fa fa-user-circle" aria-hidden="true"></i></a>
    <a href="<?= URL ?>site/logout" class="btn btn-default" role="button">Wyloguj <i class="fa fa-power-off" aria-hidden="true"></i></a>
  <?php else: ?>
    <a href="<?= URL ?>site/login" class="btn btn-default" role="button">Zaloguj <i class="fa fa-dot-circle-o" aria-hidden="true"></i></a>
  <?php endif; ?>
  <div class="container">
    <?php
      $app->getContent();
    ?>
</div>
</div>
