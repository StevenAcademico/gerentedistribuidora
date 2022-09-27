<?php require "views/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Clientes</h1>
		<a href="#" class="btn btn-primary">Nuevo</a>
	</div>

	<div class="row">
        <?php if($this->mensaje != ''):?>
            <div class="alert alert-primary" role="alert">
              <?php echo $this->mensaje;?>
            </div>
        <?php endif;?>
		<div class="col-lg-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table">
					<thead class="thead-dark">
						<tr>
							<th>RUC</th>
							<th>NOMBRE</th>
							<th>CELULAR</th>
							<th>DIRECCIÓN</th>
                            <th>CORREO</th>
							<?php if ($_SESSION['rol'] == 2) { ?>
							<th>ACCIONES</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
                        <?php foreach($this->clientes as $row): ?>
                            <?php 
								$cliente = new Cliente();
								$cliente= $row;	
							?>
                            <tr>
                                <td><?= $cliente->ruc;?></td>
                                <td><?= $cliente->nombre;?></td>
                                <td><?= $cliente->celular;?></td>
                                <td><?= $cliente->direccion;?></td>
                                <td><?= $cliente->correo;?></td>
                                <?php if ($_SESSION['rol'] == 2) { ?>
                                    <td>
                                        <a href="#" class="btn btn-success"><i class='fas fa-edit'></i></a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php endforeach;?>
					</tbody>

				</table>
			</div>

		</div>
	</div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php require "views/footer.php"; ?>