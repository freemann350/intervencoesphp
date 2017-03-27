<?php
  $titulo = "Gerência de Utilizadores";
  $removeInclude = true;
  $filtrosInclude = true;
  $PuActive = true;
?>
<!DOCTYPE html>
<html lang="en">

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
            <section class="wrapper site-min-height" id="wrapping">

                <h3><i class="fa fa-angle-right"></i> Gestão de utilizadores</h3>

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
                                    <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por tipo de utilizador</h4>
                                    <div class="form-group">
                                        <div class="form-group">
                                        <select class="form-control">
                                        <option selected disabled hidden>Escolha um tipo de utilizador...</option>
                                        <option>Admin</option>
                                        <option>Técnico</option>
                                        <option>Professor</option>
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
                                        <th>Nome</th>
                                        <th>Tipo de utilizador</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Professor A</td>
                                        <td>Admin</td>
                                        <td><a href="Editar"><i title="Editar" class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                                        <a href="#"><i title="Eliminar" class="fa fa-times fa-lg deleteRecord" aria-hidden="true"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Professor B</td>
                                        <td>Técnico</td>
                                        <td><a href="Editar"><i title="Editar" class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                                        <a href="#"><i title="Eliminar" class="fa fa-times fa-lg deleteRecord" aria-hidden="true"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Professor C</td>
                                        <td>Professor</td>
                                        <td><a href="Editar"><i title="Editar" class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                                        <a href="#"><i title="Eliminar" class="fa fa-times fa-lg deleteRecord" aria-hidden="true"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </section>
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

    <?php #HEADER INCLUDE
          include 'Shared/Scripts.php'
    ?>
</body>

</html>
