<?php
  $titulo = "Edição de perfil";
  $fileinputInclude =  true;

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  if (isset($_POST["editar_perfil_submit"])) {
    // Escape strings para prevenção de MySQL injection
    $Id = trim(mysqli_real_escape_string($con, $_POST['Id']));
    $Nome = trim(mysqli_real_escape_string($con, $_POST['Nome']));;
    $Apelido = trim(mysqli_real_escape_string($con, $_POST['Apelido']));;
    $Email = trim(mysqli_real_escape_string($con, $_POST['Email']));;

    $stmt = $con->prepare(
    "UPDATE professores
     SET Nome = ?, Apelido = ?, Email = ?
     WHERE Id = ?
    ");

    $stmt->bind_param("sssi", $Nome, $Apelido, $Email, $Id);

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
            <section class="wrapper site-min-height" id="wrapping">

                <h3><i class="fa fa-angle-right"></i> Editar perfil</h3>

                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <br>
                            <form class="form-horizontal style-form" method="post" action="<?=$_SERVER["PHP_SELF"] ?>">
                                <div class="form-group">
                                  <input type="hidden" name="Id" value="<?=$LoggedID?>">
                                  <label class="col-sm-2 col-sm-2 control-label">Imagem</label>
                                  <div class="col-sm-10">
                                    <img src="assets\img\User\profile_img.png" style="width:20%; height:20%;"><br><br>
                                    <div class="input-group">
                                      <span class="input-group-btn">
                                      <span class="btn btn-default btn-file">
                                          Procurar… <input type="file" id="imgInp">
                                      </span>
                                    </span>
                                        <input type="text" class="form-control" readonly>
                                    </div><br>
                                  </div>

                                  <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?=$primeiroNome?>" name="Nome">
                                    <br>
                                  </div>
                                  <br>

                                  <label class="col-sm-2 col-sm-2 control-label">Apelido</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?=$apelido?>" name="Apelido">
                                    <br>
                                  </div>
                                  <br>

                                  <label class="col-sm-2 col-sm-2 control-label">Email</label>
                                  <div class="col-sm-10">
                                    <input type="email" class="form-control" value="<?=$email?>" name="Email">
                                    <br>
                                    <input type="submit" class="btn btn-primary" value="Submeter" name="editar_perfil_submit">
                                  </div>
                                    <br>
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
