<?php
$page = $pagination['page'];
$items = $pagination['items'];
$itemsPerPage = $pagination['itemsPerPage'];
$pages = ceil($items/$itemsPerPage);

if ($pages > 1){

$path = $pagination['path'];

echo '<ul class="pagination">';
  if ($page > 1){
    echo '<li><a href="' . $path. ($page - 1) . '">&laquo;</a></li>';
  }

  for ($i = 1; $i <= $pages; $i++){

    if($i === $page){
      echo '<li class="active"><a>' . $i . '</a></li>';
    } else {
      echo '<li><a href="' . $path . $i . '">' . $i . '</a></li>';
    }

  }

  if ($page < $pages){
    echo '<li><a href="' . $path . ($page + 1) . '">&raquo;</a></li>';
  }
echo '</ul>';
}
?>