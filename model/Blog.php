<?php

class Blog
{
  private $id;
  private $title;
  private $description;

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

  public function description()
  {
    return $this->description;
  }

  public function setTitle($title)
  {
    if (is_string($title))
    {
      $this->title = $title;
    }
  }
  
  public function setDescription($description)
  {
    if (is_string($description))
    {
      $this->description = $description;
    }
  }

}