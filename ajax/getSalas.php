<?php
  require_once("../Shared/conn.php");

  $id = $_GET["id"];

  $stmt = $con->prepare("SELECT * FROM salas WHERE IdBloco = ? ORDER BY Sala ASC");
  $stmt->bind_param("i", $id);

  $stmt->execute();
  $result = $stmt->get_result();
?>
  <option selected value="">Escolha uma sala...</option>

<?php
  while ($row = $result->fetch_assoc()) {
?>
  <option value="<?=$row["Id"]?>"><?=$row["Sala"]?></option>
<?php } ?>
