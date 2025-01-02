<?php 
    include ("conexion.php");
    include ("funciones.php");
    
    if(isset($_POST["Id_usuario"])) {
        $Id_usuario = $_POST["Id_usuario"];
        $Imagen = obtener_nombre_imagen($Id_usuario);
        
        if ($Imagen != "") {
            $imagen_path = "img/" . $Imagen;
            if (file_exists($imagen_path)) {
                unlink($imagen_path); 
            }
        }
        
        $stmt = $con->prepare("DELETE FROM usuarios WHERE Id = :id");
        $resultado = $stmt->execute([':id' => $Id_usuario]);
    
        if ($resultado) {
            echo 'Registro Borrado';
        } else {
            echo 'Error al borrar el registro';
        }
    }
    

?>