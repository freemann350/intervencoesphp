<?php
  $titulo = "Novo Equipamento"
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
                <h3><i class="fa fa-angle-right"></i> Registo de novo equipamento</h3>
                <div class="row mt">
                    <div class="form-panel">

                        <form class="form-horizontal style-form" method="get">
                            <div class="form-group">
                                <br><br>

                                <label class="col-sm-2 col-sm-2 control-label">Tipo de equipamento</label>
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

                                <label class="col-sm-2 col-sm-2 control-label">Marca do equipamento</label>
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

                                <label class="col-sm-2 col-sm-2 control-label">Descrição</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" rows="7"></textarea>
                                    <span class="help-block">Tente ser o mais breve possível.</span>
                                    <br>

                                    <input type="submit" class="btn btn-primary" value="Submeter">
                                    <br>
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
