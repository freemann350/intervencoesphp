<?php
  $titulo = "Verificar Dados";
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
            <section class="wrapper site-min-height">
                <h3><i class="fa fa-angle-right"></i> Registo de intervenções - Visualização de dados</h3>
                <div class="row mt">
                    <div class="form-panel">

                        <form class="form-horizontal style-form" method="get">
                            <div class="form-group">
                                <br><br>
                                <label class="col-sm-2 col-sm-2 control-label">Equipamento</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">Projetor</p>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Data</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">01/01/2001</p>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Hora</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">00:00</p>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Descrição</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id nisi feugiat, porta justo dignissim, commodo nisl. Sed nec facilisis elit, a malesuada enim. Suspendisse tempor nunc lobortis condimentum dictum. Mauris
                                        quis metus rhoncus, placerat dolor sit amet, pharetra ipsum. Fusce finibus mattis velit. Sed vitae aliquam odio. Nam mollis in leo ac tempus. Fusce ultrices felis id suscipit rutrum. Suspendisse ipsum ante, vulputate
                                        ac auctor sit amet, finibus ut mi. Nulla rhoncus elementum cursus. Sed vehicula tempus ligula vitae hendrerit. Fusce lacus dolor, lacinia sit amet dignissim sit amet.</p>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Problema</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">Cabos partidos</p>
                                    <br>
                                        <input type="button" class="btn btn-primary" value="Voltar" onclick="goBack()">
                                </div>
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

    <?php #HEADER INCLUDE
          include 'Shared/Scripts.php'
    ?>
</body>

</html>
