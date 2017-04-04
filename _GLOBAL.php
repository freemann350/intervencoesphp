<?php
  $rootFolder = "/intervencoesphp";

  define("ROOT", $rootFolder);
  define("INCLUDE_ROOT", $_SERVER["DOCUMENT_ROOT"] . $rootFolder);

  include_once(INCLUDE_ROOT . "/DB/conn.php");

 ?>
