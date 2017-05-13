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

$stmt = $con->prepare("SELECT concat_ws(' ', nome, apelido) nome, email, Ativo, professores.Id, roles.role FROM professores inner join roles on professores.idrole = roles.id WHERE Not professores.Id = " . $LoggedID /*. " AND ativo = 1"*/);

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
            <section class="wrapper site-min-height">
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
                <h3><i class="fa fa-angle-right"></i> Gestão de utilizadores</h3>

                <div class="row mt">
                    <br><br>
                    <div class="col-lg-12">
                        <div class="form-panel" style="min-width: 620px; table-layout:fixed;">
                            <div class="col-lg-12" id="filtrosheader">
                                <span class="float-xs-left" id="filtrostext">Filtros</span>
                                <span class="float-xs-right" id="filtrosdown"><i class="fa fa-caret-down"></i></span>
                            </div>

                            <div class="col-lg-12" id="filtrosdiv" style="display: none;">
                                <br>
                                <form>

                                    <br>
                                    <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por tipo de utilizador</h4>
                                    <div class="form-group">
                                        <div class="form-group">
                                        <select class="form-control">
                                        <option selected disabled hidden>Escolha um tipo de utilizador...</option>
                                        <option>Admin</option>
                                        <option>Técnico</option>
                                        <option>Professor</option>
                                      </select>
                                      </div>
                                    </div>
                                    <br>

                                    <br>
                                    <h4 class="mb"><i class="fa fa-angle-right"></i> Consultar por professor</h4>
                                    <div class="form-group">
                                      <input type="text" class="form-control" placeholder="Escreva aqui o nome do professor...">
                                    </div>
                                    <br>
                                    <input type="submit" class="btn btn-primary" value="Procurar">
                                </form>
                                <hr>
                            </div>

                            <br><br><br>
                            <a href="NovoUtilizador" style="float: right;">+ Registar novo Utilizador</a>
                            <table class="table table-hover" style="min-width: 600px; table-layout:fixed; overflow: hidden;">
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
                                      <td><?php if ($row['Ativo'] == "1"){ echo "Sim";} else { echo "Não"; }?></td>
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
                                          <i title="Inativar Utilizador" class="fa fa-times fa-lg" aria-hidden="true"></i>
                                        </a>
                                      <?php } else {?>
                                          <i title="O utilizador já está inativo." id="disabledDelete" class="fa fa-times fa-lg" aria-hidden="true"></i>
                                      <?php };?>
                                    </tr>
                                  <?php }} else { ?>
                                    <tr>
                                      <td><?php echo 'Não foram encontrados nenhuns dados.'?></td>
                                      <td>&nbsp;N/D </td>
                                      <td>&nbsp;N/D </td>
                                    </tr>
                                    <?php };?>
                                </tbody>
                            </table>
                            <a href="NovoUtilizador" style="float: right;">+ Registar novo Utilizador</a>
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
          content: 'Tem a certeza que pretende inativar este utilizador?<br><br> Poderá voltar a ativá-lo ao editar o utilizador.',
          buttons: {
              Sim: function() {
                $.ajax({
                  method: "GET",
                  url: "ajax/deleteUtilizador.php?id=" + id,
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
