<?php

/*
    Diccionario de controladores,
    Se subdivide hasta llegar al controlador y acción deseado
*/
return [
    'imagenes' => [
        'primer-usuario' => [
            'subir' => [
                'action' => 'primerUsuario.php@subirImagen'
            ],
        ],
        'usuario' => [
            'subir' => [
                'action' => 'usuario.php@subirImagen'
            ],
            'obtener' => [
                'action' => 'usuario.php@obtenerImagen'
            ]
        ],
    ]
];
