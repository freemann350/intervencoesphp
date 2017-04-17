<?php
  require_once("../Shared/conn.php");

  if (isset($_GET["id"])) {
    $Id = $_GET["id"];

    $stmt = $con->prepare("DELETE FROM pedidos WHERE Id = ?");
    $stmt->bind_param("i", $Id);
    $stmt->execute();

    echo "1";
  } else {
    echo "0";
  }
