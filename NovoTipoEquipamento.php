<?php
  $titulo = "Novo tipo de Equipamento";

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  if ($LoggedRole == "3") {
    header("Location: 403");
  }

  if (isset($_POST["novo_equip_submit"])) {
    // Escape user inputs for security
    $Nome = trim(mysqli_real_escape_string($con, $_POST['Nome']));

    $stmt = $con->prepare("INSERT INTO tipoequipamento (TipoEquipamento, Ativo) VALUES (?, 1)");

    $stmt->bind_param("s", $Nome);

    $stmt->execute();

    header('Location: TipoEquipamento');
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
                <h3><i class="fa fa-angle-right"></i> Novo tipo de Equipamento</h3>
                <div class="row mt">
                    <div class="form-panel">
                        <form class="form-horizontal style-form" method="POST" action="<?= $_SERVER["PHP_SELF"] ?>">
                            <div class="form-group">
                                <br>
                                <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="Nome" required>
                                  <br>
                                  <input type="submit" name="novo_equip_submit" class="btn btn-primary" value="Submeter">
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
