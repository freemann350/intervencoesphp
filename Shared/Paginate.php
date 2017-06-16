<?php  if ($row['TotalDados'] > $per_page) {?>
<div class="btn-group" style="margin-left: 10px">
  <?php if ($pg == 1) { ?>
  <a onclick="insertParameter('p', 1)" class="btn btn-default"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a>
  <a class="btn btn-default"><i class="fa fa-angle-left" aria-hidden="true"></i></a>

  <?php } else { ?>
  <a onclick="insertParameter('p', 1)" class="btn btn-default"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a>
  <a onclick="insertParameter('p', <?=$pg-1?>)" class="btn btn-default"><i class="fa fa-angle-left" aria-hidden="true"></i></a>

  <?php } ?>

  <?php
      $maxPages = ceil($row['TotalDados'] / $per_page);
      #ceiling(query sem limit / maximo de dados p/pág)
      $pageMaxDiff = $maxPages - $pg;
      $pagesRendered = 0;

      if ($maxPages <= 5) {
        for ($i = 1; $i <= $maxPages; $i++) {
  ?>
  <a onclick="insertParameter('p', <?=$i?>)" class="btn btn-default <?=($pg == $i) ? "active" : ""?>"><?=$i?></a>
  <?php
        };
      } else {
        if ($pg < 3) {
          for ($i = 1; $i <= $pg; $i++) {
  ?>
  <a onclick="insertParameter('p', <?=$i?>)" class="btn btn-default <?=($pg == $i) ? "active" : ""?>"><?=$i?></a>
  <?php
  $pagesRendered++;
          }
          $max = (5 - $pagesRendered > $maxPages) ? $maxPages : (5 - $pagesRendered);

          for ($i = $pg + 1; $i <= 5; $i++) {
  ?>
  <a onclick="insertParameter('p', <?=$i?>)" class="btn btn-default <?=($pg == $i) ? "active" : ""?>"><?=$i?></a>
  <?php
  $pagesRendered++;
          }
        } elseif ($pageMaxDiff < 3) {
          for ($i = $maxPages - 4; $i <= $maxPages; $i++) {
  ?>
  <a onclick="insertParameter('p', <?=$i?>)" class="btn btn-default <?=($pg == $i) ? "active" : ""?>"><?=$i?></a>
  <?php
    $pagesRendered++;
          }
        } else {
          for ($i = $pg - 2; $i <= $pg + 2; $i++) {
  ?>
  <a onclick="insertParameter('p', <?=$i?>)" class="btn btn-default <?=($pg == $i) ? "active" : ""?>"><?=$i?></a>
  <?php
  $pagesRendered++;
          }
        }
      }
  ?>
<?php if ($pg == $maxPages) { ?>
  <a class="btn btn-default"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
  <a class="btn btn-default"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
<?php } else { ?>
  <a onclick="insertParameter('p', <?=$pg+1?>)" class="btn btn-default"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
  <a onclick="insertParameter('p', <?=$maxPages?>)" class="btn btn-default"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
<?php } ?>

<?php if ($pg>$maxPages){ ?>
  <script>
    window.location.replace("Utilizadores");
  </script>
<?php } ?>
</div>
<?php } ?>
