<?php

$routeRoot = new RouteNode(
    NULL,
    [
        'login' => new RouteNode(),
        'usuario' => new RouteNode(
            new RouteLeaf(
                'general/usuario.php',
                'Usuario'
            )
        ),
    ]
);

return $routeRoot;
