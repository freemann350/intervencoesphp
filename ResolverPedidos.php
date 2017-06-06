<?php
  $titulo = "Consultar Pedidos";
  $datepickerInclude = true;
  $removeInclude =  true;
  $filtrosInclude =  true;
  $PrActive = true;

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  if ($LoggedRole == "3") {
    header("Location: 403");
  }
  if (isset($_POST['filtros_conspedidos_submit']) || (!empty($_POST['Data1'])) || (!empty($_POST['Data2'])) || (!empty($_POST['Equipamento'])) || (!empty($_POST['Bloco'])) || (!empty($_POST['Sala'])) || (!empty($_POST['Nome']))) {
    $Date1 = trim(mysqli_real_escape_string($con, $_POST['Data1']));
    $Date2 = trim(mysqli_real_escape_string($con, $_POST['Data2']));

    $Equipamento = trim(mysqli_real_escape_string($con, $_POST['Equipamento']));
    $Nome = trim(mysqli_real_escape_string($con, $_POST['Nome']));
    $Bloco = trim(mysqli_real_escape_string($con, $_POST['Bloco']));
    $Sala = trim(mysqli_real_escape_string($con, $_POST['Sala']));

    $switch = true;

    if ((!empty($Date1)) && (!empty($Date2)) && (isset($Date1)) && (isset($Date2))) {

      if ($switch){
        $Query .= " WHERE ";
        $switch = false;
      } else {
        $Query .= " AND ";
      }

      $Date1 = str_replace('/', '-', $Date1);
      $Date1 = date('Y-m-d', strtotime($Date1));

      $Date2 = str_replace('/', '-', $Date2);
      $Date2 = date('Y-m-d', strtotime($Date2));

      $Query .= " pedidos.Data BETWEEN '". $Date1 ."' AND '". $Date2 ."'";
    }

    if ((!empty($Equipamento)) && (isset($Equipamento))) {
      if ($switch){
        $Query .= " WHERE ";
        $switch = false;
      } else {
        $Query .= " AND ";
      }

      $Query .= " pedidos.IdEquipamento = " . $Equipamento;
    }

    if ((!empty($Bloco)) && (isset($Bloco))) {
      if ($switch){
        $Query .= " WHERE ";
        $switch = false;
      } else {
        $Query .= " AND ";
      }

      $Query .= " salas.IdBloco = " . $Bloco;
    }

    if ((!empty($Nome)) && (isset($Nome))) {
      if ($switch){
        $Query .= " WHERE ";
        $switch = false;
      } else {
        $Query .= " AND ";
      }
      $Nome = "%" . $Nome . "%";
      $Query .= " concat_ws(' ', professores.Nome, professores.Apelido) LIKE " . $Nome;
    }

    if ((!empty($Sala)) && (isset($Sala))) {
      if ($switch){
        $Query .= " WHERE ";
        $switch = false;
      } else {
        $Query .= " AND ";
      }

      $Query .= " pedidos.IdSala = " . $Sala;
    }

    $stmt = $con->prepare($Query);

    /*ECHO $Query;*/

    $stmt->execute();

    $result = $stmt->get_result();
  } else {
    $stmt = $con->prepare("SELECT pedidos.Id, equipamentos.Nome, salas.Sala, professores.Id AS IdProf,concat_ws(' ', professores.Nome, professores.Apelido) NomeTodo, pedidos.Resolvido FROM pedidos INNER JOIN Salas ON pedidos.IdSala = salas.Id INNER JOIN equipamentos ON pedidos.IdEquipamento = equipamentos.Id INNER JOIN professores ON professores.Id = pedidos.IdProfessor WHERE Resolvido = '0';");

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
            <section class="wrapper site-min-height" id="wrapping">

                <h3><i class="fa fa-angle-right"></i> Todos os pedidos</h3>

                <div class="row mt">
                    <br>
                    <div class="col-lg-12" >
                        <div class="form-panel" style="overflow: auto;">
                          <div class="col-lg-12" id="filtrosheader" style="min-width: 620px;">
                                <span class="float-xs-left" id="filtrostext">Filtros</span>
                                <span class="float-xs-right" id="filtrosdown"><i>(Carregue nesta barra para filtrar a informação)</i>&nbsp;&nbsp; <i class="fa fa-caret-down" id="caret-spin"></i></span>
                            </div>

                            <div class="col-lg-12" id="filtrosdiv" style="display: none; min-width: 620px;">
                                <br>
                                <form class="style-form" method="post">
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
                                        <option selected hidden value="">Escolha um equipamento...</option>
                                        <?php
                                          $stmt1 = $con->prepare("SELECT * FROM equipamentos");

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
                                  <div class="form-group">
                                    <input type="text" class="form-control" name="Nome" placeholder="Escreva aqui o nome do professor..." value="<?php if(isset($_POST['Nome'])) { echo $_POST['Nome'];}?>">
                                  </div>
                                  <br>


                                  <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por Bloco</h4>
                                  <div class="form-group">
                                    <select class="form-control" name="Bloco" onchange="getSalas(this);">
                                      <option selected hidden value="">Escolha um bloco...</option>
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
                                      <option selected hidden value="">Escolha uma sala...</option>
                                      <?php
                                        $stmt1 = $con->prepare("SELECT * FROM salas");

                                        $stmt1->execute();
                                        $result1 = $stmt1->get_result();

                                        while ($row1 = $result1->fetch_assoc()) {
                                      ?>
                                        <option value="<?=$row1["Id"]?>"><?=$row1["Sala"]?></option>
                                      <?php } ?>
                                    </select><br><br>
                                    <input type="submit" class="btn btn-primary" name="filtros_conspedidos_submit" value="Procurar">
                                  </div>
                              </form>
                              <hr>
                              <br>
                          </div>

                            <br><br>
                            <table class="table table-hover" style="min-width: 600px; table-layout:fixed; overflow: auto;" id="OrderTableToggle">
                                <thead>
                                    <tr>
                                        <th>Equipamento</th>
                                        <th>Professor</th>
                                        <th>Sala</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  if ($result->num_rows != 0) {
                                    while ($row = $result->fetch_assoc()) {
                                  ?>
                                  <tr>
                                      <td><?=$row['Nome']?></td>
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
                                        <td><?php echo 'Não foram encontrados nenhuns dados.'?></td>
                                        <td>&nbsp;N/D </td>
                                        <td>&nbsp;N/D </td>
                                        <td>&nbsp;N/D </td>
                                    </tr>
                                  <?php }?>
                                </tbody>
                            </table>
                            <?php
                              if (isset($_POST['filtros_utilizadores_submit'])) {

                                $stmt = $con->prepare("SELECT count(*) AS TotalDados FROM professores INNER JOIN roles ON professores.IdRole = roles.Id WHERE Nome LIKE ? AND professores.IdRole = ? AND Not professores.Id = " . $LoggedID);

                                $stmt->bind_param("ss", $Nome, $Tipo);
                                $stmt->execute();

                                $result = $stmt->get_result();

                                $row = $result->fetch_assoc();

                                echo "Total de dados: " . $row['TotalDados']."<br><br>";

                              } else {
                                $stmt = $con->prepare("SELECT count(*) AS TotalDados FROM pedidos INNER JOIN Salas ON pedidos.IdSala = salas.Id INNER JOIN equipamentos ON pedidos.IdEquipamento = equipamentos.Id INNER JOIN professores ON professores.Id = pedidos.IdProfessor WHERE Resolvido = '0';");

                                $stmt->execute();

                                $result = $stmt->get_result();

                                $row = $result->fetch_assoc();
                                echo "Total de dados: " . $row['TotalDados'] ."<br><br>";
                              }
                            ?>
                        </div>
                    </div>
                </div>
              </section>
          </section>
          <div style="padding-bottom: 30px;"></div>
          <!-- /MAIN CONTENT -->

          <?php #FOOTER INCLUDE
            include 'Shared\Footer.php';
          ?>
      </section>

    <?php #LINKS INCLUDE
          include 'Shared/Scripts.php'
    ?>
</body>

</html>
