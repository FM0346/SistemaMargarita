<?php

// La ruta no contiene ninguna acción
return new RouteNode(
    NULL,
    [
        // todo General
        'general' => include(dirname(__DIR__) . '/routes/general.php'),

        //todo Programa de entrega de alimentos
        'programa-entrega-alimentos' => include(dirname(__DIR__) . '/routes/programa_entrega_alimentos.php'),

        // todo Programa Comedor Santa Rita
        'comedor-santa-rita' => include(dirname(__DIR__) . '/routes/comedor_santa_rita.php'),

        // todo Asistencia económica
        'asistencia-economica' => include(dirname(__DIR__) . '/routes/asistencia_economica.php'),

        // todo Pastoral social de la salud
        'pastoral-social-salud' => include(dirname(__DIR__) . '/routes/pastoral_social_salud.php'),
    ]
);
