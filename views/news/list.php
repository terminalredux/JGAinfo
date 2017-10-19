<?php
  $currDay = date('d/m/Y');
?>
<h3><strong><?=  ucfirst($this->site) ?></strong></h3>
<br>
<?php foreach($this->list as $item): ?>
  <div class="row news-list-item">
    <div class="col-md-2">
      <div class="text-center">
        <?= '<img src="' . $item->getThumbnail() . '" width="100px">' ?>
      </div>
    </div>
    <div class="col-md-10">
      <div class="row">
        <h5><strong><?= $item->getTitle() ?></strong></h5>
        <?php if ($currDay == date('d/m/Y', $item->getPubDateTime())): ?>
          <small>Dzisiaj <?= date('H:i', $item->getPubDateTime()) ?> <i class="fa fa-clock-o" aria-hidden="true"></i></small><br>
        <?php else: ?>
          <small><?= date('d/m/Y H:i', $item->getPubDateTime()) ?> <i class="fa fa-clock-o" aria-hidden="true"></i></small><br>
        <?php endif; ?>
        <?php if (!empty($item->getAuthor())): ?>
          <small><?= $item->getAuthor() ?></small><br>
        <?php endif; ?>
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
