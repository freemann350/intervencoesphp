<?php
  $titulo = "Registar Pedido";
  $datepickerInclude = true;
  $PrpActive = true;
  $timepickerInclude = true;

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  if (isset($_POST["pedido_submit"])) {
    // Escape strings para prevenção de MySQL injection
    $Nome = trim(mysqli_real_escape_string($con, $_POST['Nome']));
    $Sala = trim(mysqli_real_escape_string($con, $_POST['Sala']));
    $Equipamento = trim(mysqli_real_escape_string($con, $_POST['Equipamento']));
    $Data = trim(mysqli_real_escape_string($con, $_POST['Data']));
    $Hora = trim(mysqli_real_escape_string($con, $_POST['Hora']));
    $Descricao = trim(mysqli_real_escape_string($con, $_POST['Descricao']));

    // Conversão da data do utilizador para formato MySQLi
    $Date = str_replace('/', '-', $Data);
    $DataMySQL = date('Y-m-d', strtotime($Date));

    $stmt = $con->prepare("INSERT INTO pedidos (IdProfessor, IdSala, IdEquipamento, Data, Hora, Descricao) VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("iiisss", $Nome, $Sala, $Equipamento, $DataMySQL, $Hora, $Descricao);

    $stmt->execute();

    $ttl='Sucesso';
    $msg = 'Dados introduzidos com sucesso.';
  } else {
    $ttl='Erro';
    $msg = 'Houve um problema com a introdução de dados.';
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
            <section class="wrapper site-min-height">
                <h3><i class="fa fa-angle-right"></i> Registo de pedidos</h3>
                <div class="row mt">
                    <div class="form-panel">
                        <form class="form-horizontal style-form" method="POST" action="<?= $_SERVER["PHP_SELF"] ?>">
                            <div class="form-group">
                                <br>

                                <input type="hidden" value="<?php echo $LoggedID;?>" name="Nome">

                                <label class="col-sm-2 col-sm-2 control-label">Bloco</label>
                                <div class="col-sm-10">
                                  <select id="bloco" class="form-control" name="Bloco" required onchange="getSalas(this);">
                                    <?php
                                      $stmt = $con->prepare("SELECT * FROM blocos");

                                      $stmt->execute();
                                      $result = $stmt->get_result();

                                      while ($row = $result->fetch_assoc()) {
                                    ?>
                                      <option value="<?= $row['Id'] ?>"<?php echo ($row["Bloco"] == "A" ? "selected" : "") ?>><?= $row["Bloco"] ?></option>
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
                                        <option value="<?= $row['Id'] ?>"><?= $row["Nome"] ?></option>
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
                                    <input type="text" class="form-control" placeholder="DD/MM/AAAA" name="Data" readonly required>
                                  </div>
                                  <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Hora</label>
                                <div class="col-sm-10">
                                  <div class="input-group clockpicker">
                                    <span class="input-group-addon time-get-color">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                  <input type="text" class="form-control" value="<?php echo date('H:i', strtotime('-1 hour')); ?>" name="Hora"
                                  readonly required>
                                  </div>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Descrição</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" rows="7" name="Descricao" required></textarea>
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

</body>

</html>
