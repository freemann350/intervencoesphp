<?php
  $titulo = "Gestão de tipos de equipamentos";
  $removeInclude = true;
  $filtrosInclude =  true;
  $PTEqActive = true;
  $paginatejs = true;

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  if ($LoggedRole == "3") {
    header("Location: 403");
  }

  #PAGINAÇÃO
  if (isset($_GET['p']) && (trim($_GET['p']) <> "") && (is_numeric($_GET['p']))) {
    $pg = $_GET['p'];
  } else {
    $pg = 1;
  }

  if ($pg < '1'){
    header("Location: TipoEquipamento");
  }

  $per_page = 20;
  $pfunc = ceil($pg*$per_page) - $per_page;

  $Query = "SELECT * FROM tipoequipamento";
  $QueryCount = "SELECT count(*) TotalDados FROM tipoequipamento";

  if ((isset($_GET['Equipamento'])) || (isset($_GET['Ativo'])) || (isset($_GET['Inativo']))) {
    $switch = true;
    $Equipamento = trim(mysqli_real_escape_string($con, $_GET['Equipamento']));

    if ((!empty($Equipamento)) && (isset($Equipamento))) {
      if ($switch){
        $Query .= " WHERE ";
        $QueryCount .= " WHERE ";
        $switch = false;
      } else {
        $Query .= " AND ";
        $QueryCount .= " AND ";
      }
      $Equipamento = "'%" . $Equipamento . "%'";
      $Query .= " tipoequipamento.TipoEquipamento LIKE " . $Equipamento;
      $QueryCount .= " tipoequipamento.TipoEquipamento LIKE " . $Equipamento;
    }

    if ((!empty($_GET['Ativo'])) && (isset($_GET['Ativo'])) && (empty($_GET['Inativo'])) && (!isset($_GET['Inativo']))) {
      if ($switch){
        $Query .= " WHERE ";
        $QueryCount .= " WHERE ";
        $switch = false;
      } else {
        $Query .= " AND ";
        $QueryCount .= " AND ";
      }
      $Query .= " tipoequipamento.Ativo = '1'";
      $QueryCount .= " tipoequipamento.Ativo = '1'";
    }

    if ((!empty($_GET['Inativo'])) && (isset($_GET['Inativo'])) && (empty($_GET['Ativo'])) && (!isset($_GET['Ativo']))) {
      if ($switch){
        $Query .= " WHERE ";
        $QueryCount .= " WHERE ";
        $switch = false;
      } else {
        $Query .= " AND ";
        $QueryCount .= " AND ";
      }
      $Query .= " tipoequipamento.Ativo = '0'";
      $QueryCount .= " tipoequipamento.Ativo = '0'";
    }

    if ((empty($_GET['Inativo'])) && (!isset($_GET['Inativo'])) && (empty($_GET['Ativo'])) && (!isset($_GET['Ativo']))) {
      if ($switch){
        $Query .= " WHERE ";
        $QueryCount .= " WHERE ";
        $switch = false;
      } else {
        $Query .= " AND ";
        $QueryCount .= " AND ";
      }
      $Query .= " tipoequipamento.Ativo = '1' ";
      $QueryCount .= " tipoequipamento.Ativo = '1'";
    }
    $Query .= " LIMIT $pfunc, $per_page";
    $stmt = $con->prepare($Query);

    $stmt->execute();

    $result = $stmt->get_result();
  } else {
    $QueryCount .= " WHERE Ativo = '1'";

    $Query .= " WHERE Ativo = '1' LIMIT $pfunc, $per_page";

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

                <h3><i class="fa fa-angle-right"></i> Gestão de tipos de equipamentos</h3>

                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel" style="overflow: auto;">
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
                                </div>

                                <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por estado de ativo</h4>
                                <div style="margin-left:10px;">
                                  <label class="checkbox-inline">
                                    <input type="checkbox" name="Ativo" class="radio-inline" <?php if (isset($_GET['Ativo'])) { echo 'Checked';}?>>
                                    <p style="cursor: pointer;" class="unselectable">Sim</p>
                                  </label>
                                  <label class="checkbox-inline">
                                    <input type="checkbox" name="Inativo" class="radio-inline" <?php if (isset($_GET['Inativo'])) { echo 'Checked';} ?>>
                                    <p style="cursor: pointer;" class="unselectable">Não</p>
                                  </label><br><br>
                                  <input type="submit" class="btn btn-primary" value="Procurar">
                                </div>
                              </form>
                              <hr>
                            </div>
                          <br><br><br>
                          <a href="NovoTipoEquipamento"  title="Adicionar um novo tipo de equipamento">+ Registar novo tipo de equipamento</a>
                            <table class="table table-striped table-hover nav-collapse" style="min-width: 600px; table-layout:fixed; overflow: auto;">
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
                                      <td><?php if ($row['Ativo'] == "1"){ echo "<i style='color: #60D439; cursor: help' title='O tipo de equipamento encontra-se ativo' class='fa fa-check fa-lg' aria-hidden='true'></i>";} else { echo "<i style='color: #E8434E;cursor: help' title='O tipo de equipamento encontra-se inativo' class='fa fa-times fa-lg' aria-hidden='true'></i>"; }?></td>
                                      <td><?= $row["TipoEquipamento"] ?></td>
                                      <td>
                                        <a href="EditarTipoEquipamento?Id=<?=$row['Id'];?>">
                                          <i title="Editar tipo de equipamento" class="fa fa-pencil fa-lg" aria-hidden="true"></i>
                                        </a>
                                        <?php if ($row['Ativo'] == '1') {?>
                                        <a href="javascript:;" class="deleteRecord" data-id="<?=$row['Id'];?>">
                                          <i style="color: #E8434E" title="Inativar tipo de equipamento" class="fa fa-times fa-lg" aria-hidden="true"></i>
                                        </a>
                                      <?php } else {?>
                                        <a href="javascript:;" class="activateRecord" data-id="<?=$row['Id'];?>">
                                          <i style="color: #60D439" title="Ativar tipo de equipamento" class="fa fa-check fa-lg" aria-hidden="true"></i>
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
                                $stmt = $con->prepare($QueryCount);

                                $stmt->execute();

                                $result = $stmt->get_result();

                                $row = $result->fetch_assoc();
                                echo "Total de dados: " . $row['TotalDados'] ."<br><br>";

                            ?>
                            <a href="NovoTipoEquipamento" title="Adicionar um novo tipo de equipamento">+ Registar novo tipo de equipamento</a>
                            <br>
                        </div>
                    </div>
                </div>
                <?php #PAGINAÇÃO SCRIPT
                  require("Shared/Paginate.php");

                  if ($pg>$maxPages){ ?>
                    <script>
                      window.location.replace("Equipamentos");
                    </script>
                <?php } ?>
            </section>
        </section>

        <!-- /MAIN CONTENT -->

        <?php #FOOTER INCLUDE
          include 'Shared/Footer.php';
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
                  url: "ajax/inativarTipoEquip.php?id=" + id,
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
                  url: "ajax/ativarTipoEquip.php?id=" + id,
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
