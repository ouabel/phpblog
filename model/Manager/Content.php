<?php
class ContentManager extends Manager
{
  private $itemsPerPage;
  protected $table;
  protected $countItems;

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

  public function setCountItems($countItems)
  {
    $countItems = (int) $countItems;
    $this->countItems = $countItems;
  }

  public function countItems()
  {
    return $this->countItems;
  }

  public function pagination($path, $class = 'pagination'){

    $page = $this->currentPage();
    $itemsPerPage = $this->itemsPerPage();
    $items = $this->countItems;
    $pages = ceil($items/$itemsPerPage);
    $pagination = '';
    $path .= 'page=';

    if ($pages > 1){
      $pagination .= '<ul class="' . $class . '">';
        if ($page > 1){
          $pagination .= '<li><a href="' . $path. ($page - 1) . '">&laquo;</a></li>';
        }

        for ($i = 1; $i <= $pages; $i++){

          if($i === $page){
            $pagination .= '<li class="active"><a>' . $i . '</a></li>';
          } else {
            $pagination .= '<li><a href="' . $path . $i . '">' . $i . '</a></li>';
          }

        }

        if ($page < $pages){
          $pagination .= '<li><a href="' . $path . ($page + 1) . '">&raquo;</a></li>';
        }
      $pagination .= '</ul>';
      return $pagination;
    }
    return false;
  }

}