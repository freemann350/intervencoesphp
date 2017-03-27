<?php
  $titulo = "O Meu Perfil";
  $fileinputInclude =  true;
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

                <h3><i class="fa fa-angle-right"></i> Definições</h3>

                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <h3>Editar perfil</h3>
                            <br>
                            <form class="form-horizontal style-form" method="get">
                                <div class="form-group">

                                  <label class="col-sm-2 col-sm-2 control-label">Imagem</label>
                                  <div class="col-sm-10">
                                    <img src="assets/img/Users/profile_img.jpg" style="width:20%; height:20%;"><br><br>
                                    <div class="input-group">
                                      <span class="input-group-btn">
                                      <span class="btn btn-default btn-file">
                                          Procurar… <input type="file" id="imgInp">
                                      </span>
                                    </span>
                                        <input type="text" class="form-control" disabled>
                                    </div><br>
                                  </div>


                                  <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                    <br>
                                  </div>
                                  <br>

                                  <label class="col-sm-2 col-sm-2 control-label">Morada</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control">
                                      <br>
                                  </div>
                                  <br>

                                  <label class="col-sm-2 col-sm-2 control-label">Email</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                    <br>
                                    <input type="submit" class="btn btn-primary" value="Submeter">
                                  </div>
                                    <br>
                            </form>
                          </div>
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

    <?php #HEADER INCLUDE
          include 'Shared/Scripts.php'
    ?>
</body>

</html>
