<?php
  require_once("../Shared/conn.php");

  $id = $_GET["id"];

  $stmt = $con->prepare("SELECT * FROM equipamentos WHERE IdSala = ? ORDER BY Nome ASC");
  $stmt->bind_param("i", $id);

  $stmt->execute();
  $result = $stmt->get_result();
  ?>
    <option selected value="">Escolha um equipamento...</option>

  <?php
    while ($row = $result->fetch_assoc()) {
  ?>
  <option value="<?=$row["Id"]?>"><?=$row["Nome"]?></option>
<?php } ?>
