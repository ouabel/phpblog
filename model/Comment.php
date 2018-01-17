<?php

class Comment extends Content
{
  private $postId;
  private $author;
  private $reports;

  public function postId()
  {
    return $this->postId;
  }

  public function author()
  {
    return $this->author;
  }

  public function reports()
  {
    return $this->reports;
  }

  public function reported()
  {
    if (isset($_SESSION["reportComment-".$this->id()])){
      return true;
    } else {
      return false;
    }
  }

  public function setPostId($postId)
  {
    $postId = (int) $postId;

    if ($postId > 0)
    {
      $this->postId = $postId;
    }
  }

  public function setAuthor($author)
  {
    if (is_string($author))
    {
      $this->author = $author;
    }
  }

  public function setReports($reports)
  {
    (int) ($reports);
      $this->reports = $reports;
  }
}