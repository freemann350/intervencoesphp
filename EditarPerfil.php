<?php
  $titulo = "Edição de perfil";
  $fileinputInclude =  true;

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  if ((isset($_POST["editar_perfil_submit"])) && (isset($_POST["Nome"])) && (isset($_POST["Apelido"])) && (isset($_POST["Email"]))) {
    // Escape strings para prevenção de MySQL injection
    $Id = $LoggedID;
    $Nome = trim(mysqli_real_escape_string($con, $_POST['Nome']));
    $Apelido = trim(mysqli_real_escape_string($con, $_POST['Apelido']));
    $Email = trim(mysqli_real_escape_string($con, $_POST['Email']));
    $Descricao = trim(mysqli_real_escape_string($con, $_POST['Descricao']));
    $Descricao = stripslashes(str_replace('\r\n',PHP_EOL,$Descricao));

    $stmt = $con->prepare(
    "UPDATE professores
     SET Nome = ?, Apelido = ?, Email = ?, Descricao = ?
     WHERE Id = ?
    ");

    $stmt->bind_param("ssssi", $Nome, $Apelido, $Email, $Descricao, $Id);

    $stmt->execute();

    header("Location: Perfil?Id=$LoggedID");
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
            <section class="wrapper" id="wrapping">

                <h3><i class="fa fa-angle-right"></i> Editar perfil</h3>

                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <br>
                            <form class="form-horizontal style-form" method="post">
                                <div class="form-group">

                                  <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?=$primeiroNome?>" name="Nome" required>
                                    <br>
                                  </div>
                                  <br>

                                  <label class="col-sm-2 col-sm-2 control-label">Apelido</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?=$apelido?>" name="Apelido" required>
                                    <br>
                                  </div>
                                  <br>

                                  <label class="col-sm-2 col-sm-2 control-label">Email</label>
                                  <div class="col-sm-10">
                                    <input type="email" class="form-control" value="<?=$email?>" name="Email" required>
                                    <br>
                                  </div>
                                  <br>
                                  <label class="col-sm-2 col-sm-2 control-label">Descrição (Opcional)</label>
                                  <div class="col-sm-10">
                                      <textarea type="text" class="form-control" rows="7" name="Descricao" placeholder="Faça uma breve descrição de si..."><?=$Desc?></textarea>
                                      <br>
                                      <input type="submit" class="btn btn-primary" value="Submeter" name="editar_perfil_submit">
                                  </div>
                            </form>
                          </div>
                    </div>
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
</body>

</html>
