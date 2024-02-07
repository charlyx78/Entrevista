const tabla = $("#tablaProductos");

var isEditando = false;

getProductos();

$("form[name='formProducto']").on("submit", function(e) {
    e.preventDefault();

    var $form = $(this);

    let urlController = isEditando ? "../controllers/UpdateProducto.php" : "../controllers/AddProducto.php";

    $.ajax({
        method: "post",
        url: urlController,
        data: $('#formProducto').serialize(), 
        success: function(response) {
            alert('Producto guardado exitosamente');
            getProductos();
            $('#nombre').val('');
            $('#precio').val('');
            $('#descripcion').val('');
            isEditando = false;
            $('#id').hide()
        },
        error: function(error) {
            console.log(error);
        }
    })
})    


function getProductos() {
    $.ajax({
        method: "post",
        url: "../controllers/ReadProducto.php",
        data: {'idProducto': 0}, 
        success: function(response) {
            console.log(response)
            printProductos(response);
            removeProducto();
            getProductoById();
        },
        error: function(error) {
            console.log(error);
        }
    })
}

function printProductos(productos) {
    tabla.html('');
    productos.forEach(p => {
        tabla.append(`
            <tr>
                <td>${p.nombre}</td>
                <td>$ ${p.precio}</td>
                <td>${p.descripcion}</td>
                <td>${p.fechaRegistro}</td>
                <td><button data-idproducto="${p.id}" class="editar">Editar</button></td>
                <td><button data-idproducto="${p.id}" class="eliminar">Eliminar</button></td>
            </tr>
        `);
    });
}

function removeProducto() {
    $('.eliminar').click(function() {
        let idProducto = $(this).data('idproducto'); 
    
        if(confirm('Estas seguro de eliminar este producto?')) {
            $.ajax({
                method: "post",
                data: {'idProducto': idProducto}, 
                url: "../controllers/DeleteProducto.php",
                success: function(response) {
                    alert('Producto eliminado exitosamente');
                    getProductos();
                },
                error: function(error) {
                    alert(error);
                }
            })
        }
    })
}

$('#btnModoEdicion').click(function(e) {
    isEditando = false;
    $('#id').val('');
    $('#id').hide();
    $('#nombre').val('');
    $('#precio').val('');
    $('#descripcion').val('');
    $('#btnModoEdicion').hide()
})


function getProductoById() {
    $('.editar').click(function(){
        let idProducto = $(this).data('idproducto');
        $.ajax({
            method: "post",
            url: "../controllers/ReadProducto.php",
            data: {'idProducto': idProducto}, 
            success: function(response) {
                window.scrollTo(0,0)
                $('#id').val(response[0].id)
                $('#nombre').val(response[0].nombre)
                $('#precio').val(response[0].precio)
                $('#descripcion').val(response[0].descripcion)
                isEditando = true;
                $('#id').show()
                $('#btnModoEdicion').show()
            },
            error: function(error) {
                console.log(error);
            }
        })
    })
}
