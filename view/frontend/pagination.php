<?php
$page = $pagination['page'];
$items = $pagination['items'];
$itemsPerPage = $pagination['itemsPerPage'];
$pages = ceil($items/$itemsPerPage);

if ($pages > 1){

$path = $pagination['path'];

echo '<div class="pagination">';
  if ($page > 1){
    echo '<a href="' . $path. ($page - 1) . '">&#9664;</a> — ';
  }

  for ($i = 1; $i <= $pages; $i++){

    if($i === $page){
      echo '<span class="current-page">' . $i . '</span>';
    } else {
      echo ' <a href="' . $path . $i . '">' . $i . '</a> ';
    }

  }

  if ($page < $pages){
    echo ' — <a href="' . $path . ($page + 1) . '">&#9654;</a>';
  }
echo '</div>';
}
?>