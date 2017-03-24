<?php
  $titulo = "Página Inicial";
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

                  <p class="centered"><a href="settings.php"><img src="assets/img/User/ui-sam.jpg" class="img-circle" width="60"></p>
                  <h5 class="centered">Admin</h5></a>

                    <li class="mt">
                        <a class="active" href="index.php">
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
            <section class="wrapper site-min-height" id="wrapping">

                <h3><i class="fa fa-angle-right"></i> Página inicial</h3>

                <div class="row mt">

                    <div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                        <div class="box1">
                            <span class="unselectable">A</span>
                            <h3>1</h3>
                        </div>
                        <p class="unselectable">Total de intervenções feitas no Bloco A</p>
                    </div>

                    <div class="col-md-2 col-sm-2 box0">
                        <div class="box1">
                            <span class="unselectable">B</span>
                            <h3>2</h3>
                        </div>
                        <p class="unselectable">Total de intervenções feitas no Bloco B</p>
                    </div>

                    <div class="col-md-2 col-sm-2 box0">
                        <div class="box1">
                            <span class="unselectable">C</span>
                            <h3>3</h3>
                        </div>
                        <p class="unselectable">Total de intervenções feitas no Bloco C</p>
                    </div>

                    <div class="col-md-2 col-sm-2 box0">
                        <div class="box1">
                            <span class="unselectable">D</span>
                            <h3>4</h3>
                        </div>
                        <p class="unselectable">Total de intervenções feitas no Bloco D</p>
                    </div>

                    <div class="col-md-2 col-sm-2 box0">
                        <div class="box1">
                            <span class="unselectable">E</span>
                            <h3>5</h3>
                        </div>
                        <p class="unselectable">Total de intervenções feitas no Bloco E</p>
                    </div>
                </div>

                <div class="row mt">

                    <div class="col-md-2 col-sm-2 col-md-offset-2 box0 ">
                        <div class="box1">
                            <img class="imagesIndex" src="assets/img/Items/pc.png" height="160" width="130" style='max-width: 110%; max-height: 110%' draggable='false' ondragstart="return false;">
                            <h3>5</h3>
                        </div>
                        <p class="unselectable">Total de intervenções feitas em Computadores</p>
                    </div>

                    <div class="col-md-1 col-sm-1"></div>

                    <div class="col-md-2 col-sm-2 box0 ">
                        <div class="box1">
                            <img class="imagesIndex" src="assets/img/Items/projetor.png" height="160" width="150" style='max-width: 110%; max-height: 110%' draggable='false' ondragstart="return false;">
                            <h3>5</h3>
                        </div>
                        <p class="unselectable">Total de intervenções feitas em Projetores</p>
                    </div>

                    <div class="col-md-1 col-sm-1"></div>

                    <div class="col-md-2 col-sm-2 box0 ">
                        <div class="box1">
                            <img class="imagesIndex" src="assets/img/Items/qi.png" height="160" width="160" style='max-width: 110%; max-height: 110%' draggable='false' ondragstart="return false;">
                            <h3>5</h3>
                        </div>
                        <p class="unselectable">Total de intervenções feitas em Quadros Interativos</p>
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

    <?php
      include 'Shared/Scripts.php';
    ?>
    <script>
    $('#logout').click(function(){
    $.confirm({
    title: 'Sair',
    content: 'Tem a certeza que pretende sair?',
    buttons: {
    Sim: function () {
    window.location.href = "login.php";
    },
    Não: function () {

    },

    }
    });
    });
</script>
</body>

</html>
