<?php
  $currDay = date('d/m/Y');
?>
<h3>Przegląd wiadomości strony <strong><?= $this->site ?></strong></h3>
<br>
<?php foreach($this->list as $item): ?>
  <div class="row" style="<?= $currDay == date('d/m/Y', $item->getPubDateTime()) ? 'background: #E4F1FE;' : '' ?>">
    <div class="col-md-2">
      <div class="text-center">
        <?= '<img src="' . $item->getThumbnail() . '" width="150px">' ?>
      </div>
    </div>
    <div class="col-md-10">
      <div class="row">
        <h5><strong><a href="<?= $item->getLink() ?>"><?= $item->getTitle() ?></a></strong></h5>
        <?php if (!empty($item->getAuthor())): ?>
          <small><?= $item->getAuthor() ?></small><br>
        <?php endif; ?>
        <p><?= date('d/m/Y H:i', $item->getPubDateTime()); ?></p>
        <p><?= $item->getShortContent() ?></p>
      </div>
      <div class="row text-right">
        <form action="<?= URL ?>news/details/<?= $this->site ?>" method="POST">
            <input type="hidden" name="details_url" value="<?= $item->getLink() ?>">
            <input type="submit" value="Więcej" class="btn btn-default">
        </form>
      </div>
    </div>
  </div>
  <hr>
<?php endforeach; ?>
