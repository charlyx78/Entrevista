<?php
    Class db { 
        static public function connect() {
            $host = "localhost:3307";
            $db = "pruebaentrevista";
            $user = "root";
            $pass = "Phineas2011!";
            try {
                $mysqli = new mysqli($host,$user,$pass,$db);
                if ($mysqli->connect_errno) {
                    $response = (object)array("status"=>500,"message"=>$mysqli->connect_error);
                    echo json_encode($response);
                    die("Error de conexión: " . $mysqli->connect_error);
                }
                else{
                    "Conexion exitosa";
                }
            } 
            catch(Exception $exc) {
                $response = (object)array("status"=>500,"message"=>"Error al conectarse a la base de datos, favor de crear la base de datos en el archivo script.sql o configurar el usuario y contraseña en el archivo db.php");
                echo json_encode($response);
                exit;
            }
            return $mysqli;
        }
    }
?> 