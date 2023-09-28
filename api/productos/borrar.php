<?php

//Encabezados(headers)
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');


include_once '../../config/Basemysql.php';
include_once '../../models/Producto.php';

//Instanciamos la conexion a la base de datos

$baseDatos = new Basemysql();

$db = $baseDatos->connect();

//Instanciamos el objeto producto

$producto = new Producto($db);

$data = json_decode(file_get_contents("php://input"));

//Stear el id de categoria
$producto->id = $data->id;

if ($producto->eliminar()) {
    echo json_encode(
        array('message' => 'Producto Eliminado')
    );
} else {
    echo json_encode(
        array('meesage' => 'No se pudo Eliminar el producto')
    );
}
