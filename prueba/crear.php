<?php
    include ("conexion.php");
    include ("funciones.php");

    if($_POST["Operacion"] == "Crear"){
        $Imagen = '';
        if ($_FILES["Imagen_usuario"]["name"] != "") {
            $Imagen = subir_imagen();
        }
        $stmt = $con-> prepare ("INSERT INTO usuarios (Nombre, Apellido, Imagen, Telefono, Email) VALUES(:nombre, :apellidos, :imagen, :telefono, :email)");

        $resultado = $stmt->execute(
            array(
                ':nombre' => $_POST["Nombre"],
                ':apellidos' => $_POST["Apellido"],
                ':telefono' => $_POST["Telefono"],
                ':email' => $_POST["Email"],
                ':imagen' => $Imagen
            )
        );

        if(!empty($resultado)){
            echo 'Registro creado';
        }
    }
?>