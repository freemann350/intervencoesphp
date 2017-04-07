<?php
  $fileinputInclude =  true;

  require_once 'Shared/conn.php';
  require_once 'Shared/Restrict.php';

  $titulo = "Perfil de "  . $LoggedNome ;

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

                <h3><i class="fa fa-angle-right"></i> Ver perfil</h3>

                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                          <form class="form-horizontal style-form" method="get">
                              <div class="form-group">
                                  <br>
                                  <label class="col-sm-2 col-sm-2 control-label"><b>Imagem</b></label>
                                  <div class="col-sm-10">
                                    <img src="assets\img\User\profile_img.png" style="width:20%; height:20%;"><br><br>
                                  </div>
                                  <br>

                                  <label class="col-sm-2 col-sm-2 control-label"><b>Nome</b></label>
                                  <div class="col-sm-10">
                                      <p class="form-control-static">
                                        <?= $LoggedNome ?>
                                      </p>
                                      <br>
                                  </div>

                                  <label class="col-sm-2 col-sm-2 control-label"><b>Email</b></label>
                                  <div class="col-sm-10">
                                      <p class="form-control-static"><?= $email ?></p>
                                      <br>
                                  </div>
                              </div>
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
