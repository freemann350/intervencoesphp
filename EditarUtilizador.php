<?php
  require_once 'Shared/conn.php';
  require_once 'Shared/Restrict.php';

  if (!(isset($_GET["Id"])) || (trim($_GET["Id"]) == "") || (!is_numeric($_GET["Id"])) || ($_GET['Id']==$LoggedID)) {
    header("Location: 404");
  }

  $titulo = "Editar Utilizador";
  $validatejs = true;

  if ($LoggedRole != "1") {
    header("Location: 403");
  }

  $stmt = $con->prepare(
  "SELECT * FROM professores WHERE Id = ?"
  );

  $stmt->bind_param("i", $_GET['Id']);
  $stmt->execute();

  $result = $stmt->get_result();
  $utilizador = $result->fetch_assoc();

  if ($result->num_rows == 0) {
    header("Location: 404");
  }

  if (isset($_POST["editar_util_submit"])) {
    // Escape user inputs for security
    $Nome = trim(mysqli_real_escape_string($con, $_POST['Nome']));
    $Apelido = trim(mysqli_real_escape_string($con, $_POST['Apelido']));
    $Email = trim(mysqli_real_escape_string($con, $_POST['Email']));
    $Username = trim(mysqli_real_escape_string($con, $_POST['Username']));
    $Tipo = trim(mysqli_real_escape_string($con, $_POST['Tipo']));
    $Id = trim(mysqli_real_escape_string($con, $_GET["Id"]));
    $Ativo = ((isset($_POST['Ativo'])) ? "1" : "0");

    $stmt = $con->prepare(
    "UPDATE professores SET Nome = ?, Apelido = ?, Email = ?, Username = ?, IdRole = ?, Ativo = ? WHERE Id = ?");

    $stmt->bind_param("ssssiii", $Nome, $Apelido, $Email, $Username, $Tipo, $Ativo, $Id);

    $stmt->execute();

    header("Location: Utilizadores");
  };

  if (isset($_POST["editar_pwd_submit"])) {
    if ($_POST['Password'] == $_POST['Password2']) {
    // Escape user inputs for security
    $Id = trim(mysqli_real_escape_string($con, $_GET["Id"]));
    $Password = trim(mysqli_real_escape_string($con,$_POST['Password']));

    $stmt = $con->prepare(
    "UPDATE professores SET Password = ? WHERE Id = ?");

    $stmt->bind_param("si", $Password, $Id);

    $stmt->execute();

    header("Location: Utilizadores");
    }
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
            <section class="wrapper">
              <br>
                <h3><i class="fa fa-angle-right"></i> Edição de Utilizador</h3>
                <div class="row mt">
                    <div class="form-panel">
                      <h3><i class="fa fa-angle-right"></i> Editar dados principais de utilizador</h3><br>
                        <form class="form-horizontal style-form" method="POST" action="<?= $_SERVER["PHP_SELF"] ?>" id="EditarUtilizador">
                            <div class="form-group">
                                <br>
                                <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" value="<?=$utilizador['Nome']?>" name="Nome" required>
                                  <br>
                                </div>
                                <br>

                                <label class="col-sm-2 col-sm-2 control-label">Apelido</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" value="<?=$utilizador['Apelido']?>" name="Apelido" required>
                                  <br>
                                </div>
                                <br>

                                <label class="col-sm-2 col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                  <input type="email" class="form-control" value="<?=$utilizador['Email']?>" name="Email" required>
                                  <br>
                                </div>
                                <br>

                                <label class="col-sm-2 col-sm-2 control-label">Nome de utilizador</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" value="<?=$utilizador['Username']?>" name="Username" required>
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
                                        <option value="<?= $row['Id'] ?>" <?=(($row["Id"] == $utilizador["IdRole"]) ? "selected" : "")  ?>><?=$row["Role"] ?></option>
                                      <?php } ?>
                                    </select>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Ativo</label>
                                <div class="col-sm-10">
                                  <div class="checkbox">
                                    <label>
                                      <input style="margin-top:2px;" type="checkbox" name="Ativo"<?php if ($utilizador['Ativo'] == '1'){?> checked <?php };?>>
                                      <p>Ativo</p>
                                    </label>
                                  </div>
                                  <br>
                                  <input type="submit" class="btn btn-primary" value="Submeter" name="editar_util_submit">
                                </div>
                        </form>
                        </div>
                    </div><br>

                        <div class="form-panel">
                          <h3><i class="fa fa-angle-right"></i> Editar Palavra-Passe</h3>
                          <br>
                            <form class="form-horizontal style-form" method="POST" id="EditarPassword">
                                <div class="form-group">
                                  <label class="col-sm-2 col-sm-2 control-label">Palavra-Passe</label>
                                  <div class="col-sm-10">
                                    <input type="password" class="form-control" name="Password" placeholder="••••••" id="pw1" required>
                                    <br>
                                  </div><br>
                                  <label class="col-sm-2 col-sm-2 control-label">Confirmar Palavra-Passe</label>
                                  <div class="col-sm-10">
                                    <input type="password" class="form-control" name="Password2" placeholder="••••••" required>
                                    <br>
                                    <input type="submit" class="btn btn-primary" value="Submeter" name="editar_pwd_submit">
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

    <?php #SCRIPTS INCLUDE
          include 'Shared/Scripts.php'
    ?>
    <script type="text/javascript">
      $("#EditarUtilizador").validate({
         errorClass: "my-error-class",
         validClass: "my-valid-class",
         rules: {
            'Nome': {
              minlength: 3
            },
            'Apelido':{
              minlength: 3
            },
            'Username': {
              minlength: 4
            },
            'Password': {
              minlength: 5
            },
            'Password2': {
              minlength: 5,
              equalTo: '#pw1'
            }
        },

        messages: {
          'Password2': "Escreva a mesma Palavra-Passe que foi antes escrita"
        }
    });

    $("#EditarPassword").validate({
       errorClass: "my-error-class",
       validClass: "my-valid-class",
       rules: {
          'Password': {
            minlength: 5
          },
          'Password2': {
            minlength: 5,
            equalTo: '#pw1'
          }
      },

      messages: {
        'Password2': "Escreva a mesma Palavra-Passe que foi antes escrita"
      }
  });
    </script>

</body>

</html>
