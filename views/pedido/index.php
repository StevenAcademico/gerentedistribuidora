<?php require "views/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Confirmar pedidos</h1>
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
							<th>NUMERO</th>
							<th>FECHA EMISIÓN</th>
							<th>FECHA ENTREGA</th>
							<th>CLIENTE</th>
                            <th>IMPORTE TOTAL</th>
                            <th style="display: none;">Estado</th>
							<?php if ($_SESSION['rol'] == 2) { ?>
							<th>ACCIONES</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
                        <?php foreach($this->pedidos as $row): ?>
                            <?php 
								$pedidos = new Pedido();
								$pedidos= $row;	
							?>
                            <tr>
                                <td><?= $pedidos->numero;?></td>
                                <td><?= date("d/m/Y", strtotime($pedidos->fecha));?></td>
                                <td><?= date("d/m/Y", strtotime($pedidos->fechaEntrega));?></td>
                                <td><?= $pedidos->cliente->nombre;?></td>
                                <td><?= $pedidos->importe;?></td>
                                <td  style="display: none;"><?= $pedidos->estado;?></td>
                                <?php if ($_SESSION['rol'] == 2) { ?>
                                    <td>
                                        <button title="Confirmar Pedido"  class="isSelected btn btn-success"><i class='fas fa-check'></i></button>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php endforeach;?>
					</tbody>

				</table>
			</div>
            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <span class="font-weight-bold text-black ">Cantidad: </span>
                        <?php echo count($this->pedidos); ?>
                    </div>
                </div>
            </div>

		</div>
	</div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<div class="modal fade" id="ConfirmarPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h1 text-dark" id="exampleModalLabel">Confirmar Pedido</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
            <div class="card-header">
                <h3>Detalle del Pedido</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div>
                            <div class="form-group">
                                <label for="">Cliente: </label>
                                <span id="cliente">nombre cliente</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <div class="form-group">
                                <label for="">Fecha Entrega: </label>
                                <span id="fecha">fecha Entrega</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="table_detail"  style="width: 100%;" class="table table-hover">
                        <thead>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Unidad</th>
                            <th>Precio</th>
                            <th>Descripcion</th>
                            <th>Monto</th>    
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
       </div>
      <div class="modal-footer">
        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
        <button class="btn btn-dark" id="btnConfirmar">Confirmar Pedido</button>
      </div>
    </div>
  </div>
</div>

<script>

    function confirmarPedido(pedido){
        $("#cliente").text(pedido[3]);
        $("#fecha").text(pedido[2]);
        $.ajax({
            type: "GET",
            url: url_static + "pedido/getDetallesById/"+pedido[0],
            contentType: false,
            processData: false,
            success: function (response) {
                let data = JSON.parse(response);
                load_table_detail(data);
            }
        });

        $("#ConfirmarPedido").modal({
            keyboard: false,
            backdrop: 'static'
        });
    }

    $("#table tbody").on("click","button.isSelected",function(){
        let table = $("#table").DataTable();
        let data = table.row($(this).parents("tr")).data();
        if(data[5] == "Pendiente"){
            confirmarPedido(data);
        }else{
            Swal.fire("Sistema","Pedido ya fue confirmado","warning");
        }
        
    });


    function load_table_detail(_data){
        $('#table_detail').DataTable({
                "language": {
                    "decimal": "",
                    "emptyTable": "No hay datos",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                    "infoFiltered": "(Filtro de _MAX_ total registros)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "No se encontraron coincidencias",
                    "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                    },
                    "aria": {
                    "sortAscending": ": Activar orden de columna ascendente",
                    "sortDescending": ": Activar orden de columna desendente"
                    }
                },
                "data": _data,
                "dom": "t",
                destroy: true,
                columns: [
                    
                    {
                        "data": "presentacion",
                        render: function(data){
                            return data.producto.nombre;
                        }
                    },
                    {
                        "data": "cantidad",
                    },
                    {
                        "data": "unidad",
                        render: function(data){
                            return data.nombre;
                        }
                    },
                    {
                        "data": "presentacion",
                        render: function(data){
                            return data.precio;
                        }
                    },
                    
                    {
                        "data": "descripcion"
                    },
                    {
                        "data": "monto",
                        render: function(data,meta,row){
                            return row.presentacion.precio*row.cantidad;
                        }
                    }
                    
                ]
            });
    }


    $("#btnConfirmar").click(function(){
        
        Swal.fire({
            title: 'Sistema',
            text: '¿Desea confirmar pedido?',
            icon: 'info',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: `No`,
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: url_static + "pedido/confirmar",
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        let obj = JSON.parse(response);
                        let refresh = false;
                        let info = "error";

                        if(obj.cod == 201){
                            refresh = true;
                            info = "success"
                        }

                        Swal.fire("Sistema",obj.msje,info);

                        if(refresh == true){
                            setTimeout("window.location='<?php echo constant("URL")?>pedido'", 3000);
                        }
                    }
                });
            }
        });
    });


</script>

<?php require "views/footer.php"; ?>