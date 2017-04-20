<?php
  if (!(isset($_GET["Id"])) || (trim($_GET["Id"]) == "") || !(is_numeric($_GET["Id"]))) {
    header("Location: Inicial");
  }

  $titulo = "Registar Intervenção";
  $timepickerInclude = true;
  $datepickerInclude = true;

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  if ($LoggedRole == "3") {
    header("Location: 403");
  }

  $stmt = $con->prepare(
  "SELECT * FROM pedidos WHERE Id = ?");

  $stmt->bind_param("i", $_GET['Id']);
  $stmt->execute();

  $result = $stmt->get_result();

  if (isset($_POST["registar_interv_submit"])) {
    // Escape strings para prevenção de MySQL injection
    $Id = trim(mysqli_real_escape_string($con, $_GET['Id']));
    $Data = trim(mysqli_real_escape_string($con, $_POST['Data']));
    $Hora = trim(mysqli_real_escape_string($con, $_POST['Hora']));
    $Descricao = trim(mysqli_real_escape_string($con, $_POST['Descricao']));
    $Resolvido = ((isset($_POST['Resolvido'])) ? "1" : "0");
    // Conversão da data do utilizador para formato MySQLi

    $Date = str_replace('/', '-', $Data);
    $DataMySQL = date('Y-m-d', strtotime($Date));

    $stmt = $con->prepare("INSERT INTO intervencoes (IdPedido, Data, Hora, Descricao, Resolvido) values (?, ?, ?, ?, " . $Resolvido . ")");

    $stmt->bind_param("isss", $Id, $Data, $Hora, $Descricao);

    $stmt->execute();
  };
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
            <section class="wrapper site-min-height">
                <h3><i class="fa fa-angle-right"></i> Registo de intervenções</h3>
                <div class="row mt">
                    <div class="form-panel">
                        <form class="form-horizontal style-form" method="post">
                            <div class="form-group">
                                <br>

                                <label class="col-sm-2 col-sm-2 control-label">Data</label>
                                <div class="col-sm-10" id="datepicker-registos">
                                  <div class="input-group date">
                                    <span class="input-group-addon time-get-color">
                                      <i class="glyphicon glyphicon-th"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="DD/MM/AAAA" value="02/01/2017" name="Data" readonly required>
                                  </div>
                                  <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Hora</label>
                                <div class="col-sm-10">
                                  <div class="input-group clockpicker">
                                    <span class="input-group-addon time-get-color">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                  <input type="text" class="form-control" value="<?php echo date('h:i', strtotime('-1 hour')); ?>" name="Hora"
                                  readonly required>
                                  </div>
                                    <br>
                                </div>


                                <label class="col-sm-2 col-sm-2 control-label">Descrição</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" rows="7" name="Descricao" required></textarea>
                                    <span class="help-block">Tente ser o mais breve possível.</span>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Resolvido</label>
                                <div class="col-sm-10">
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" name="Resolvido">
                                    <p style="margin-top:2px;">Resolvido</p>
                                  </label>
                                </div>
                                <br>
                                <input type="submit" class="btn btn-primary" value="Submeter" name="registar_interv_submit">
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
