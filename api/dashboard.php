<?php

//Allows access to queries from all sources
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT");
//Indicates the content type (json) and the charset

/*
  Result array
  status - bool - Boolean that indicates if the query was successful
  data - array - Array with the information of the result
  errorMessage - string - Information of the error in case status is false
*/
$result = array('status' => 0, 'data' => [], 'errorMessage' => null);

//If doesn't exist an actionGroup variable, exits
if (isset($_GET['actionGroup']) === false) {
  $result['errorMessage'] = 'Undefined action group';
  exit(json_encode($result, JSON_UNESCAPED_UNICODE));
}

if (isset($_GET['action']) === false) {
  $result['errorMessage'] = 'Undefined action';
  exit(json_encode($result, JSON_UNESCAPED_UNICODE));
}

$actionGroupFile = './models/actionGroups/' . $_GET['actionGroup'] . '.php';
$action = $_GET['action'];

if (file_exists($actionGroupFile) === false) {
  $result['errorMessage'] = 'Action group doesn\'t exists';
  exit(json_encode($result, JSON_UNESCAPED_UNICODE));
}

require_once($actionGroupFile);

$actionMaker = new ActionGroup();
if (array_key_exists($action, $actionMaker->getActionDictionary()) === false) {
  $result['errorMessage'] = 'Action doesn\'t exists';
  exit(json_encode($result, JSON_UNESCAPED_UNICODE));
}

$action = $actionMaker->getActionDictionary()[$action];
$actionResult = $actionMaker->$action();

if ($actionMaker->getErrorMessage() !== NULL) {
  $result['errorMessage'] = $actionMaker->getErrorMessage();
  $result['status'] = 0;
} else {
  $result['data'] = $actionResult;
  $result['status'] = 1;
}

exit(json_encode($result, JSON_UNESCAPED_UNICODE));
