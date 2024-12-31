<?php
    include("conexion.php");
    include("funciones.php");

    if (isset($_POST["Id_usuario"])) {
        $salida = array();
        $stmt = $con->prepare("SELECT * FROM usuarios WHERE Id = :Id_usuario LIMIT 1");
        $stmt->bindParam(':Id_usuario', $_POST["Id_usuario"], PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetch();

        if ($resultado) {
            $salida["nombre"] = $resultado["Nombre"];
            $salida["apellido"] = $resultado["Apellido"];
            $salida["telefono"] = $resultado["Telefono"];
            $salida["email"] = $resultado["Email"];
            
            // Si tiene imagen, incluirla en el JSON
            if ($resultado["Imagen"] != "") {
                $salida["Imagen_usuario"] = '<img src="img/' . $resultado["Imagen"] . '" class="img-thumbnail" width="100" height="50" /><input type="hidden" name="imagen_usuario_oculta" value="' . $resultado["Imagen"] . '"/>';
            } else {
                $salida["Imagen_usuario"] = '<input type="hidden" name="imagen_usuario_oculta" value=""/>';
            }
        }

        echo json_encode($salida); 
    }

?>