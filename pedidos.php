<?php
  $titulo = "Registar Pedido";
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

        <aside>
            <div id="sidebar" class="nav-collapse">
                <ul class="sidebar-menu" id="nav-accordion">

                  <p class="centered"><a href="settings.php"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></p>
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
                        <a class="active" href="javascript:;">
                            <i class="fa fa-pencil-square-o"></i>
                            <span>Registos</span>
                        </a>
                        <ul class="sub">
                            <li class="active"><a href="pedidos.php" style="background: transparent;">Pedido de intervenção</a></li>
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
                        <a href="javascript:;">
                            <i class="fa fa-search"></i>
                            <span>Consultas</span>
                        </a>
                        <ul class="sub">
                            <li><a href="consinterv.php" style="background: transparent;">Intervenções</a></li>
                            <li><a href="conspedidos.php" style="background: transparent;">Pedidos</a></li>
                            <li> <a href="consequip.php"style="background: transparent;">Equipamento</a></li>
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
            <section class="wrapper site-min-height">
                <h3><i class="fa fa-angle-right"></i> Registo de pedidos</h3>
                <div class="row mt">
                    <div class="form-panel">
                        <form class="form-horizontal style-form" method="get">
                            <div class="form-group">
                                <br>

                                <label class="col-sm-2 col-sm-2 control-label">Bloco</label>
                                <div class="col-sm-10">
                                    <select class="form-control">
                                      <option>A</option>
                                      <option>B</option>
                                      <option>C</option>
                                      <option>D</option>
                                      <option>E</option>
                                    </select>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Sala</label>
                                <div class="col-sm-10">
                                    <select class="form-control">
                                      <option>1</option>
                                      <option>2</option>
                                      <option>3</option>
                                      <option>4</option>
                                      <option>5</option>
                                    </select>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Equipamento</label>
                                <div class="col-sm-10">
                                    <select class="form-control">
                                      <option>Computador</option>
                                      <option>Projetor</option>
                                      <option>Quadro interativo</option>
                                      <option>Outro</option>
                                    </select>
                                    <br>
                                </div>

                                <label class="col-sm-2 control-label">Data</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control" id="date" name="date" placeholder="DD/MM/YYYY" type="text">
                                    </div>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Descrição</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" rows="7"></textarea>
                                    <span class="help-block">Tente ser o mais breve possível.</span>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Problema</label>
                                <div class="col-sm-10">
                                    <select class="form-control">
                                      <option>1</option>
                                      <option>2</option>
                                      <option>3</option>
                                      <option>4</option>
                                      <option>5</option>
                                    </select>
                                    <br>
                                    <input type="submit" class="btn btn-primary" value="Submeter">
                                </div>
                        </form>
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

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.0.3/jquery-confirm.min.js"></script>
    <script src="assets/js/jquery.confirm.js"></script>
    <script src="assets/js/jquery.datepicker.js"></script>
    <script src="assets/js/jquery.datepicker.min.js"></script>
    <script src="assets/js/common-scripts.js"></script>
</body>

</html>
