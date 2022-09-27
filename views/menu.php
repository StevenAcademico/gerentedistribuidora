<!-- Sidebar -->
<link rel="shortcut icon" href="<?php echo constant("url")?>public/img/logo.png"> 
  <title>Distribuciones Y Servicios Generales LAL</title>

<ul class="navbar-nav bg-gray-900 sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo constant('URL')?>main/home">
		<div class="sidebar-brand-icon rotate-n-15">
		</div>
		<div class="sidebar-brand-text mx-3">Distribuciones Y Servicios Generales LAL</div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		Menu
	</div>

	<!-- Nav Item - Pages Collapse Menu -->

	
	<!-- Nav Item - Clientes Collapse Menu 
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#itemCliente" aria-expanded="true" aria-controls="itemCliente">
			<i class="fas fa-fw fa-user"></i>
			<span>Clientes</span>
		</a>
		<div id="itemCliente" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="<?php echo constant('URL')?>cliente/registro">Nuevo</a>
				<a class="collapse-item" href="<?php echo constant('URL')?>cliente">Listado</a>
			</div>
		</div>
	</li>
	-->

	<!-- Nav Item - Pedidos Collapse Menu -->
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#itemPedido" aria-expanded="true" aria-controls="collapseUtilities">
			<i class="fas fa-fw fa-cart-plus"></i>
			<span>Pedidos</span>
		</a>
		<div id="itemPedido" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="<?php echo constant('URL')?>pedido">Confimar Pedido</a>
			</div>
		</div>
	</li>

	<!-- Nav Item - Pagos Collapse Menu -->
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#itemPago" aria-expanded="true" aria-controls="collapseUtilities">
			<i class="fas fa-fw fa-list-alt"></i>
			<span>Compra</span>
		</a>
		<div id="itemPago" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="<?php echo constant('URL')?>compra">Compras</a>
				<a class="collapse-item" href="<?php echo constant('URL')?>compra/registro">Nuevo</a>
				<!--
				<a class="collapse-item" href="<?php echo constant('URL')?>pago/registro">Nuevo</a>
				<a class="collapse-item" href="<?php echo constant('URL')?>pago">Listado</a>
				-->
			</div>
		</div>
	</li>

	<!-- Nav Item - Solicitud Collapse Menu -->
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#itemSolicitud" aria-expanded="true" aria-controls="collapseUtilities">
			<i class="fas fa-fw fa-toilet-paper"></i>
			<span>Solicitud Cotizacion</span>
		</a>
		<div id="itemSolicitud" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
			<a class="collapse-item" href="<?php echo constant('URL')?>solicitud">Cotizaciones</a>
				<a class="collapse-item" href="<?php echo constant('URL')?>solicitud/registro">Nueva solicitud</a>
			</div>
		</div>
	</li>


</ul>