<?php

//Encabezados(headers)
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Basemysql.php';
include_once '../../models/Producto.php';


//Instanciamos la conexion a la base de datos

$baseDatos = new Basemysql();

$db = $baseDatos->connect();

//Instanciamos el objeto categoria

$producto = new Producto($db);

//Get id
$producto->id = isset($_GET['id']) ? $_GET['id'] : die();

//get categoria
$producto->leerIndividual();

//creamos el array
$producto_arr = array(
    'id' => $producto->id,
    'titulo' => $producto->titulo,
    'texto' => $producto->texto,
    'categoria_id' => $producto->categoria_id,
    'categoria_nombre' =>$producto->categoria_nombre
);

//crear json

print_r(json_encode($producto_arr));