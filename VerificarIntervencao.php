<?php
if (!(isset($_GET["Id"])) || (trim($_GET["Id"]) == "") || !(is_numeric($_GET["Id"]))) {
  header("Location: 404");
}

  $titulo = "Verificar intervenção";

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  #verifica se o utilizador existe
  $stmt = $con->prepare("SELECT * FROM intervencoes WHERE Id = ?");

  $stmt->bind_param("i", $_GET['Id']);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 0) {
    header("Location: 404");
  }

  $stmt = $con->prepare(
  "SELECT IdPedido, Data, Hora, intervencoes.Descricao, Resolvido, concat_ws(' ', professores.Nome, professores.Apelido) NomeTodo FROM intervencoes INNER JOIN professores ON intervencoes.IdProfessor = professores.Id WHERE intervencoes.Id = ?
  ");

  $stmt->bind_param("i", $_GET['Id']);
  $stmt->execute();

  $result = $stmt->get_result();

  $row = $result->fetch_assoc();

  $Date = str_replace('-', '/', $row['Data']);
  $DataLeitura = date('d/m/Y', strtotime($Date));

  $HoraLeitura = date('H:i', strtotime($row['Hora']));
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
            <section class="wrapper">
                <h3><i class="fa fa-angle-right"></i> Intervenções - Visualização de dados</h3>
                <div class="row mt">
                    <div class="form-panel">

                        <form class="form-horizontal style-form" method="get">
                            <div class="form-group">
                                <br>
                                <label class="col-sm-2 col-sm-2 control-label">Pedido</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><u><a href="VerificarPedido?Id=<?=$row['IdPedido']?>">Ver pedido original</u></a></p>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Professor interveniente</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=$row['NomeTodo']?></p>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Data</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=$DataLeitura?></p>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Hora</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=$HoraLeitura?></p>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Descrição</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static whitespace"><?=$row['Descricao']?></p>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Resolvido</label>
                                <div class="col-sm-10">
                                  <p class="form-control-static"><?php if ($row['Resolvido'] =='1') { echo 'Sim';} else {echo 'Não';}?></p>
                                  <br>
                                  <input type="button" class="btn btn-primary" value="Voltar" onclick="goBack()">
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
