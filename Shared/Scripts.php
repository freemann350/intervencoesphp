  <script src="assets\libs\jquery\dist\jquery.min.js"></script>
  <script src="assets\libs\bootstrap\dist\css\bootstrap.min.css"></script>

  <script src="assets\libs\template\js\jquery-ui-1.9.2.custom.min.js"></script>
  <script src="assets\libs\template\js\jquery.ui.touch-punch.min.js"></script>
  <script class="include" type="text/javascript" src="assets\libs\template\js\jquery.dcjqaccordion.2.7.js"></script>
  <script src="assets\libs\template\js\jquery.scrollTo.min.js"></script>
  <script src="assets\libs\template\js\jquery.nicescroll.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.0.3/jquery-confirm.min.js"></script>
  <script src="assets\libs\template\js\jquery.confirm.js"></script>
  <script src="assets\libs\template\js\common-scripts.js"></script>

  <?php
    #DATEPICKER PLUGIN
    if (isset($datepickerInclude) && ($datepickerInclude = true)) {
  ?>
  <script src="assets\libs\bootstrap-datepicker\dist\js\bootstrap-datepicker.js"></script>
  <script src="assets\libs\bootstrap-datepicker\dist\js\jquery.datepicker.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
  <?php };?>

  <?php
    #TIMEPICKER PLUGIN
    if (isset($timepickerInclude) && ($timepickerInclude = true)) {
  ?>
  <script src="assets\libs\jt.timepicker\jquery.timepicker.js"></script>
  <?php };?>

  <?php
    #FILE INPUT PLUGIN
    if (isset($fileinputInclude) && ($fileinputInclude = true)) {
  ?>
  <script src="assets\libs\template\js\fileinput.js"></script>
  <?php };?>

  <?php
    #REMOVE PLUGIN
    if (isset($removeInclude) && ($removeInclude = true)) {
  ?>
  <script src="assets\libs\template\js\remove.js"></script>
  <?php  };?>

  <?php
    #ANIMAÇÃO FILTROS PLUGIN
    if (isset($filtrosInclude) && ($filtrosInclude = true)) {
  ?>
  <script type="text/javascript" src="assets\libs\template\js\filtrosanimate.js"></script>
  <?php };?>

  <?php
    #BACKSTRETCH PLUGIN
    if (isset($backstretchInclude) && ($backstretchInclude = true)) {
  ?>
  <script type="text/javascript" src="assets\libs\jquery-backstretch\jquery.backstretch.min.js"></script>
  <script>
      $.backstretch("assets/img/aesm.jpg");
  </script>
  <?php };?>

  <script type="text/javascript">
      $('#timepicker').timepicker();
  </script>

  <script>
    function goBack() {
        window.history.back();
    }
  </script>
