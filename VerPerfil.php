<?php
  $titulo = "Perfil de [Nome de utilizador]";
  $fileinputInclude =  true;
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
                                  <label class="col-sm-2 col-sm-2 control-label">Imagem</label>
                                  <div class="col-sm-10">
                                    <img src="assets\img\User\profile_img.png" style="width:20%; height:20%;"><br><br>
                                  </div>
                                  <br>

                                  <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                                  <div class="col-sm-10">
                                      <p class="form-control-static">Professor</p>
                                      <br>
                                  </div>

                                  <label class="col-sm-2 col-sm-2 control-label">Email</label>
                                  <div class="col-sm-10">
                                      <p class="form-control-static">ProfessorA@mail.com</p>
                                      <br>
                                  </div>

                                  <label class="col-sm-2 col-sm-2 control-label">Último Acesso</label>
                                  <div class="col-sm-10">
                                      <p class="form-control-static">00/00/0000 00:00</p>
                                      <br>
                                          <input type="button" class="btn btn-primary" value="Voltar" onclick="goBack()">
                                          <input type="button" class="btn btn-primary" value="Editar" onclick="location.href='Perfil'">
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
