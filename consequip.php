<?php
  $titulo = "Consultar Equipamento";
  $removeInclude = true;
  $filtrosInclude =  true;
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

        <aside>
            <div id="sidebar" class="nav-collapse">
                <ul class="sidebar-menu" id="nav-accordion">

                  <p class="centered"><a href="settings.php"><img src="assets/img/user/ui-sam.jpg" class="img-circle" width="60"></p>
                  <h5 class="centered">Admin</h5></a>

                    <li class="mt">
                        <a href="index.php">
                            <i class="fa fa-home"></i>
                            <span>Página inicial</span>
                        </a>
                    </li>

                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-user"></i>
                            <span>Administração</span>
                        </a>
                        <ul class="sub">
                            <li><a href="utilizadores.php" style="background: transparent;">Utilizadores</a></li>
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-pencil-square-o"></i>
                            <span>Registos</span>
                        </a>
                        <ul class="sub">
                            <li><a href="pedidos.php" style="background: transparent;">Pedido de intervenção</a></li>
                            <li><a href="registarint.php" style="background: transparent;">Intervenções</a></li>
                            <li><a href="atualizaequip.php" style="background: transparent;">Atualizar equipamento</a></li>
                            <li><a href="registarnovoequip.php" style="background: transparent;">Novo equipamento</a></li>
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-book"></i>
                            <span>Os meus registos</span>
                        </a>
                        <ul class="sub">
                            <li><a href="minhasinterv.php" style="background: transparent;">Intervenções</a></li>
                            <li><a href="meusped.php" style="background: transparent;">Pedidos</a></li>
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a class="active" href="javascript:;">
                            <i class="fa fa-search"></i>
                            <span>Consultas</span>
                        </a>
                        <ul class="sub">
                            <li><a href="consinterv.php" style="background: transparent;">Intervenções</a></li>
                            <li><a href="conspedidos.php" style="background: transparent;">Pedidos</a></li>
                            <li class="active"> <a href="consequip.php"style="background: transparent;">Equipamento</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="sidebar-menu" id="logoutbtn">
                    <li class="sub-menu">
                        <a id="logout" style="cursor: pointer;">
                            <i class="fa fa-sign-out"></i>
                            <span>Sair</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>


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
                                        <th>#</th>
                                        <th>Equipamento</th>
                                        <th>Data</th>
                                        <th>Hora</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Projetor</td>
                                        <td>00-00-0000</td>
                                        <td>00:00</td>
                                        <td><a href="editar.php"><i title="Editar" class="fa fa-pencil fa-lg" aria-hidden="true"></i>  <a href="verificar.php"> <i title="Ver todas as informações" class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                                            <a href="#"><i title="Eliminar" class="fa fa-times fa-lg deleteRecord" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Computador</td>
                                        <td>00-00-0000</td>
                                        <td>00:00</td>
                                        <td><a href="editar.php"><i title="Editar" class="fa fa-pencil fa-lg" aria-hidden="true"></i>  <a href="verificar.php"> <i title="Ver todas as informações" class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                                            <a href="#"><i title="Eliminar" class="fa fa-times fa-lg deleteRecord" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Quadro Interativo</td>
                                        <td>00-00-0000</td>
                                        <td>00:00</td>
                                        <td><a href="editar.php"><i title="Editar" class="fa fa-pencil fa-lg" aria-hidden="true"></i>  <a href="verificar.php"> <i title="Ver todas as informações" class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
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
                    <span><u><a href="feedback.php" class="support">Feedback/Suporte</a></u></span>
                </div>
            </footer>
        </section>
    </section>

    <?php #SCRIPTS INCLUDE
          include 'Shared/Scripts.php'
    ?>
</body>

</html>
