<?php require "views/header.php"; ?>
<style>
    .table-solicitar tbody tr{
        text-align: center;
        cursor: pointer;
    }
    .select-producto {
        background: #36ccb047;
        color: #000;
    }
</style>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center  justify-content-between mb-4">
        <h1 class="h1 mb-0 text-gray-800">Registrar Solicitud</h1>
    </div>
    <div class="card">
        <div class="d-flex justify-content-center flex-wrap px-5 py-3">
            <div class="col-md-8 col-12" >
                <div style="max-height: 300px;overflow: auto;">
                    <table class="table table-solicitar">
                        <thead style="position: sticky;top: 0;">
                            <tr style="background: #36b9cc;color: #fff;text-align: center;">
                                <td>Producto</td>
                                <td>Requiere</td>
                                <td>Unidad</td>
                                <td>Stock</td>
                                <td>Solicitar</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($this->productoSolicitar as $key => $value) :?>
                                <tr class="select-update" data-key="<?= $value['CodPresentacion']?>">
                                    <td><?= $value['Producto']?></td>
                                    <td><?= $value['CantidadRequerida']?></td>
                                    <td><?= $value['nombre']?></td>
                                    <td><?= $value['Stock']?></td>
                                    <td class="cantidadRequeria-<?= $value['CodPresentacion']?>"><?= $value['CantidadSolicitar']?></td>
                                </tr>
                            <?php endforeach?>
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <button class="btn-danger btn mt-2 " type="button" id="registrarCotizacion">Preparar Solicitud</button>
                </div>
            </div>
            <div class="col-md-2 col-12 text-left">
                <p>Solicitar</p>
                <input type="number" class="form-control" value="1" id="cantidadSolicitar">
                <button class="btn-info btn mt-2" type="button" id="actualizarPedido">Actualizar</button>
                
            </div>
            <!-- <div class="col-12 text-right pb-4">
                <button class="btn-danger btn mt-2" type="button">Preparar Solicitud</button>       
            </div> -->
        </div>
        <!-- <div class="card-header">
            <h3>Seleccionar Producto</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div>
                        <div class="form-group">
                            <label for="">Producto</label>
                            <select name="producto" id="producto" class="form-control">
                            <?php foreach ($this->presentaciones as $row): ?>
                                <?php 
                                    $presentacion = new Presentacion();
                                    $presentacion = $row;    
                                ?>
                                <option 
                                        data-product = "<?=$presentacion->producto->nombre?>"
                                        data-stock = "<?=$presentacion->cantidad?>"
                                        data-unity = "<?=$presentacion->unidad->nombre?>"
                                        value="<?=$presentacion->codigo;?>"><?= $presentacion->descripcion . " - " . $presentacion->producto->nombre ." - ". $presentacion->unidad->nombre ?></option>
                            <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div>
                        <div class="form-group">
                            <label for="">Cantidad</label>
                            <input type="number" name="cantidad" id="cantidad" class="form-control" value="1" min="1">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div>
                        <div class="form-group">
                            <label for="">&nbsp;</label>
                            <button id="btnAdd" class="form-control btn btn-danger" title="Agregar Producto">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table responsive">
                <table id="table_detail" style="width: 100%;" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Opcion</th>
                            <th>CodPresentacion</th>
                            <th>Producto</th>
                            <th>Cantidad Requerida</th>
                            <th>Unidad</th>
                            <th>Stock</th>
                            <th>Cantidad Solicitada</th>                            
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div>
                        &nbsp;
                    </div>
                </div>
                <div class="col-lg-3">
                    <div>
                        <div class="form-group">
                            <label for="">&nbsp;</label>
                            <button id="btnGuardar" class="form-control btn btn-success" title="Guardar">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script>
    $(document).ready(function () {
        load_table_detail(Array());
    });
    var PEDIDO_ACTUALIZAR = [];
    var PEDIDO_ACTUALIZAR = <?php echo json_encode($this->productoSolicitar) ?>;

    var PRODUCTO_SELECT = null;

    $('.select-update').click(function () {  
        $('.select-update').removeClass('select-producto')
        $(this).addClass('select-producto')
        let key = $(this).data('key')
        let find = PEDIDO_ACTUALIZAR.find(obj => obj.CodPresentacion == key)
        PRODUCTO_SELECT = find
        $('#cantidadSolicitar').val(find.CantidadSolicitar)
    })

    $('#registrarCotizacion').click(function () {  
        var formData = new FormData();
        formData.append('fecha', new Date());
        formData.append('detalles',JSON.stringify(PEDIDO_ACTUALIZAR));
        if(PEDIDO_ACTUALIZAR.length > 0){
          $.ajax({
            type: "POST",
            url: url_static + "solicitud/guardar",
            contentType: false,
            processData: false,
            data: formData  ,          
            success: function (response) {
                let obj = JSON.parse(response);
                let refresh = false;
                let info = "error";

                if(obj.cod == 201){
                  refresh = true;
                  info = "success"
                }

                Swal.fire("Sistema",obj.msje,info)
                    .then(function () {  
                        if(obj.cod == 201){
                            if(refresh == true){
                    
                                let ventana = window.open('<?php echo constant("URL")?>solicitud/generarPDF/'+obj.Cotizacion, '_blank');
                                ventana.focus()
                            setTimeout("window.location='<?php echo constant("URL")?>solicitud'", 1000);
                            }
                        }
                    });

                
            }
          });
        }else{
          Swal.fire("Sistema","Debe agregar al menos un producto","warning");
        }
    })

    $('#actualizarPedido').click(function (){
        let find = PEDIDO_ACTUALIZAR.find(obj => obj.CodPresentacion == PRODUCTO_SELECT.CodPresentacion)
        find.CantidadSolicitar= $('#cantidadSolicitar').val() <= 0 ? 1 :$('#cantidadSolicitar').val()
        
        $('.select-update .cantidadRequeria-'+PRODUCTO_SELECT.CodPresentacion).html(find.CantidadSolicitar)
    })
    
    function load_table_detail(_data){
        $('#table_detail').DataTable({
                destroy: true,
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
                columns: [
                    {
                        "data": null,
                        render: function () { 
                            return "<button class='btn_remove btn btn-danger' title='Eliminar'><i class='fas fa-trash'></i></button>";
                        }
                    },
                    {
                        "data": "presentacion",
                        visible: false
                    },
                    {
                        "data": "producto",
                    },
                    {
                        "data": "cantidad_req"
                    },
                    {
                        "data": "unidad",
                    },
                    {
                        "data": "stock"
                    },
                    {
                        "data": "cantidad",
                    }
                    
                ]
            });
    }

    $("#cantidadSolicitar").keyup(function () {
        var valor = $(this).prop("value");
        if (valor <= 0)
            $(this).prop("value", "1");
    })

    $("#cantidadSolicitar").change(function () {
        var valor = $(this).prop("value");
        if (valor <= 0)
            $(this).prop("value", "1");
    })

    $("#table_detail tbody").on('click','button.btn_remove',function () { 
        let table = $("#table_detail").DataTable();
        table
            .row( $(this).parents('tr') )
            .remove()
            .draw();
    });

    function searchId(obj) {
        let table = $("#table_detail").DataTable();
        let data = table.rows().data();

        for (let index = 0; index < data.length; index++) {
            const element = data[index];
            if(element.presentacion == obj.presentacion){
                return true;
            }        
        }

        return false;    
    }

    function limpiarDetalles(){
        $("#cantidad").val(1);
    }

    $("#btnAdd").click(function(event){
        let obj = {
            presentacion : $("#producto").val(),
            producto: $("#producto option:selected").data("product"),
            cantidad_req: $("#producto option:selected").data("stock"),
            unidad: $("#producto option:selected").data("unity"),
            stock: $("#producto option:selected").data("stock"),
            cantidad: $("#cantidad").val(),
        };


        let buscar = searchId(obj);

        if(buscar == false){
            let table = $("#table_detail").DataTable();
            table.row.add(obj).draw();
            limpiarDetalles();
        }           
    });


    $("#btnGuardar").click(function(){
        let table = $("#table_detail").DataTable();
        let data = table.rows().data();
        let rows = Array();
        for (let index = 0; index < data.length; index++) {
          const element = data[index];
          rows.push(element);         
        }

        var formData = new FormData();
        formData.append('fecha', new Date());
        formData.append('detalles',JSON.stringify(rows));
        if(rows.length > 0){
          $.ajax({
            type: "POST",
            url: url_static + "solicitud/guardar",
            contentType: false,
            processData: false,
            data: formData  ,          
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
                  setTimeout("window.location='<?php echo constant("URL")?>solicitud'", 3000);
                }
            }
          });
        }else{
          Swal.fire("Sistema","Debe agregar al menos un producto","warning");
        }
    })

</script>

<?php require "views/footer.php"; ?>