<?php
session_start(); 
$id = $_POST["id1"];
$id_proveedor = $_POST["id_proveedor"];
$fecha = $_POST["fecha"];
$factura_compra = $_POST["factura_compra"];
$id_producto = $_POST["id_producto"];
$vl_costo = $_POST["vl_costo"];
$iva = $_POST["iva"];
$vl_venta = $_POST["vl_venta"];
$cantidad = $_POST["cantidad"];
$bodega = $_POST["bodega"];
$user_id = $_SESSION["idUser"];
$state = "1";

$response = array();
include '../../php/conexion.php';
// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CALL actualizar_compras(".$id.",'".$id_proveedor."', '".$fecha."', '".$factura_compra."','".$id_producto."', '".$vl_costo."', '".$iva."', '".$vl_venta."','".$cantidad."','".$bodega."','".$user_id."','".$state."');";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $row_cnt = $result->num_rows;
    if ($row_cnt > 0) {
        $response["success"] = true;
        $response["message"] = "Su compra ha sido registrado con el numero: ".$row["id1"];
        $response["numero"] = $row["id1"];
        echo json_encode($response);
        
    } else {
        $response["success"] = false;
                $response["message"] = "No se guardó la información.";
                echo json_encode($response);
    }
}

$conn->close();
?>