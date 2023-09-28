<?php

//Encabezados(headers)
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');




include_once '../../config/Basemysql.php';
include_once '../../models/Producto.php';


//Instanciamos la conexion a la base de datos

$baseDatos = new Basemysql();

$db = $baseDatos->connect();

//Instanciamos el objeto categoria

$producto = new Producto($db);

$data = json_decode(file_get_contents("php://input"));

//Stear el id de categoria
$producto->id = $data->id;
$producto->titulo = $data->titulo;
$producto->texto = $data->texto;
$producto->categoria_id = $data->categoria_id;
//categoria

if ($producto->actualizar()) {
    echo json_encode(
        array('message' => 'Producto actualizado')
    );
} else {
    echo json_encode(
        array('meesage' => 'No se pudo actualizar el Producto')
    );
}
