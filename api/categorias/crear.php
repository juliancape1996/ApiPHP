<?php

//Encabezados(headers)
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');




include_once '../../config/Basemysql.php';
include_once '../../models/Categoria.php';


//Instanciamos la conexion a la base de datos

$baseDatos = new Basemysql();

$db = $baseDatos->connect();

//Instanciamos el objeto categoria

$categoria = new Categoria($db);

$data = json_decode(file_get_contents("php://input"));

$categoria->nombre = $data->nombre;

//categoria

if ($categoria->crear()) {
    echo json_encode(
        array('message' => 'Categoria creada')
    );
} else {
    echo json_encode(
        array('meesage' => 'Categoria no creada')
    );
}
