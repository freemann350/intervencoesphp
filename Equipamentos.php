<?php

  $titulo = "Gerência de Equipamentos";
  $removeInclude = true;
  $EqActive = true;

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  if ($LoggedRole != "1") {
    header("Location: 403");
  }

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
              <br>
              <?php
                if (isset($_GET["msg"])) {
                  if ($_GET["msg"] == "1") {
              ?>
                <div class="alert alert-success"><b>Sucesso!</b> Os dados foram alterados com êxito.</div>
              <?php
                } elseif ($_GET["msg"] == "2") {
              ?>
                <div class="alert alert-danger"><b>Ocorreu um erro.</b> Se tal persistir, contacte um responsável técnico.</div>
              <?php
                };
              };
              ?>

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
                                        <a href="javascript:;" class="deleteRecord" data-id="<?=$row["Id"];?>">
                                          <i title="Eliminar" class="fa fa-times fa-lg" aria-hidden="true"></i>
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
    <script>
    $('.deleteRecord').click(function() {
      let id = $(this).attr("data-id");
      $.confirm({
          title: 'Sair',
          content: 'Tem a certeza que pretende eliminar este registo?',
          buttons: {
              Sim: function() {
                $.ajax({
                  method: "GET",
                  url: "ajax/deleteEquipamento.php?id=" + id,
                  success: function(data) {
                    if (data == "1") {
                      window.location.href = location.href.split('?')[0] + "?msg=1"
                    } else {
                      window.location.href = location.href.split('?')[0] + "?msg=2"
                    }
                  }
                });
              },
              Não: function() {

              },

          }
      });
    });
    </script>
</body>

</html>
