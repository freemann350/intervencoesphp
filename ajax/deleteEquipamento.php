<?php
  require_once("../Shared/conn.php");

  if (isset($_GET["id"])) {
    $Id = $_GET["id"];

    $stmt = $con->prepare("DELETE FROM equipamentos WHERE Id = ?");
    $stmt->bind_param("i", $Id);
    $stmt->execute();

  if (mysqli_affected_rows($con) > 0) {
    echo "1";
  } else {
    echo "0";
  }
};
