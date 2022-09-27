<?php require "views/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Compras</h1>
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
							<th>CODIGO</th>
							<th>EMISION</th>
							<th>PROVEEDOR</th>
                            <th>VER</th>
						</tr>
					</thead>
					<tbody>
                        <?php foreach($this->compras as $row): ?>
                            <tr>
                                <td><?= $row['CodCompra'];?></td>
                                <td><?= $row['Emision'];?></td>
                                <td><?= $row['Proveedor'];?></td>
                                <td><a href="<?php echo constant("URL")?>compra/generarPDF/<?= $row['CodCompra'];?>" target="black">PDF</a></td>
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