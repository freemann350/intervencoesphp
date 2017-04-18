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

  $stmt = $con->prepare(
  "SELECT pedidos.Id, equipamentos.Nome, salas.Sala FROM pedidos INNER JOIN Salas ON pedidos.IdSala = salas.Id INNER JOIN equipamentos ON pedidos.IdEquipamento = equipamentos.Id;
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
            <section class="wrapper site-min-height" id="wrapping">

                <h3><i class="fa fa-angle-right"></i> Todos os pedidos</h3>

                <div class="row mt">
                    <br>
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <div class="col-lg-12" id="filtrosheader">
                                <span class="float-xs-left" id="filtrostext">Filtros</span>
                                <span class="float-xs-right" id="filtrosdown"><i class="fa fa-caret-down"></i></span>
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
                                <input type="submit" class="btn btn-primary" value="Procurar">
                                </form>
                                <hr>
                                <br>
                            </div>

                            <br><br><br>
                            <table class="table table-hover">
                                <thead>
                                    <tr>

                                        <th>Equipamento</th>
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
                                    </tr>
                                  <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
