<?php

//Encabezados(headers)
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');


include_once '../../config/Basemysql.php';
include_once '../../models/Producto.php';


//Instanciamos la conexion a la base de datos

$baseDatos = new Basemysql();

$db = $baseDatos->connect();

//Instanciamos el objeto producto

$producto = new Producto($db);

$data = json_decode(file_get_contents("php://input"));

$producto->titulo = $data->titulo;
$producto->texto = $data->texto;
$producto->categoria_id = $data->categoria_id;
//producto

if ($producto->crear()) {
    echo json_encode(
        array('message' => 'Producto creado')
    );
} else {
    echo json_encode(
        array('meesage' => 'Producto no creado')
    );
}
