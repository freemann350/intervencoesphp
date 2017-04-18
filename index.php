<?php
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

		$stmt = $con->prepare("SELECT * FROM professores WHERE Username = ? and Password = ?");
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
                <form class="form-login" action="" method = "post">
                    <h2 class="form-login-heading"><b>Intervenções AESM</b></h2>
                    <div class="login-wrap">
											<?php if (isset($error) && ($error=true)) {?>
											  <div class="form-group form-group has-error has-feedback">
													<input type="text" class="form-control" placeholder="Utilizador" name="username" autofocus>
													<br>

                      		<input type="password" class="form-control" placeholder="Palavra-passe" name="password">
													<input type="hidden" name="redirurl" value="<? echo $_SERVER['HTTP_REFERER']; ?>">
                            <br>
                            <button class="btn btn-theme btn-block" href="Inicial" type="submit"><i class="fa fa-lock"></i> Entrar</button>
                        </div>
                        <hr>
                        <p style="text-align: center; color: #FF0000"> Utilizador/Palavra-Passe Inválida</p>
											<?php } else {?>
                        <input type="text" class="form-control" placeholder="Utilizador" name="username" autofocus>
                        <br>
                        <div class="form-group">
                      		<input type="password" class="form-control" placeholder="Palavra-passe" name="password">
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
</body>

</html>
