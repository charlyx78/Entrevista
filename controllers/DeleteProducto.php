<?php
    require_once "../db.php";
    require_once "../models/Producto.php";
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idProducto = $_POST["idProducto"];
        $producto = new Producto(0, "", 0, "", date("y-m-d H:i:s"), 0);
        $producto->DeleteProducto($idProducto);
    }
?>