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


    if($_POST["Operacion"] == "Editar"){
        $Imagen = '';
        if ($_FILES["Imagen_usuario"]["name"] != "") {
            $Imagen = subir_imagen();
        } else {
            $Imagen = $_POST["imagen_usuario_oculta"];
        }
        $stmt = $con-> prepare ("UPDATE usuarios SET Nombre=:nombre, Apellido=:apellidos, Imagen=:imagen, Telefono=:telefono, Email=:email WHERE Id=:id");

        $resultado = $stmt->execute(
            array(
                ':nombre' => $_POST["Nombre"],
                ':apellidos' => $_POST["Apellido"],
                ':telefono' => $_POST["Telefono"],
                ':email' => $_POST["Email"],
                ':imagen' => $Imagen,
                ':id' => $_POST["Id_usuario"],
            )
        );

        if(!empty($resultado)){
            echo 'Registro Actualizado';
        }
    }
?>