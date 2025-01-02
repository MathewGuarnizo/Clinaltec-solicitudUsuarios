<?php  

    function subir_imagen(){
        if(isset($_FILES["Imagen_usuario"])){

            $extension = explode('.', $_FILES["Imagen_usuario"]["name"]);
            $nuevo_nombre = rand() . '.' . $extension[1];
            $ubicacion = './img/' . $nuevo_nombre;
            move_uploaded_file($_FILES["Imagen_usuario"]["tmp_name"], $ubicacion);
            return $nuevo_nombre;
        }
    }

    function obtener_nombre_imagen($Id_usuario){
        include('conexion.php');
        $stmt = $con->prepare("SELECT Imagen FROM usuarios WHERE Id = :id");
        $stmt->bindParam(':id', $Id_usuario);
        $stmt->execute();
        $resultado = $stmt->fetch();
        return $resultado['Imagen'];
    }

    function obtener_todos_registros(){
        include('conexion.php');
        $stmt = $con->prepare("SELECT * FROM usuarios");
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        return $stmt->rowCount();
    }
    



?>