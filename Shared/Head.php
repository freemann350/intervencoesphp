<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="assets/Img/favicon.ico">
    <title>Intervenções AESM - <?php  echo $titulo?></title>

    <?php
      #COMMON LINKS
    ?>
    <link href="assets\libs\bootstrap\dist\css\bootstrap.min.css" rel="stylesheet">
    <link href="assets\libs\font-awesome\css\font-awesome.min.css" rel="stylesheet" />
    <link href="assets\libs\template\css\style.css" rel="stylesheet">
    <link href="assets\libs\template\css\style-responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="assets\libs\jquery-confirm\jquery-confirm.min.css">

    <?php
      #DATEPICKER
      if (isset($datepickerInclude) && ($datepickerInclude)) {
    ?>
    <link rel="stylesheet" href="assets\libs\bootstrap-datepicker\dist\css\bootstrap-datepicker3.min.css">
    <?php };?>

    <?php
      #TIMEPICKER
      if (isset($timepickerInclude) && ($timepickerInclude)) {
    ?>
    <link href="assets\libs\clockpicker\dist\jquery-clockpicker.min.css" rel="stylesheet">
    <?php };?>

    <?php
      #FILE INPUT
      if (isset($fileinputInclude) && ($fileinputInclude)) {
    ?>
    <link href="assets\libs\template\css\fileinput.css" rel="stylesheet">
    <?php };?>
</head>
