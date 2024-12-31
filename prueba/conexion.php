<?php 

    $usuario = 'root';
    $password = '';
    $name = 'crud_usuarios';
    

try {
    $con = new PDO ("mysql:host=localhost;dbname=".$name, $usuario, $password);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>