<aside>
    <div id="sidebar" class="nav-collapse">
        <ul class="sidebar-menu" id="nav-accordion">

          <li class="sub-menu">
              <a <?php if (isset($PiActive) && ($PiActive)){?> class="active" <?php };?>href="Inicial">
                  <i class="fa fa-home"></i>
                  <span>Página inicial</span>
              </a>
          </li>

          <li class="sub-menu">
              <a <?php if (isset($PPActive) && ($PPActive)){?> class="active" <?php };?>href="Perfil?Id=<?=$LoggedID?>">
                  <i class="fa fa-user-circle"></i>
                  <span>O meu perfil</span>
              </a>
          </li>

          <?php if ($LoggedRole == "1") { ?>
          <li class="sub-menu">
              <a <?php if ((isset($PuActive) && ($PuActive))){?> class="active" <?php };?>  href="javascript:;">
                  <i class="fa fa-users"></i>
                  <span>Administração</span>
              </a>
              <ul class="sub">
                  <li <?php if (isset($PuActive) && ($PuActive)){?> class="active" <?php };?>><a href="Utilizadores" style="background: transparent;">Utilizadores</a></li>
              </ul>
          </li>
          <?php }?>

          <?php if ($LoggedRole == "1" || $LoggedRole == "2") { ?>
          <li class="sub-menu">
              <a <?php if ((isset($EqActive) && ($EqActive)) || (isset($PTEqActive) && ($PTEqActive))){?> class="active" <?php };?> href="javascript:;">
                  <i class="fa fa-desktop"></i>
                  <span>Equipamentos</span>
              </a>
              <ul class="sub">
                  <li <?php if (isset($PTEqActive) && ($PTEqActive)){?> class="active" <?php };?>><a href="TipoEquipamento" style="background: transparent;">Tipos de Equipamento</a></li>
                  <li <?php if (isset($EqActive) && ($EqActive)){?> class="active" <?php };?>><a href="Equipamentos" style="background: transparent;">Equipamentos</a></li>
              </ul>
          </li>
          <?php } ?>

          <li class="sub-menu">
            <a <?php if ((isset($PrpActive) && ($PrpActive)) || (isset($PmpActive) && ($PmpActive)) || (isset($PcpActive) && ($PcpActive))){?> class="active" <?php };?> href="javascript:;">
                  <i class="fa fa-pencil-square-o"></i>
                  <span>Pedidos</span>
              </a>
              <ul class="sub">
                  <li<?php if (isset($PrpActive) && ($PrpActive)){?> class="active" <?php };?>><a href="RegistarPedido" style="background: transparent;">Registar Pedido</a></li>
                  <li<?php if (isset($PmpActive) && ($PmpActive)){?> class="active" <?php };?>><a href="MeusPedidos" style="background: transparent;">Os Meus Pedidos</a></li>
                  <li<?php if (isset($PcpActive) && ($PcpActive)){?> class="active" <?php };?>><a href="ConsultarPedidos" style="background: transparent;">Consultar Pedidos</a></li>
              </ul>
          </li>

          <li class="sub-menu">
              <a <?php if ((isset($PmiActive) && ($PmiActive)) || (isset($PciActive) && ($PciActive)) || (isset($PrActive) && ($PrActive)) ){?> class="active" <?php };?> href="javascript:;">
                  <i class="fa fa-wrench"></i>
                  <span>Intervenções</span>
              </a>
              <ul class="sub">
                <?php if (($LoggedRole == "1") || ($LoggedRole == "2")) { ?>
                  <li <?php if (isset($PrActive) && ($PrActive)){?> class="active" <?php };?>><a href="ResolverPedidos" style="background: transparent;">Resolver Pedidos</a></li>
                  <li <?php if (isset($PmiActive) && ($PmiActive)){?> class="active" <?php };?>><a href="MinhasIntervencoes" style="background: transparent;">As Minhas Intervenções</a></li>
              <?php };?>
                  <li <?php if (isset($PciActive) && ($PciActive)){?> class="active" <?php };?>><a href="ConsultarIntervencoes" style="background: transparent;">Consultar Intervenções</a></li>
              </ul>
          </li>
        </ul>

        <ul class="sidebar-menu" id="logoutbtn">
            <li class="sub-menu">
                <a id="logout" style="cursor: pointer;">
                    <i class="fa fa-sign-out"></i>
                    <span>Sair</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
