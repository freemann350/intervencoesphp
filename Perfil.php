<?php
  if (!(isset($_GET["Id"])) || (trim($_GET["Id"]) == "") || !(is_numeric($_GET["Id"]))) {
    header("Location: 404");
  }

  $fileinputInclude =  true;

  require_once 'Shared/conn.php';
  require_once 'Shared/Restrict.php';

  if ($LoggedID == $_GET['Id']) {
    $PPActive =  true;
  }

  #verifica se o utilizador existe
  $stmt = $con->prepare("SELECT * FROM professores WHERE Id = ?");

  $stmt->bind_param("i", $_GET['Id']);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 0) {
    header("Location: 404");
  }

  $stmt = $con->prepare(
  "SELECT concat_ws(' ', nome, apelido) NomeTodo, Nome, Descricao, roles.Role, Apelido, Email FROM professores INNER JOIN roles ON roles.Id = professores.IdRole WHERE professores.Id = ?
  ");

  $stmt->bind_param("i", $_GET['Id']);
  $stmt->execute();

  $result = $stmt->get_result();

  $row = $result->fetch_assoc();

  $titulo = "Perfil de "  . $row['NomeTodo'] ;

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

                <h3><i class="fa fa-angle-right"></i> <?=$row['NomeTodo']?> (<?=$row['Role']?>)</h3>

                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                          <form class="form-horizontal style-form" method="get">
                              <div class="form-group">

                                <label class="col-sm-2 col-sm-2 control-label"><b>Email</b></label>
                                <div class="col-sm-10">
                                  <p class="form-control-static"><?=$row['Email']?></p>
                                  <br>
                                </div>

                                  <label class="col-sm-2 col-sm-2 control-label"><b>Descrição</b></label>
                                  <div class="col-sm-10">
                                    <p class="form-control-static"><?php if (empty($row['Descricao'])) {echo 'N/D';} else {echo $row['Descricao'];}?></p>
                                    <br>
                                    <?php if ($LoggedID == $_GET['Id']) {?>
                                    <a href="EditarPerfil"><input type="button" class="btn btn-primary" value="Editar Perfil"></a>
                                    <?php };?>
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
