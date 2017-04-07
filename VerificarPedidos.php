<?php
  $titulo = "Verificar Pedidos";

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  /*
  Professor
  Equipamento
  Sala
  Descricao
  Data
  Hora
  Resolvido
  */

  $stmt = $con->prepare(
  "SELECT pedidos.Id, pedidos.descricao, pedidos.Data, pedidos.Hora, pedidos.Resolvido, equipamentos.Nome, salas.Sala, concat_ws(' ', professores.Nome, professores.Apelido) NomeTodo FROM pedidos INNER JOIN Salas ON pedidos.IdSala = salas.Id INNER JOIN equipamentos ON pedidos.IdEquipamento = equipamentos.Id INNER JOIN professores ON pedidos.IdProfessor = professores.Id WHERE pedidos.Id = ?
  ");

  $stmt->bind_param("i", $_GET['Id']);
  $stmt->execute();

  $result = $stmt->get_result();

  $row = $result->fetch_assoc()
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
            <section class="wrapper site-min-height">
                <h3><i class="fa fa-angle-right"></i> Pedidos - Visualização de dados</h3>
                <div class="row mt">
                    <div class="form-panel">

                        <form class="form-horizontal style-form">
                            <div class="form-group">
                                <br>

                                <label class="col-sm-2 col-sm-2 control-label"><b>Professor</b></label>
                                <div class="col-sm-10"> <p class="form-control-static"><?=$row["NomeTodo"]?></p>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label"><b>Equipamento</b></label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=$row["Nome"]?></p>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label"><b>Data</b></label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=$row["Data"]?></p>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label"><b>Hora</b></label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=$row["Hora"]?></p>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label"><b>Descrição</b></label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=$row["descricao"]?></p>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label"><b>Resolvido</b></label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">N/A</p>
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
