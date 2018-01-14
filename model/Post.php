<?php

class Post extends Content
{
  private $updateDateFr;
  private $commentsNumber;

  public function excerpt($readMore, $linkClass, $length = 450)
  {
    $excerpt = $this->content();
    if(strlen($excerpt) <= $length) {
      return $excerpt;
    } else {
      $excerpt = substr($excerpt, 0, $length);
      $excerpt = rtrim($excerpt);
      $excerpt .= '... <a href="' . $this->link() . '" class="' . $linkClass . '">' . $readMore . '</a>';
    }

    return $excerpt;
  }

  public function updateDateFr()
  {
    return $this->updateDateFr;
  }

  public function commentsNumber()
  {
    return $this->commentsNumber;
  }

  public function link($criteria = null)
  {
    switch ($criteria) {
      case 'edit':
        return "admin.php?action=editPost&amp;id=" . $this->id();
        break;

      case 'delete':
        return "admin.php?action=deletePost&amp;id=" . $this->id();
        break;

      case 'editComments':
        return "admin.php?action=editComments&amp;id=" . $this->id();
        break;

      default:
        return "index.php?action=post&amp;id=" . $this->id();
        break;
    }
  }

  public function setTitle($title)
  {
    if (is_string($title))
    {
      $this->title = $title;
    }
  }

  public function setUpdateDateFr($updateDateFr)
  {
    if (is_string($updateDateFr))
    {
      $this->updateDateFr = $updateDateFr;
    }
  }

  public function setCommentsNumber($commentsNumber)
  {
    $commentsNumber = (int) $commentsNumber;

    if ($commentsNumber > 0 )
    {
      $this->commentsNumber = $commentsNumber;
    }
  }
}