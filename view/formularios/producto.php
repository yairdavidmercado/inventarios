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
    <section class="container py-4">
        <div class="row">
            <div class="col-md-12">
                <ul id="tabs" class="nav nav-tabs">
                    <li class="nav-item"><a href="" data-target="#home1" data-toggle="tab" class="nav-link small text-uppercase active">Productos</a></li>
                    <li class="nav-item"><a href="" data-target="#profile1" data-toggle="tab" class="nav-link small text-uppercase">Categorías</a></li>
                    <!-- <li class="nav-item"><a href="" data-target="#messages1" data-toggle="tab" class="nav-link small text-uppercase">Messages</a></li> -->
                </ul>
                <br>
                <div id="tabsContent" class="tab-content">
                    <div id="home1" class="tab-pane fade active show">
                        <div class="row">
                            <div class="mx-auto col-sm-12">
                                <!-- form user info -->
                                <div id="ver_editar" style="display:none" class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">Editar producto</h5>
                                    </div>
                                    <div class="card-body">
                                        <form name="editar_producto" class="form" role="form" id="form_actualizar" role="form" onsubmit="event.preventDefault(); return actualizar_productos();" autocomplete="off">
                                            <div class="container">
                                                <div class="row">
                                                    <div style="display:none" class="col-sm-12">
                                                        <div class="form-group">
                                                            <input maxlength="255" ref="id" class="form-control form-control-sm" id="id1" name="id1" type="text" placeholder="id">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <input maxlength="255" ref="nombre" class="form-control form-control-sm" id="nombre1" name="nombre1" type="text" placeholder="Nombre">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input maxlength="20" class="form-control form-control-sm" id="vl_costo1" name="vl_costo1" onKeyUp="calcular()" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" type="text" placeholder="Valor de costo">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <input class="form-control form-control-sm" id="iva1" name="iva1" onKeyUp="calcular()" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" v-int type="text" placeholder="IVA">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <input class="form-control form-control-sm" disabled id="valor_iva1" name="valor_iva1" type="text" placeholder="Valor IVA">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input class="form-control form-control-sm" disabled id="total_costo1" name="total_costo1" type="text" placeholder="Total costo">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input class="form-control form-control-sm" id="vl_venta1" name="vl_venta1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" type="text" placeholder="Valor de venta">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <select ref="select" required class="form-control form-control-sm id_categoria" id="id_categoria1" name="id_categoria1">
                                                                <option value="">Seleccione el categoría</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <select ref="select" required class="form-control form-control-sm id_proveedor" id="id_proveedor1" name="id_proveedor1">
                                                                <option value="">Seleccione el proveedor</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <select class="form-control form-control-sm" id="state1" name="state1" >
                                                            <option value="">Estado</option>
                                                            <option value="1">ACTIVO</option>
                                                            <option value="0">INACTIVO</option>
                                                        </select>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-success" type="submit">Guardar</button>
                                                    <button class="btn btn-primary" type="button" onclick="ver_guardar()">Nuevo</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="ver_guardar" class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">Crear producto</h5>
                                    </div>
                                    <div class="card-body">
                                        <form name="crear_producto" class="form" role="form" id="form_guardar" role="form" onsubmit="event.preventDefault(); return guardar_productos();" autocomplete="off">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <input maxlength="255" ref="nombre" class="form-control form-control-sm" required name="nombre" type="text" placeholder="Nombre">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input maxlength="20" class="form-control form-control-sm" onKeyUp="calcular()" required name="vl_costo" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" type="text" placeholder="Valor de costo">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <input class="form-control form-control-sm" onKeyUp="calcular()" required name="iva" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" v-int type="text" placeholder="IVA">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <input class="form-control form-control-sm disabled" name="valor_iva" disabled type="text" placeholder="Valor IVA">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input class="form-control form-control-sm disabled" name="total_costo" disabled type="text" placeholder="Total costo">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input class="form-control form-control-sm" required name="vl_venta" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" type="text" placeholder="Valor de venta">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <select ref="select" required class="form-control form-control-sm id_categoria" name="id_categoria">
                                                                <option value="">Seleccione el categoría</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <select ref="select" required class="form-control form-control-sm id_proveedor" name="id_proveedor">
                                                                <option value="">Seleccione el proveedor</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-primary" type="submit">Guardar</button>
                                                    <button class="btn btn-danger" type="button" onclick="ver_guardar()">Limpiar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- /form user info -->
                            </div>
                            <div class="col-sm-12 py-4">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <select ref="select" onchange="Showproducto(this.value)" required class="form-control form-control-sm id_bodegas" id="bodega" name="bodega">
                                                    <option value="">Seleccione el bodegas</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header">
                                        <h5 class="mb-0">Productos</h5>
                                    </div>
                                    <div class="card-body table-responsive-sm">
                                        <table class="table" id="example" style="width:100%;font-size:11px">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th style="display:none" scope="col">Id</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Valor costo</th>
                                                    <th scope="col">Valor Venta</th>
                                                    <th scope="col">IVA</th>
                                                    <th scope="col">Total costo</th>
                                                    <th scope="col">Categoría</th>
                                                    <th scope="col">Proveedor</th>
                                                    <th scope="col">Cantidad</th>
                                                    <th scope="col">Fecha</th>
                                                    <th style="display:none" scope="col">vl IVA</th>
                                                    <th style="display:none" scope="col">id Categoría</th>
                                                    <th style="display:none" scope="col">id Proveedor</th>
                                                    <th style="display:none" scope="col">Perfil</th>
                                                    <th style="display:none" scope="col">Estado</th>
                                                    <th scope="col">Bodega</th>
                                                    <th style="width:10px" scope="col"></th>
                                                    <th style="width:10px" scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbodytable">
                                                <!-- <tr>
                                                    <td>{{item.nit}}</td>
                                                    <td>{{item.nombre}}</td>
                                                    <td>{{item.direccion}}</td>
                                                    <td>{{item.telefono}}</td>
                                                    <td>{{item.email}}</td>
                                                    <td class="editar"><button class="btn btn-warning btn-sm" onclick="ver_editar()" >Editar</button></td>
                                                    <td ><button class="btn btn-danger btn-sm">x</button></td>
                                                </tr> -->
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
                                                        <div class="col-sm-3">
                                                            <label for="">Id producto</label>
                                                            <div class="form-group">
                                                            <input maxlength="20" class="form-control form-control-sm" disabled required name="modal_id1" id="modal_id1" type="text" placeholder="id">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <label for="">Nombre producto</label>
                                                            <div class="form-group">
                                                            <input maxlength="20" class="form-control form-control-sm" disabled name="modal_nombre" id="modal_nombre" type="text" placeholder="Cantidad existente">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <label for="">Cantidad existente</label>
                                                            <div class="form-group">
                                                                <input maxlength="20" class="form-control form-control-sm" required name="modal_cantidad" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" type="text" placeholder="Cantidad existente">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                        </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="profile1" class="tab-pane fade">
                    <div class="row">
                        <div class="col-sm-3">
                            <!-- form user info -->
                            <div id="ver_editar_categoria" style="display:none" class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Editar categoria</h5>
                                </div>
                                <div class="card-body">
                                    <form class="form" id="form_actualizar_categoria" role="form" onsubmit="event.preventDefault(); return actualizar_categoria();" autocomplete="off">
                                        <div class="container">
                                        <div style="display:none" class="form-group">
                                                <input class="form-control form-control-sm" name="id1_categoria" id="id1_categoria" type="text" placeholder="identificación">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control form-control-sm" required name="nombre1_categoria" id="nombre1_categoria" type="text" placeholder="Nombre">
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control form-control-sm" name="state1_categoria" id="state1_categoria" >
                                                    <option value="">Estado</option>
                                                    <option value="1">ACTIVO</option>
                                                    <option value="0">INACTIVO</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-success" type="submit">guardar</button>
                                                <button class="btn btn-primary" type="button" onclick="ver_guardar_categoria()">Nuevo</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="ver_guardar_categoria" class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Crear categoría</h5>
                                </div>
                                <div class="card-body">
                                    <form class="form" id="form_guardar_categoria" role="form" methods="POST" onsubmit="event.preventDefault(); return guardar_categoria();" autocomplete="off">
                                        <div class="container">
                                            <div class="form-group">
                                                <input class="form-control form-control-sm" required name="nombre_categoria" type="text" placeholder="Nombre">
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary" type="submit">Agregar</button>
                                                <button class="btn btn-danger" type="button" @click="limpiarcategoria()">Limpiar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /form user info -->
                        </div>
                        <div class="col-sm-9">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">categoría</h5>
                                </div>
                                <div class="card-body table-responsive">
                                    <table class="table" id="example_categoria" style="width:100%; font-size:11px">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">id</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Fecha</th>
                                                <th style="width:10px" scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodytable_categoria">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    </div>
                    <div id="messages1" class="tab-pane fade">
                        <div class="row pb-2">
                            <div class="col-md-7">
                                <p>Tabs can be used to contain a variety of content &amp; elements. They are a good way to group <a href="" class="link">relevant content</a>. Display initial content in context to the user. Enable the user to flow through
                                    <a href="" class="link">more</a> information as needed.
                                </p>
                            </div>
                            <div class="col-md-5"><img src="//dummyimage.com/1005x559.png/5fa2dd/ffffff" class="float-right img-fluid img-rounded"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<script src="../../assets/js/jquery.slim.min.js" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/jquery.slim.min.js"><\/script>')</script>
    <script src="../../assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="/inventarios/assets/js/bootstrap-notify.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
