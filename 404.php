<!DOCTYPE html>
<html lang="en">

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
            <section class="wrapper site-min-height" id="wrapping">

                <h3><i class="fa fa-angle-right"></i> 404: Página não existente</h3>

                <div class="row mt">
                    <p style="margin-left:2.5%; font-size: 14px">A página que procura não existe. Irá ser redirecionado para a página inicial.
                    <p style="margin-left:2.5%; font-size: 14px">Caso não aconteça nada,<a href="Inicial.php">Carregue aqui</a>.</p>
                    </p>
                </div>
            </section>
            <!-- /MAIN CONTENT -->

            <footer class="site-footer">
                <div class="text-center">
                    <span>GestiEscola&copy; 2017</span>
                    <a href="#" class="go-top">
                        <i class="fa fa-angle-up"></i>
                    </a>
                    <br>
                    <span><u><a href="feedback.php" class="support">Feedback/Suporte</a></u></span>
                </div>
            </footer>
        </section>
    </section>

    <?php #HEADER INCLUDE
          include 'Shared/Scripts.php'
    ?>
    <script>
    setTimeout(function(){
      window.location = "Index.php";
    }, 2800);
</script>
</body>

</html>
