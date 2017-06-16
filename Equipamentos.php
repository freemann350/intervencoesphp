<?php
  $titulo = "Gestão de equipamentos";
  $removeInclude = true;
  $filtrosInclude =  true;
  $EqActive = true;

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  if ($LoggedRole != "1") {
    header("Location: 403");
  }

  $Query = "SELECT * FROM equipamentos";
  $QueryCount = "SELECT count(*) TotalDados FROM equipamentos";

  if (isset($_GET['filtros_equipamentos_submit']) && (isset($_GET['Equipamento']))) {

    $Equipamento = trim(mysqli_real_escape_string($con, $_GET['Equipamento']));

    if ((!empty($Equipamento)) && (isset($Equipamento))) {
      $Equipamento = "'%" . $Equipamento . "%'";
      $Query .= " WHERE Nome LIKE " . $Equipamento;
      $QueryCount .= " WHERE Nome LIKE " . $Equipamento;
    }

    $stmt = $con->prepare($Query);

    $stmt->execute();

    $result = $stmt->get_result();
  } else {
    $stmt = $con->prepare($Query);

    $stmt->execute();

    $result = $stmt->get_result();
  }
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
              <?php
                if (isset($_GET["msg"])) {
                  if ($_GET["msg"] == "1") {
              ?>
                <br>
                <div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Sucesso!</b> Os dados foram alterados com êxito.</div>
              <?php
                } elseif ($_GET["msg"] == "2") {
              ?>
                <br>
                <div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Ocorreu um erro.</b> Se tal persistir, contacte um responsável técnico.</div>
              <?php
                };
              };
              ?>

                <h3><i class="fa fa-angle-right"></i> Gestão de equipamentos</h3>

                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                          <div class="col-lg-12" id="filtrosheader" style="min-width: 620px;">
                                <span class="float-xs-left" id="filtrostext">Filtros</span>
                                <span class="float-xs-right" id="filtrosdown"><i>(Carregue nesta barra para filtrar a informação)</i>&nbsp;&nbsp; <i class="fa fa-caret-down" id="caret-spin"></i></span>
                            </div>

                            <div class="col-lg-12" id="filtrosdiv" style="display: none; min-width: 620px;">
                              <form class="form-horizontal style-form" method="GET">
                                <br>
                                <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por nome de equipamento</h4>
                                <div style="margin-left:10px;">
                                  <input type="text" class="form-control" name="Equipamento" placeholder="Escreva aqui o nome do equipamento..." value="<?php if (Isset($_GET['Equipamento'])) { echo $_GET['Equipamento'];};?>">
                                  <br>
                                  <input type="submit" class="btn btn-primary" name="filtros_equipamentos_submit" value="Procurar">
                                </div>
                              </form>
                              <hr>
                            </div>
                          <br><br><br>
                          <a href="NovoEquipamento"  title="Adicionar um novo equipamento">+ Registar novo Equipamento</a>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                      <th>Ativo</th>
                                      <th>Nome</th>
                                      <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    if ($result->num_rows != 0) {
                                    while ($row = $result->fetch_assoc()) {
                                  ?>
                                    <tr>
                                      <td><?php if ($row['Ativo'] == "1"){ echo "<i style='color: #60D439; cursor: help' title='O equipamento encontra-se ativo' class='fa fa-check fa-lg' aria-hidden='true'></i>";} else { echo "<i style='color: #E8434E;cursor: help' title='O equipamento encontra-se inativo' class='fa fa-times fa-lg' aria-hidden='true'></i>"; }?></td>
                                      <td><?= $row["Nome"] ?></td>
                                      <td>
                                        <a href="EditarEquipamento?Id=<?=$row['Id'];?>">
                                          <i title="Editar equipamento" class="fa fa-pencil fa-lg" aria-hidden="true"></i>
                                        </a>
                                        <?php if ($row['Ativo'] == '1') {?>
                                        <a href="javascript:;" class="deleteRecord" data-id="<?=$row['Id'];?>">
                                          <i style="color: #E8434E" title="Inativar equipamento" class="fa fa-times fa-lg" aria-hidden="true"></i>
                                        </a>
                                      <?php } else {?>
                                        <a href="javascript:;" class="activateRecord" data-id="<?=$row['Id'];?>">
                                          <i style="color: #60D439" title="Ativar equipamento" class="fa fa-check fa-lg" aria-hidden="true"></i>
                                        </a>
                                      <?php };?>
                                      </td>
                                    </tr>
                                  <?php }} else { ?>
                                    <tr>
                                      <td>N/D</td>
                                      <td>N/D</td>
                                      <td>N/D </td>
                                    </tr>
                                  <?php };?>
                                </tbody>
                            </table>
                            <?php
                              if (isset($_GET['filtros_equipamentos_submit'])) {

                                $stmt = $con->prepare($QueryCount);

                                $stmt->execute();

                                $result = $stmt->get_result();

                                $row = $result->fetch_assoc();

                                echo "Total de dados: " . $row['TotalDados']."<br><br>";

                              } else {
                                $stmt = $con->prepare($QueryCount);

                                $stmt->execute();

                                $result = $stmt->get_result();

                                $row = $result->fetch_assoc();
                                echo "Total de dados: " . $row['TotalDados'] ."<br><br>";
                              }
                            ?>
                            <a href="NovoEquipamento" title="Adicionar um novo equipamento">+ Registar novo Equipamento</a>
                            <br>
                        </div>
                    </div>
                </div>
            </section>
        </section>

        <!-- /MAIN CONTENT -->

        <?php #FOOTER INCLUDE
          include 'Shared\Footer.php';
        ?>
    </section>

    <?php #HEADER INCLUDE
          include 'Shared/Scripts.php'
    ?>
    <script>
    $('.deleteRecord').click(function() {
      let id = $(this).attr("data-id");
      $.confirm({
          title: 'Sair',
          content: 'Tem a certeza que pretende inativar este equipamento?',
          buttons: {
              Sim: function() {
                $.ajax({
                  method: "GET",
                  url: "ajax/inativarEquip.php?id=" + id,
                  success: function(data) {
                    if (data == "1") {
                      window.location.href = location.href.split('?')[0] + "?msg=1"
                    } else {
                      window.location.href = location.href.split('?')[0] + "?msg=2"
                    }
                  }
                });
              },
              Não: function() {

              },

          }
      });
    });

    $('.activateRecord').click(function() {
      let id = $(this).attr("data-id");
      $.confirm({
          title: 'Sair',
          content: 'Tem a certeza que pretende ativar este equipamento?',
          buttons: {
              Sim: function() {
                $.ajax({
                  method: "GET",
                  url: "ajax/ativarEquip.php?id=" + id,
                  success: function(data) {
                    if (data == "1") {
                      window.location.href = location.href.split('?')[0] + "?msg=1"
                    } else {
                      window.location.href = location.href.split('?')[0] + "?msg=2"
                    }
                  }
                });
              },
              Não: function() {

              },

          }
      });
    });
    </script>
</body>

</html>