$(function() {
        permisos("productos")
        Showcategoria()
        buscar_bodegas()
        buscar_categorias()
        buscar_proveedores()
        console.log( "index!" );
  });

    function guardar_productos() {
        if ($("#bodega").val().length == 0) {
            notificacion("Por favor seleccione la bodega.", "danger")
            $("#bodega").focus()
            return false
        }
      $.ajax({
        type : 'POST',
        data: $("#form_guardar").serialize(),
        url: '/inventarios/php/producto/guardar.php',
        success: function(respuesta) {
          let obj = JSON.parse(respuesta)
          if (obj.success) {
            notificacion("El producto ha sido guardado exitosamente.", "success")
            limpiar_form()
            Showproducto($("#bodega").val())
            $("input[name*='nombre']").focus()
          }else{
            alert('Datos invalidos para el acceso')
          }
        },
        error: function() {
          console.log("No se ha podido obtener la información");
        }
      });
      
    }

    function guardar_existencias() {
        if ($("#bodega").val().length == 0) {
            notificacion("Por favor seleccione la bodega.", "danger")
            $("#bodega").focus()
            return false
        }
        $.ajax({
            type : 'POST',
            data: $("#form_existencias").serialize()+"&modal_id="+$("input[name*='modal_id']").val()+"&bodega="+$("#bodega").val(),
            url: '/inventarios/php/producto/guardar_cantidad.php',
            success: function(respuesta) {
            let obj = JSON.parse(respuesta)
            if (obj.success) {
                notificacion("Se ha agregado una existencia al producto selenccionado.", "success")
                Showproducto($("#bodega").val())
                $(".close").click()
                $("input[name*='modal_cantidad']").val("")
            }else{
                alert('Datos invalidos para el acceso')
            }
            },
            error: function() {
            console.log("No se ha podido obtener la información");
            }
        });
      
    }

    function actualizar_productos() {
      $.ajax({
        type : 'POST',
        data: $("#form_actualizar").serialize(),
        url: '/inventarios/php/producto/actualizar.php',
        success: function(respuesta) {
          let obj = JSON.parse(respuesta)
          if (obj.success) {
            notificacion("El producto ha sido actualizado exitosamente.", "success")
            //limpiar_form()
            Showproducto($("#bodega").val())
            $("input[name*='nit1']").focus()
          }else{
            alert('Datos invalidos para el acceso')
          }
        },
        error: function() {
          console.log("No se ha podido obtener la información");
        }
      });
      
    }

    function Showproducto(bodega) {
        let values = { 
            cod: "1",
            parametro1: "1",
            parametro2: bodega
        }; 
        $.ajax({
        type : 'POST',
        data: values,
        url: '/inventarios/php/producto/seleccionar.php',
        beforeSend: function() {
            //$(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
        //$(".loader").css("display", "none")
        let obj = JSON.parse(respuesta)
        $("#example").dataTable().fnDestroy();
        let fila = ''
        $.each(obj.resultado, function( index, val ) {
            fila += '<tr>'+
                        '<td style="display:none">'+val.id+'</td>'+
                        '<td>'+val.nombre+'</td>'+
                        '<td>'+parseInt(val.vl_costo).toFixed(0)+'</td>'+
                        '<td>'+parseInt(val.vl_venta).toFixed(0)+'</td>'+
                        '<td>'+parseInt(val.total_iva).toFixed(0)+'</td>'+
                        '<td>'+parseInt(val.total_costo).toFixed(0)+'</td>'+
                        '<td>'+val.categoria+'</td>'+
                        '<td>'+val.proveedor+'</td>'+
                        '<td>'+val.cantidad+'</td>'+
                        '<td>'+val.fecha+'</td>'+
                        '<td style="display:none">'+val.iva+'</td>'+
                        '<td style="display:none">'+val.id_categoria+'</td>'+
                        '<td style="display:none">'+val.id_proveedor+'</td>'+
                        '<td style="display:none">'+val.perfil+'</td>'+
                        '<td style="display:none">'+val.state+'</td>'+
                        '<td>'+bodega+'</td>'+
                        '<td class="editar"><button class="btn btn-warning btn-sm" onclick="ver_editar()" >Editar</button></td>'+
                        '<td class="cantidad" ><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter" >Stock</button></td>'+
                    '</tr>'
        });
        $("#tbodytable").html(fila)
        $('#example').DataTable({
            "ordering": false,
            "paging": false
        });

            $(".editar").click(function() {
                var valores=[];
    
                // Obtenemos todos los valores contenidos en los <td> de la fila
                // seleccionada
                $(this).parents("tr").find("td").each(function(){
                    valores.push($(this).html());
                });
                $("#nombre1").focus()
                $("#id1").val(valores[0])
                $("#nombre1").val(valores[1])
                $("#vl_costo1").val(valores[2])
                $("#vl_venta1").val(valores[3])
                $("#iva1").val(valores[10])
                $("#id_categoria1").val(valores[11])
                $("#id_proveedor1").val(valores[12])
                $("#perfil1").val(valores[13])
                $("#state1").val(valores[14])
                calcular()
            })
        
            $(".cantidad").click(function() {
                var valores=[];
    
                // Obtenemos todos los valores contenidos en los <td> de la fila
                // seleccionada
                $(this).parents("tr").find("td").each(function(){
                    valores.push($(this).html());
                });
                $("#modal_id1").val(valores[0])
                $("#modal_nombre").val(valores[1])

            })
        },
        error: function() {
        //$(".loader").css("display", "")
        console.log("No se ha podido obtener la información");
        }
    });
    
  }

    function limpiar_form() {
            $("input[name*='nombre1']").val("")
            $("input[name*='vl_costo1']").val("")
            $("input[name*='vl_venta1']").val("")
            $("input[name*='iva1']").val("19")
            $("select[name*='id_categoria1']").val("")
            $("select[name*='id_proveedor1']").val("")
            $("select[name*='perfil1']").val("")
            $("select[name*='state1']").val("")
    }

    function ver_guardar() {
        $("#ver_guardar").css("display", "block")
        $("#ver_editar").css("display", "none")
    }

    function ver_editar() {
        $(".editar").click()
        $("#ver_editar").css("display", "block")
        $("#ver_guardar").css("display", "none")
    }

    function calcular() {
        let vl_costo = document.crear_producto.vl_costo.value;
        let iva = document.crear_producto.iva.value;

        let vl_costo1 = document.editar_producto.vl_costo1.value;
        let iva1 = document.editar_producto.iva1.value;
        try{
            //Calculamos el número escrito:
            vl_costo = (isNaN(parseInt(vl_costo)))? 0 : parseInt(vl_costo);
            iva = (isNaN(parseInt(iva)))? 0 : parseInt(iva);
            document.crear_producto.valor_iva.value = ((vl_costo*iva)/100).toFixed(0);
            document.crear_producto.total_costo.value = (((vl_costo*iva)/100)+vl_costo).toFixed(0);

            vl_costo1 = (isNaN(parseInt(vl_costo1)))? 0 : parseInt(vl_costo1);
            iva1 = (isNaN(parseInt(iva1)))? 0 : parseInt(iva1);
            document.editar_producto.valor_iva1.value = ((vl_costo1*iva1)/100).toFixed(0);
            document.editar_producto.total_costo1.value = (((vl_costo1*iva1)/100)+vl_costo1).toFixed(0);
        }
        //Si se produce un error no hacemos nada
        catch(e) {}
    }

    function format_number(param) {
       let number = new Intl.NumberFormat().format(param)
       return number
    }

