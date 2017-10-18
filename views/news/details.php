<h3><strong><?= ucfirst($this->site) ?></strong></h3>
<h1><?= $this->news->getTitle() ?></h1>
<strong>
  <?= date('d/m/Y H:i', $this->news->getPubDateTime()) ?>
</strong>
<?php if (!empty($this->news->getUpdateDateTime())): ?>
  <p>
    <small>
      Zaktualizowano: <?= date('d/m/Y H:i', $this->news->getUpdateDateTime()) ?>
    </small>
  </p>
<?php endif; ?>
<?php if (!empty($this->news->getAuthor())): ?>
  <br>
  <small><?= $this->news->getAuthor() ?></small>
<?php endif; ?>
<br><br>
<?php if (!empty($this->news->getMainPhoto())): ?>
  <img src="<?= $this->news->getMainPhoto() ?>" alt="fotografia do wiadomości">
<?php endif; ?>
<p><?= $this->news->getContent() ?></p>
<br><br>
<a href="<?= $this->news->getSourceLink() ?>"  class="btn btn-default" role="button">Źródło</a>
