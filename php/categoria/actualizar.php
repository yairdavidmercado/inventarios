<?php
session_start();
$id = $_POST["id1_categoria"];
$nombre = utf8_decode($_POST["nombre1_categoria"]);
$user_id = $_SESSION["idUser"];
$state = $_POST["state1_categoria"];

$response = array();
include '../../php/conexion.php';
// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CALL actualizar_categorias('".$id."', '".$nombre."', '".$user_id."','".$state."');";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $row_cnt = $result->num_rows;
    if ($row_cnt > 0) {
        $response["success"] = true;
        $response["message"] = "Su categoria ha sido registrado con el numero: ".$row["id1"];
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