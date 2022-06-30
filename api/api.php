<?php

include('./helpers/apiHeaders.php');
require('./controllers/apiController.php');

require('./databases/database.php');

ApiController::getAction($_SERVER['REQUEST_URI']);
exit;


$query = "Select * from usuarios.usuario_tipo";
$params = null;

$data = Database::getQueryData('SistemaMargarita', $query, $params);

ApiController::exitData($data);
