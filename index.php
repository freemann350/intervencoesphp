<?php
	$validatejs = true;
	session_start();
	if (isset($_SESSION['usr']) && ($_SESSION['usr'] !== "")) {
		header('Location: Inicial');
	}
	$titulo = "Login";
	$backstretchInclude = True;
	include 'Shared/conn.php';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form
    $usr = mysqli_real_escape_string($con, $_POST['username']);
    $pwd = mysqli_real_escape_string($con, $_POST['password']);

		$stmt = $con->prepare("SELECT * FROM professores");
		$stmt->execute();
		$result = $stmt->get_result();

		$stmt = $con->prepare("SELECT * FROM professores WHERE Username = BINARY ? and Password = BINARY ? AND Ativo = '1'");
		$stmt->bind_param("ss", $usr, $pwd);

		$stmt->execute();

		$result = $stmt->get_result();

    $count = $result->num_rows;

    // If result matched $usr and $pwd, table row must be 1 row
    if($count == 1) {
				if (!session_id())
					session_start();
					$_SESSION['usr'] = $usr;
					$_SESSION['Logged'] = true;

					if(isset($_GET['return_url'])) {
						header('Location: ' . $_GET['return_url']);
					 } else {
					   header('Location: Inicial');
					 };

					 die();
      } else {
         $error = true;
      };
   };
?>
<!DOCTYPE html>
<html lang="pt">

<?php #HEADER INCLUDE
      include 'Shared/Head.php';
?>

<body>
    <section id="container">
            <div class="container">
                <form class="form-login" action="" method = "post" id="loginform">
                    <h2 class="form-login-heading"><b>Intervenções AESM</b></h2>
                    <div class="login-wrap">
											<?php if (isset($error) && ($error=true)) {?>
											  <div class="form-group form-group has-error has-feedback">
													<input type="text" value="<?php if (isset($_POST['username'])) { echo $_POST['username']; } else { echo '';} ?>" class="form-control" placeholder="Utilizador" name="username" autofocus required>
													<br>

                      		<input type="password" class="form-control" placeholder="Palavra-passe" name="password" required>
													<input type="hidden" name="redirurl" value="<? echo $_SERVER['HTTP_REFERER']; ?>">
                            <br>
                            <button class="btn btn-theme btn-block" href="Inicial" type="submit"><i class="fa fa-lock"></i> Entrar</button>
                        </div>
                        <hr>
                        <p style="text-align: center; color: #FF0000"> Utilizador/Palavra-Passe Inválida</p>
											<?php } else {?>
                        <input type="text" class="form-control" placeholder="Utilizador" name="username" autofocus required>
                        <br>
                        <div class="form-group">
                      		<input type="password" class="form-control" placeholder="Palavra-passe" name="password" required>
													<input type="hidden" name="redirurl" value="<? echo $_SERVER['HTTP_REFERER']; ?>">
                            <br>
                            <button class="btn btn-theme btn-block" href="Inicial" type="submit"><i class="fa fa-lock"></i> Entrar</button>
                        </div>
                        <hr>
												<?php };?>
										</div>
                </form>
            </div>
    </section>

    <?php #HEADER INCLUDE
          include 'Shared/Scripts.php';
    ?>

		<script type="text/javascript">
      $("#loginform").validate({
         errorClass: "my-error-class",
         validClass: "my-valid-class",

         messages: {
          'username': "Tem de escrever o nome de utilizador",
					'password': "Tem de preencher a Palavra-Passe"
         }
      });
    </script>
</body>

</html>
