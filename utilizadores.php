<?php
  $titulo = "Gerência de Utilizadores";
  $removeInclude = true;
  $filtrosInclude = true;
  $PuActive = true;
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

                                        <th>Nome</th>
                                        <th>Tipo de utilizador</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td>Professor A</td>
                                        <td>Admin</td>
                                        <td>
                                          <a href="EditarUtilizador">
                                            <i title="Editar Utilizador" class="fa fa-pencil fa-lg" aria-hidden="true"></i>
                                          </a>
                                          <a href="Perfil">
                                            <i title="Ver Perfil de Utilizador" class="fa fa-eye fa-lg" aria-hidden="true"></i>
                                          </a>
                                          <a href="#">
                                            <i title="Eliminar" class="fa fa-times fa-lg deleteRecord" aria-hidden="true"></i>
                                          </a>
                                      </td>
                                    </tr>
                                    <tr>

                                        <td>Professor B</td>
                                        <td>Técnico</td>
                                        <td>
                                          <a href="EditarUtilizador">
                                            <i title="Editar Utilizador" class="fa fa-pencil fa-lg" aria-hidden="true"></i>
                                          </a>
                                          <a href="Perfil">
                                            <i title="Ver Perfil de Utilizador" class="fa fa-eye fa-lg" aria-hidden="true"></i>
                                          </a>
                                          <a href="#">
                                            <i title="Eliminar" class="fa fa-times fa-lg deleteRecord" aria-hidden="true"></i>
                                          </a>
                                      </td>
                                    </tr>
                                    <tr>

                                        <td>Professor C</td>
                                        <td>Professor</td>
                                        <td>
                                          <a href="EditarUtilizador">
                                            <i title="Editar Utilizador" class="fa fa-pencil fa-lg" aria-hidden="true"></i>
                                          </a>
                                          <a href="Perfil">
                                            <i title="Ver Perfil de Utilizador" class="fa fa-eye fa-lg" aria-hidden="true"></i>
                                          </a>
                                        <a href="#">
                                          <i title="Eliminar" class="fa fa-times fa-lg deleteRecord" aria-hidden="true"></i>
                                        </a>
                                      </td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="NovoUtilizador">+ Registar novo Utilizador</a>
                        </div>
                    </div>
                </div>

            </section>
        </section>
        <!-- /MAIN CONTENT -->

        <?php #FOOTER INCLUDE
          include 'Shared\Footer.php';
        ?>
    </section>

    <?php #HEADER INCLUDE
          include 'Shared/Scripts.php'
    ?>
</body>

</html>
