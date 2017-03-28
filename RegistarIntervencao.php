<?php
  $titulo = "Registar Intervenção";
  $timepickerInclude = true;
  $datepickerInclude = true;
?>
<!DOCTYPE html>
<html lang="pt">

<?php #HEADER INCLUDE
      Include 'Shared/Head.php'
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
                <h3><i class="fa fa-angle-right"></i> Registo de intervenções</h3>
                <div class="row mt">
                    <div class="form-panel">
                        <form class="form-horizontal style-form" method="get">
                            <div class="form-group">
                                <br>
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
                                      <input class="form-control" id="datepicker-registos" name="date" value="<?php echo date('d/m/Y', strtotime('-1 hour')); ?>" type="text">
                                  </div>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Hora</label>
                                <div class="col-sm-10">
                                  <div class="input-group clockpicker">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                  <input type="text" class="form-control" value="<?php echo date('h:i', strtotime('-1 hour')); ?>" style="cursor: text;">
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
