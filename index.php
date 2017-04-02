<?php
	$titulo = "Login";
	$backstretchInclude = True;
	include 'Shared/conn.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form   
      $usr = mysqli_real_escape_string($db,$_POST['username']);
      $pwd = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT * FROM professores WHERE username = '$usr' and passcode = '$pwd'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $usr and $pwd, table row must be 1 row
		
      if($count == 1) {
         session_register("usr");
         $_SESSION['login_user'] = $usr;
         
         header("location: Inicial");
      }else {
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
                        <div class="form-group has-error has-feedback">
                            <input type="password" class="form-control" id="inputError" placeholder="Palavra-passe" name="password">
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
