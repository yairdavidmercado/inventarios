<?php
session_start(); 
$id_orden = $_POST["id"];
$total = $_POST["total"];
$sub_total = $_POST["sub_total"];
$iva = $_POST["iva"];
$tipo_venta = $_POST["tipo_venta"];
$bodega = $_POST["bodega"];
$user_id = $_SESSION["idUser"];

$response = array();
include '../../php/conexion.php';
// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT despachar('".$id_orden."', '".$iva."', '".$sub_total."', '".$total."', '".$tipo_venta."', '".$bodega."', '".$user_id."');";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $row_cnt = $result->num_rows;
    if ($row_cnt > 0) {
        $response["success"] = true;
        $response["numero"] = implode(',', $row);
        echo json_encode($response);
        
    } else {
        $response["success"] = false;
                $response["message"] = "No se guardó la información.";
                echo json_encode($response);
    }
}

$conn->close();
?>