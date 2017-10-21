<?php
  use Libs\Base\Bootstrap;
  use Libs\Session\Session;
  $app = Bootstrap::getInstance();
?>
<div class="main_template">
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="<?= URL ?>site">JGA info</a>
      </div>
      <ul class="nav navbar-nav">
        <li><a href="<?= URL ?>news/list/jelonka"><i class="fa fa-rss" aria-hidden="true"></i> jelonka.com</a></li>
        <li><a href="<?= URL ?>news/list/jg24"><i class="fa fa-rss" aria-hidden="true"></i> jg24.pl</a></li>
        <li><a href="<?= URL ?>news/list/24jgora"><i class="fa fa-rss" aria-hidden="true"></i> 24jgora.pl</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if (Session::get('logged')): ?>
          <li><a href="<?= URL ?>dashboard">Panel administracyjny <i class="fa fa-user-circle" aria-hidden="true"></i></a></li>
          <li><a href="<?= URL ?>site/logout">Wyloguj <i class="fa fa-power-off" aria-hidden="true"></i></a></li>
        <?php else: ?>
          <li><a href="<?= URL ?>about">O stronie <i class="fa fa-info-circle" aria-hidden="true"></i></a></li>
          <li><a href="<?= URL ?>site/contact">Kontakt <i class="fa fa-envelope-open" aria-hidden="true"></i></a></li>
          <li><a href="<?= URL ?>site/login">Zaloguj <i class="fa fa-dot-circle-o" aria-hidden="true"></i></a></li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>
  <div class="container">
    <?php
      $app->getContent();
    ?>
</div>
</div>
