<?php
namespace App\Components\Parsers\Models;

class SingleNews
{
  private $title;
  private $content;
  private $pubDateTime;
  private $updateDateTime;
  private $author;
  private $sourceLink;
  private $mainPhoto;
  //private $photos; as a GalleryInterface ???
  //private ??? next object ???

  /**
   * Check first if there is more
   * one than one paragraph
   */
  public function getFirtspParagraph() : string {
    $array = explode('<br><br>', $this->content);
    return $array[0];
  }

  /**
   *
   */
  public function getRestArticle() : string {
    $array = explode('<br><br>', $this->content);
    unset($array[0]);
    return implode('<br><br>', $array);
  }

  public function getTitle() : string {
    return $this->title;
  }

  public function getContent() : string {
    return $this->content;
  }

  public function getPubDateTime() : int {
    return $this->pubDateTime;
  }

  public function getAuthor() : string {
    return $this->author;
  }

  public function getSourceLink() : string {
    return $this->sourceLink;
  }

  public function getMainPhoto(){
    return $this->mainPhoto;
  }

  public function getUpdateDateTime() {
    return $this->updateDateTime;
  }

  public function setTitle($title) : void {
    $this->title = $title;
  }

  public function setContent($content) : void {
    $this->content = $content;
  }

  public function setPubDateTime($pubDateTime) : void  {
    $this->pubDateTime = $pubDateTime;
  }

  public function setAuthor($author) : void {
    $this->author = $author;
  }

  public function setSourceLink($sourceLink) : void {
    $this->sourceLink = $sourceLink;
  }

  public function setMainPhoto($mainPhoto) : void {
    $this->mainPhoto = $mainPhoto;
  }

  public function setuUpdateDateTime($updateDateTime) {
    $this->updateDateTime = $updateDateTime;
  }
}
