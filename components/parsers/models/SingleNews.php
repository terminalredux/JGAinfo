<?php
namespace App\Components\Parsers\Models;

class SingleNews
{
  private $title;
  private $content;
  private $pubDateTime;
  //private $updateDateTime;
  private $author;
  private $sourceLink;
  //private $mainPhoto;
  //private $photos;

  public function getTitle() {
    return $this->title;
  }

  public function getContent() {
    return $this->content;
  }

  public function getPubDateTime() {
    return $this->pubDateTime;
  }

  public function getAuthor() {
    return $this->author;
  }

  public function getSourceLink() {
    return $this->sourceLink;
  }

  public function setTitle($title) {
    $this->title = $title;
  }

  public function setContent($content) {
    $this->content = $content;
  }

  public function setPubDateTime($pubDateTime) {
    $this->pubDateTime = $pubDateTime;
  }

  public function setAuthor($author) {
    $this->author = $author;
  }

  public function setSourceLink($sourceLink) {
    $this->sourceLink = $sourceLink;
  }
}
