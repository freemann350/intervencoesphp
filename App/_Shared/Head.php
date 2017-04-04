<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Alexandre Gaspar">
    <meta name="keyword" content="Intervenções, AESM">
    <link rel="icon" href="<?=ROOT?>\favicon.ico">
    <title>Intervenções AESM - <?php  echo $titulo?></title>

    <base href="intervencoesphp" />

    <?php
      #COMMON LINKS
    ?>
    <link href="<?=ROOT?>\assets\libs\bootstrap\dist\css\bootstrap.min.css" rel="stylesheet">
    <link href="<?=ROOT?>\assets\libs\font-awesome\css\font-awesome.min.css" rel="stylesheet" />
    <link href="<?=ROOT?>\assets\libs\template\css\style.css" rel="stylesheet">
    <link href="<?=ROOT?>\assets\libs\template\css\style-responsive.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.0.3/jquery-confirm.min.css" rel="stylesheet">

    <?php
      #DATEPICKER
      if (isset($datepickerInclude) && ($datepickerInclude = true)) {
    ?>
    <link rel="stylesheet" href="<?=ROOT?>\assets\libs\bootstrap-datepicker\dist\css\bootstrap-datepicker3.min.css">
    <?php };?>

    <?php
      #TIMEPICKER
      if (isset($timepickerInclude) && ($timepickerInclude = true)) {
    ?>
    <link href="<?=ROOT?>\assets\libs\clockpicker\dist\jquery-clockpicker.min.css" rel="stylesheet">
    <?php };?>

    <?php
      #FILE INPUT
      if (isset($fileinputInclude) && ($fileinputInclude = true)) {
    ?>
    <link href="<?=ROOT?>\assets\libs\template\css\fileinput.css" rel="stylesheet">
    <?php };?>
</head>
