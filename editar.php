<?php
  $titulo = "Editar";
  $datepickerInclude = true;
  $removeInclude =  true;
  $filtrosInclude =  true;
  $timepickerInclude =  true;
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
                <h3><i class="fa fa-angle-right"></i> Registo de intervenções - Editar</h3>
                <div class="row mt">
                    <div class="form-panel">

                        <form class="form-horizontal style-form" method="get">
                            <div class="form-group">
                                <br><br>
                                <label class="col-sm-2 col-sm-2 control-label">Equipamento</label>
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

                                <label class="col-sm-2 control-label">Data</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control" id="date" name="date" placeholder="DD/MM/AAAA" type="text">
                                    </div>
                                    <br>
                                </div>

                                <label class="col-sm-2 col-sm-2 control-label">Hora</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                        <input type="text" class="form-control" id="timepicker" name="timepicker" placeholder="HH:MM" included>
                                    </div>
                                    <span class="help-block">Pode ser escrito à mão.</span>
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
                                    <input type="submit" class="btn btn-primary" value="Confirmar edição">
                                </div>
                        </form>
                        </div>
                        <div>
                            <p></p>
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
