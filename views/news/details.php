<h3><strong><?= $this->site ?></strong></h3>
<h1><?= $this->news->getTitle() ?></h1>
<strong><?= $this->news->getPubDateTime() ?></strong>
<small><?= $this->news->getAuthor() ?></small>
<br><br>
<p><?= $this->news->getContent() ?></p>
