<?php
  $titulo = "Gestão de Utilizadores";
  $removeInclude = true;
  $filtrosInclude = true;
  $PuActive = true;

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';

  if ($LoggedRole != "1") {
    header("Location: 403");
  }

  if (isset($_POST['filtros_utilizadores_submit']) && ($_POST['Tipo'] > '1')) {
    $Tipo = $_POST['Tipo'];
    $Nome = "%" . $_POST['Nome'] . "%";

    $stmt = $con->prepare("SELECT concat_ws(' ', nome, apelido) nome, email, Ativo, professores.Id, professores.IdRole, roles.role FROM professores inner join roles on professores.idrole = roles.id WHERE Nome LIKE ? AND professores.IdRole LIKE ? AND Not professores.Id = " . $LoggedID);

    $stmt->bind_param("ss", $Nome, $Tipo);
    $stmt->execute();

    $result = $stmt->get_result();
  } else {
    $stmt = $con->prepare("SELECT concat_ws(' ', nome, apelido) nome, email, Ativo, professores.Id, professores.IdRole, roles.role FROM professores inner join roles on professores.idrole = roles.id WHERE Not professores.Id = " . $LoggedID /*. " AND ativo = 1"*/);

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
            <section class="wrapper site-min-height">
              <?php
                if (isset($_GET["msg"])) {
                  if ($_GET["msg"] == "1") {
              ?>
                <br>
                <div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Sucesso!</b> Os dados foram alterados com êxito.</div>
              <?php
                } elseif ($_GET["msg"] == "2") {
              ?>
                <br>
                <div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Ocorreu um erro.</b> Se tal persistir, contacte um responsável técnico.</div>
              <?php
                };
              };
              ?>
                <h3><i class="fa fa-angle-right"></i> Gestão de utilizadores</h3>

                <div class="row mt">
                    <div class="col-lg-12" >
                        <div class="form-panel" style="overflow: auto;">
                            <div class="col-lg-12" id="filtrosheader" style="min-width: 620px;">
                                <span class="float-xs-left" id="filtrostext">Filtros</span>
                                <span class="float-xs-right" id="filtrosdown"><i>(Carregue nesta barra para filtrar a informação)</i>&nbsp;&nbsp; <i class="fa fa-caret-down" id="caret-spin"></i></span>
                            </div>

                            <div class="col-lg-12" id="filtrosdiv" style="display: none; min-width: 620px;">
                                <br>
                                <form class="form-horizontal style-form" method="post">
                                    <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por tipo de utilizador</h4>
                                      <div style="margin-left:10px;">
                                        <select class="form-control" name="Tipo">
                                          <option selected hidden value="">Escolha o tipo de utilizador...</option>
                                            <?php
                                              $stmt1 = $con->prepare("SELECT * FROM roles");

                                              $stmt1->execute();
                                              $result1 = $stmt1->get_result();

                                              while ($roles = $result1->fetch_assoc()) {
                                            ?>
                                            <option value="<?= $roles['Id'] ?>"><?=$roles["Role"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <br>

                                    <br>
                                    <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por professor</h4>
                                    <div style="margin-left:10px;">
                                      <input type="text" class="form-control" name="Nome" placeholder="Escreva aqui o nome do professor..." value="<?php if(isset($_POST['Nome'])) { echo $_POST['Nome'];}?>">
                                    </div>
                                    <br>

                                    <br>
                                    <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por estado de ativo</h4>
                                    <div style="margin-left:10px;">
                                      <label class="radio-inline">
                                        <input type="radio" name="Ativo" class="radio-inline" value="1">
                                        <p style="cursor: pointer;" class="unselectable">Sim</p>
                                      </label>
                                      <label class="radio-inline">
                                        <input type="radio" name="Ativo" class="radio-inline" value="0">
                                        <p style="cursor: pointer;" class="unselectable">Não</p>
                                      </label>
                                      <label class="radio-inline">
                                        <input type="radio" name="Ativo" class="radio-inline" value="" checked>
                                        <p style="cursor: pointer;" class="unselectable">Ambos</p>
                                      </label><br><br>
                                      <input type="submit" class="btn btn-primary" name="filtros_utilizadores_submit" value="Procurar">
                                    </div>
                                </form>
                                <hr>
                            </div>

                            <br><br><br>
                            <a href="NovoUtilizador">+ Registar novo Utilizador</a>
                            <table class="table table-hover nav-collapse" style="min-width: 600px; table-layout:fixed; overflow: auto;" id="OrderTableToggle">
                                <thead>
                                    <tr>
                                      <th>Ativo</th>
                                      <th>Nome</th>
                                      <th>Tipo de utilizador</th>
                                      <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    if ($result->num_rows != 0) {
                                    while ($row = $result->fetch_assoc()) {
                                  ?>
                                    <tr>
                                      <td><?php if ($row['Ativo'] == "1"){ echo "<i style='color: #60D439; cursor: help' title='O utilizador encontra-se ativo' class='fa fa-check fa-lg' aria-hidden='true'></i>";} else { echo "<i style='color: #E8434E;cursor: help' title='O utilizador encontra-se inativo' class='fa fa-times fa-lg' aria-hidden='true'></i>"; }?></td>
                                      <td><a href="Perfil?Id=<?=$row['Id']?>"><?= $row["nome"] ?></a></td>
                                      <td><?= $row["role"] ?></td>
                                      <td>
                                        <a href="EditarUtilizador?Id=<?=$row['Id']?>">
                                          <i title="Editar Utilizador" class="fa fa-pencil fa-lg" aria-hidden="true"></i>
                                        </a>
                                        <a href="Perfil?Id=<?=$row['Id']?>">
                                          <i title="Ver Perfil de Utilizador" class="fa fa-eye fa-lg" aria-hidden="true"></i>
                                        </a>
                                        <?php if ($row['Ativo'] == '1') {?>
                                        <a href="javascript:;" class="deleteRecord" data-id="<?=$row['Id'];?>">
                                          <i style="color: #60D439" title="Inativar Utilizador" class="fa fa-check fa-lg" aria-hidden="true"></i>
                                        </a>
                                      <?php } else {?>
                                        <a href="javascript:;" class="activateRecord" data-id="<?=$row['Id'];?>">
                                          <i style="color: #E8434E" title="Ativar Utilizador" class="fa fa-times fa-lg" aria-hidden="true"></i>
                                        </a>
                                      <?php };?>
                                    </tr>
                                  <?php }} else { ?>
                                    <tr>
                                      <td><?php echo 'Não foram encontrados nenhuns dados.'?></td>
                                      <td>&nbsp;N/D </td>
                                      <td>&nbsp;N/D </td>
                                      <td>&nbsp;N/D </td>
                                    </tr>
                                    <?php };?>
                                </tbody>
                            </table>
                            <?php
                              if (isset($_POST['filtros_utilizadores_submit'])) {

                                $stmt = $con->prepare("SELECT count(*) AS TotalDados FROM professores INNER JOIN roles ON professores.IdRole = roles.Id WHERE Nome LIKE ? AND professores.IdRole = ? AND Not professores.Id = " . $LoggedID);

                                $stmt->bind_param("ss", $Nome, $Tipo);
                                $stmt->execute();

                                $result = $stmt->get_result();

                                $row = $result->fetch_assoc();

                                echo "Total de dados: " . $row['TotalDados']."<br><br>";

                              } else {
                                $stmt = $con->prepare("SELECT count(*) AS TotalDados FROM professores");

                                $stmt->execute();

                                $result = $stmt->get_result();

                                $row = $result->fetch_assoc();
                                echo "Total de dados: " . $row['TotalDados'] ."<br><br>";
                              }
                            ?>
                            <a href="NovoUtilizador">+ Registar novo Utilizador</a>
                            <br>
                        </div>
                    </div>
                </div>

            </section>
        </section>
        <div style="padding-bottom: 30px;"></div>
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
          content: 'Tem a certeza que pretende inativar este utilizador?<br><br> Poderá voltar a ativá-lo ao editar o utilizador.',
          buttons: {
              Sim: function() {
                $.ajax({
                  method: "GET",
                  url: "ajax/inativarUtilizador.php?id=" + id,
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

    <script>
    $('.activateRecord').click(function() {
      let id = $(this).attr("data-id");
      $.confirm({
          title: 'Sair',
          content: 'Tem a certeza que pretende inativar este utilizador?<br><br> Poderá voltar a ativá-lo ao editar o utilizador.',
          buttons: {
              Sim: function() {
                $.ajax({
                  method: "GET",
                  url: "ajax/inativarUtilizador.php?id=" + id,
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