s<?php
    $titulo = "500";
?>
<!DOCTYPE html>
<html lang="pt">

<?php #HEADER INCLUDE
      include 'Shared/Head.php'
?>

<body>

    <section id="container">
      <?php #HEADER INCLUDE
            include 'Shared/Header-Erros.php'
      ?>

        <!--MAIN CONTENT-->
        <section>
            <section class="wrapper" id="wrapping">

                <h3><i class="fa fa-angle-right"></i> 500: Erro interno</h3>

                <div class="row mt">
                    <p style="margin-left:2.5%; font-size: 14px">Ocorreu um problema da nossa parte, pedimos desculpa. Irá ser redirecionado para a página inicial.
                    <p style="margin-left:2.5%; font-size: 14px">Caso não aconteça nada,<a href="Inicial">Carregue aqui</a>.</p>
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
                    <span><u><a href="feedback" class="support">Feedback/Suporte</a></u></span>
                </div>
            </footer>
        </section>
    </section>

    <?php #FOOTER INCLUDE
      include 'Shared\Footer.php';
    ?>
    <script>
    setTimeout(function(){
      window.location = "Inicial";
    }, 2800);
    </script>
</body>

</html>
