<?php
$jumPage = ceil($jumlahData / $dataperPage);
if($noPage > 1){
  echo '<li><a href="?module=ibuhamil&hal='.($noPage-1).'">&laquo;</a></li>';
}
for($page = 1; $page <= $jumPage; $page++){
  $showPage = 0;
  if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)){
    if (($showPage == 1) && ($page != 2)){
      echo '<li class="disabled"><a href="#">...</a></li>';
    }
    if (($showPage != ($jumPage - 1)) && ($page == $jumPage)){
      echo '<li class="disabled"><a href="#">...</a></li>';
    }
    if ($page == $noPage){
      echo '<li class="disabled"><a href="#"><b>'.$page.'</b></a></li>';
    }else{
      echo '<li><a href="?module=ibuhamil&hal='.$page.'">'.$page.'</a></li>';
    }
    $showPage = $page;
  }
}
if ($noPage < $jumPage){
  echo '<li><a href="?module=ibuhamil&hal='.($noPage+1).'">&raquo;</a></li>';
}
?>