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

$resultado = $categoria->leer();

//Contar las filas 
$num = $resultado->rowCount();

//validamos si existe una categoria
if ($num > 0) {
    //Array de categorias
    $categoria_arr = array();
    $categoria_arr['data'] = array();

    while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $categoria_item = array(
            'id' => $id,
            'nombre' => $nombre
        );

        //Enviar datos
        array_push($categoria_arr['data'], $categoria_item);
    }
    //Enviar en formato json

    echo json_encode($categoria_arr);

}else{
    //No hay categorias
    echo json_encode(array('message' => 'No hay categorias'));

}
