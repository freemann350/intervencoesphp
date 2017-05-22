<?php
  $titulo = "Gestão de Equipamentos";
  $removeInclude = true;
  $filtrosInclude =  true;
  $EqActive = true;

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  if ($LoggedRole != "1") {
    header("Location: 403");
  }

  if (isset($_POST['filtros_equipamentos_submit'])) {
    $Nome = "%" . $_POST["Equipamento"] . "%";

    $stmt = $con->prepare("SELECT * FROM equipamentos WHERE Nome Like ?");

    $stmt->bind_param("s", $Nome);
    $stmt->execute();

    $result = $stmt->get_result();
  } else {
    $stmt = $con->prepare("SELECT * FROM equipamentos");

    $stmt->execute();

    $result = $stmt->get_result();
  }
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
              <?php
                if (isset($_GET["msg"])) {
                  if ($_GET["msg"] == "1") {
              ?>
                <div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Sucesso!</b> Os dados foram alterados com êxito.</div>
              <?php
                } elseif ($_GET["msg"] == "2") {
              ?>
                <div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Ocorreu um erro.</b> Se tal persistir, contacte um responsável técnico.</div>
              <?php
                };
              };
              ?>

                <h3><i class="fa fa-angle-right"></i> Gestão de equipamentos</h3>

                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                          <div class="col-lg-12" id="filtrosheader" style="min-width: 620px;">
                                <span class="float-xs-left" id="filtrostext">Filtros</span>
                                <span class="float-xs-right" id="filtrosdown"><i>(Carregue nesta barra para filtrar a informação)</i>&nbsp;&nbsp; <i class="fa fa-caret-down" id="caret-spin"></i></span>
                            </div>

                            <div class="col-lg-12" id="filtrosdiv" style="display: none; min-width: 620px;">
                              <form class="form-horizontal style-form" method="post">
                                <br>
                                <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por nome de equipamento</h4>
                                <div style="margin-left:10px;">
                                  <input type="text" class="form-control" name="Equipamento" placeholder="Escreva aqui o nome do equipamento..." value="<?php if (Isset($_POST['Equipamento'])) { echo $_POST['Equipamento'];};?>">
                                  <br>
                                  <input type="submit" class="btn btn-primary" name="filtros_equipamentos_submit" value="Procurar">
                                </div>
                              </form>
                              <hr>
                            </div>
                          <br><br><br>
                          <a href="NovoEquipamento">+ Registar novo Equipamento</a>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    if ($result->num_rows != 0) {
                                    while ($row = $result->fetch_assoc()) {
                                  ?>
                                    <tr>
                                      <td><?= $row["Nome"] ?></td>
                                      <td>
                                        <a href="EditarEquipamento?Id=<?=$row['Id'];?>">
                                          <i title="Editar Utilizador" class="fa fa-pencil fa-lg" aria-hidden="true"></i>
                                        </a>
                                        <a href="javascript:;" class="deleteRecord" data-id="<?=$row['Id'];?>">
                                          <i title="Eliminar" class="fa fa-times fa-lg" aria-hidden="true"></i>
                                        </a>
                                      </td>
                                    </tr>
                                  <?php }} else { ?>
                                    <tr>
                                        <td><?php echo 'Não foram encontrados nenhuns dados.'?></td>
                                        <td>&nbsp;N/D </td>
                                    </tr>
                                  <?php };?>
                                </tbody>
                            </table>
                            <?php
                              if (isset($_POST['filtros_equipamentos_submit'])) {

                                $stmt = $con->prepare("SELECT count(*) AS TotalDados FROM equipamentos WHERE Nome Like ?");

                                $stmt->bind_param("s", $Nome);
                                $stmt->execute();

                                $result = $stmt->get_result();

                                $row = $result->fetch_assoc();

                                echo "Total de dados: " . $row['TotalDados']."<br><br>";

                              } else {
                                $stmt = $con->prepare("SELECT count(*) AS TotalDados FROM equipamentos");

                                $stmt->execute();

                                $result = $stmt->get_result();

                                $row = $result->fetch_assoc();
                                echo "Total de dados: " . $row['TotalDados'] ."<br><br>";
                              }
                            ?>
                            <a href="NovoEquipamento">+ Registar novo Equipamento</a>
                            <br>
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
