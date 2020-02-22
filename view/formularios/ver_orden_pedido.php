<?php
// start a session
session_start();
 if (!isset($_SESSION['idUser'])) {
    header ("Location:/inventarios/index.php"); 
 }
// manipulate session variables
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Inventario</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/offcanvas/">

    <!-- Bootstrap core CSS -->
<link href="../../assets/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

<meta name="theme-color" content="#563d7c">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  </head>
  <body class="bg-light">
  <?php require("../menu.php"); ?>

<main role="main" class="container py-5">
  <div class="py-2 bg-white rounded shadow-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <select ref="select" onchange="ShowPedidos(this.value)" class="form-control form-control-sm id_bodegas" id="bodega" name="bodega">
                        <option value="">Seleccione el bodegas</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 mb-3">
                <label style="font-size:14px;" for="">Tipo de venta</label>
                <hr style="margin-top:-1px;">
                <div class="custom-control custom-radio custom-control-inline">
                    <input id="debit" value="efectivo" name="tipo_venta" type="radio" class="custom-control-input" checked="" required="">
                    <label class="custom-control-label" for="debit">Efectivo</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input id="bank" value="tarjeta" name="tipo_venta" type="radio" class="custom-control-input" required="">
                    <label class="custom-control-label" for="bank">Tarjeta</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input id="credit" value="credito" name="tipo_venta" type="radio" class="custom-control-input" required="">
                    <label class="custom-control-label" for="credit">Crédito</label>
                </div>
            </div>
            <div class="mx-auto col-sm-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Sin despacho</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Despachadas</a>
                </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card">
                            <div class="card-header">
                            <a  href="orden_pedido.php" class="btn btn-sm float-right" style="background-color: #6c63ff; color:#fff">Crear pedidos</a>
                                <h5 class="mb-0">Ordenes de pedido sin despacho</h5>
                            </div>
                            <div class="card-body table-responsive-sm">
                                <table class="table" id="example" style="width:100%;font-size:11px">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width:10px" scope="col">Detalle</th>
                                            <th scope="col">Id</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Total pedido</th>
                                            <th scope="col">Tipo</th>
                                            <th scope="col">Vendedor</th>
                                            <th scope="col">Fecha</th>
                                            <th style="width:10px"></th>
                                            <th style="width:10px"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodytable">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">orden terminadas</h5>
                            </div>
                            <div class="card-body table-responsive-sm">
                                <table class="table" id="example1" style="width:100%;font-size:11px">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width:10px" scope="col">Detalle</th>
                                            <th scope="col">Id</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Total pedido</th>
                                            <th scope="col">Tipo</th>
                                            <th scope="col">Vendedor</th>
                                            <th scope="col">Fecha</th>
                                            <th style="width:10px"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodytable1">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <div id="ver_credito" style="display:none" class="col-sm-12 py-4">
                <!-- form user info -->
                <div id="ver_editar" class="card">
                    <div class="card-header">
                    <button class="btn btn-success btn-sm float-right" onclick="btn_guardar()">Guardar</button>
                        <h5 class="mb-0">Abonar a orden</h5>
                    </div>
                    <div class="card-body">
                        <form name="editar_orden" class="form" role="form" id="form_actualizar" role="form" onsubmit="event.preventDefault(); return guardar_abono();" autocomplete="off">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input maxlength="255" ref="id" required disabled class="form-control form-control-sm" id="id1" name="id1" type="text" placeholder="id">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input maxlength="255" ref="nombre" required disabled class="form-control form-control-sm" name="nombre1" type="text" placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input maxlength="20" class="form-control form-control-sm" required name="vl_abono1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" type="text" placeholder="Valor del abono">
                                        </div>
                                    </div>
                                </div>
                                <div style="display:none" class="form-group">
                                <button class="btn btn-success btn-sm float-right" id="submit_guardar" type="submit">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /form user info -->
                <div id="ver_editar" class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Abonos realizados</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table" style="width:100%;font-size:11px">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Valor abono</th>
                                    <th scope="col">Fecha</th>
                                    <th style="width:10px" scope="col">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyabono">
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <div class="col-sm-12">
                <!-- /form user info -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Detalles de la orden pedido <span id="text_id_pedido"></span></h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table " id="example" style="width:100%; font-size:10px">
                            <thead class="thead-light">
                                <tr>
                                    <th style="display:none" scope="col">Id Producto</th>
                                    <th scope="col">Id Producto</th>
                                    <th scope="col">Nombre del producto</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Existencias</th>
                                    <th scope="col">Valor unitario</th>
                                    <th scope="col">IVA</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Total</th>
                                    <th style="width:10px"></th>
                                </tr>
                            </thead>
                            <tbody id="tbodydetalle_orden">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <form id="form_existencias" class="form" role="form" role="form" onsubmit="event.preventDefault(); return guardar_existencias();" autocomplete="off">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Configurar existencias</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                <div class="container">
                                    <div class="row">
                                    <div style="display:none" class="col-sm-3">
                                            <div class="form-group">
                                            <input maxlength="20" class="form-control form-control-sm" required name="modal_id" type="text" placeholder="Cantidad existente">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                            <input maxlength="20" class="form-control form-control-sm" disabled name="modal_nombre" type="text" placeholder="Cantidad existente">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <input maxlength="20" class="form-control form-control-sm" required name="modal_cantidad" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" type="text" placeholder="Cantidad existente">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" alert() class="btn btn-primary">Guardar cambios</button>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</main>
