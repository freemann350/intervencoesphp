<?php
  if (!(isset($_GET["Id"])) || (trim($_GET["Id"]) == "") || !(is_numeric($_GET["Id"]))) {
    header("Location: 404");
  }

  $titulo = "Editar tipo de equipamento";

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  if ($LoggedRole == 3) {
    header("Location: 403");
  }

  $stmt = $con->prepare(
  "SELECT * FROM equipamentos WHERE Id = ?"
  );

  $stmt->bind_param("i", $_GET['Id']);
  $stmt->execute();

  $result = $stmt->get_result();
  $equipamento = $result->fetch_assoc();

  if (isset($_POST["editar_equip_submit"])) {
    // Escape user inputs for security
    $Nome = trim(mysqli_real_escape_string($con, $_POST['Nome']));
    $Tipo = trim(mysqli_real_escape_string($con, $_POST['Tipo']));
    $Sala = trim(mysqli_real_escape_string($con, $_POST['Sala']));
    $NrSerie = trim(mysqli_real_escape_string($con, $_POST['NrSerie']));
    $Observacoes = trim(mysqli_real_escape_string($con, $_POST['Observacoes']));
    $Id = trim(mysqli_real_escape_string($con, $_GET['Id']));

    $stmt = $con->prepare("UPDATE equipamentos SET Nome = ?, IdTipo = ?, IdSala = ?, NrSerie = ?, Observacoes = ? WHERE Id = ?");

    $stmt->bind_param("siissi", $Nome, $Tipo, $Sala, $NrSerie, $Observacoes, $Id);

    $stmt->execute();
    header('Location: Equipamentos');
  }
?>
<!DOCTYPE html>
<html lang="pt">

<?php #HEADER INCLUDE
      Include 'Shared/Head.php';
?>

<body>
    <section id="container">
      <?php #HEADER INCLUDE
            include 'Shared/Header.php';
      ?>

      <?php #SIDEBAR INCLUDE
            include 'Shared/Sidebar.php';
      ?>

        <!--MAIN CONTENT-->
        <section id="main-content">
            <section class="wrapper">
                <h3><i class="fa fa-angle-right"></i> Novo Equipamento</h3>
                <div class="row mt">
                    <div class="form-panel">
                      <form class="form-horizontal style-form" method="POST">
                          <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="Nome" required value="<?=$equipamento['Nome']?>">
                              <br>
                            </div>

                            <br>
                            <label class="col-sm-2 col-sm-2 control-label">Tipo de Equipamento</label>
                            <div class="col-sm-10">
                              <select class="form-control" name="Tipo" required>
                                <?php
                                  $stmt1 = $con->prepare("SELECT * FROM tipoequipamento");

                                  $stmt1->execute();
                                  $result1 = $stmt1->get_result();

                                  while ($tipo = $result1->fetch_assoc()) {
                                ?>

                                <option value="<?= $tipo['Id'] ?>"><?=$tipo["TipoEquipamento"]; ?></option>
                                <?php } ?>
                              </select>
                              <br>
                            </div>

                            <br>
                            <label class="col-sm-2 col-sm-2 control-label">Sala</label>
                            <div class="col-sm-10">
                              <select class="form-control" name="Sala" required>
                                  <?php
                                    $stmt1 = $con->prepare("SELECT * FROM salas");

                                    $stmt1->execute();
                                    $result1 = $stmt1->get_result();

                                    while ($salas = $result1->fetch_assoc()) {
                                  ?>

                                  <option value="<?= $salas['Id'] ?>"><?=$salas["Sala"]; ?></option>
                                  <?php } ?>
                              </select>
                              <br>
                            </div>

                            <label class="col-sm-2 col-sm-2 control-label">Número de série (Opcional)</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="NrSerie" value="<?=$equipamento['NrSerie']?>">
                              <br>
                            </div>

                            <label class="col-sm-2 col-sm-2 control-label">Observações (Opcional)</label>
                            <div class="col-sm-10">
                              <textarea type="text" class="form-control" rows="7" name="Observacoes"><?=$equipamento['Observacoes']?></textarea>
                              <br>
                              <input type="submit" name="editar_equip_submit" class="btn btn-primary" value="Submeter">
                            </div>
                          </div>
                      </form>
                    </div>
                </div>
            </section>
            <!-- /MAIN CONTENT -->

            <?php #FOOTER INCLUDE
              include 'Shared\Footer.php';
            ?>
        </section>
    </section>

    <?php #HEADER INCLUDE
          include 'Shared/Scripts.php'
    ?>

</body>

</html>
