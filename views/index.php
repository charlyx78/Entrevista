<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="../styles/index.css">
</head>
<body>
    <form id="formProducto" name="formProducto" method="post">
        <button id="btnModoEdicion" style="margin-bottom: 2em;" hidden>Salir del modo edicion</button>
        <div class="campo">
            <input type="number" id="id" name="id" placeholder="Id" hidden readonly>
        </div>
        <div class="campo">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div class="campo">
            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" required>
        </div>
        <div class="campo">
            <label for="descripcion">Descripcion</label>
            <textarea type="text" id="descripcion" name="descripcion"></textarea>
        </div>
        <div class="campo">
            <button type="submit" id="btnGuardar">Guardar</button>
        </div>
    </form>

    <table cellpadding="10px">
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Descripcion</th>
            <th>Fecha de registro</th>
            <th></th>
            <th></th>
        </tr>
        <tbody id="tablaProductos"></tbody>
    </table>


    <script src="../scripts/jquery-3.7.1.min.js"></script>
    <script src="../scripts/index.js"></script>
</body>
</html>