<script src="../../assets/js/jquery.slim.min.js" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/jquery.slim.min.js"><\/script>')</script>
    <script src="../../assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="/inventarios/assets/js/bootstrap-notify.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script>
$(function() {
        permisos("ver_orden_pedido")
        buscar_bodegas()
        console.log( "index!" );
  });

    function despachar(id) {
        $.confirm({
            title: 'Atención!',
            content: '¿ Estas seguro de que quieres despachar el pedido número '+id+' ?',
            buttons: {
                confirm: function () {
                    $.ajax({
                        type : 'POST',
                        data: "id="+id+"&tipo_venta="+$("input[name^=tipo_venta]:checked").val()+"&bodega="+$('#bodega').val(),
                        url: '/inventarios/php/ver_orden_pedidos/guardar_despacho.php',
                        success: function(respuesta) {
                        let obj = JSON.parse(respuesta)
                        if (obj.success) {
                            if (obj.numero > 0) {
                                notificacion("La orden se ha despachado correctamente.", "success")
                                ShowPedidos($('#bodega').val())   
                            }else{
                                notificacion("No se puede realizar el despacho, por que la orden tiene un producto o varios productos que la cantidad ordenada supera las existencias en bodega.", "success")
                            }
                        }else{
                            alert('Datos invalidos para el acceso')
                        }
                        },
                        error: function() {
                        console.log("No se ha podido obtener la información");
                        }
                    });    
                },
                cancel: function () {
                    //$.alert('Canceled!');
                }
            }
        });
      
    }

    function ShowPedidos(bodega) {
        Showorden_terminadas(bodega)
        //ver_credito(tipo_venta)
        let values = { 
            cod: "1",
            parametro1: 'pedido',
            parametro2: bodega,
            parametro3: 0 
        }; 
        $.ajax({
        type : 'POST',
        data: values,
        url: '/inventarios/php/ver_orden_pedidos/seleccionar.php',
        beforeSend: function() {
            //$(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
        //$(".loader").css("display", "none")
        let obj = JSON.parse(respuesta)
        $("#example").dataTable().fnDestroy();
        let fila = ''
        let color_danger = ''
        let btn_despacho = ''
        $.each(obj.resultado, function( index, val ) {
            if (val.validar_despacho == '1' ) {
                color_danger = ''
                btn_despacho = '<td onclick="despachar('+val.id+')"><a style="cursor:pointer;font-size:9px" class="btn btn-primary btn-sm text-white" >Despachar</a></td>'
            }else{
                color_danger = 'bg-warning'
                btn_despacho = ''
            }
            fila += '<tr class="'+color_danger+'">'+
                        '<td onclick="Showdetalle_pedidos('+val.id+')" class="editar"><h6><span style="cursor:pointer" class="badge badge-info"><i class="fa fa-eye"></i></span></h6></td>'+
                        '<td>'+val.id+'</td>'+
                        '<td>'+val.nombre+'</td>'+
                        '<td>'+parseInt(val.valor_factu).toFixed(0)+'</td>'+
                        '<td><span class="text-uppercase">'+val.tipo_venta+'</span></td>'+
                        '<td>'+val.usuario_crea+'</td>'+
                        '<td>'+val.fecha+'</td>'+
                        '<td onclick="eliminar_pedido('+val.id+')"><a style="cursor:pointer" ><i style="font-size:11px" class="fa fa-window-close"></i></a></td>'+
                        btn_despacho+
                    '</tr>'
        });
        $("#tbodytable").html(fila)
        $('#example').DataTable({
            "ordering": false,
            "paging": false
        });
        },
        error: function() {
        //$(".loader").css("display", "")
        console.log("No se ha podido obtener la información");
        }
    });
    
  }

  function Showorden_terminadas(bodega) {
        let values = { 
            cod: "1",
            parametro1: 'pedido',
            parametro2: bodega,
            parametro3: 1
        }; 
        $.ajax({
        type : 'POST',
        data: values,
        url: '/inventarios/php/ver_orden_pedidos/seleccionar.php',
        beforeSend: function() {
            //$(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
        //$(".loader").css("display", "none")
        let obj = JSON.parse(respuesta)
        $("#example1").dataTable().fnDestroy();
        let fila = ''
        $.each(obj.resultado, function( index, val ) {
            fila += '<tr>'+
            '<td onclick="Showdetalle_pedidos('+val.id+')" class="editar"><h6><span style="cursor:pointer" class="badge badge-info"><i class="fa fa-eye"></i></span></h6></td>'+
                        '<td>'+val.id+'</td>'+
                        '<td>'+val.nombre+'</td>'+
                        '<td>'+parseInt(val.valor_factu).toFixed(0)+'</td>'+
                        '<td><span class="text-uppercase">'+val.tipo_venta+'</span></td>'+
                        '<td>'+val.usuario_crea+'</td>'+
                        '<td>'+val.fecha+'</td>'+
                    '</tr>'
        });
        $("#tbodytable1").html(fila)
        $('#example1').DataTable({
            "ordering": false,
            "paging": false
        });
        },
        error: function() {
        //$(".loader").css("display", "")
        console.log("No se ha podido obtener la información");
        }
    });
    
  }

  function Showdetalle_pedidos(orden) {
        $('#text_id_pedido').text('N° '+orden)
        let values = { 
            cod: "2",
            parametro1: orden,
            parametro2: 1,
            parametro3: $("#bodega").val()
        }; 
        $.ajax({
        type : 'POST',
        data: values,
        url: '/inventarios/php/ver_orden_pedidos/seleccionar.php',
        beforeSend: function() {
            //$(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
        //$(".loader").css("display", "none")
        let obj = JSON.parse(respuesta)
        let fila = ''
        let total_iva = 0
        let sub_total = 0
        $.each(obj.resultado, function( index, val ) {
            total_iva += (parseInt(val.iva)*parseInt(val.cantidad)*(val.vl_venta))/100
            sub_total += parseInt(val.cantidad)*(val.vl_venta)-((parseInt(val.iva)*parseInt(val.cantidad)*(val.vl_venta))/100)
            let color_danger = ''
            if (parseInt(val.cantidad) > parseInt(val.existencias)) {
                color_danger = 'bg-danger'
            }else{
                color_danger = ''
            }
            fila += '<tr class="'+color_danger+'">'+
                        '<td class="id_productos" style="display:none" >'+val.id+'</td>'+
                        '<td>'+val.id_producto+'</td>'+
                        '<td>'+val.nombre_producto+'</td>'+
                        '<td>'+val.cantidad+'</td>'+
                        '<td>'+val.existencias+'</td>'+
                        '<td>'+val.vl_venta+'</td>'+
                        '<td>'+parseFloat((parseInt(val.iva)*parseInt(val.cantidad)*(val.vl_venta))/100).toFixed(2)+'</td>'+
                        '<td>'+parseFloat(parseInt(val.cantidad)*(val.vl_venta)-((parseInt(val.iva)*parseInt(val.cantidad)*(val.vl_venta))/100)).toFixed(2)+'</td>'+
                        '<td>'+parseFloat(parseInt(val.cantidad)*(val.vl_venta)).toFixed(2)+'</td>'+
                        //'<td class="editar"><a style="cursor:pointer" onclick="ver_editar()" ><i style="font-size:11px" class="fa fa-pencil-square-o"></i></a></td>'+
                        '<td class="borrar"><a style="cursor:pointer" onclick="confirmar_eliminacion('+val.id+')" ><i style="font-size:11px" class="fa fa-window-close"></i></a></td>'+
                    '</tr>'
        });
        $("#tbodydetalle_orden").html(fila)
            //$('#example').DataTable().ajax.reload();
        },
        error: function() {
        //$(".loader").css("display", "")
        console.log("No se ha podido obtener la información");
        }
    });
    
  }

    function limpiar_form() {
            $("input[name*='id1']").val("")
            $("input[name*='nombre1']").val("")
            $("input[name*='vl_abono1']").val("")
    }

    function btn_guardar() {
        $("#submit_guardar").click()
    }

    function ver_credito(consec) {
        $("#tbodydetalle_orden").html("")
        if (consec == "credito") {
            $("#ver_credito").css("display", "block")
            limpiar_form()
            $("#tbodyabono").html("")
        }else{
            $("#ver_credito").css("display", "none")
        }
    }

    function ver_editar() {
        $(".editar").click()
        $("#ver_editar").css("display", "block")
        $("#ver_guardar").css("display", "none")
    }

    function eliminar_pedido(id) {
        $.confirm({
            title: 'Atención!',
            content: '¿ Estas seguro de que quieres eliminar el pedido número '+id+' ?',
            buttons: {
                confirm: function () {
                    if ($("#bodega").val() == 0) {
                        notificacion("Por favor seleccione la bodega.", "danger")
                        $("#bodega").focus()
                        return false
                    }
                    let values = {
                        id_orden: id,
                        tipo_venta: 'pedido',
                        bodega: $("#bodega").val()
                    }
                    $.ajax({
                        type : 'POST',
                        data: values,
                        url: '/inventarios/php/ver_orden_pedidos/eliminar.php',
                        success: function(respuesta) {
                        let obj = JSON.parse(respuesta)
                        if (obj.numero == 1) {
                            //$.alert('Confirmed!');
                            notificacion("el producto se ha eliminado exitosamente.", "success")
                            //limpiar_form()
                            ShowPedidos($("#bodega").val())
                        }else{
                            notificacion("El producto no se encuentra en la base de datos, por favor actualice la página.", "danger")
                        }
                        },
                        error: function() {
                        console.log("No se ha podido obtener la información");
                        }
                    });
                },
                cancel: function () {
                    //$.alert('Canceled!');
                }
            }
        });
    }

</script>
</body>
</html>
