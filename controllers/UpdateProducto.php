<?php
    require_once "../db.php";
    require_once "../models/Producto.php";
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idProducto = $_POST["id"];
        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];
        $descripcion = $_POST["descripcion"];

        $producto = new Producto($idProducto, $nombre, $precio, $descripcion, date("y-m-d H:i:s"), 0);
        $producto->UpdateProducto();
    }
?>