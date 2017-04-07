<?php
  require_once("../Shared/conn.php");

  $id = $_GET["id"];

  $stmt = $con->prepare("select * from salas where idbloco = ? order by Sala asc");
  $stmt->bind_param("i", $id);

  $stmt->execute();
  $result = $stmt->get_result();

  while ($row = $result->fetch_assoc()) {
?>
  <option value="<?=$row["Id"]?>"><?=$row["Sala"]?></option>
<?php } ?>
