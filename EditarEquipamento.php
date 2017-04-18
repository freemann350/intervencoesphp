<?php
  if (!(isset($_GET["Id"])) || (trim($_GET["Id"]) == "") || !(is_numeric($_GET["Id"]))) {
    header("Location: Inicial");
  }

  $titulo = "Editar Equipamento";

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  if ($LoggedRole != "1") {
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
    $Id = trim(mysqli_real_escape_string($con, $_POST['Id']));

    $stmt = $con->prepare("UPDATE equipamentos SET Nome = ? WHERE Id = ?");

    $stmt->bind_param("si", $Nome, $Id);

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
            <section class="wrapper site-min-height">
                <h3><i class="fa fa-angle-right"></i> Novo Equipamento</h3>
                <div class="row mt">
                    <div class="form-panel">
                        <form class="form-horizontal style-form" method="POST" action="<?= $_SERVER["PHP_SELF"] ?>">
                            <div class="form-group">
                              <input type="hidden" name="Id" value="<?=$_GET['Id']?>">
                                <br>
                                <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="Nome" value="<?=$equipamento['Nome']?>" required>
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
