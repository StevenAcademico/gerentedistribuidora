<?php require "views/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center  justify-content-between mb-4">
        <h1 class="h1 mb-0 text-gray-800">Registrar Pedido</h1>
        <a href="<?php echo constant('URL')?>pedido" class="btn btn-danger">Regresar</a>
    </div>
    <form  id="frmData" action="<?php echo constant("URL")?>pedido/guardar"  method="post" autocomplete="off">

        <div class="card">
            <div class="card-header">
                <h3 class="font-weight-bold text-gray-900">Datos de Entrega</h3>
            </div>
            <div class="card-body bg-gray-400">
                <div class="row">
                    <div class="col-lg-6">
                        <div>
                            <div class="form-group">
                                <label for="" class="text-gray-900">Fecha</label>
                                <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo date("Y-m-d")?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <div class="form-group">
                                <label for="" class="text-gray-900">Direccion</label>
                                <input type="text" name="direccion" id="direccion" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <div class="form-group">
                                <label for="" class="text-gray-900">Teléfono</label>
                                <input type="tel" name="telefono" maxlength="9" onkeypress="return soloNumeros(event);" id="telefono" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <div class="form-group">
                                <label for="" class="text-gray-900">Referencia</label>
                                <textarea cols="10" rows="5" name="referencia" id="referencia" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div>
                            <div class="form-group">
                                &nbsp;
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div>
                            <div class="form-group">
                                <label for="">&nbsp;</label>
                                <button type="button" class="btn btn-dark text-white" id="btnActualizarC">Actualizar Datos</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="font-weight-bold text-gray-900">Datos de los Productos</h3>
            </div>
            <div class="card-body bg-gray-400">
                <div class="row">
                    <div class="col-lg-4">
                        <div>
                            <div class="form-group">
                                <label for="">Categoria</label>
                                <select name="categoria" id="categoria" class="form-control">
                                    <option value="0">--Seleccione</option>
                                <?php foreach($this->categorias as $cat):?>
                                    <?php $categoria = new Categoria();?>
                                    <?php $categoria = $cat;?>
                                    <option value="<?=$categoria->codigo?>"><?=$categoria->nombre?></option>
                                <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div>
                            <div class="form-group">
                                <label for="">Producto</label>
                                <select name="producto" id="producto" class="form-control">
                                    <option value="0">--Seleccione</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div>
                            <div class="form-group">
                                <label for="">Presentación</label>
                                <select name="presentacion" id="presentacion" class="form-control">
                                    <option value="0">--Seleccione</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div>
                            <div class="form-group">
                                <label for="">Cantidad</label>
                                <input type="number" name="cantidad" id="cantidad" class="form-control" value="1" min="1">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div>
                            <div class="form-group">
                                <label for="">Unidad</label>
                                <select name="unidad" id="unidad" class="form-control">
                                    <option value="0">--Seleccione</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <div class="form-group">
                                <label for="" class="text-gray-900">Descripcion</label>
                                <textarea cols="10" rows="3" name="descripcion" id="descripcion" class="form-control"></textarea>
                            
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div>
                            <div class="form-group">
                                <label for="">&nbsp;</label>
                                <input type="hidden" name="index_row" id="index_row">
                                <button type="button" id="btnActualizar" class="btn btn-dark text-white form-control">Actualizar</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div>
                            <div class="form-group">
                                <label for="">&nbsp;</label>
                                <button type="button" id="btnAgregar" class="btn btn-dark text-white form-control">Agregar</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div>
                            <div class="form-group">
                                <label for="">&nbsp;</label>
                                <button type="button" id="btnCancelar" class="btn btn-dark text-white form-control">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="table_detail"  style="width: 100%;" class="table table-hover">
                        <thead>
                            <th>Opción</th>
                            <th>Codigo Producto</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Codigo Unidad</th>
                            <th>Unidad</th>
                            <th>Codigo Presentacion</th>
                            <th>Precio</th>
                            <th>Descripcion</th>
                            <th>Monto</th>    
                            <th>Categoria</th>            
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div>
                            &nbsp;
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div>
                            <label for="" class="float-right text-dark">Monto</label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" id="total" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div>
                            &nbsp;
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div>
                            <div class="form-group">
                                <label for="">&nbsp;</label>
                                <input type="submit" class="btn btn-danger text-white form-control" value="Registrar">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
    var categorias = Array();
    $(document).ready(function () {
        load_table_detail(Array());
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
                columns: [
                    {
                        "data": null,
                        render: function () { 
                            return "<button class='btn_remove btn btn-danger' title='Eliminar'><i class='fas fa-trash'></i></button>";
                        }
                    },
                    {
                        "data": "codproducto",
                        visible: false
                    },
                    {
                        "data": "producto",
                    },
                    {
                        "data": "cantidad"
                    },
                    {
                        "data": "codunidad",
                        visible: false
                    },
                    {
                        "data": "unidad"
                    },
                    {
                        "data": "codpresentacion",
                        visible: false
                    },
                    {
                        "data": "precio"
                    },
                    
                    {
                        "data": "descripcion"
                    },
                    {
                        "data": "monto"
                    },
                    {
                        "data": "categoria",
                        visible : false
                    }
                    
                ]
            });
    }

    $('#table_detail tbody').on('click', 'tr', function () {
        var table = $('#table_detail').DataTable();
        let data = table.row($(this)).data();
        let index = table.row($(this)).index();
        if(data == null){
            limpiarDetalles();
        }else{
            Swal.fire({
                title: 'Sistema',
                text: 'Desea Modificar Fila?',
                icon: 'info',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Si',
                cancelButtonText: `No`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    llenarDetalles(data);
                    $("#index_row").val(index);
                    $("#btnAgregar").prop("disabled",true);
                } else if (result.isCancel) {
                    $("#btnAgregar").prop("disabled",false);
                }
            });
            
        }
    });


    $("#categoria").change(function(){
        let categoria = $(this).val();
        $.ajax({
            type: "GET",
            url: url_static + "producto/getProductByCategoria/"+categoria,
            contentType: false,
            processData: false,
            success: function (response) {
                let data = JSON.parse(response);
                $("#producto").empty();
                let option = "<option value='0'>--Seleccione</option>";
                data.forEach(x => {
                    option += `<option value="${x.codigo}">${x.nombre}</>`;
                    
                });
                $("#producto").append(option);
            }
          });
    });
    
    $("#producto").change(function(){
        let producto = $(this).val();
        $.ajax({
            type: "GET",
            url: url_static + "presentacion/getActivosByProducto/"+producto,
            contentType: false,
            processData: false,
            success: function (response) {
                let data = JSON.parse(response);
                $("#presentacion").empty();
                let option = "<option value='0'>--Seleccione</option>";
                data.forEach(x => {
                    option += `<option data-price="${x.precio}" value="${x.codigo}">${x.descripcion}</>`;
                    
                });
                $("#presentacion").append(option);
            }
          });
    });

    $("#presentacion").change(function(){
        let producto = $("#producto").val();
        let presentacion = $(this).val();
        $.ajax({
            type: "GET",
            url: url_static + "unidad/getUnidadByProductYPresentacion/"+producto + "/" + presentacion,
            contentType: false,
            processData: false,
            success: function (response) {
                let data = JSON.parse(response);
                $("#unidad").empty();
                let option = "<option value='0'>--Seleccione</option>";
                data.forEach(x => {
                    option += `<option value="${x.codigo}">${x.nombre}</>`;
                    
                });
                $("#unidad").append(option);
            }
          });
    });


    function searchId(obj) {
        let table = $("#table_detail").DataTable();
        let data = table.rows().data();

        for (let index = 0; index < data.length; index++) {
        const element = data[index];
        if(element.codproducto == obj.codproducto && element.codunidad == obj.codunidad){
            return true;
        }
        
        }

        return false;
    
    }

    function limpiarDetalles(){
        $("#index_row").val("");
        $("#cantidad").val(1);
        $("#categoria").val(0).trigger("change");
        $("#producto").val(0).trigger("change");
        $("#presentacion").val(0).trigger("change");
        $("#descripcion").val("");
    }

    function llenarProductos(categoria, producto){
        $.ajax({
            type: "GET",
            url: url_static + "producto/getProductByCategoria/"+categoria,
            contentType: false,
            processData: false,
            success: function (response) {
                let data = JSON.parse(response);
                $("#producto").empty();
                let option = "<option value='0'>--Seleccione</option>";
                data.forEach(x => {
                    option += `<option ${x.codigo == producto ? 'selected':''} value="${x.codigo}">${x.nombre}</>`;
                    
                });
                $("#producto").append(option);
            }
        });
    }

    function llenarPresentaciones(producto,presentacion){
        $.ajax({
            type: "GET",
            url: url_static + "presentacion/getActivosByProducto/"+producto,
            contentType: false,
            processData: false,
            success: function (response) {
                let data = JSON.parse(response);
                $("#presentacion").empty();
                let option = "<option value='0'>--Seleccione</option>";
                data.forEach(x => {
                    option += `<option ${x.codigo == presentacion ? 'selected':''} data-price="${x.precio}" value="${x.codigo}">${x.descripcion}</>`;
                    
                });
                $("#presentacion").append(option);
            }
          });
    }

    function llenarUnidades(producto,presentacion,unidad){
        $.ajax({
            type: "GET",
            url: url_static + "unidad/getUnidadByProductYPresentacion/"+producto + "/" + presentacion,
            contentType: false,
            processData: false,
            success: function (response) {
                let data = JSON.parse(response);
                $("#unidad").empty();
                let option = "<option value='0'>--Seleccione</option>";
                data.forEach(x => {
                    option += `<option ${x.codigo == unidad ? 'selected':''} value="${x.codigo}">${x.nombre}</>`;
                    
                });
                $("#unidad").append(option);
            }
          });
    }

    function llenarDetalles(data){

        if(data == null){
            limpiarDetalles();
        }else{
            
            $("#cantidad").val(data.cantidad);
            $("#categoria").val(data.categoria).trigger("change");
            llenarProductos(data.categoria,data.codproducto);
            llenarPresentaciones(data.codproducto,data.codpresentacion);
            llenarUnidades(data.codproducto,data.codpresentacion,data.codunidad);
            $("#descripcion").val(data.descripcion);
        }
       
    }

    function validar(){
        let estado = true;
        if($("#categoria").val() == 0){
            let msje = "Seleccione categoria válida";
            Swal.fire("Sistema",msje,"warning");
            return false;
        }

        if($("#producto").val() == 0){
            let msje = "Seleccione producto válido";
            Swal.fire("Sistema",msje,"warning");
            return false;
        }

        if($("#presentacion").val() == 0){
            let msje = "Seleccione presentacion válida";
            Swal.fire("Sistema",msje,"warning");
            return false;
        }

        if($("#unidad").val() == 0){
            let msje = "Seleccione unidad Válida";
            Swal.fire("Sistema",msje,"warning");
            return false;
        }

        return estado;
    }

    $("#btnAgregar").click(function(event){
        let obj = {
            codproducto : $("#producto").val(),
            producto: $("#producto option:selected").text(),
            cantidad: $("#cantidad").val(),
            codunidad : $("#unidad").val(),
            unidad: $("#unidad option:selected").text(),
            codpresentacion: $("#presentacion").val(),
            precio: $("#presentacion option:selected").data("price"),
            descripcion: $("#descripcion").val(),
            monto: parseFloat($("#cantidad").val()) * parseFloat($("#presentacion option:selected").data("price")),
            categoria: $("#categoria").val()
        };


        let buscar = searchId(obj);

        if(validar()){
            if(buscar == false){
                let table = $("#table_detail").DataTable();
                table.row.add(obj).draw();
                limpiarDetalles();
            }
        }
        

        
    });

    $("#btnActualizar").click(function(){
        let table = $("#table_detail").DataTable();
        var index = $("#index_row").val();
        if(index != ''){
            let obj = {
                codproducto : $("#producto").val(),
                producto: $("#producto option:selected").text(),
                cantidad: $("#cantidad").val(),
                codunidad : $("#unidad").val(),
                unidad: $("#unidad option:selected").text(),
                codpresentacion: $("#presentacion").val(),
                precio: $("#presentacion option:selected").data("price"),
                descripcion: $("#descripcion").val(),
                monto: parseFloat($("#cantidad").val()) * parseFloat($("#presentacion option:selected").data("price")),
                categoria: $("#categoria").val()
            };



            if(validar()){
                let table = $("#table_detail").DataTable();
                table.row(index).data(obj).invalidate();
                limpiarDetalles();
                $("#btnAgregar").prop("disabled",false);
            }
            
        }else{
            Swal.fire("Sistema","debe seleccionar una fila","warning");
        }
    });

    $("#btnCancelar").click(function(){
        limpiarDetalles();
        $("#btnAgregar").prop("disabled",false);
    });

    $("#table_detail tbody").on('click','button.btn_remove',function () { 
        let table = $("#table_detail").DataTable();
        table
            .row( $(this).parents('tr') )
            .remove()
            .draw();
    });

    $("#frmData").submit(function(event){
        event.preventDefault();
        let form = $("#frmData");

        form.validate({
          errorElement: "span",
          errorClass: "help-block",
          errorPlacement: function (error, element) {
              error.addClass('invalid-feedback');
              element.closest('.form-group').append(error);
          },
          highlight: function (element, errorClass, validClass) {
              $(element).addClass('is-invalid');
          },
          unhighlight: function (element, errorClass, validClass) {
              $(element).closest('.form-control').removeClass('is-invalid');
              $(element).closest('.form-control').addClass('is-valid');
          },
          rules:{
          "direccion":{
              required: true,
          },
          "telefono":{
              required: true,
          },
          "referencia":{
              required: true,
          }
        },
            messages:{
            
            "direccion":{
                required: "* Campo requerido",
            },
            "telefono":{
                required: "* Campo requerido",
            },
            "referencia":{
                required: "* Campo requerido",
            }
            
        }
      });

      if(form.valid()){
        let table = $("#table_detail").DataTable();
        let data = table.rows().data();
        let rows = Array();
        for (let index = 0; index < data.length; index++) {
          const element = data[index];
          rows.push(element);         
        }

        var formElement = document.getElementById("frmData");
        var formData = new FormData(formElement);
        formData.append('detalles',JSON.stringify(rows));
        if(rows.length > 0){
          $.ajax({
            type: "POST",
            url: url_static + "pedido/guardar",
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
                  setTimeout("window.location='<?php echo constant("URL")?>pedido'", 3000);
                }
            }
          });
        }else{
          Swal.fire("Sistema","Debe agregar al menos un producto","warning");
        }
      }
    
    });


    

</script>

<?php require "views/footer.php"; ?>