<?php
if (!(isset($_GET["Id"])) || (trim($_GET["Id"]) == "") || !(is_numeric($_GET["Id"]))) {
  header("Location: 404");
}

  $titulo = "Verificar Equipamento";

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  #verifica se o equipamento existe
  $stmt = $con->prepare("SELECT * FROM equipamentos WHERE Id = ?");

  $stmt->bind_param("i", $_GET['Id']);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 0) {
    header("Location: 404");
  }

  $stmt = $con->prepare("SELECT equipamentos.Id, Nome, NrSerie, Observacoes, salas.Sala, tipoequipamento.TipoEquipamento FROM equipamentos INNER JOIN salas ON salas.Id = equipamentos.IdSala INNER JOIN tipoequipamento ON tipoequipamento.Id = equipamentos.IdTipo WHERE equipamentos.Id = ?");

  $stmt->bind_param("i", $_GET['Id']);
  $stmt->execute();

  $result = $stmt->get_result();

  $row = $result->fetch_assoc();
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
                                <br><br>
                                <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=$row['Nome']?></p>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Tipo de equipamento</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=$row['TipoEquipamento']?></p>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Sala</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=$row['Sala']?></p>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Número de Série</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?php if (empty($row['NrSerie'])) { echo "N/D"; } else { echo $row['NrSerie']; } ?></p>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Observações</label>
                                <div class="col-sm-10">
                                  <p class="form-control-static whitespace"><?php if (empty($row['Observacoes'])) { echo "N/D"; } else { echo $row['Observacoes'];} ?></p>
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
