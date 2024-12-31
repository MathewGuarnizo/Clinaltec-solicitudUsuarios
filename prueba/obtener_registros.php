<?php

include("conexion.php");
include("funciones.php");

$query = "SELECT * FROM usuarios ";

if (isset($_POST["search"]["value"])) {
    $query .= "WHERE Nombre LIKE '%" . $_POST["search"]["value"] . "%' OR Apellido LIKE '%" . $_POST["search"]["value"] . "%' ";
}

if (isset($_POST["order"])) {
    $column = $_POST["order"][0]["column"];
    $dir = $_POST["order"][0]["dir"];
    $query .= "ORDER BY " . $column . " " . $dir . " ";
} else {
    $query .= "ORDER BY Id DESC ";
}

if ($_POST["length"] != -1) {
    $query .= "LIMIT " . $_POST["start"] . "," . $_POST["length"];
}

$stmt = $con->prepare($query);
$stmt->execute();
$resultado = $stmt->fetchAll();
$datos = array();
$filtered_rows = $stmt->rowCount();

foreach ($resultado as $fila) {
    $imagen = "";
    if ($fila["Imagen"] != '') {
        $imagen = '<img src="img/' . $fila["Imagen"] . '" class="img-thumbnail" width="50" height="35" />';
    } else {
        $imagen = '';
    }

    $sub_array = array();
    $sub_array[] = $fila["Id"];
    $sub_array[] = $fila["Nombre"];
    $sub_array[] = $fila["Apellido"];
    $sub_array[] = $fila["Telefono"];
    $sub_array[] = $fila["Email"];
    $sub_array[] = $imagen;
    $sub_array[] = $fila["Fecha"];
    $sub_array[] = '<button type="button" name="editar" Id="' . $fila["Id"] . '" data-bs-toggle="modal" data-bs-target="#" class="btn btn-warning btn-sx edita"> Editar </button>';
    $sub_array[] = '<button type="button" name="borrar" Id="' . $fila["Id"] . '" class="btn btn-danger btn-sx edita"> Borrar </button>';

    $datos[] = $sub_array;
}

$salida = array(
    "draw" => intval($_POST["draw"]),
    "recordsTotal" => $filtered_rows,
    "recordsFiltered" => obtener_todos_registros(),
    "data" => $datos
);

header('Content-Type: application/json');
echo json_encode($salida, JSON_UNESCAPED_UNICODE);
exit;
