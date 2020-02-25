<?php
session_start(); 
$cod = $_POST["cod"];
$parametro1 = $_POST["parametro1"];
$parametro2 = $_POST["parametro2"];
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
	CAST(fecha AS DATE) as fecha, 
	((vl_costo*(CAST(iva AS DECIMAL(5,0))))/100)*cantidad as total_iva,
	(vl_costo*cantidad) as total_costo,
	(vl_costo+((vl_costo*(CAST(iva AS DECIMAL(5,0))))/100))*cantidad as total,
	(SELECT TRIM(nombre) FROM productos WHERE productos.id = compras.id_producto) as producto,
	(SELECT TRIM(nombre) FROM proveedors WHERE proveedors.id = compras.id_proveedor) as proveedor,
	(SELECT TRIM(nombre) FROM bodegas WHERE bodegas.id = compras.bodega) as bodegas
	FROM compras WHERE bodega = $parametro2 AND compras.state = 1 order by id desc;";
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
}
$conn->close();
?>