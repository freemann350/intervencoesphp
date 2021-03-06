<?php
  $titulo = "Novo Equipamento";
  $validatejs = true;

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  if ($LoggedRole == "3") {
    header("Location: 403");
  }

  if (isset($_POST["novo_equip_submit"]) && (isset($_POST['Nome'])) && (isset($_POST['Tipo'])) && (isset($_POST['Sala']))) {
    // Escape user inputs for security
    $Nome = trim(mysqli_real_escape_string($con, $_POST['Nome']));
    $Tipo = trim(mysqli_real_escape_string($con, $_POST['Tipo']));
    $Sala = trim(mysqli_real_escape_string($con, $_POST['Sala']));
    $NSerie = trim(mysqli_real_escape_string($con, $_POST['NrSerie']));
    $Observacoes = trim(mysqli_real_escape_string($con, $_POST['Observacoes']));
    $Observacoes = stripslashes(str_replace('\r\n',PHP_EOL,$Observacoes));

    $stmt = $con->prepare("INSERT INTO equipamentos (Nome, IdTipo, IdSala, Observacoes, NrSerie, Ativo) VALUES (?, ?, ?, ?, ?, '1')");

    $stmt->bind_param("siiss", $Nome, $Tipo, $Sala, $Observacoes, $NSerie);

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
                        <form class="form-horizontal style-form" method="POST" id="NovoEquipamentoForm">
                            <div class="form-group">

                              <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="Nome" required>
                                <br>
                              </div>

                              <label class="col-sm-2 col-sm-2 control-label">Tipo de Equipamento</label>
                              <div class="col-sm-10">
                                <select class="form-control" name="Tipo" required>
                                  <option value="" selected hidden>Escolha o tipo de equipamento...</option>
                                  <?php
                                    $stmt1 = $con->prepare("SELECT * FROM tipoequipamento WHERE Ativo = '1'");

                                    $stmt1->execute();
                                    $result1 = $stmt1->get_result();

                                    while ($tipo = $result1->fetch_assoc()) {
                                  ?>

                                  <option value="<?= $tipo['Id'] ?>"><?=$tipo["TipoEquipamento"]; ?></option>
                                  <?php } ?>
                                </select>
                                <br>
                              </div>

                              <label class="col-sm-2 col-sm-2 control-label">Bloco</label>
                              <div class="col-sm-10">
                                <select id="bloco" class="form-control" name="Bloco" required onchange="getSalas(this);">
                                  <?php
                                    $stmt = $con->prepare("SELECT * FROM blocos");

                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    while ($row = $result->fetch_assoc()) {
                                  ?>
                                    <option value="<?= $row['Id'] ?>"><?= $row["Bloco"] ?></option>
                                  <?php }; ?>
                                </select>
                                <br>
                              </div>

                              <label class="col-sm-2 col-sm-2 control-label">Sala</label>
                              <div class="col-sm-10">
                                <select id="sala" class="form-control" name="Sala" required>
                                </select>
                                <br>
                              </div>

                              <label class="col-sm-2 col-sm-2 control-label">Número de série (Opcional)</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="NrSerie">
                                <span class="help-block"></span>
                                <br>
                              </div>

                              <label class="col-sm-2 col-sm-2 control-label">Observações (Opcional)</label>
                              <div class="col-sm-10">
                                  <textarea type="text" class="form-control" rows="7" name="Observacoes"></textarea>
                                  <span class="help-block">Tente ser o mais breve possível.</span>
                                  <br>
                                  <input type="submit" class="btn btn-primary" value="Submeter" name="novo_equip_submit">
                              </div>
                        </form>
                      </div>
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
    <script type="text/javascript" src="assets/libs/template/js/editar-pedido.js"></script>
    <script type="text/javascript">
      $("#NovoEquipamentoForm").validate({
         errorClass: "my-error-class",
         validClass: "my-valid-class",

         messages: {
          'Nome': "Tem de escrever o nome do equipamento",
          'Tipo': "Tem de escolher que tipo de equipamento é este",
          'Sala': "Tem de escolher a sala deste equipamento"
         }
      });
    </script>
</body>

</html>
