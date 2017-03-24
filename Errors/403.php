<!DOCTYPE html>
<html lang="en">

<?php #HEADER INCLUDE
      include '/intervencoesphp/Shared/Head.php'
?>

<body>

    <section id="container">
      <?php #HEADER INCLUDE
            include '/intervencoesphp/Shared/Header-Erros.php'
      ?>

        <!--MAIN CONTENT-->
        <section id="">
            <section class="wrapper site-min-height" id="wrapping">

                <h3><i class="fa fa-angle-right"></i> 403: Acesso Negado</h3>

                <div class="row mt">
                    <p style="margin-left:2.5%; font-size: 14px">Você não tem acesso a esta página.
                        <br><a href="index.php">Voltar à página inicial.</a>
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
          include '/intervencoesphp/Shared/Scripts.php'
    ?>

</body>

</html>
