<?php
  $titulo = "Novo Utilizador";
  $timepickerInclude = true;
  $datepickerInclude = true;

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  if ($LoggedRole != "1") {
    header("Location: 403");
  }

  if (isset($_POST["novo_util_submit"])) {
    // Escape user inputs for security
    $Nome = trim(mysqli_real_escape_string($con, $_POST['Nome']));
    $Apelido = trim(mysqli_real_escape_string($con, $_POST['Apelido']));
    $Email = trim(mysqli_real_escape_string($con, $_POST['Email']));
    $Password = trim(mysqli_real_escape_string($con, $_POST['Password']));
    $Username = trim(mysqli_real_escape_string($con, $_POST['Username']));
    $Tipo = trim(mysqli_real_escape_string($con, $_POST['Tipo']));

    $stmt = $con->prepare("INSERT INTO professores (Nome, Apelido, Username, Email, Password, IdRole, Ativo) VALUES (?, ?, ?, ?, ?, ?, '1')");

    $stmt->bind_param("sssssi", $Nome, $Apelido, $Username, $Email, $Password, $Tipo);

    $stmt->execute();
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
                <h3><i class="fa fa-angle-right"></i> Novo Utilizador</h3>
                <div class="row mt">
                    <div class="form-panel">
                        <form class="form-horizontal style-form" method="POST" action="<?= $_SERVER["PHP_SELF"] ?>">
                            <div class="form-group">
                                <br>
                                <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="Nome" required>
                                  <br>
                                </div>
                                <br>

                                <label class="col-sm-2 col-sm-2 control-label">Apelido</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="Apelido" required>
                                  <br>
                                </div>
                                <br>

                                <label class="col-sm-2 col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                  <input type="email" class="form-control" name="Email" required>
                                  <br>
                                </div>
                                <br>

                                <label class="col-sm-2 col-sm-2 control-label">Nome de utilizador</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="Username" required>
                                  <br>
                                </div>
                                <br>

                                <label class="col-sm-2 col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                  <input type="password" class="form-control" name="Password" required>
                                  <br>
                                </div>
                                <br>

                                <label class="col-sm-2 col-sm-2 control-label">Confirmar Password</label>
                                <div class="col-sm-10">
                                  <input type="password" class="form-control" name="Password2" required>
                                  <br>
                                </div>
                                <br>

                                <label class="col-sm-2 col-sm-2 control-label">Tipo de utilizador</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Tipo" required>
                                      <?php
                                        $stmt = $con->prepare("SELECT * FROM roles");

                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        while ($row = $result->fetch_assoc()) {
                                      ?>
                                        <option value="<?= $row['Id'] ?>"<?php echo ($row["Role"] == "Professor" ? "selected" : "") ?>><?= $row["Role"] ?></option>
                                      <?php } ?>
                                    </select>
                                    <br>
                                    <input type="submit" name="novo_util_submit" class="btn btn-primary" value="Submeter">
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
