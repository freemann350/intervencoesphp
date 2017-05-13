<?php
  $titulo = "Consultar Equipamento";
  $datepickerInclude = true;
  $removeInclude =  true;
  $filtrosInclude =  true;
  $PciActive = true;

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  $stmt = $con->prepare("SELECT intervencoes.Resolvido, intervencoes.Data, intervencoes.Id, salas.Sala, equipamentos.Nome, professores.Id AS IdProf, concat_ws(' ', professores.Nome, professores.Apelido) NomeTodo FROM intervencoes
    INNER JOIN pedidos ON intervencoes.IdPedido = pedidos.Id
    INNER JOIN equipamentos ON pedidos.IdEquipamento = equipamentos.Id
    INNER JOIN salas ON pedidos.IdSala = salas.Id
    INNER JOIN professores ON intervencoes.IdProfessor = professores.Id
    ");

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
            <section class="wrapper site-min-height" id="wrapping" style="min-width: 20%; max-width: 140%; overflow: auto;">

                <h3><i class="fa fa-angle-right"></i> Todas as intervenções</h3>

                <div class="row mt">
                    <br>
                    <div class="col-lg-12">
                        <div class="form-panel" style="min-width: 620px; table-layout:fixed;">
                            <div class="col-lg-12" id="filtrosheader">
                                <span class="float-xs-left" id="filtrostext">Filtros</span>
                                <span class="float-xs-right" id="filtrosdown"><i>(Carregue nesta barra para filtrar a informação)</i>&nbsp;&nbsp; <i class="fa fa-caret-down" id="caret-spin"></i></span>
                            </div>

                            <div class="col-lg-12" id="filtrosdiv" style="display: none;">
                                <br>
                                <form>
                                <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por dias</h4>
                                <div class="input-group input-daterange">
                                    <input type="text" class="form-control" placeholder="DD/MM/AAAA">
                                    <div class="input-group-addon">Até</div>
                                    <input type="text" class="form-control" placeholder="DD/MM/AAAA">
                                </div>
                                <br>

                                <br>
                                <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por equipamento</h4>
                                <div class="form-group">
                                    <div class="form-group">
                                      <select class="form-control">
                                        <option selected disabled hidden>Escolha um equipamento...</option>
                                        <option>Computador</option>
                                        <option>Projetor</option>
                                        <option>Quadro interativo</option>
                                        <option>Outros</option>
                                      </select>
                                    </div>
                                </div>
                                <br>

                                <br>
                                <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por professor</h4>
                                <div class="form-group">
                                  <input type="text" class="form-control" placeholder="Escreva aqui o nome do professor...">
                                </div>
                                <br>

                                <br>
                                <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por problema</h4>
                                <div class="form-group">
                                    <div class="form-group">
                                      <select class="form-control">
                                        <option selected disabled hidden>Escolha um tipo de problema...</option>
                                        <option>Problema 1</option>
                                        <option>Problema 2</option>
                                        <option>Problema 3</option>
                                        <option>Problema 4</option>
                                        <option>Problema 5</option>
                                      </select>
                                    </div>
                                </div>
                                <br>

                                <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por estado de resolvido</h4>
                                <div class="form-group">
                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" name="Resolvido">
                                      <p style="margin-top:2px; cursor: pointer;" class="unselectable">Resolvido</p>
                                    </label>
                                  </div>
                                </div>
                                <br>

                                <input type="submit" class="btn btn-primary" value="Procurar">
                                </form>
                                <hr>
                                <br>
                            </div>

                            <br><br>
                            <table class="table table-hover" style="min-width: 600px; table-layout:fixed; overflow: hidden;">
                                <thead>
                                    <tr>
                                      <th>Resolvido</th>
                                      <th>Equipamento</th>
                                      <th>Data resolv.</th>
                                      <th title="Professor Interveniente">Professor Interv.</th>
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
                                        <td style="padding-left: 20px;"><?php if ($row['Resolvido'] == "1") {echo "Sim";} else {echo "Não";}?></td>
                                        <td><?=$row["Nome"]?></td>
                                        <td><?=$DataLeitura?></td>
                                        <td><a href="Perfil?Id=<?=$row['IdProf']?>"><?=$row['NomeTodo']?></td>
                                        <td><?=$row["Sala"]?></td>
                                        <td>
                                          <a href="VerificarIntervencao?Id=<?=$row["Id"];?>">
                                            <i title="Ver todas as informações" class="fa fa-eye fa-lg" aria-hidden="true"></i>
                                          </a>
                                        </td>
                                    </tr>
                                    <?php }} else { ?>
                                      <tr>
                                          <td><?php echo 'Não foram encontrados nenhuns dados.'?></td>
                                          <td>&nbsp;N/D </td>
                                          <td>&nbsp;N/D </td>
                                          <td>&nbsp;N/D </td>
                                          <td>&nbsp;N/D </td>
                                          <td>&nbsp;N/D </td>
                                      </tr>
                                    <?php };?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <br><br><br>
            </section>
            <!-- /MAIN CONTENT -->

            <?php #FOOTER INCLUDE
              include 'Shared\Footer.php';
            ?>
        </section>
    </section>

    <?php #LINKS INCLUDE
          include 'Shared/Scripts.php'
    ?>
</body>

</html>
