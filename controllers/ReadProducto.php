<?php
    require_once "../db.php";
    require_once "../models/Producto.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        header('Content-Type: application/json');
        $idProducto = $_POST["idProducto"];
        $productos = new Producto(0, "", 0, "", date("y-m-d H:i:s"), 0);
        $result = $productos->ReadProducto($idProducto);
        echo json_encode($result);
    }
?>