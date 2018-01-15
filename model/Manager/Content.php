<?php
class ContentManager extends Manager
{
  private $itemsPerPage;
  protected $table;

  public function __construct($table)
  {
    if(is_string($table)){
      $this->table = $table;
    }
  }

  public function itemsPerPage(){
    return $this->itemsPerPage;
  }

  public function table(){
    return $this->table;
  }

  public function setItemsPerPage($int){
    $int = (int) $int;
    $this->itemsPerPage = $int;
  }

  public function deleteContent(Content $content)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('DELETE FROM ' . $this->table() . ' WHERE id = ?');
    $executeResult = $req->execute([$content->id()]);

    return $executeResult;
  }

  public function currentPage()
  {
    if(isset($_GET['page'])){
      $page = intval($_GET['page']);
      if($page <= 1){
        $page = 1;
      }
    } else {
      $page = 1;
    }
    return $page;
  }
}