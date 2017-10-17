<?php
namespace App\Components\Parsers\Models;

class NewsList
{
  private $titles = [];
  private $shortContents = [];
  private $authors = [];
  private $thumbnails = [];
  private $pubDateTimes = [];
  private $links = [];
  private $length;

  /**
   * Flag for validation method
   */
  const NO_AUTHORS = 1;

  /**
   * Check if the number of items
   * in each array is the same
   * Sets length property!
   * @param bool $flag
   * @return bool
   */
  public function validation($flag = false) : bool {
    $result = false;
    if ($flag === self::NO_AUTHORS) {
      if ($this->titles->length && $this->shortContents->length && $this->thumbnails->length
        && $this->pubDateTimes->length && $this->links->length) {
        $result = true;
      }
    } else if (!$flag) {
      if ($this->titles->length && $this->shortContents->length && $this->authors->length
        && $this->thumbnails->length && $this->pubDateTimes->length && $this->links->length) {
        $result = true;
      }
    }
    if ($result) {
      $this->length = $this->titles->length;
    }
    return $result;
  }

  /**
   * Gets length. You must call validation() method first to set.
   * If failure return 0 as a error message!
   * @return int
   */
  public function getLength() : int {
    if (isset($this->length)) {
      return $this->length;
    }
    return 0;
  }

  public function getTitle($position) {
    return $this->titles[$position];
  }

  public function setTitles($titles) {
    $this->titles = $titles;
  }

  public function getShortContent($position) {
    return $this->shortContents[$position];
  }

  public function setShortContents($shortContents) {
    $this->shortContents = $shortContents;
  }

  public function getAuthor($position) {
    return $this->authors[$position];
  }

  public function setAuthors($authors) {
    $this->authors = $authors;
  }

  public function getThumbnail($position) {
    return $this->thumbnails[$position];
  }

  public function setThumbnails($thumbnails)  {
    $this->thumbnails = $thumbnails;
  }

  public function getPubDateTime($position) {
    return $this->pubDateTimes[$position];
  }

  public function setPubDateTimes($pubDateTimes) {
    $this->pubDateTimes = $pubDateTimes;
  }

  public function getLink($position) {
    return $this->links[$position];
  }

  public function setLinks($links) {
    $this->links = $links;
  }
}
