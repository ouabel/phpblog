<?php

class Post
{
  private $id;
  private $title;
  private $content;
  private $dateFr;
  private $updateDateFr;
  private $commentsNumber;

  public function __construct(array $data)
  {
    $this->hydrate($data);
  }

  public function hydrate(array $data)
  {
    foreach ($data as $key => $value)
    {
      $method = 'set'.ucfirst($key);

      if (method_exists($this, $method))
      {
        $this->$method($value);
      }
    }
  }

  public function setId($id)
  {
    $id = (int) $id;

    if ($id > 0)
    {
      $this->id = $id;
    }
  }

  public function id()
  {
    return $this->id;
  }

  public function title()
  {
    return $this->title;
  }

  public function content()
  {
    return $this->content;
  }

  public function dateFr()
  {
    return $this->dateFr;
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
        return "admin.php?action=editPost&amp;id=" . $this->id;
        break;

      case 'delete':
        return "admin.php?action=deletePost&amp;id=" . $this->id;
        break;

      case 'editComments':
        return "admin.php?action=editComments&amp;id=" . $this->id;
        break;

      default:
        return "index.php?action=post&amp;id=" . $this->id;
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

  public function setContent($content)
  {
    if (is_string($content))
    {
      $this->content = $content;
    }
  }

  public function setDateFr($dateFr)
  {
    if (is_string($dateFr))
    {
      $this->dateFr = $dateFr;
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