<?php
  $titulo = "Feedback";
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

                <h3><i class="fa fa-angle-right"></i> Feedback/Suporte</h3>

                <div class="row mt">
                  <div class="form-panel">
                    <p style="font-size:13px;"><i class="fa fa-angle-right fa-lg"></i>&nbsp; Todos os programas podem ter erros, e este não é excepção.<br>&emsp;Em caso de encontrar erros ou caso tenha algo a relatar acerca deste programa, preencha o seguinte formulário.<br>&emsp;<b>A sua opinião conta.</b></p>
                      <form class="form-horizontal style-form" method="post">
                          <div class="form-group">

                                <label class="col-sm-2 col-sm-2 control-label">Descrição</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" rows="7"></textarea>
                                    <span class="help-block">Tente ser o mais breve possível.</span>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Tipo de relato</label>
                                <div class="col-sm-10">
                                  <select class="form-control">
                                    <option>Feedback</option>
                                    <option>Melhoria de site</option>
                                    <option>Resolução de um problema</option>
                                  </select>
                                  <br>
                                  <input type="submit" class="btn btn-primary" value="Submeter">
                                </div>
                            </form>
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
