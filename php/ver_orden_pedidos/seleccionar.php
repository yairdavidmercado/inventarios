<?php
session_start(); 
$cod = $_POST["cod"];
$parametro1 = $_POST["parametro1"];
$parametro2 = $_POST["parametro2"];
$parametro3 = $_POST["parametro3"];
$response = array();
include '../conexion.php';
// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$conn -> set_charset("utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($cod == '1') {
	$sql = "SELECT *,
	(SELECT nombre FROM users WHERE id = orden_pedidos.user_id) AS usuario_crea,
	CASE WHEN (SELECT nombre FROM clientes WHERE clientes.id = id_cliente LIMIT 1) IS NULL THEN 'NINGUNO' ELSE (SELECT nombre FROM clientes WHERE clientes.id = id_cliente LIMIT 1) END AS nombre, 
	CAST(reg_date AS DATE) as fecha,
    validar_despacho(id, bodega) AS validar_despacho
	FROM orden_pedidos WHERE orden_pedidos.state = 1 AND tipo_venta = '".$parametro1."' AND bodega = '".$parametro2."' AND confirmar = '".$parametro3."' order by id desc;";
	$result = $conn->query($sql);
	// output data of each row
	$response["resultado"] = array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$datos = array();

								// push single product into final response array
								array_push($response["resultado"], $row);

								
		}
		$response["success"] = true;
		echo json_encode($response);
	} else {
		$response["success"] = false;
							$response["message"] = "No se encontraron registros";
							// echo no users JSON
							echo json_encode($response);
	}
}elseif ($cod == '2') {
    $sql = "SELECT *, 
    IF((select sum(existencias.cantidad) FROM existencias WHERE existencias.id_producto = detalle_pedido.id_producto AND existencias.bodega = $parametro3 ) IS NULL, 0 ,(select sum(existencias.cantidad) FROM existencias WHERE existencias.id_producto = detalle_pedido.id_producto AND existencias.bodega = $parametro3 )-(IF ((SELECT SUM(detalle_factura.cantidad) FROM detalle_factura WHERE detalle_factura.id_producto = detalle_pedido.id_producto AND detalle_factura.state = $parametro2 AND detalle_factura.bodega = $parametro3) IS NULL, 0, (SELECT SUM(detalle_factura.cantidad) FROM detalle_factura WHERE detalle_factura.id_producto = detalle_pedido.id_producto AND detalle_factura.state = $parametro2 AND detalle_factura.bodega = $parametro3)))) as existencias,
    (SELECT iva FROM productos WHERE productos.id = detalle_pedido.id_producto) AS iva, (SELECT nombre FROM productos WHERE productos.id = detalle_pedido.id_producto) AS nombre_producto, CAST(reg_date AS DATE) as fecha 
    FROM detalle_pedido WHERE id_orden_pedidos = $parametro1 AND state = $parametro2 order by id desc;";
    $result = $conn->query($sql);
    // output data of each row
    $response["resultado"] = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $datos = array();

                                // push single product into final response array
                                array_push($response["resultado"], $row);

                                
        }
        $response["success"] = true;
        echo json_encode($response);
    } else {
        $response["success"] = false;
        $response["message"] = "No se encontraron registros";
        // echo no users JSON
        echo json_encode($response);
    }
    //termina cod 1
}elseif ($cod == '3') {
    $sql = "SELECT *, (SELECT iva FROM productos WHERE productos.id = detalle_pedido.id_producto) AS iva, (SELECT nombre FROM productos WHERE productos.id = detalle_pedido.id_producto) AS nombre_producto, CAST(reg_date AS DATE) as fecha 
    FROM detalle_pedido WHERE id_orden_pedidos = $parametro1 AND state = $parametro2 order by id desc;";
    $result = $conn->query($sql);
    // output data of each row
    $response["resultado"] = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $datos = array();

                                // push single product into final response array
                                array_push($response["resultado"], $row);

                                
        }
        $response["success"] = true;
        echo json_encode($response);
    } else {
        $response["success"] = false;
        $response["message"] = "No se encontraron registros";
        // echo no users JSON
        echo json_encode($response);
    }
    //termina cod 1
}
$conn->close();
?>