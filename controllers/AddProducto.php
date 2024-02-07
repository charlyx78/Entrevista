<?php
    require_once "../db.php";
    require_once "../models/Producto.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];
        $descripcion = $_POST["descripcion"];

        $producto = new Producto(0, $nombre, $precio, $descripcion, date("y-m-d H:i:s"), 0);
        $producto->AddProducto();
    }
?>