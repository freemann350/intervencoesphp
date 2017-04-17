<?php
  if (!(isset($_GET["Id"])) || (trim($_GET["Id"]) == "") || !(is_numeric($_GET["Id"]))) {
    header("Location: Inicial");
  }

  $titulo = "Editar";
  $datepickerInclude = true;
  $removeInclude =  true;
  $filtrosInclude =  true;
  $timepickerInclude =  true;

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  $stmt = $con->prepare(
  "SELECT pedidos.Id, pedidos.descricao, pedidos.Data, pedidos.Hora, pedidos.Resolvido, equipamentos.Nome, salas.Sala, pedidos.IdEquipamento, concat_ws(' ', professores.Nome, professores.Apelido) NomeTodo FROM pedidos INNER JOIN Salas ON pedidos.IdSala = salas.Id INNER JOIN equipamentos ON pedidos.IdEquipamento = equipamentos.Id INNER JOIN professores ON pedidos.IdProfessor = professores.Id WHERE pedidos.Id = ? AND pedidos.IdProfessor = ?");

  $stmt->bind_param("ii", $_GET['Id'], $LoggedID);
  $stmt->execute();

  $result = $stmt->get_result();

  if ($result->num_rows == 0) {
    header("Location: Inicial");
  }

  $pedido = $result->fetch_assoc();

  $Date = str_replace('-', '/', $pedido['Data']);
  $DataLeitura = date('d/m/Y', strtotime($Date));

  $HoraLeitura = date('H:i', strtotime($pedido['Hora']));

  if (isset($_POST["editar_pedidos_submit"])) {
    // Escape strings para prevenção de MySQL injection
    $Id = trim(mysqli_real_escape_string($con, $_POST['Id']));
    $Sala = trim(mysqli_real_escape_string($con, $_POST['Sala']));
    $Equipamento = trim(mysqli_real_escape_string($con, $_POST['Equipamento']));
    $Data = trim(mysqli_real_escape_string($con, $_POST['Data']));
    $Hora = trim(mysqli_real_escape_string($con, $_POST['Hora']));
    $Descricao = trim(mysqli_real_escape_string($con, $_POST['Descricao']));

    // Conversão da data do utilizador para formato MySQLi
    $Date = str_replace('/', '-', $Data);
    $DataMySQL = date('Y-m-d', strtotime($Date));

    $stmt = $con->prepare(
    "UPDATE pedidos
     SET IdSala = ?, IdEquipamento = ?, Data = ?, Hora = ?, Descricao = ?
     WHERE Id = ?
    ");

    $stmt->bind_param("iisssi", $Sala, $Equipamento, $DataMySQL, $Hora, $Descricao, $Id);

    $stmt->execute();

    $ttl='Sucesso';
    $msg = 'Dados introduzidos com sucesso.';
  };
?>
<!DOCTYPE html>
<html lang="pt">

<?php #HEADER INCLUDE
      include 'Shared/Head.php'
?>

<body>

    <section id="container">
      <?php #HEADER INCLUDE
            include 'Shared/Header.php'
      ?>

      <?php #SIDEBAR INCLUDE
            include 'Shared/Sidebar.php'
      ?>

        <!--MAIN CONTENT-->
        <section id="main-content">
            <section class="wrapper site-min-height"><br>
              <div class="alert alert-danger"><b>Erro!</b> Os dados não foram alterados com êxito.</div>
                <h3><i class="fa fa-angle-right"></i> Registo de Pedidos - Editar</h3>
                <div class="row mt">
                    <div class="form-panel">
                        <form class="form-horizontal style-form" method="POST" action="<?= $_SERVER["PHP_SELF"] ?>">
                            <div class="form-group">
                                <br>
                                <input type="hidden" value="<?=$pedido['Id']?>" name="Id">

                                <label class="col-sm-2 col-sm-2 control-label">Bloco</label>
                                <div class="col-sm-10">
                                  <select id="bloco" class="form-control" name="Bloco" required onchange="getSalas(this);">
                                    <?php
                                      $stmt = $con->prepare("SELECT * FROM blocos");

                                      $stmt->execute();
                                      $result = $stmt->get_result();

                                      while ($row = $result->fetch_assoc()) {
                                    ?>
                                      <option value="<?= $row['Id'] ?>"<?=($row["Id"] == $pedido["Id"] ? "selected" : "") ?>><?= $row["Bloco"] ?></option>
                                    <?php }; ?>
                                  </select>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Sala</label>
                                <div class="col-sm-10">
                                  <select id="sala" disabled class="form-control" name="Sala" required>
                                    <option value="0" selected disabled hidden>Escolha a Sala...</option>
                                  </select>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Equipamento</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Equipamento" required>
                                      <option value="0" selected disabled hidden>Escolha o Equipamento...</option>
                                      <?php
                                        $stmt = $con->prepare("SELECT * FROM equipamentos");

                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        while ($row = $result->fetch_assoc()) {
                                      ?>
                                      <option value="<?= $row['Id'] ?>" <?=(($row["Id"] == $pedido["IdEquipamento"]) ? "selected" : "")  ?>><?=$row["Nome"] ?></option>
                                      <?php }; ?>
                                    </select>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Data</label>
                                <div class="col-sm-10" id="datepicker-registos">
                                  <div class="input-group date">
                                    <span class="input-group-addon time-get-color">
                                      <i class="glyphicon glyphicon-th"></i>
                                    </span>
                                    <input type="text" class="form-control" value="<?=$DataLeitura?>" name="Data" readonly>
                                  </div>
                                  <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Hora</label>
                                <div class="col-sm-10">
                                  <div class="input-group clockpicker">
                                    <span class="input-group-addon time-get-color">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                  <input type="text" class="form-control" value="<?=$HoraLeitura?>" name="Hora"
                                  readonly required>
                                  </div>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Descrição</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" rows="7" name="Descricao" required><?=$pedido['descricao']?></textarea>
                                    <span class="help-block">Tente ser o mais breve possível</span>
                                    <br>
                                    <input type="submit" class="btn btn-primary" value="Submeter" name="editar_pedidos_submit">
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
</body>

</html>
