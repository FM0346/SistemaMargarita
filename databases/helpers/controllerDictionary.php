<?php

/*
    Diccionario de controladores,
    Se subdivide hasta llegar al controlador y acción deseado
*/
return [
    'ejecutar' => [
        'action' => 'database.php@ejecutarConsulta'
    ],
    'ejecutar-obtener' => [
        'action' => 'database.php@ejecutarObtenerConsulta'
    ]
];
