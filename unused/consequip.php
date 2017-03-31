<?php
  $titulo = "Consultar Equipamento";
  $removeInclude = true;
  $filtrosInclude =  true;
?>
<!DOCTYPE html>
<html lang="pt">

<?php #LINKS INCLUDE
      include '/Shared/Head.php'
?>

<body>

    <section id="container">
      <?php #HEADER INCLUDE
            include '/Shared/Header.php'
      ?>

      <?php #SIDEBAR INCLUDE
            include '/Shared/Sidebar.php'
      ?>

        <!--MAIN CONTENT-->
        <section id="main-content">
            <section class="wrapper site-min-height" id="wrapping">

                <h3><i class="fa fa-angle-right"></i> Todos os equipamentos</h3>

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

                                <br>
                                <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por tipo de equipamento</h4>
                                <div class="form-group">
                                    <div class="form-group">
                                      <select class="form-control">
                                        <option selected disabled hidden>Escolha um tipo de equipamento...</option>
                                        <option>Computador</option>
                                        <option>Projetor</option>
                                        <option>Quadro interativo</option>
                                        <option>Outros</option>
                                      </select>
                                    </div>
                                </div>
                                <br>

                                <br>
                                <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por marca</h4>
                                <div class="form-group">
                                    <div class="form-group">
                                      <select class="form-control">
                                        <option selected disabled hidden>Escolha a marca do equipamento...</option>
                                        <option>Marca 1</option>
                                        <option>Marca 2</option>
                                        <option>Marca 3</option>
                                        <option>Marca 4</option>
                                        <option>Marca 5</option>
                                      </select>
                                    </div>
                                </div>
                                <br>

                                <br>
                                <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por bloco</h4>
                                <div class="form-group">
                                    <div class="form-group">
                                      <select class="form-control">
                                        <option selected disabled hidden>Escolha o bloco...</option>
                                        <option>Bloco A</option>
                                        <option>Bloco B</option>
                                        <option>Bloco C</option>
                                        <option>Bloco D</option>
                                        <option>Bloco E</option>
                                      </select>
                                    </div>
                                </div>
                                <br>

                                <br>
                                <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por localização do equipamento</h4>
                                <div class="form-group">
                                    <div class="form-group">
                                      <select class="form-control">
                                        <option selected disabled hidden>Escolha a sala onde se encontra o equipamento...</option>
                                        <option>Sala 1</option>
                                        <option>Sala 2</option>
                                        <option>Sala 3</option>
                                        <option>Sala 4</option>
                                        <option>Sala 5</option>
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
                                         
                                        <td><a href="Editar"><i title="Editar" class="fa fa-pencil fa-lg" aria-hidden="true"></i>  <a href="Verificar"> <i title="Ver todas as informações" class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                                            <a href="#"><i title="Eliminar" class="fa fa-times fa-lg deleteRecord" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                         
                                        <td>Computador</td>
                                        <td>00-00-0000</td>
                                         
                                        <td><a href="Editar"><i title="Editar" class="fa fa-pencil fa-lg" aria-hidden="true"></i>  <a href="Verificar"> <i title="Ver todas as informações" class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                                            <a href="#"><i title="Eliminar" class="fa fa-times fa-lg deleteRecord" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                         
                                        <td>Quadro Interativo</td>
                                        <td>00-00-0000</td>
                                         
                                        <td><a href="Editar"><i title="Editar" class="fa fa-pencil fa-lg" aria-hidden="true"></i>  <a href="Verificar"> <i title="Ver todas as informações" class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                                            <a href="#"><i title="Eliminar" class="fa fa-times fa-lg deleteRecord" aria-hidden="true"></i></a>
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

    <?php #SCRIPTS INCLUDE
          include '/Shared/Scripts.php'
    ?>
</body>

</html>
