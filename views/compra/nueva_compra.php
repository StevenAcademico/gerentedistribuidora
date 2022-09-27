<?php require "views/header.php"; ?>
<style>
    table tbody tr{
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
        <h1 class="h1 mb-0 text-gray-800">Registrar Compra</h1>
    </div>
    <div class="card">
        <div class="d-flex justify-content-center flex-wrap px-5 py-3">
            <div class="col-md-8 col-12" >
                <div style="max-height: 200px;overflow: auto;">
                    <table class="table table-cotizacion">
                        <thead style="position: sticky;top: 0;">
                            <tr style="background: #36b9cc;color: #fff;text-align: center;">
                                <td>Cotización</td>
                                <td>Emisión</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($this->cotizacion as $key => $value) :?>
                                <tr class="select-update" data-key="<?= $value->codigo?>">
                                    <td><?= $value->codigo?></td>
                                    <td><?= $value->fecha?></td>
                                </tr>
                            <?php endforeach?>
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <button class="btn-primary btn mt-2 " type="button" id="cargarCotizacion">Cargar Datos</button>
                </div>
            </div>
            <div class="col-md-8 col-12 mt-5" >
                <div>Detalle Solicitud <span class="detalleSolicitudTitulo"></span></div>
                <div style="max-height: 200px;overflow: auto;">
                    <table class="table table-detalleCotizacion">
                        <thead style="position: sticky;top: 0;">
                            <tr style="background: #36b9cc;color: #fff;text-align: center;">
                                <td>Producto</td>
                                <td>Cantidad</td>
                                <td>Unidad</td>
                                <td>Solicitar</td>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-2 col-12 text-left mt-5">
                <p>Cantidad</p>
                <input type="number" class="form-control" value="1" id="cantidadSolicitar">
                <button class="btn-info btn mt-2" type="button" id="agregarProducto">Agregar</button>
            </div>
            <div class="col-md-8 col-12 mt-5" >
                <div style="max-height: 200px;overflow: auto;">
                    <table class="table table-detalleCompra">
                        <thead style="position: sticky;top: 0;">
                            <tr style="background: #36b9cc;color: #fff;text-align: center;">
                                <td>Producto</td>
                                <td>Solicitud</td>
                                <td>Cantidad</td>
                                <td>Unidad</td>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-2 col-12 text-left mt-5">
                <label for="proveedor">Proveedor</label>
                <select name="" id="proveedor" class="form-control">
                    <?php foreach($this->proveedor as $key => $item):?>
                        <option value="<?=$item['CodProveedor']?>"><?=$item['Proveedor']?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="col-12 text-right">
                    <button class="btn-danger btn mt-2 " type="button" id="registrarCompra">Registrar Compra</button>
            </div>
        </div>                        
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script>
    $(document).ready(function () {
        load_table_detail(Array());
    });  
    
    var COTIZACION_LISTA = <?php echo json_encode($this->cotizacion) ?>;
    var DETALLE_COTIZACION = [];
    var COTIZACION_SELECT = null;
    var PRESENTACION_SELECT = null;
    var DETALLE_COMPRA = [];

    $('.table-cotizacion .select-update').click(function () {  
        $('.table-cotizacion .select-update').removeClass('select-producto')
        $(this).addClass('select-producto')
        let key = $(this).data('key')
        let find = COTIZACION_LISTA.find(obj => obj.codigo == key)
        COTIZACION_SELECT = find
    })

    $(document).on('click','.table-detalleCotizacion .select-update',function () {  
        $('.table-detalleCotizacion .select-update').removeClass('select-producto')
        $(this).addClass('select-producto')
        let key = $(this).data('key')
        let find = DETALLE_COTIZACION.find(obj => obj.CodDetalle == key)
        PRESENTACION_SELECT = find
        $('#cantidadSolicitar').val(PRESENTACION_SELECT.FaltaSolicitar)
    })

    $('#agregarProducto').click(function () {
        if (PRESENTACION_SELECT != null) {
            let finDetalle = DETALLE_COMPRA.find(obj => obj.CodDetalle == PRESENTACION_SELECT.CodDetalle);
            
            if (finDetalle != null) {
                finDetalle.Cantidad +=  Number($('#cantidadSolicitar').val() <= 0 ? 1 : $('#cantidadSolicitar').val())
            }else{
                DETALLE_COMPRA.push({
                    CodSolicitud : PRESENTACION_SELECT.CodSolicitud,
                    CodPresentacion: PRESENTACION_SELECT.CodPresentacion,
                    Cantidad: Number($('#cantidadSolicitar').val() <= 0 ? 1 : $('#cantidadSolicitar').val()),
                    CodDetalle : PRESENTACION_SELECT.CodDetalle,
                    Producto:PRESENTACION_SELECT.Producto,
                    Unidad:PRESENTACION_SELECT.Unidad
                })   
            }

            let html = ''
            DETALLE_COMPRA.forEach(element => {
                html += `<tr class="select-update" data-key="${element.CodDetalle}">
                            <td>${element.Producto}</td>
                            <td>${element.CodSolicitud}</td>
                            <td>${element.Cantidad}</td>
                            <td>${element.Unidad}</td>
                        </tr>`
            });
            $('.table-detalleCompra tbody').html(html);
        }else{
            Swal.fire("Sistema","Debe seleccionar un producto","info");  
        }
    })

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

    $('#cargarCotizacion').click(function () {  
        $.ajax({
            type: "GET",
            url: url_static + "compra/obtenerSolicitud/"+COTIZACION_SELECT.codigo,
            contentType: false,
            processData: false,
            data: {}  ,          
            success: function (response) {
                COTIZACION_SELECT = null;
                PRESENTACION_SELECT = null;
                let obj = JSON.parse(response);
                $('.detalleSolicitudTitulo').html(obj[0].CodSolicitud);
                let html = ''
                DETALLE_COTIZACION = obj
                obj.forEach(element => {
                    html += `<tr class="select-update" data-key="${element.CodDetalle}">
                                <td>${element.Producto}</td>
                                <td>${element.FaltaSolicitar}</td>
                                <td>${element.Unidad}</td>
                                <td class="cantidadComprar-${element.CodDetalle}">${Number(element.FaltaSolicitar) < 0 ? 0 : element.FaltaSolicitar}</td>
                              </tr>`
                });
                $('.table-detalleCotizacion tbody').html(html);
            }
        });
    })

    $('#registrarCompra').click(function () {  
        var formData = new FormData();
        formData.append('Proveedor', $('#proveedor').val());
        formData.append('Detalle',JSON.stringify(DETALLE_COMPRA));
        if(DETALLE_COMPRA.length > 0){
          $.ajax({
            type: "POST",
            url: url_static + "compra/guardar",
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
                    
                                let ventana = window.open('<?php echo constant("URL")?>compra/generarPDF/'+obj.Compra, '_blank');
                                ventana.focus()
                            setTimeout("window.location='<?php echo constant("URL")?>compra/registro'", 1000);
                            }
                        }
                    });

                
            }
          });
        }else{
          Swal.fire("Sistema","Debe agregar al menos un producto","warning");
        }
    })
</script>

<?php require "views/footer.php"; ?>