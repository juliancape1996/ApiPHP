
<?php


class Categoria
{
    private $conn;
    private $table ='categorias';


    //Propiedades
    public $id;
    public $nombre;
    public $fecha_creacion;


    //Constructor conexion a la bd

    public function __construct($db)
    {
        $this->conn = $db;
    }


    //Obtener categorias

    public function leer()
    {
        //Crear query
        $query = "SELECT id, nombre, fecha_creacion FROM  ".$this->table."   ORDER BY fecha_creacion DESC";

        //Preparar sentencia 
        $stmt = $this->conn->prepare($query);
        //ejecuto query
        $stmt->execute();
        return $stmt;
    }

    //Obtener categoria individual

    public function leerIndividual()
    {
        //Crear query
        $query = "SELECT id, nombre , fecha_creacion  FROM ".$this->table." WHERE id = ? LIMIT 0,1";
        //Preparar sentencia 
        $stmt = $this->conn->prepare($query);
        //Vinculamos parametros
        $stmt->bindParam(1, $this->id);
        //ejecuto query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id = $row['id'];
        $this->nombre = $row['nombre'];
        $this->fecha_creacion = $row['fecha_creacion'];
    }

    //Crear nueva categoria 

    public function crear()
    {
        //Crear query
        $query = "INSERT INTO " . $this->table . " (nombre)VALUES(:nombre)";
        //Preparar sentencia 
        $stmt = $this->conn->prepare($query);
        //Limpiar datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));

        //Vinculamos parametros
        $stmt->bindParam(":nombre", $this->nombre);

        //ejecuto query
        if ($stmt->execute()) {
            return true;
        }

        //si hay error 
        printf("Error.\n", $stmt->error);
        return false;
    }
    //actualizar nueva categoria 

    public function actualizar()
    {
        //Crear query
        $query = "UPDATE " . $this->table . " SET nombre=:nombre WHERE id =:id";
        //Preparar sentencia 
        $stmt = $this->conn->prepare($query);
        //Limpiar datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Vinculamos parametros
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":id", $this->id);

        //ejecuto query
        if ($stmt->execute()) {
            return true;
        }

        //si hay error 
        printf("Error.\n", $stmt->error);
        return false;
    }


        //eliminar nueva categoria 

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
