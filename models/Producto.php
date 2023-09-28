
<?php


class Producto
{
    private $conn;
    private $table = 'productos';


    //Propiedades
    public $id;
    public $categoria_id;
    public $categoria_nombre;
    public $titulo;
    public $texto;
    public $fecha_creacion;


    //Constructor conexion a la bd

    public function __construct($db)
    {
        $this->conn = $db;
    }


    //Obtener productos

    public function leer()
    {
        //Crear query
        $query = "SELECT c.nombre as nombre_categoria,p.id,p.categoria_id,p.titulo,p.texto,p.fecha_creacion 
        FROM " . $this->table . " p LEFT JOIN categorias c ON p.categoria_id = c.id
        ORDER BY p.fecha_creacion DESC";
        //Preparar sentencia 
        $stmt = $this->conn->prepare($query);

        //ejecuto query
        $stmt->execute();
        return $stmt;
    }

    //Obtener producto individual

    public function leerIndividual()
    {
        //Crear query
        $query = "SELECT c.nombre as categoria_nombre,p.id,p.categoria_id,p.titulo,p.texto,p.fecha_creacion 
        FROM " . $this->table . " p LEFT JOIN categorias c ON p.categoria_id = c.id
        WHERE p.id = ? LIMIT 0,1";
        //Preparar sentencia 
        $stmt = $this->conn->prepare($query);

        //Vinculamos parametros
        $stmt->bindParam(1, $this->id);

        //ejecuto query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //Configurar propiedades
        $this->titulo = $row['titulo'];
        $this->texto = $row['texto'];
        $this->categoria_id = $row['categoria_id'];
        $this->categoria_nombre = $row['categoria_nombre'];
        $this->fecha_creacion = $row['fecha_creacion'];
    }

    //Crear nueva producto 

    public function crear()
    {
        //Crear query
        $query = "INSERT INTO " . $this->table . " (titulo,texto,categoria_id)VALUES(:titulo,:texto,:categoria_id)";
        //Preparar sentencia 
        $stmt = $this->conn->prepare($query);
        //Limpiar datos
        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->texto = htmlspecialchars(strip_tags($this->texto));
        $this->categoria_id = htmlspecialchars(strip_tags($this->categoria_id));

        //Vinculamos parametros
        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":texto", $this->texto);
        $stmt->bindParam(":categoria_id", $this->categoria_id);

        //ejecuto query
        if ($stmt->execute()) {
            return true;
        }

        //si hay error 
        printf("Error.\n", $stmt->error);
        return false;
    }
    //actualizar nueva producto 

   
    public function actualizar()
    {
        //Crear query
        $query = "UPDATE ".$this->table ."  
        SET titulo=:titulo,texto=:texto,categoria_id=:categoria_id
        WHERE id= :id";
        //Preparar sentencia 
        $stmt = $this->conn->prepare($query);
        //Limpiar datos
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->texto = htmlspecialchars(strip_tags($this->texto));
        $this->categoria_id = htmlspecialchars(strip_tags($this->categoria_id));

        //Vinculamos parametros
        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":texto", $this->texto);
        $stmt->bindParam(":categoria_id", $this->categoria_id);
        $stmt->bindParam(":id", $this->id);

        //ejecuto query
        if ($stmt->execute()) {
            return true;
        }

        //si hay error 
        printf("Error.\n", $stmt->error);
        return false;
    }


        //eliminar un producto 
        public function eliminar()
        {
            //Crear query
            $query = "DELETE FROM " . $this->table . " WHERE id =:id";
            //Preparar sentencia 
            $stmt = $this->conn->prepare($query);
            //Limpiar datos
            $this->id = htmlspecialchars(strip_tags($this->id));    
            //Vinculamos parametros
            $stmt->bindParam(":id", $this->id);
    
            //ejecuto query
            if ($stmt->execute()) {
                return true;
            }
    
            //si hay error 
            printf("Error.\n", $stmt->error);
            return false;
        }
}
