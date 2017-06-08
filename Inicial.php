<?php
  $titulo = "Página Inicial";
  $PiActive = true;

  require 'Shared/conn.php';
  require 'Shared/Restrict.php';
?>
<!DOCTYPE html>
<html lang="pt">

<?php #HEADER INCLUDE
      include 'Shared/Head.php'
?>

<?php
    #Bloco A - Total de intervenções
    $stmtBlA = $con->prepare("SELECT count(*) AS Total FROM intervencoes INNER JOIN pedidos ON intervencoes.IdPedido = pedidos.Id INNER JOIN salas ON pedidos.IdSala = salas.Id WHERE salas.IdBloco = 1");

    $stmtBlA->execute();

    $resultBlA = $stmtBlA->get_result();

    $rowBlA = $resultBlA->fetch_assoc();

    #Bloco B - Total de intervenções
    $stmtBlB = $con->prepare("SELECT count(*) AS Total FROM intervencoes INNER JOIN pedidos ON intervencoes.IdPedido = pedidos.Id INNER JOIN salas ON pedidos.IdSala = salas.Id WHERE salas.IdBloco = 2");

    $stmtBlB->execute();

    $resultBlB = $stmtBlB->get_result();

    $rowBlB = $resultBlB->fetch_assoc();

    #Bloco C - Total de intervenções
    $stmtBlC = $con->prepare("SELECT count(*) AS Total FROM intervencoes INNER JOIN pedidos ON intervencoes.IdPedido = pedidos.Id INNER JOIN salas ON pedidos.IdSala = salas.Id WHERE salas.IdBloco = 3");

    $stmtBlC->execute();

    $resultBlC = $stmtBlC->get_result();

    $rowBlC = $resultBlC->fetch_assoc();

    #Bloco D - Total de intervenções
    $stmtBlD = $con->prepare("SELECT count(*) AS Total FROM intervencoes INNER JOIN pedidos ON intervencoes.IdPedido = pedidos.Id INNER JOIN salas ON pedidos.IdSala = salas.Id WHERE salas.IdBloco = 4");

    $stmtBlD->execute();

    $resultBlD = $stmtBlD->get_result();

    $rowBlD = $resultBlD->fetch_assoc();

    #Bloco E - Total de intervenções
    $stmtBlE = $con->prepare("SELECT count(*) AS Total FROM intervencoes INNER JOIN pedidos ON intervencoes.IdPedido = pedidos.Id INNER JOIN salas ON pedidos.IdSala = salas.Id WHERE salas.IdBloco = 5");

    $stmtBlE->execute();

    $resultBlE = $stmtBlE->get_result();

    $rowBlE = $resultBlE->fetch_assoc();

    #Computador - Total de intervenções
    $stmtPC = $con->prepare("SELECT count(*) AS Total FROM intervencoes INNER JOIN pedidos ON intervencoes.IdPedido = pedidos.Id WHERE pedidos.IdEquipamento = 1");

    $stmtPC->execute();

    $resultPC = $stmtPC->get_result();

    $rowPC = $resultPC->fetch_assoc();

    #Projetor - Total de intervenções
    $stmtPJ = $con->prepare("SELECT count(*) AS Total FROM intervencoes INNER JOIN pedidos ON intervencoes.IdPedido = pedidos.Id WHERE pedidos.IdEquipamento = 2");

    $stmtPJ->execute();

    $resultPJ = $stmtPJ->get_result();

    $rowPJ = $resultPJ->fetch_assoc();

    #Quadro interativo - Total de intervenções
    $stmtQI = $con->prepare("SELECT count(*) AS Total FROM intervencoes INNER JOIN pedidos ON intervencoes.IdPedido = pedidos.Id WHERE pedidos.IdEquipamento = 3");

    $stmtQI->execute();

    $resultQI = $stmtQI->get_result();

    $rowQI = $resultQI->fetch_assoc();


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
            <section class="wrapper" id="wrapping">

                <h3><i class="fa fa-angle-right"></i> Página inicial</h3>

                <div class="row mt">

                    <div class="col-md-2 col-sm-6 col-md-offset-1 box0">
                        <div class="box1">
                            <span class="unselectable">A</span>
                            <h3><?=$rowBlA['Total']?></h3>
                        </div>
                        <p class="unselectable">Total de intervenções feitas no Bloco A</p>
                    </div>

                    <div class="col-md-2 col-sm-6 box0">
                        <div class="box1">
                            <span class="unselectable">B</span>
                            <h3><?=$rowBlB['Total']?></h3>
                        </div>
                        <p class="unselectable">Total de intervenções feitas no Bloco B</p>
                    </div>

                    <div class="col-md-2 col-sm-6 box0">
                        <div class="box1">
                            <span class="unselectable">C</span>
                            <h3><?=$rowBlC['Total']?></h3>
                        </div>
                        <p class="unselectable">Total de intervenções feitas no Bloco C</p>
                    </div>

                    <div class="col-md-2 col-sm-6 box0">
                        <div class="box1">
                            <span class="unselectable">D</span>
                            <h3><?=$rowBlD['Total']?></h3>
                        </div>
                        <p class="unselectable">Total de intervenções feitas no Bloco D</p>
                    </div>

                    <div class="col-md-2 col-sm-12 box0">
                        <div class="box1">
                            <span class="unselectable">E</span>
                            <h3><?=$rowBlE['Total']?></h3>
                        </div>
                        <p class="unselectable">Total de intervenções feitas no Bloco E</p>
                    </div>
                </div>

                <div class="row mt">
                    <div class="col-md-2 col-sm-6 col-md-offset-2 box0">
                        <div class="box1">
                            <img class="imagesIndex" src="assets/img/Items/pc.png" height="160" width="130" style='max-width: 110%; max-height: 110%' draggable='false' ondragstart="return false;">
                            <h3><?=$rowPC['Total']?></h3>
                        </div>
                        <p class="unselectable">Total de intervenções feitas em Computadores</p>
                    </div>

                    <div class="col-md-1 col-sm-1"></div>

                    <div class="col-md-2 col-sm-6 box0 ">
                        <div class="box1">
                            <img class="imagesIndex" src="assets/img/Items/projetor.png" height="160" width="150" style='max-width: 110%; max-height: 110%' draggable='false' ondragstart="return false;">
                            <h3><?=$rowPJ['Total']?></h3>
                        </div>
                        <p class="unselectable">Total de intervenções feitas em Projetores</p>
                    </div>

                    <div class="col-md-1 col-sm-1"></div>

                    <div class="col-md-2 col-sm-12 box0 ">
                        <div class="box1">
                            <img class="imagesIndex" src="assets/img/Items/qi.png" height="160" width="160" style='max-width: 110%; max-height: 110%' draggable='false' ondragstart="return false;">
                            <h3><?=$rowQI['Total']?></h3>
                        </div>
                        <p class="unselectable" style="margin-bottom:7%">Total de intervenções feitas em Quadros Interativos</p>
                    </div>
                </div>

                <div class="row mt">
                  <div class="col-sm-3" style="margin-bottom: 2%">
                		<div class="darkblue-panel pn">
                			<div class="darkblue-header">
						  		      <h5>Equipamento com mais pedidos</h5>
                			</div>
                      <div class="centered">
                        <h3 class="darkblue-panel-p">NOME DO UTILIZADOR</h3>
                      </div>
                        <p class="darkblue-panel-p"><i class="fa fa-pencil"></i> 122</p>
                      </div>
                		</div>

                <div class="col-sm-3" style="margin-bottom: 2%">
              		<div class="darkblue-panel pn">
              			<div class="darkblue-header">
					  		      <h5>Utilizador com mais intervenções</h5>
              			</div>
                    <div class="centered">
                      <h3 class="darkblue-panel-p">Francisco Caneira</h3>
                    </div>
                      <p class="darkblue-panel-p"><i class="fa fa-pencil"></i> 122</p>
                    </div>
              		</div>

                  <div class="col-sm-3" style="margin-bottom: 2%">
                		<div class="darkblue-panel pn">
                			<div class="darkblue-header">
						  		      <h5>Bloco com mais pedidos</h5>
                			</div>
                      <div class="centered">
                        <h3 class="darkblue-panel-p">Bloco B</h3>
                      </div>
                        <p class="darkblue-panel-p"><i class="fa fa-pencil"></i> 122</p>
                      </div>
                		</div>

                    <div class="col-sm-3" style="margin-bottom: 2%">
                  		<div class="darkblue-panel pn">
                  			<div class="darkblue-header">
  						  		      <h5>Equipamento com mais intervenções</h5>
                  			</div>
                        <div class="centered">
                        <h3 class="darkblue-panel-p">NOME DO UTILIZADOR</h3>
                      </div>
                        <p class="darkblue-panel-p"><i class="fa fa-pencil"></i> 122</p>
                      </div>
                		</div>
            	   </div>
              </section>
            <!-- /MAIN CONTENT -->

            <?php #FOOTER INCLUDE
              include 'Shared\Footer.php';
            ?>
          </section>
        </section>

    <?php
      include 'Shared/Scripts.php';
    ?>
</body>

</html>
