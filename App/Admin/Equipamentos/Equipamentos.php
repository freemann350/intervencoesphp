<?php
  $titulo = "Gerência de Equipamentos";
  $removeInclude = true;
  $EqActive = true;

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  $stmt = $con->prepare("SELECT * FROM equipamentos");

  $stmt->execute();

  $result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="pt">

<?php #HEADER INCLUDE
      include 'Shared/Head.php'
?>

<body>

    <section id="container">
      <?php #HEADER INCLUDE
            include 'Shared/Header.php'
      ?>

      <?php #SIDEBAR INCLUDE
            include 'Shared/Sidebar.php'
      ?>

        <!--MAIN CONTENT-->
        <section id="main-content">
            <section class="wrapper site-min-height" id="wrapping">

                <h3><i class="fa fa-angle-right"></i> Gestão de utilizadores</h3>

                <div class="row mt">
                    <br><br>
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    while ($row = $result->fetch_assoc()) {
                                  ?>
                                    <tr>
                                      <td><?= $row["Nome"] ?></td>
                                      <td>
                                        <a href="EditarUtilizador">
                                          <i title="Editar Utilizador" class="fa fa-pencil fa-lg" aria-hidden="true"></i>
                                        </a>                        
                                        <a href="#">
                                          <i title="Eliminar" class="fa fa-times fa-lg deleteRecord" aria-hidden="true"></i>
                                        </a>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </section>
        </section>
        <!-- /MAIN CONTENT -->

        <?php #FOOTER INCLUDE
          include 'Shared\Footer.php';
        ?>
    </section>

    <?php #HEADER INCLUDE
          include 'Shared/Scripts.php'
    ?>
</body>

</html>
