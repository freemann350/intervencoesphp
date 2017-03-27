<?php
$titulo = "Login";
$backstretchInclude = True;
?>
<!DOCTYPE html>
<html lang="en">

<?php #HEADER INCLUDE
      include 'Shared/Head.php'
?>

<body>
    <section id="container">
            <div class="container">
                <form class="form-login" action="Inicial">
                    <h2 class="form-login-heading">Intervenções AESM</h2>
                    <div class="login-wrap">
                        <input type="text" class="form-control" placeholder="Utilizador" autofocus>
                        <br>
                        <div class="form-group has-error has-feedback">
                            <input type="password" class="form-control" id="inputError" placeholder="Palavra-passe">
                            <br>
                            <button class="btn btn-theme btn-block" href="Inicial" type="submit"><i class="fa fa-lock"></i> Entrar</button>
                        </div>
                        <hr>
                        <p style="text-align: center; color: #FF0000">Utilizador/Palavra-Passe inválida</p>
                    </div>
                </form>
            </div>
    </section>

    <?php #HEADER INCLUDE
          include 'Shared/Scripts.php'
    ?>
</body>

</html>
