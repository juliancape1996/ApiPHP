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

$resultado = $producto->leer();

//Contar las filas 
$num = $resultado->rowCount();

//validamos si existe un producto
if ($num > 0) {
    //Array de categorias
    $producto_arr = array();
    //$producto_arr['data'] = array();

    while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $producto_item = array(
            'id' => $id,
            'titulo' => $titulo,
            'texto' => $texto,
            'categoria_id' => $categoria_id,
            'nombre_categoria' =>$nombre_categoria
        );

        //Enviar datos
        array_push($producto_arr, $producto_item);
    }
    //Enviar en formato json

    echo json_encode($producto_arr);

}else{
    //No hay productos
    echo json_encode(array('message' => 'No hay productos'));

}
