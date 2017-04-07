<?php
  $titulo = "O Meu Perfil - Editar";
  $fileinputInclude =  true;

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';
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

                <h3><i class="fa fa-angle-right"></i> Editar perfil</h3>

                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <br>
                            <form class="form-horizontal style-form" method="get">
                                <div class="form-group">

                                  <label class="col-sm-2 col-sm-2 control-label">Imagem</label>
                                  <div class="col-sm-10">
                                    <img src="assets\img\User\profile_img.png" style="width:20%; height:20%;"><br><br>
                                    <div class="input-group">
                                      <span class="input-group-btn">
                                      <span class="btn btn-default btn-file">
                                          Procurar… <input type="file" id="imgInp">
                                      </span>
                                    </span>
                                        <input type="text" class="form-control" readonly>
                                    </div><br>
                                  </div>


                                  <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $primeiroNome?>">
                                    <br>
                                  </div>
                                  <br>

                                  <label class="col-sm-2 col-sm-2 control-label">Apelido</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $apelido?>">
                                    <br>
                                  </div>
                                  <br>

                                  <label class="col-sm-2 col-sm-2 control-label">Email</label>
                                  <div class="col-sm-10">
                                    <input type="email" class="form-control" value="<?= $email?>">
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
