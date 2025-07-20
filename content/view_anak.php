<?php
             $jumPage=ceil($jumlahData / $dataperPage);
             if($noPage > 1)
             {
              echo '<li>';
              echo"<a href='?module=dataanak&hal=".($noPage-1)."'>&laquo;</a>";
              echo '</li>';
             }
             for($page = 1; $page <= $jumPage; $page++)
             {
              $showPage = 0;
              if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || 
                  ($page == 1) || ($page == $jumPage))
              {
               if (($showPage == 1) && ($page != 2)) {

                echo '<li class="disabled">';
                echo "<a href='#'>...</a>";
                echo '</li>';
               }
               if (($showPage != ($jumPage - 1)) && ($page == $jumPage)) {

                echo '<li class="disabled">';
                echo "<a href='#'>...</a>";
                echo '</li>';
               }
               if ($page == $noPage){

                echo '<li class="disabled">';
                 echo " <a href='#'><b>".$page."</b></a> ";
                echo '</li>';
               }
               else {

                echo '<li>';
                echo " <a href='?module=dataanak&hal=".$page."'>".$page."</a> ";
                echo '</li>';
               }
               $showPage=$page;
              }
             }


             if ($noPage < $jumPage) {

              echo '<li>';
              echo "<a href='umum-".($noPage+1).".html'>&raquo;</a>";
              echo '</li>';
              }
            ?>