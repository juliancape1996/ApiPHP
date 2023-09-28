<?php

//Encabezados(headers)
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Basemysql.php';
include_once '../../models/Categoria.php';


//Instanciamos la conexion a la base de datos

$baseDatos = new Basemysql();

$db = $baseDatos->connect();

//Instanciamos el objeto categoria

$categoria = new Categoria($db);

//Get id
$categoria->id = isset($_GET['id']) ? $_GET['id'] : die();

//get categoria
$categoria->leerIndividual();

//creamos el array
$categoria_arr = array(
    'id' => $categoria->id,
    'nombre'=>$categoria->nombre,
);

//crear json

print_r(json_encode($categoria_arr));