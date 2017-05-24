<?php
  require_once("../Shared/conn.php");

  if (isset($_GET["id"])) {
    $Id = $_GET["id"];

    $stmt = $con->prepare("UPDATE pedidos INNER JOIN intervencoes ON pedidos.Id = intervencoes.IdPedido SET pedidos.Resolvido = 0 WHERE intervencoes.Id = ?");
    $stmt->bind_param("i", $Id);
    $stmt->execute();

    $stmt = $con->prepare("DELETE FROM intervencoes WHERE Id = ?");
    $stmt->bind_param("i", $Id);
    $stmt->execute();

  if (mysqli_affected_rows($con) > 0) {
    echo "1";
  } else {
    echo "0";
  }
};
