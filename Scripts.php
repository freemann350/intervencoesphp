
  <script src="assets\libs\jquery\dist\jquery.min.js"></script>
  <script src="assets\libs\bootstrap\dist\js\bootstrap.min.js"></script>

  <script src="assets\libs\template\js\jquery-ui-1.9.2.custom.min.js"></script>
  <script src="assets\libs\template\js\jquery.ui.touch-punch.min.js"></script>
  <script class="include" type="text/javascript" src="assets\libs\template\js\jquery.dcjqaccordion.2.7.js"></script>
  <script src="assets\libs\template\js\jquery.scrollTo.min.js"></script>
  <script src="assets\libs\template\js\jquery.nicescroll.js" type="text/javascript"></script>
  <script src="assets\libs\jquery-confirm\jquery-confirm.min.js"></script>
  <script src="assets\libs\template\js\jquery.confirm.js"></script>
  <script src="assets\libs\template\js\common-scripts.js"></script>

  <?php
    #DATEPICKER PLUGIN
    if (isset($datepickerInclude) && ($datepickerInclude = true)) {
  ?>
  <script src="assets\libs\bootstrap-datepicker\dist\js\bootstrap-datepicker.js"></script>
  <script src="assets\libs\bootstrap-datepicker\dist\locales\bootstrap-datepicker.pt.min.js"></script>
  <script src="assets\libs\template\js\jquery.datepicker.js"></script>
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
      $.backstretch("assets/img/login/aesm.jpg", {speed: 500}) ;
  </script>
  <?php };?>
  <?php
    #BACKSTRETCH PLUGIN
    if (isset($timepickerInclude) && ($timepickerInclude = true)) {
  ?>
  <script src="assets\libs\clockpicker\dist\jquery-clockpicker.min.js"></script>
  <script src="assets\libs\clockpicker\dist\bootstrap-clockpicker.js"></script>
  <script type="text/javascript">
    $('.clockpicker').clockpicker({
      default: 'now',
      donetext: 'Feito',
      vibrate: true
  });
  </script>
<?php };?>

<?php if (isset($validatejs) && ($validatejs = true)) {?>
  <script src="assets\libs\jquery-validation\dist\jquery.validate.js"></script>
  <script src="assets\libs\jquery-validation\src\localization\messages_pt_PT.js"> </script>
<?php };?>
  <script>
    function goBack() {
        window.history.back();
    }
  </script>
