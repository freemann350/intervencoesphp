<?php
  $titulo = "Consultar Equipamento";
  $datepickerInclude = true;
  $removeInclude =  true;
  $filtrosInclude =  true;
  $PcpActive = true;
?>
<!DOCTYPE html>
<html lang="en">

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

                <h3><i class="fa fa-angle-right"></i> Todas as intervenções</h3>

                <div class="row mt">
                    <br><br>
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
                                        <th>#</th>
                                        <th>Equipamento</th>
                                        <th>Data</th>
                                         
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Projetor</td>
                                        <td>00-00-0000</td>
                                         
                                        <td>
                                            <a href="Verificar"> <i title="Ver todas as informações" class="fa fa-eye fa-lg" aria-hidden="true"></i></a> <a href= "RegistarIntervencao"><i title="Registar intervenção" class="fa fa-wrench" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Computador</td>
                                        <td>00-00-0000</td>
                                         
                                        <td>
                                            <a href="Verificar"> <i title="Ver todas as informações" class="fa fa-eye fa-lg" aria-hidden="true"></i> </a>
                                            <a href= "RegistarIntervencao"><i title="Registar intervenção" class="fa fa-wrench" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Quadro Interativo</td>
                                        <td>00-00-0000</td>
                                         
                                        <td>
                                            <a href="Verificar"> <i title="Ver todas as informações" class="fa fa-eye fa-lg" aria-hidden="true"></i></a> <a href= "RegistarIntervencao"><i title="Registar intervenção" class="fa fa-wrench" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /MAIN CONTENT -->

            <footer class="site-footer">
                <div class="text-center">
                    <span>GestiEscola&copy; 2017</span>
                    <a href="#" class="go-top">
                        <i class="fa fa-angle-up"></i>
                    </a><br>
                    <span><u><a href="feedback" class="support">Feedback/Suporte</a></u></span>
                </div>
            </footer>
        </section>
    </section>

    <?php #LINKS INCLUDE
          include 'Shared/Scripts.php'
    ?>
</body>

</html>
