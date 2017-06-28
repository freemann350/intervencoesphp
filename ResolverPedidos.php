<?php
  $titulo = "Resolução de pedidos";
  $datepickerInclude = true;
  $removeInclude =  true;
  $filtrosInclude =  true;
  $PrActive = true;
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
    header("Location: ResolverPedidos");
  }

  $per_page = 20;
  $pfunc = ceil($pg*$per_page) - $per_page;

  $Query = "SELECT pedidos.Id, equipamentos.Nome, salas.Sala, professores.Id AS IdProf, pedidos.Data, concat_ws(' ', professores.Nome, professores.Apelido) NomeTodo, pedidos.Resolvido FROM pedidos INNER JOIN Salas ON pedidos.IdSala = salas.Id INNER JOIN equipamentos ON pedidos.IdEquipamento = equipamentos.Id INNER JOIN professores ON professores.Id = pedidos.IdProfessor WHERE Resolvido = '0'";
  $QueryCount = "SELECT count(*) TotalDados FROM pedidos INNER JOIN Salas ON pedidos.IdSala = salas.Id INNER JOIN equipamentos ON pedidos.IdEquipamento = equipamentos.Id INNER JOIN professores ON professores.Id = pedidos.IdProfessor WHERE Resolvido = '0'";

  if (isset($_GET['filtros_conspedidos_submit']) || ((isset($_GET['Data1'])) && (isset($_GET['Data2']))) || (isset($_GET['Equipamento'])) || (isset($_GET['Bloco'])) || (isset($_GET['Sala'])) || (isset($_GET['Nome']))) {
    $Date1 = trim(mysqli_real_escape_string($con, $_GET['Data1']));
    $Date2 = trim(mysqli_real_escape_string($con, $_GET['Data2']));

    $Equipamento = trim(mysqli_real_escape_string($con, $_GET['Equipamento']));
    $Nome = trim(mysqli_real_escape_string($con, $_GET['Nome']));
    $Bloco = trim(mysqli_real_escape_string($con, $_GET['Bloco']));
    $Sala = trim(mysqli_real_escape_string($con, $_GET['Sala']));
    $TipoEquipamento = trim(mysqli_real_escape_string($con, $_GET['TipoEquipamento']));

    if ((!empty($Date1)) && (!empty($Date2)) && (isset($Date1)) && (isset($Date2))) {
      $Date1 = str_replace('/', '-', $Date1);
      $Date1 = date('Y-m-d', strtotime($Date1));

      $Date2 = str_replace('/', '-', $Date2);
      $Date2 = date('Y-m-d', strtotime($Date2));

      $Query .= " AND pedidos.Data BETWEEN '". $Date1 ."' AND '". $Date2 ."'";
      $QueryCount .= " AND pedidos.Data BETWEEN '". $Date1 ."' AND '". $Date2 ."'";
    }

    if ((!empty($TipoEquipamento)) && (isset($TipoEquipamento))) {
      $Query .= " AND equipamentos.IdTipo = " . $TipoEquipamento;
      $QueryCount .= " AND equipamentos.IdTipo = " . $TipoEquipamento;
    }

    if ((!empty($Equipamento)) && (isset($Equipamento))) {
      $Query .= " AND pedidos.IdEquipamento = " . $Equipamento;
      $QueryCount .= " AND pedidos.IdEquipamento = " . $Equipamento;
    }

    if ((!empty($Bloco)) && (isset($Bloco))) {
      $Query .= " AND salas.IdBloco = " . $Bloco;
      $QueryCount .= " AND salas.IdBloco = " . $Bloco;
    }

    if ((!empty($Nome)) && (isset($Nome))) {
      $Nome = "'%" . $Nome . "%'";
      $Query .= " AND concat_ws(' ', professores.Nome, professores.Apelido) LIKE " . $Nome;
      $QueryCount .= " AND concat_ws(' ', professores.Nome, professores.Apelido) LIKE " . $Nome;
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
            <section class="wrapper" id="wrapping">

                <h3><i class="fa fa-angle-right"></i> Resolução de pedidos</h3>

                <div class="row mt">
                    <div class="col-lg-12" >
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
                                      <input type="text" class="form-control" placeholder="DD/MM/AAAA" name="Data1" value="<?php if (isset($_GET['Data1'])) {echo $_GET['Data1'];} ?>">
                                      <div class="input-group-addon">Até</div>
                                      <input type="text" class="form-control" placeholder="DD/MM/AAAA" name="Data2" value="<?php if (isset($_GET['Data2'])) {echo $_GET['Data2'];} ?>">
                                  </div><br>

                                  <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por professor</h4>
                                  <div class="form-group">
                                    <input type="text" class="form-control" name="Nome" placeholder="Escreva aqui o nome do professor..." value="<?php if(isset($_GET['Nome'])) { echo $_GET['Nome'];}?>">
                                  </div><br>

                                  <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por tipo de equipamento</h4>
                                  <div class="form-group">
                                      <select class="form-control" name="TipoEquipamento">
                                        <option selected value="">Escolha um tipo de equipamento...</option>
                                        <?php
                                          $stmt1 = $con->prepare("SELECT * FROM tipoequipamento");

                                          $stmt1->execute();
                                          $result1 = $stmt1->get_result();

                                          while ($equip = $result1->fetch_assoc()) {
                                        ?>
                                        <option value="<?= $equip['Id'] ?>" <?php if ((!empty($_GET['TipoEquipamento'])) && (isset($_GET['TipoEquipamento']))) {  if ($equip["Id"] == $_GET['TipoEquipamento']) { echo "Selected";}} ?>><?=$equip["TipoEquipamento"]; ?></option>
                                        <?php } ?>
                                      </select>
                                  </div><br>

                                  <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por Bloco</h4>
                                  <div class="form-group">
                                    <select id ="bloco" class="form-control" name="Bloco" onchange="getSalas(this);">
                                      <option selected value="">Escolha um bloco...</option>
                                      <?php
                                        $stmt1 = $con->prepare("SELECT * FROM blocos");

                                        $stmt1->execute();
                                        $result1 = $stmt1->get_result();

                                        while ($row1 = $result1->fetch_assoc()) {
                                      ?>
                                        <option value="<?= $row1['Id'] ?>"<?php if ((!empty($_GET['Bloco'])) && (isset($_GET['Bloco']))) {  if ($row1["Id"] == $_GET['Bloco']) { echo "Selected";}} ?>><?= $row1["Bloco"] ?></option>
                                      <?php }; ?>
                                    </select>
                                  </div><br>

                                  <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por Sala</h4>
                                  <div class="form-group">
                                    <select id="sala" class="form-control" name="Sala" onchange="getEquip(this);">
                                    </select>
                                    <span class="help-block">Nota: Escolha o bloco primeiro</span>
                                  </div><br>

                                  <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por equipamento</h4>
                                  <div class="form-group">
                                    <select id="equipamento" class="form-control" name="Equipamento">
                                    </select>
                                    <span class="help-block">Nota: Escolha a sala primeiro</span>
                                    <input type="submit" class="btn btn-primary" value="Procurar">
                                  </div>
                              </form>
                              <hr>
                              <br>
                          </div>

                            <table class="table table-striped table-hover" style="min-width: 600px; table-layout:fixed; overflow: auto;" id="OrderTableToggle">
                                <thead>
                                    <tr>
                                        <th>Equipamento</th>
                                        <th>Data pedido</th>
                                        <th>Professor</th>
                                        <th>Sala</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  if ($result->num_rows != 0) {
                                    while ($row = $result->fetch_assoc()) {
                                    $Date = str_replace('-', '/', $row['Data']);
                                    $Date = date('d/m/Y', strtotime($Date));
                                  ?>
                                  <tr>
                                      <td><?=$row['Nome']?></td>
                                      <td><?=$Date?></td>
                                      <td><a href="Perfil?Id=<?=$row['IdProf']?>"><?=$row['NomeTodo']?></a></td>
                                      <td><?=$row['Sala']?></td>
                                      <td>
                                          <a href="VerificarPedido?Id=<?=$row['Id']?>">
                                            <i title="Ver todas as informações" class="fa fa-eye fa-lg" aria-hidden="true"></i>
                                          </a>
                                          &nbsp;
                                          <a href= "RegistarIntervencao?Id=<?=$row['Id']?>">
                                            <i title="Registar intervenção" class="fa fa-wrench" aria-hidden="true"></i>
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
                                  <?php }?>
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
                        window.location.replace("ResolverPedidos");
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
