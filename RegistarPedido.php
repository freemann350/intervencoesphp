<?php
  $titulo = "Registar Pedido";
  $datepickerInclude = true;
  $PrpActive = true;
  $timepickerInclude = true;
  $validatejs = true;

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  if (isset($_POST["pedido_submit"]) && (isset($_POST["Bloco"])) && (isset($_POST["Sala"])) && (isset($_POST["Equipamento"])) && (isset($_POST["Data"])) && (isset($_POST["Hora"])) && (isset($_POST["Descricao"])) && ($_POST["Equipamento"] !== '0')) {
    // Escape strings para prevenção de MySQL injection
    $Sala = trim(mysqli_real_escape_string($con, $_POST['Sala']));
    $Equipamento = trim(mysqli_real_escape_string($con, $_POST['Equipamento']));
    $Data = trim(mysqli_real_escape_string($con, $_POST['Data']));
    $Hora = trim(mysqli_real_escape_string($con, $_POST['Hora']));
    $Descricao = trim(mysqli_real_escape_string($con, $_POST['Descricao']));
    $Descricao = stripslashes(str_replace('\r\n',PHP_EOL,$Descricao));

    // Conversão da data do utilizador para formato MySQLi
    $Date = str_replace('/', '-', $Data);
    $DataMySQL = date('Y-m-d', strtotime($Date));

    $stmt = $con->prepare("INSERT INTO pedidos (IdProfessor, IdSala, IdEquipamento, Data, Hora, Descricao) VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("iiisss", $LoggedID, $Sala, $Equipamento, $DataMySQL, $Hora, $Descricao);

    $stmt->execute();

    $msg = '1';
  } else {
    $msg = '2';
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
            <section class="wrapper">
              <?php
                if (isset($msg) && (isset($_POST['pedido_submit']))) {
                  if ($msg = "1") {
              ?>
                <br>
                <div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Sucesso!</b> Os dados foram inseridos com êxito.</div>
              <?php
                } elseif ($msg = "2") {
              ?>
                <br>
                <div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Ocorreu um erro.</b> Se tal persistir, contacte um responsável técnico.</div>
              <?php
                  }
                }
              ?>
                <h3><i class="fa fa-angle-right"></i> Registo de pedido</h3>
                <div class="row mt">
                    <div class="form-panel">
                        <form class="form-horizontal style-form" id="RegistarPedido" method="POST">
                            <div class="form-group">
                                <br>

                                <label class="col-sm-2 col-sm-2 control-label">Bloco</label>
                                <div class="col-sm-10">
                                  <select id="bloco" class="form-control" name="Bloco" required onchange="getSalas(this);">
                                    <?php
                                      $stmt = $con->prepare("SELECT * FROM blocos");

                                      $stmt->execute();
                                      $result = $stmt->get_result();

                                      while ($row = $result->fetch_assoc()) {
                                    ?>
                                      <option value="<?= $row['Id']?>"<?php echo ($row["Bloco"] == "A" ? "selected" : "") ?>><?= $row["Bloco"] ?></option>
                                    <?php }; ?>
                                  </select>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Sala</label>
                                <div class="col-sm-10">
                                  <select id="sala" class="form-control" name="Sala" required onchange="getEquip(this);">
                                  </select>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Equipamento</label>
                                <div class="col-sm-10">
                                  <select id="equipamento" class="form-control" name="Equipamento" required>
                                  </select>
                                  <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Data</label>
                                <div class="col-sm-10" id="datepicker-registos">
                                  <div class="input-group date">
                                    <span class="input-group-addon time-get-color">
                                      <i class="glyphicon glyphicon-th"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="DD/MM/AAAA" value="<?php if (isset($_POST['Data'])) { echo $_POST['Data']; } else { echo date("d/m/Y"); }; ?>" name="Data" readonly required>
                                  </div>
                                  <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Hora</label>
                                <div class="col-sm-10">
                                  <div class="input-group clockpicker">
                                    <span class="input-group-addon time-get-color">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                  <input type="text" class="form-control" placeholder="HH:MM" value="<?php if (isset($_POST['Hora'])) { echo $_POST['Hora']; } else { echo (date('H:i', strtotime('-1 hour'))); }; ?>" name="Hora"
                                  readonly required>
                                  </div>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Descrição</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" rows="7" name="Descricao" required placeholder="Descreva aqui o problema..."><?php if (isset($_POST['Descricao'])) { echo $_POST['Descricao']; } else { echo ''; };?></textarea>
                                    <span class="help-block">Tente ser o mais breve possível.</span>
                                    <br>
                                    <input type="submit" class="btn btn-primary" value="Submeter" name="pedido_submit">
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
    <?php
      include 'Shared/Scripts.php';
    ?>

    <script type="text/javascript" src="assets/libs/template/js/registar-pedido.js"></script>
    <script type="text/javascript">
      $("#RegistarPedido").validate({
         errorClass: "my-error-class",
         validClass: "my-valid-class",

         messages: {
          'Equipamento': "Tem de escolher um equipamento"
         }
      });
    </script>
</body>

</html>
