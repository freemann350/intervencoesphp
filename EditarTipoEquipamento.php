<?php
  if (!(isset($_GET["Id"])) || (trim($_GET["Id"]) == "") || !(is_numeric($_GET["Id"]))) {
    header("Location: 404");
  }

  $titulo = "Editar tipo de equipamento";
  $validatejs = true;

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  if ($LoggedRole != "1") {
    header("Location: 403");
  }

  $stmt = $con->prepare(
  "SELECT * FROM tipoequipamento WHERE Id = ?"
  );

  $stmt->bind_param("i", $_GET['Id']);
  $stmt->execute();

  $result = $stmt->get_result();
  $TipoEq = $result->fetch_assoc();

  if (isset($_POST["editar_equip_submit"]) && (isset($_POST["Nome"]))) {
    // Escape user inputs for security
    $Nome = trim(mysqli_real_escape_string($con, $_POST['Nome']));
    $Id = trim(mysqli_real_escape_string($con, $_GET['Id']));

    $stmt = $con->prepare("UPDATE tipoequipamento SET TipoEquipamento = ? WHERE Id = ?");

    $stmt->bind_param("si", $Nome, $Id);

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
                <h3><i class="fa fa-angle-right"></i> Editar tipo de equipamento</h3>
                <div class="row mt">
                    <div class="form-panel">
                        <form class="form-horizontal style-form" method="POST" id="EditarTipoEquipamento">
                            <div class="form-group">
                                <br>
                                <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="Nome" value="<?=$TipoEq['TipoEquipamento']?>" required>
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

    <script type="text/javascript">
      $("#EditarTipoEquipamento").validate({
         errorClass: "my-error-class",
         validClass: "my-valid-class",

         messages: {
          'Nome': "Tem de escrever o nome do tipo de equipamento"
         }
      });
    </script>
</body>

</html>
