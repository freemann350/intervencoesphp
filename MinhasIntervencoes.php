<?php
  $titulo = "Minhas Intervenções";
  $datepickerInclude = true;
  $filtrosInclude = true;
  $removeInclude = true;
  $PmiActive = true;

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  #3 = professor
  if ($LoggedRole == "3") {
    header("Location: 403");
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
            <section class="wrapper site-min-height">
                <h3><i class="fa fa-angle-right"></i> As minhas intervenções</h3>

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

                            <br><br><br>
                            <table class="table table-hover">
                                <thead>
                                    <tr>

                                        <th>Equipamento</th>
                                        <th>Data</th>

                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td>Projetor</td>
                                        <td>00-00-0000</td>

                                        <td><a href="EditarIntervencao"><i title="Editar" class="fa fa-pencil fa-lg" aria-hidden="true"></i>  <a href="Verificar"> <i title="Ver todas as informações" class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                                            <a href="#"><i title="Eliminar" class="fa fa-times fa-lg deleteRecord" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>Computador</td>
                                        <td>00-00-0000</td>

                                        <td><a href="EditarIntervencao"><i title="Editar" class="fa fa-pencil fa-lg" aria-hidden="true"></i>  <a href="Verificar"> <i title="Ver todas as informações" class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                                            <a href="#"><i title="Eliminar" class="fa fa-times fa-lg deleteRecord" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>Quadro Interativo</td>
                                        <td>00-00-0000</td>

                                        <td>
                                          <a href="EditarIntervencao"><i title="Editar" class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                                          <a href="Verificar"> <i title="Ver todas as informações" class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                                          <a href="#"><i title="Eliminar" class="fa fa-times fa-lg deleteRecord" aria-hidden="true"></i></a></td>
                                    </tr>
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
