<?php
  $titulo = "Meus Pedidos";
  $datepickerInclude = true;
  $removeInclude = true;
  $filtrosInclude = true;
  $PmpActive = true;

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  $stmt = $con->prepare(
  "SELECT pedidos.Id, equipamentos.Nome, salas.Sala FROM pedidos INNER JOIN Salas ON pedidos.IdSala = salas.Id INNER JOIN equipamentos ON pedidos.IdEquipamento = equipamentos.Id WHERE pedidos.IdProfessor = ?;
  ");

  $stmt->bind_param("i", $LoggedID);
  $stmt->execute();

  $result = $stmt->get_result();
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
            <section class="wrapper site-min-height">
              <br>
              <div class="alert alert-success"><b>Sucesso!</b> Os dados foram alterados com êxito.</div>

                <h3><i class="fa fa-angle-right"></i> Os meus Pedidos</h3>

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
                                    <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por tipo de problema</h4>
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

                            <br><br>
                            <table class="table table-hover" style="max-width: 15116165px; overflow: scroll;">
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
                                        <td><?=$row["Nome"]?></td>
                                        <td><?=$row["Sala"]?></td>
                                        <td>
                                          <a href="EditarPedido?Id=<?=$row["Id"];?>">
                                            <i title="Editar" class="fa fa-pencil fa-lg" aria-hidden="true"></i>
                                          <a href="VerificarPedidos?Id=<?=$row["Id"];?>">
                                            <i title="Ver todas as informações" class="fa fa-eye fa-lg" aria-hidden="true"></i>
                                          </a>
                                          <a href="#">
                                            <i title="Eliminar" class="fa fa-times fa-lg deleteRecord" aria-hidden="true"></i>
                                          </a>
                                        </td>
                                    </tr>
                                    <?php }} else { ?>
                                      <tr>
                                          <td><?php echo 'Não foram encontrados nenhuns dados.'?></td>
                                          <td> - </td>
                                          <td> - </td>
                                      </tr>
                                    <?php };?>
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

    <?php #HEADER INCLUDE
          include 'Shared/Scripts.php'
    ?>
</body>

</html>
