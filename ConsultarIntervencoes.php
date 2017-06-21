<?php
  $titulo = "Consultar intervenções";
  $datepickerInclude = true;
  $removeInclude =  true;
  $filtrosInclude =  true;
  $PciActive = true;
  $paginatejs = true;

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  #PAGINAÇÃO
  if (isset($_GET['p'])) {
    $pg = $_GET['p'];
  } else {
    $pg = 1;
  }

  if ($pg < '1'){
    header("Location: ConsultarIntervencoes");
  }

  $per_page = 15;
  $pfunc = ceil($pg*$per_page) - $per_page;

  $Query = "SELECT intervencoes.Resolvido, intervencoes.Data, intervencoes.Id, salas.Sala, equipamentos.Nome, professores.Id AS IdProf, concat_ws(' ', professores.Nome, professores.Apelido) NomeTodo FROM intervencoes INNER JOIN pedidos ON intervencoes.IdPedido = pedidos.Id INNER JOIN equipamentos ON pedidos.IdEquipamento = equipamentos.Id INNER JOIN salas ON pedidos.IdSala = salas.Id INNER JOIN professores ON intervencoes.IdProfessor = professores.Id";
  $QueryCount = "SELECT count(*) AS TotalDados FROM intervencoes INNER JOIN pedidos ON intervencoes.IdPedido = pedidos.Id INNER JOIN equipamentos ON pedidos.IdEquipamento = equipamentos.Id INNER JOIN salas ON pedidos.IdSala = salas.Id INNER JOIN professores ON intervencoes.IdProfessor = professores.Id";

  if (isset($_GET['filtros_consint_submit']) || (isset($_GET['Data1'])) || (isset($_GET['Data2'])) || (isset($_GET['Equipamento'])) || (isset($_GET['Bloco'])) || (isset($_GET['Sala'])) || (isset($_GET['Nome']))) {
    $Date1 = trim(mysqli_real_escape_string($con, $_GET['Data1']));
    $Date2 = trim(mysqli_real_escape_string($con, $_GET['Data2']));

    $Equipamento = trim(mysqli_real_escape_string($con, $_GET['Equipamento']));
    $Nome = trim(mysqli_real_escape_string($con, $_GET['Nome']));
    $Bloco = trim(mysqli_real_escape_string($con, $_GET['Bloco']));
    $Sala = trim(mysqli_real_escape_string($con, $_GET['Sala']));

    $switch = true;

    if ((!empty($Date1)) && (!empty($Date2)) && (isset($Date1)) && (isset($Date2))) {
      if ($switch){
        $Query .= " WHERE ";
        $QueryCount .= " WHERE ";
        $switch = false;
      } else {
        $Query .= " AND ";
        $QueryCount .= " AND ";
      }

      $Date1 = str_replace('/', '-', $Date1);
      $Date1 = date('Y-m-d', strtotime($Date1));

      $Date2 = str_replace('/', '-', $Date2);
      $Date2 = date('Y-m-d', strtotime($Date2));

      $Query .= " intervencoes.Data BETWEEN '". $Date1 ."' AND '". $Date2 ."'";
      $QueryCount .= " intervencoes.Data BETWEEN '". $Date1 ."' AND '". $Date2 ."'";
    }

    if ((!empty($Equipamento)) && (isset($Equipamento))) {
      if ($switch){
        $Query .= " WHERE ";
        $QueryCount .= " WHERE ";
        $switch = false;
      } else {
        $Query .= " AND ";
        $QueryCount .= " AND ";
      }

      $Query .= " pedidos.IdEquipamento = " . $Equipamento;
      $QueryCount .= " pedidos.IdEquipamento = " . $Equipamento;
    }

    if ((!empty($Bloco)) && (isset($Bloco))) {
      if ($switch){
        $Query .= " WHERE ";
        $QueryCount .= " WHERE ";
        $switch = false;
      } else {
        $Query .= " AND ";
        $QueryCount .= " AND ";
      }

      $Query .= " salas.IdBloco = " . $Bloco;
      $QueryCount .= " salas.IdBloco = " . $Bloco;
    }

    if ((!empty($Nome)) && (isset($Nome))) {
      if ($switch){
        $Query .= " WHERE ";
        $QueryCount .= " WHERE ";
        $switch = false;
      } else {
        $Query .= " AND ";
        $QueryCount .= " AND ";
      }
      $Nome = "'%" . $Nome . "%'";
      $Query .= " concat_ws(' ', professores.Nome, professores.Apelido) LIKE " . $Nome;
      $QueryCount .= " concat_ws(' ', professores.Nome, professores.Apelido) LIKE " . $Nome;
    }

    if ((!empty($Sala)) && (isset($Sala))) {
      if ($switch){
        $Query .= " WHERE ";
        $QueryCount .= " WHERE ";
        $switch = false;
      } else {
        $Query .= " AND ";
        $QueryCount .= " AND ";
      }

      $Query .= " pedidos.IdSala = " . $Sala;
      $QueryCount .= " pedidos.IdSala = " . $Sala;
    }

    if ((!empty($_GET['Resolvido'])) && (isset($_GET['Resolvido'])) && (empty($_GET['NResolvido'])) && (!isset($_GET['NResolvido']))) {
      if ($switch){
        $Query .= " WHERE ";
        $QueryCount .= " WHERE ";
        $switch = false;
      } else {
        $Query .= " AND ";
        $QueryCount .= " AND ";
      }
      $Query .= " intervencoes.Resolvido = 1 ";
      $QueryCount .= " intervencoes.Resolvido = 1";
    }

    if ((!empty($_GET['NResolvido'])) && (isset($_GET['NResolvido'])) && (empty($_GET['Resolvido'])) && (!isset($_GET['Resolvido']))) {
      if ($switch){
        $Query .= " WHERE ";
        $QueryCount .= " WHERE ";
        $switch = false;
      } else {
        $Query .= " AND ";
        $QueryCount .= " AND ";
      }
      $Query .= " intervencoes.Resolvido = 0 ";
      $QueryCount .= " intervencoes.Resolvido = 0";
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

<?php #LINKS INCLUDE
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
            <section class="wrapper" id="wrapping" >

                <h3><i class="fa fa-angle-right"></i> Todas as intervenções</h3>

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
                                        <option selected value="">Escolha um tipo de equipamento...</option>
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

                                  <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por professor</h4>
                                  <div style="form-group">
                                    <input type="text" class="form-control" name="Nome" placeholder="Escreva aqui o nome do professor..." value="<?php if(isset($_GET['Nome'])) { echo $_GET['Nome'];}?>">
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

                                  <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por estado de resolvido</h4>
                                  <div style="margin-left:10px;">
                                    <label class="checkbox-inline">
                                      <input type="checkbox" name="Resolvido" class="radio-inline" <?php if (isset($_GET['Ativo'])) { echo 'Checked';}?>>
                                      <p style="cursor: pointer;" class="unselectable">Sim</p>
                                    </label>
                                    <label class="checkbox-inline">
                                      <input type="checkbox" name="NResolvido" class="radio-inline" <?php if (isset($_GET['Inativo'])) { echo 'Checked';} ?>>
                                      <p style="cursor: pointer;" class="unselectable">Não</p>
                                    </label><br><br>
                                    <input type="submit" class="btn btn-primary" value="Procurar">
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
                                      <th>Professor Interveniente</th>
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
                                        <td><a href="Perfil?Id=<?=$row['IdProf']?>" title="Ver perfil de <?=$row['NomeTodo']?>"><?=$row['NomeTodo']?></td>
                                        <td><?=$row["Sala"]?></td>
                                        <td>
                                          <a href="VerificarIntervencao?Id=<?=$row["Id"];?>">
                                            <i title="Ver todas as informações" class="fa fa-eye fa-lg" aria-hidden="true"></i>
                                          </a>
                                        </td>
                                    </tr>
                                    <?php }} else { ?>
                                      <tr>
                                          <td>N/D</td>
                                          <td>N/D </td>
                                          <td>N/D </td>
                                          <td>N/D </td>
                                          <td>N/D </td>
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

                              echo "Total de dados: " . $row['TotalDados']."<br><br>";
                            ?>
                        </div>
                    </div>
                </div>
                <?php #PAGINAÇÃO SCRIPT
                  require("Shared/Paginate.php");
                    if ($pg>$maxPages)  {?>
                      <script>
                        window.location.replace("ConsultarIntervencoes");
                      </script>
                  <?php } ?>
            </section>
        </section>

        <!-- /MAIN CONTENT -->

        <?php #FOOTER INCLUDE
          include 'Shared/Footer.php';
        ?>
    </section>

    <?php #LINKS INCLUDE
          include 'Shared/Scripts.php'
    ?>
</body>

</html>
