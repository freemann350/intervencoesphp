<?php
  $titulo = "404";
?>
<!DOCTYPE html>
<html lang="pt">

<?php #HEADER INCLUDE
      Include 'Shared/Head.php'
?>

<body>

    <section id="container">
      <?php #HEADER INCLUDE
            include 'Shared/Header-Erros.php'
      ?>

        <!--MAIN CONTENT-->
        <section>
            <section class="wrapper" id="wrapping">

                <h3><i class="fa fa-angle-right"></i> 404: Página não existente</h3>

                <div class="row mt">
                    <p style="margin-left:2.5%; font-size: 14px">A página que procura não existe. Irá ser redirecionado para a página inicial.
                    <p style="margin-left:2.5%; font-size: 14px">Caso não aconteça nada,<a href="Inicial">Carregue aqui</a>.</p>
                    </p>
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
    <script>
    setTimeout(function(){
      window.location = "Inicial";
    }, 2800);
</script>
</body>

</html>
