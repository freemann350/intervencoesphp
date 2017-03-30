<aside>
    <div id="sidebar" class="nav-collapse">
        <ul class="sidebar-menu" id="nav-accordion">

          <a href="VerPerfil"><p class="centered"><img src="assets/img/user/ui-sam.jpg" class="img-circle" width="60"></p>
          <h5 class="centered">Admin</h5></a>

          <li class="mt">
              <a <?php if (isset($PiActive) && ($PiActive = true)){?> class="active" <?php };?>href="Inicial">
                  <i class="fa fa-home"></i>
                  <span>Página inicial</span>
              </a>
          </li>

          <li class="sub-menu">
              <a <?php if (isset($PuActive) && ($PuActive = true)){?> class="active" <?php };?>  href="javascript:;">
                  <i class="fa fa-user"></i>
                  <span>Administração</span>
              </a>
              <ul class="sub">
                  <li <?php if (isset($PuActive) && ($PuActive = true)){?> class="active" <?php };?>><a href="Utilizadores" style="background: transparent;">Utilizadores</a></li>
              </ul>
          </li>

            <li class="sub-menu">
                <a <?php if ((isset($PrpActive) && ($PrpActive = true)) || (isset($PmpActive) && ($PmpActive = true)) || (isset($PcpActive) && ($PcpActive = true))){?> class="active" <?php };?> href="javascript:;">
                    <i class="fa fa-pencil-square-o"></i>
                    <span>Pedidos</span>
                </a>
                <ul class="sub">
                    <li<?php if (isset($PrpActive) && ($PrpActive = true)){?> class="active" <?php };?>><a href="RegistarPedido" style="background: transparent;">Registar Pedido</a></li>
                    <li<?php if (isset($PmpActive) && ($PmpActive = true)){?> class="active" <?php };?>><a href="MeusPedidos" style="background: transparent;">Os Meus Pedidos</a></li>
                    <li<?php if (isset($PcpActive) && ($PcpActive = true)){?> class="active" <?php };?>><a href="ConsultarPedidos" style="background: transparent;">Consultar Pedidos</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a <?php if ((isset($PmiActive) && ($PmiActive = true)) || (isset($PciActive) && ($PciActive = true)) || (isset($PrActive) && ($PrActive = true)) ){?> class="active" <?php };?> href="javascript:;">
                    <i class="fa fa-wrench"></i>
                    <span>Intervenções</span>
                </a>
                <ul class="sub">
                    <!--<li><a href="RegistarIntervencao" style="background: transparent;">Intervenções</a></li>-->
                    <li <?php if (isset($PrActive) && ($PrActive = true)){?> class="active" <?php };?>><a href="ResolverPedidos" style="background: transparent;">Resolver Pedidos</a></li>
                    <li <?php if (isset($PmiActive) && ($PmiActive = true)){?> class="active" <?php };?>><a href="MinhasIntervencoes" style="background: transparent;">As Minhas Intervenções</a></li>
                    <li <?php if (isset($PciActive) && ($PciActive = true)){?> class="active" <?php };?>><a href="ConsultarIntervencoes" style="background: transparent;">Consultar Intervenções</a></li>
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