//---------------------------------

function guardar_categoria() {
      $.ajax({
        type : 'POST',
        data: $("#form_guardar_categoria").serialize(),
        url: '/inventarios/php/categoria/guardar.php',
        success: function(respuesta) {
          let obj = JSON.parse(respuesta)
          if (obj.success) {
            notificacion("El categoria ha sido guardado exitosamente.", "success")
            limpiar_form()
            Showcategoria()
            $("input[name*='identificacion']").focus()
          }else{
            alert('Datos invalidos para el acceso')
          }
        },
        error: function() {
          console.log("No se ha podido obtener la información");
        }
      });
      
    }

    function actualizar_categoria() {
      $.ajax({
        type : 'POST',
        data: $("#form_actualizar_categoria").serialize(),
        url: '/inventarios/php/categoria/actualizar.php',
        success: function(respuesta) {
          let obj = JSON.parse(respuesta)
          if (obj.success) {
            notificacion("El categoria ha sido actualizado exitosamente.", "success")
            //limpiar_form()
            Showcategoria()
            $("input[name*='identificacion1']").focus()
          }else{
            alert('Datos invalidos para el acceso')
          }
        },
        error: function() {
          console.log("No se ha podido obtener la información");
        }
      });
      
    }

    function Showcategoria() {
        let values = { 
            cod: "1",
            state: 1,
        }; 
        $.ajax({
        type : 'POST',
        data: values,
        url: '/inventarios/php/categoria/seleccionar.php',
        beforeSend: function() {
            //$(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
        //$(".loader").css("display", "none")
        let obj = JSON.parse(respuesta)
        $("#example_categoria").dataTable().fnDestroy();
        let fila = ''
        $.each(obj.resultado, function( index, val ) {
            fila += '<tr>'+
                        '<td>'+val.id+'</td>'+
                        '<td>'+val.nombre+'</td>'+
                        '<td>'+val.state+'</td>'+
                        '<td>'+val.reg_date+'</td>'+
                        '<td class="editar_categoria"><button class="btn btn-warning btn-sm" onclick="ver_editar_categoria()" >Editar</button></td>'+
                    '</tr>'
        });
        $("#tbodytable_categoria").html(fila)
        $('#example_categoria').DataTable({
            "ordering": false,
            "paging": false
        });

        $(".editar_categoria").click(function() {
            var valores=[];
 
            // Obtenemos todos los valores contenidos en los <td> de la fila
            // seleccionada
            $(this).parents("tr").find("td").each(function(){
                valores.push($(this).html());
            });
            $("#id1_categoria").val(valores[0])
            $("#nombre1_categoria").val(valores[1])
            $("#state1_categoria").val(valores[2])
        })
            //$('#example_categoria').DataTable().ajax.reload();
        },
        error: function() {
        //$(".loader").css("display", "")
        console.log("No se ha podido obtener la información");
        }
    });
    
  }

    function limpiar_form() {
        $("input[name*='nombre_categoria']").val("")
    }

    function ver_guardar_categoria() {
        $("#ver_guardar_categoria").css("display", "block")
        $("#ver_editar_categoria").css("display", "none")
    }

    function ver_editar_categoria() {
        $(".editar_categoria").click()
        $("#ver_editar_categoria").css("display", "block")
        $("#ver_guardar_categoria").css("display", "none")
    }
</script>
</body>
</html>
