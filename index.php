<?php
session_start();
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
    //$active = $row['active'];

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
         $error = "Utilizador/Palavra-Passe errada";
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
                    <h2 class="form-login-heading">Intervenções AESM</h2>
                    <div class="login-wrap">
                        <input type="text" class="form-control" placeholder="Utilizador" name="username" autofocus>
                        <br>
                        <div class="form-group">
                      		<input type="password" class="form-control" placeholder="Palavra-passe" name="password">
													<input type="hidden" name="redirurl" value="<? echo $_SERVER['HTTP_REFERER']; ?>">
                            <br>
                            <button class="btn btn-theme btn-block" href="Inicial" type="submit"><i class="fa fa-lock"></i> Entrar</button>
                        </div>
                        <hr>
                        <p style="text-align: center; color: #FF0000">
                        <?php if (isset($error)) { echo $error; };?></p>
                    </div>
                </form>
            </div>
    </section>

    <?php #HEADER INCLUDE
          include 'Shared/Scripts.php';
    ?>
</body>

</html>
