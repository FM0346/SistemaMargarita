<?php

/**
 * Diccionario de controladores
 * se subdivide hasta llegar al controlador y acción deseada
 */
return [
    'primer-usuario' => [
        'validar' => [
            'action' => 'primerUsuario.php@validarPrimerUsuario'
        ],
        'crear' => [
            'action' => 'primerUsuario.php@crearPrimerUsuario'
        ]
    ]
];
