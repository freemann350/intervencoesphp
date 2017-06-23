<?php
  $titulo = "Novo Utilizador";
  $timepickerInclude = true;
  $datepickerInclude = true;
  $validatejs = true;

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  if ($LoggedRole != "1") {
    header("Location: 403");
  }

  if (isset($_POST["novo_util_submit"]) && (isset($_POST["Nome"])) && (isset($_POST["Apelido"])) && (isset($_POST["Email"])) && (isset($_POST["Username"])) && (isset($_POST["Password"])) && (isset($_POST["Password2"])) && ($_POST['Password'] == $_POST['Password2'])) {
    // Escape user inputs for security
    $Nome = trim(mysqli_real_escape_string($con, $_POST['Nome']));
    $Apelido = trim(mysqli_real_escape_string($con, $_POST['Apelido']));
    $Email = trim(mysqli_real_escape_string($con, $_POST['Email']));
    $Password = trim(mysqli_real_escape_string($con, $_POST['Password']));
    $Username = trim(mysqli_real_escape_string($con, $_POST['Username']));
    $Tipo = trim(mysqli_real_escape_string($con, $_POST['Tipo']));

    $options = [
        'cost' => 11,
    ];

    $Password = password_hash($Password, PASSWORD_BCRYPT, $options);

    $stmt = $con->prepare("INSERT INTO professores (Nome, Apelido, Username, Email, Password, IdRole, Ativo) VALUES (?, ?, ?, ?, ?, ?, '1')");

    $stmt->bind_param("sssssi", $Nome, $Apelido, $Username, $Email, $Password, $Tipo);

    $stmt->execute();
    header("Location: Utilizadores");
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
                <h3><i class="fa fa-angle-right"></i> Novo Utilizador</h3>
                <div class="row mt">
                    <div class="form-panel">
                        <form class="form-horizontal style-form" id="NovoUtilizador" method="POST" action="<?php $_SERVER['PHP_SELF']?>">
                            <div class="form-group">
                                <br>
                                <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="Nome" value="<?php if (isset($_POST['Nome'])) {echo $_POST['Nome'];} ?>" required>
                                  <br>
                                </div>
                                <br>

                                <label class="col-sm-2 col-sm-2 control-label">Apelido</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="Apelido" value="<?php if (isset($_POST['Apelido'])) {echo $_POST['Apelido'];} ?>" required>
                                  <br>
                                </div>
                                <br>

                                <label class="col-sm-2 col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                  <input type="email" class="form-control" name="Email" value="<?php if (isset($_POST['Email'])) {echo $_POST['Email'];} ?>" required>
                                  <br>
                                </div>
                                <br>

                                <label class="col-sm-2 col-sm-2 control-label">Nome de utilizador</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="Username" value="<?php if (isset($_POST['Username'])) {echo $_POST['Username'];} ?>" required>
                                  <br>
                                </div>
                                <br>

                                <label class="col-sm-2 col-sm-2 control-label">Palavra-Passe</label>
                                <div class="col-sm-10">
                                  <input type="password" class="form-control" name="Password" id="pw1" required>
                                  <br>
                                </div>
                                <br>

                                <label class="col-sm-2 col-sm-2 control-label">Confirmar Palavra-Passe</label>
                                <div class="col-sm-10">
                                  <input type="password" class="form-control" name="Password2" required>
                                  <br>
                                </div>
                                <br>

                                <label class="col-sm-2 col-sm-2 control-label">Tipo de utilizador</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Tipo" required>
                                      <option value="" selected hidden>Escolha um tipo de utilizador</option>
                                      <?php
                                        $stmt = $con->prepare("SELECT * FROM roles");

                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        while ($row = $result->fetch_assoc()) {
                                      ?>
                                        <option value="<?= $row['Id'] ?>"<?php if ((!empty($_POST['Tipo'])) && (isset($_POST['Tipo']))) {  if ($row["Id"] == $_POST['Tipo']) { echo "Selected";}} ?>><?= $row["Role"] ?></option>
                                      <?php } ?>
                                    </select>
                                    <br>
                                    <input type="submit" class="btn btn-primary" value="Submeter" name="novo_util_submit">
                                </div>
                        </form>
                        </div>
                    </div>
            </section>
            <!-- /MAIN CONTENT -->

            <?php #FOOTER INCLUDE
              include 'Shared/Footer.php';
            ?>
        </section>
    </section>

    <?php #HEADER INCLUDE
          include 'Shared/Scripts.php'
    ?>

    <script type="text/javascript">
      $("#NovoUtilizador").validate({
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
          'Password2': "Escreva a mesma Palavra-Passe que foi antes escrita",
          'Tipo': "Escolha um tipo de utilizador"
        }
    });
    </script>

</body>

</html>
