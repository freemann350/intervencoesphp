<?php
  $titulo = "As minhas intervenções";
  $datepickerInclude = true;
  $filtrosInclude = true;
  $removeInclude = true;
  $PmiActive = true;
  $paginatejs = true;

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  if ($LoggedRole == "3") {
    header("Location: 403");
  }

  #PAGINAÇÃO
  if (isset($_GET['p'])) {
    $pg = $_GET['p'];
  } else {
    $pg = 1;
  }

  if ($pg < '1'){
    header("Location: MinhasIntervencoes");
  }

  $per_page = 15;
  $pfunc = ceil($pg*$per_page) - $per_page;

  $Query = "SELECT intervencoes.Resolvido, intervencoes.Id, salas.Sala, equipamentos.Nome, intervencoes.Data FROM intervencoes INNER JOIN pedidos ON intervencoes.IdPedido = pedidos.Id INNER JOIN equipamentos ON pedidos.IdEquipamento = equipamentos.Id INNER JOIN salas ON pedidos.IdSala = salas.Id INNER JOIN blocos ON blocos.Id = salas.IdBloco WHERE intervencoes.IdProfessor = " . $LoggedID . " ";

  $QueryCount = "SELECT count(*) TotalDados FROM intervencoes INNER JOIN pedidos ON intervencoes.IdPedido = pedidos.Id INNER JOIN equipamentos ON pedidos.IdEquipamento = equipamentos.Id INNER JOIN salas ON pedidos.IdSala = salas.Id INNER JOIN blocos ON blocos.Id = salas.IdBloco WHERE intervencoes.IdProfessor = " . $LoggedID . " ";

  if (isset($_GET['filtros_meusped_submit']) || (!empty($_GET['Data1'])) || (!empty($_GET['Data2'])) || (!empty($_GET['Equipamento'])) || (!empty($_GET['Bloco'])) || (!empty($_GET['Sala'])) || (!empty($_GET['Nome']))) {
    $Date1 = trim(mysqli_real_escape_string($con, $_GET['Data1']));
    $Date2 = trim(mysqli_real_escape_string($con, $_GET['Data2']));

    $Equipamento = trim(mysqli_real_escape_string($con, $_GET['Equipamento']));
    $Bloco = trim(mysqli_real_escape_string($con, $_GET['Bloco']));
    $Sala = trim(mysqli_real_escape_string($con, $_GET['Sala']));

    if ((!empty($Date1)) && (!empty($Date2)) && (isset($Date1)) && (isset($Date2))) {
      $Date1 = str_replace('/', '-', $Date1);
      $Date1 = date('Y-m-d', strtotime($Date1));

      $Date2 = str_replace('/', '-', $Date2);
      $Date2 = date('Y-m-d', strtotime($Date2));

      $Query .= " AND pedidos.Data BETWEEN '". $Date1 ."' AND '". $Date2 ."'";
      $QueryCount .= " AND pedidos.Data BETWEEN '". $Date1 ."' AND '". $Date2 ."'";
    }

    if ((!empty($Equipamento)) && (isset($Equipamento))) {
      $Query .= " AND pedidos.IdEquipamento = " . $Equipamento;
      $QueryCount .= " AND pedidos.IdEquipamento = " . $Equipamento;
    }

    if ((!empty($Bloco)) && (isset($Bloco))) {
      $Query .= " AND salas.IdBloco = " . $Bloco;
      $QueryCount .=" AND salas.IdBloco = " . $Bloco;
    }

    if ((!empty($Sala)) && (isset($Sala))) {
      $Query .= " AND pedidos.IdSala = " . $Sala;
      $QueryCount .=" AND pedidos.IdSala = " . $Sala;
    }
    $Query .= " LIMIT $pfunc, $per_page";

    $stmt = $con->prepare($Query);

    $stmt->execute();

    $result = $stmt->get_result();
  } else {
    $Query .= " LIMIT $pfunc, $per_page";

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
            <section class="wrapper"  >
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
                  }
                }
              ?>
                <h3><i class="fa fa-angle-right"></i> As minhas intervenções</h3>

                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel" style="overflow: auto;">
                            <div class="col-lg-12" id="filtrosheader" style="min-width: 620px;">
                                <span class="float-xs-left" id="filtrostext">Filtros</span>
                                <span class="float-xs-right" id="filtrosdown"><i>(Carregue nesta barra para filtrar a informação)</i>&nbsp;&nbsp; <i class="fa fa-caret-down" id="caret-spin"></i></span>
                            </div>

                            <div class="col-lg-12" id="filtrosdiv" style="display: none; min-width: 620px;">
                                <br>
                                <form class="style-form" method="GET">
                                  <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar entre datas</h4>
                                  <div class="input-group input-daterange">
                                      <input type="text" class="form-control" placeholder="DD/MM/AAAA" name="Data1">
                                      <div class="input-group-addon">Até</div>
                                      <input type="text" class="form-control" placeholder="DD/MM/AAAA" name="Data2">
                                  </div>
                                  <br>

                                  <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por equipamento</h4>
                                  <div class="form-group">
                                      <select class="form-control" name="Equipamento">
                                        <option selected value="">Escolha um equipamento...</option>
                                        <?php
                                          $stmt1 = $con->prepare("SELECT * FROM equipamentos WHERE Ativo = '1'");

                                          $stmt1->execute();
                                          $result1 = $stmt1->get_result();

                                          while ($equip = $result1->fetch_assoc()) {
                                        ?>
                                        <option value="<?= $equip['Id'] ?>"><?=$equip["Nome"]; ?></option>
                                        <?php } ?>
                                      </select>
                                  </div>
                                  <br>

                                  <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por Bloco</h4>
                                  <div class="form-group">
                                    <select class="form-control" name="Bloco" onchange="getSalas(this);">
                                      <option selected value="">Escolha um bloco...</option>
                                      <?php
                                        $stmt1 = $con->prepare("SELECT * FROM blocos");

                                        $stmt1->execute();
                                        $result1 = $stmt1->get_result();

                                        while ($row1 = $result1->fetch_assoc()) {
                                      ?>
                                        <option value="<?= $row1['Id'] ?>"><?= $row1["Bloco"] ?></option>
                                      <?php }; ?>
                                    </select>
                                  </div>
                                  <br>

                                  <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por Sala</h4>
                                  <div class="form-group">
                                    <select class="form-control" name="Sala">
                                      <option selected value="">Escolha uma sala...</option>
                                      <?php
                                        $stmt1 = $con->prepare("SELECT * FROM salas");

                                        $stmt1->execute();
                                        $result1 = $stmt1->get_result();

                                        while ($row1 = $result1->fetch_assoc()) {
                                      ?>
                                        <option value="<?=$row1["Id"]?>"><?=$row1["Sala"]?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                  <br>

                                  <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por estado de resolvido</h4>
                                  <div style="margin-left:10px;">
                                    <label class="radio-inline">
                                      <input type="radio" name="Ativo" class="radio-inline" value="1">
                                      <p style="cursor: pointer;" class="unselectable">Sim</p>
                                    </label>
                                    <label class="radio-inline">
                                      <input type="radio" name="Ativo" class="radio-inline" value="0">
                                      <p style="cursor: pointer;" class="unselectable">Não</p>
                                    </label>
                                    <label class="radio-inline">
                                      <input type="radio" name="Ativo" class="radio-inline" value="" checked>
                                      <p style="cursor: pointer;" class="unselectable">Ambos</p>
                                    </label><br><br>
                                    <input type="submit" class="btn btn-primary" name="filtros_meusped_submit" value="Procurar">
                                  </div>
                              </form>
                              <hr>
                              <br>
                          </div>

                          <table class="table table-hover" style="min-width: 600px; table-layout:fixed; overflow: auto;" id="OrderTableToggle">
                              <thead>
                                  <tr>
                                    <th>Resolvido</th>
                                    <th>Equipamento</th>
                                    <th>Data de resolução</th>
                                    <th>Sala</th>
                                    <th>Ação</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php
                                if ($result->num_rows != 0) {
                                while ($row = $result->fetch_assoc()) {
                                $Date = str_replace('-', '/', $row['Data']);
                                $DataLeitura = date('d/m/Y', strtotime($Date));
                                ?>
                                  <tr>
                                      <td><?php if ($row['Resolvido'] == "1") {echo "<b style='color: #60D439; cursor: help'><i class='fa fa-check fa-lg' title='Pedido resolvido' aria-hidden='true'></i></b>";} else {echo "<b style='color: #E8434E; cursor: help'><i class='fa fa-remove fa-lg' title='Pedido não resolvido' aria-hidden='true'></i></b>";}?></td>                                        <td><?=$row["Nome"]?></td>
                                      <td><?=$DataLeitura?></td>
                                      <td><?=$row["Sala"]?></td>
                                      <td>
                                        <a href="EditarIntervencao?Id=<?=$row["Id"];?>">
                                          <i title="Editar" class="fa fa-pencil fa-lg" aria-hidden="true"></i>
                                        </a>
                                        <a href="VerificarIntervencao?Id=<?=$row["Id"];?>">
                                          <i title="Ver todas as informações" class="fa fa-eye fa-lg" aria-hidden="true"></i>
                                        </a>
                                        <a href="javascript:;" class="deleteRecord" data-id="<?=$row["Id"];?>">
                                          <i title="Eliminar" class="fa fa-times fa-lg" aria-hidden="true"></i>
                                        </a>
                                      </td>
                                  </tr>
                                  <?php }} else { ?>
                                    <tr>
                                        <td>N/D</td>
                                        <td>N/D</td>
                                        <td>N/D</td>
                                        <td>N/D</td>
                                        <td>N/D</td>
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
                        </div>
                    </div>
                </div>
                <?php #PAGINAÇÃO SCRIPT
                  require("Shared/Paginate.php");
                    if ($pg>$maxPages)  {?>
                      <script>
                        window.location.replace("MinhasIntervencoes");
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
          content: 'Tem a certeza que pretende eliminar este registo?',
          buttons: {
              Sim: function() {
                $.ajax({
                  method: "GET",
                  url: "ajax/deleteIntervencao.php?id=" + id,
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
