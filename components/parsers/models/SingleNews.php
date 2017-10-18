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
  private $mainPhoto;
  //private $photos;
  //private ??? next object ???

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
}
