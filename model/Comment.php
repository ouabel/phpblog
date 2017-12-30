<?php

class Comment
{
  private $id;
  private $postId;
  private $author;
  private $content;
  private $dateFr;
  private $reports;

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

  public function postId()
  {
    return $this->postId;
  }

  public function author()
  {
    return $this->author;
  }

  public function content()
  {
    return $this->content;
  }

  public function dateFr()
  {
    return $this->dateFr;
  }

  public function reports()
  {
    return $this->reports;
  }

  public function reported()
  {
    if (isset($_SESSION["reportComment-".$this->id])){
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
      $this->postId= $postId;
    }
  } 
  
  public function setAuthor($author)
  {
    if (is_string($author))
    {
      $this->author = $author;
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

  public function setReports($reports)
  {
    (int) ($reports);
      $this->reports = $reports;
  }
}