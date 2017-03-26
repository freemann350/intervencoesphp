<?php
  $titulo = "Página Inicial";
  $PiActive = true;
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
</body>

</html>
