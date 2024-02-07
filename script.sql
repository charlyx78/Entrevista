CREATE DATABASE PruebaEntrevista;

USE PruebaEntrevista; 

DROP TABLE IF EXISTS Producto;
CREATE TABLE IF NOT EXISTS Producto (
	id 				INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre			VARCHAR(120) NOT NULL,
    precio			FLOAT NOT NULL,
    descripcion		TEXT,
    imagen			BLOB,
    fechaRegistro	DATETIME NOT NULL,
    activo 			TINYINT NOT NULL
);

DELIMITER //
DROP PROCEDURE IF EXISTS SP_GestionProducto;
CREATE PROCEDURE SP_GestionProducto (
	_id 			INT,
    _nombre			VARCHAR(120),
    _precio			FLOAT,
    _descripcion	TEXT,
    _imagen			BLOB,
    _fechaRegistro	DATETIME,
    _activo			TINYINT,
    _opcion			VARCHAR(3)
)
BEGIN
	/*INSERT*/
	IF _opcion = "I" THEN 
		IF NOT EXISTS (SELECT 1 FROM Producto WHERE nombre = _nombre AND activo = 1) THEN
			INSERT INTO Producto (nombre, precio, descripcion, imagen, fechaRegistro, activo)
			VALUES (_nombre, _precio, _descripcion, _imagen, CURRENT_DATE(), 1);
		END IF;
	END IF;
    
    /*SELECT BY ID*/
    IF EXISTS (SELECT 1 FROM Producto WHERE id = _id) THEN
		IF _opcion = "SID" THEN 
			SELECT 
				nombre,
				precio,
				descripcion,
				imagen,
                fechaRegistro,
				activo
			FROM VW_Productos
			WHERE id = _id AND activo = 1;
		END IF;
	END IF;
    
    /*SELECT ALL*/
    IF _opcion = "SA" THEN 
		SELECT 
			nombre,
            precio,
            descripcion,
            imagen,
			fechaRegistro,
            activo
		FROM VW_Productos 
        WHERE activo = 1;
	END IF;
        
    /*UPDATE*/
	IF EXISTS (SELECT 1 FROM Producto WHERE id = _id AND activo = 1) THEN
		IF _opcion = "U" THEN 
			UPDATE Producto SET
				nombre = _nombre,
				precio = _precio,
				descripcion = _descripcion,
				imagen = _imagen
			WHERE id = _id;
		END IF;
	END IF;
        
	/*DELETE*/
	IF EXISTS (SELECT 1 FROM Producto WHERE id = _id AND activo = 1) THEN
		IF _opcion = "D" THEN 
			UPDATE Producto SET 
				activo = 0
			WHERE id = _id;
		END IF;
	END IF;
    
END 
// DELIMITER ;

DROP VIEW IF EXISTS VW_Productos;
CREATE VIEW VW_Productos
AS
	SELECT 
		id,
		nombre,
		precio,
		descripcion,
		imagen,
		activo
    FROM Producto 
    


