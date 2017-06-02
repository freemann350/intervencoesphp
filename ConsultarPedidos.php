<?php
  $titulo = "Consultar Pedidos";
  $datepickerInclude = true;
  $removeInclude =  true;
  $filtrosInclude =  true;
  $PcpActive = true;

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  $stmt = $con->prepare(
  "SELECT pedidos.Id, equipamentos.Nome AS NomeEquip, salas.Sala, pedidos.Data, concat_ws(' ', professores.Nome, professores.Apelido) NomeProf, professores.Id AS IdProf, pedidos.Resolvido FROM pedidos INNER JOIN professores ON pedidos.IdProfessor = professores.Id INNER JOIN Salas ON pedidos.IdSala = salas.Id INNER JOIN equipamentos ON pedidos.IdEquipamento = equipamentos.Id");

  $stmt->execute();

  $result = $stmt->get_result();
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
            <section class="wrapper site-min-height" id="wrapping" >

                <h3><i class="fa fa-angle-right"></i> Todos os pedidos</h3>

                <div class="row mt">
                    <div class="col-lg-12">
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
                                      <select class="form-control" name="Bloco" onchange="getSalas(this);" id="bloco">
                                        <option selected hidden value="">Escolha um bloco...</option>
                                      </select>
                                  </div>
                                  <br>

                                  <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por Sala</h4>
                                  <div class="form-group">
                                    <select class="form-control" name="Sala" id="sala">
                                      <option selected hidden value="">Escolha uma sala...</option>
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
                                    <input type="submit" class="btn btn-primary" name="filtros_utilizadores_submit" value="Procurar">
                                  </div>
                              </form>
                              <hr>
                              <br>
                          </div>

                            <br><br>
                              <table class="table table-hover" style="min-width: 600px; table-layout:fixed; overflow: auto;" id="OrderTableToggle">
                                <thead>
                                  <tr>
                                    <th>Resolvido</th>
                                    <th>Equipamento</th>
                                    <th>Data Pedido</th>
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
                                    $DataLeitura = date('d/m/Y', strtotime($Date));
                                  ?>
                                    <tr>
                                        <td><?php if ($row['Resolvido'] == "1") {echo "<b style='color: #60D439; cursor: help'><i class='fa fa-check fa-lg' title='Pedido resolvido' aria-hidden='true'></i></b>";} else {echo "<b style='color: #E8434E; cursor: help'><i class='fa fa-remove fa-lg' title='Pedido não resolvido' aria-hidden='true'></i></b>";}?></td>
                                        <td><?=$row["NomeEquip"]?></td>
                                        <td><?=$DataLeitura?></td>
                                        <td><a href="Perfil?Id=<?=$row['IdProf']?>"><?=$row['NomeProf']?></a></td>
                                        <td><?=$row["Sala"]?></td>
                                        <td>&nbsp;
                                            <a class="Ver" href="VerificarPedido?Id=<?=$row["Id"];?>"> <i title="Ver todas as informações" class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>

                                    <?php }
                                  } else { ?>
                                        <tr>
                                            <td><?php echo 'Não foram encontrados nenhuns dados.'?></td>
                                            <td>&nbsp;N/D</td>
                                            <td>&nbsp;N/D</td>
                                            <td>&nbsp;N/D</td>
                                            <td>&nbsp;N/D</td>
                                            <td>&nbsp;N/D</td>
                                        </tr>
                                      <?php };?>
                                </tbody>
                            </table>
                            <?php
                              if (isset($_POST['filtros_utilizadores_submit'])) {

                                $stmt = $con->prepare("SELECT count(*) AS TotalDados FROM pedidos INNER JOIN professores ON pedidos.IdProfessor = professores.Id INNER JOIN Salas ON pedidos.IdSala = salas.Id INNER JOIN equipamentos ON pedidos.IdEquipamento = equipamentos.Id");

                                $stmt->bind_param("ss", $Nome, $Tipo);
                                $stmt->execute();

                                $result = $stmt->get_result();

                                $row = $result->fetch_assoc();

                                echo "Total de dados: " . $row['TotalDados']."<br><br>";

                              } else {
                                $stmt = $con->prepare("SELECT count(*) AS TotalDados FROM pedidos INNER JOIN professores ON pedidos.IdProfessor = professores.Id INNER JOIN Salas ON pedidos.IdSala = salas.Id INNER JOIN equipamentos ON pedidos.IdEquipamento = equipamentos.Id");

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
