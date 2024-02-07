<?php 
    class Producto {
        private $id;
        private $nombre;
        private $precio;
        private $descripcion;
        private $fechaRegistro;
        private $activo;

        public function __construct($id, $nombre, $precio, $descripcion, $fechaRegistro, $activo) {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->precio = $precio;
            $this->descripcion = $descripcion;
            $this->fechaRegistro = $fechaRegistro;
            $this->activo = $activo;
        }

        function AddProducto() {
            try {
                $mysqli = db::connect();
                $sql = "CALL SP_GestionProducto(?,?,?,?,?,?,?)";
                $statement = $mysqli->prepare($sql);
        
                $opcion = "I";
                $statement->bind_param(
                    "isissis",
                    $this->id,
                    $this->nombre,
                    $this->precio,
                    $this->descripcion,
                    $this->fechaRegistro,
                    $this->activo,
                    $opcion
                );

                $statement->execute();

                return "Producto agregado exitosamente.";
            }
            catch(Exception $exc) {
                return "Error al agregar un producto.";
            }
        }

        function ReadProducto($idProducto) {
            try {
                $mysqli = db::connect();
                $sql = "CALL SP_GestionProducto(?,?,?,?,?,?,?)";
                $statement = $mysqli->prepare($sql);
        
                $idProducto == 0 ? $opcion = "SA" : $opcion = "SID";

                $statement->bind_param(
                    "isissis",
                    $idProducto,
                    $this->nombre,
                    $this->precio,
                    $this->descripcion,
                    $this->fechaRegistro,
                    $this->activo,
                    $opcion
                );
                $statement->execute();

                $result = $statement->get_result(); 

                $productos = array();

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $producto = $row;
                        $productos[] = $producto;
                    }
                    return $productos;
                }
            }
            catch(Exception $exc) {
                return "Error al obtener los productos.";
            }
        }

        function UpdateProducto() {
            try {
                $mysqli = db::connect();
                $sql = "CALL SP_GestionProducto(?,?,?,?,?,?,?)";
                $statement = $mysqli->prepare($sql);

                $opcion = "U";
                $statement->bind_param(
                    "isissis",
                    $this->id,
                    $this->nombre,
                    $this->precio,
                    $this->descripcion,
                    $this->fechaRegistro,
                    $this->activo,
                    $opcion
                );
                $statement->execute();
            }
            catch(Exception $exc){
                return "Error al editar el producto.";
            }
        }

        function DeleteProducto($idProducto) {
            try {
                $mysqli = db::connect();
                $sql = "CALL SP_GestionProducto(?,?,?,?,?,?,?)";
                $statement = $mysqli->prepare($sql);

                $opcion = "D";
                $statement->bind_param(
                    "isissis",
                    $idProducto,
                    $this->nombre,
                    $this->precio,
                    $this->descripcion,
                    $this->fechaRegistro,
                    $this->activo,
                    $opcion
                );
                $statement->execute();

                return "Producto editado exitosamente.";

            }
            catch(Exception $exc){
                return "Error al eliminar el producto.";
            }
        }
    }
?>