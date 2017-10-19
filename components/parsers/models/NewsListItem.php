<?php
namespace App\Components\Parsers\Models;

class NewsListItem
{
  private $title;
  private $shortContent;
  private $thumbnail;
  private $link;
  private $author;
  private $pubDateTime;

  /**
   * Return how many hours left when post was added
   */
  public function hoursLeft() : int {
    $hours = time() - $this->pubDateTime;
    $result = $hours / 3600;
    return (int) $result;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getShortContent() {
    return $this->shortContent;
  }

  public function getThumbnail() {
    return $this->thumbnail;
  }

  public function getLink() {
    return $this->link;
  }

  public function getAuthor() {
    return $this->author;
  }

  public function getPubDateTime() {
    return $this->pubDateTime;
  }

  public function setTitle($title) {
    $this->title = $title;
  }

  public function setShortContent($shortContent) {
    $this->shortContent = $shortContent;
  }

  public function setThumbnail($thumbnail) {
    $this->thumbnail = $thumbnail;
  }

  public function setLink($link) {
    $this->link = $link;
  }

  public function setAuthor($author) {
    $this->author = $author;
  }

  public function setPubDateTime($pubDateTime) {
    $this->pubDateTime = $pubDateTime;
  }


}
