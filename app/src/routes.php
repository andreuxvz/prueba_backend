<?php

use Slim\Http\Request;
use Slim\Http\Response;


$app->get('/empleados', function (Request $request, Response $response) {
  $email = $request->getQueryParam('email');
  $contents = file_get_contents("storage/employees.json");
  $employees = json_decode($contents, true);
 
  if ($email != '' && $email !== null)  {
    foreach ($employees as $key => $employee) {
      if (strpos($employee['email'], $email) === false ) {
        unset($employees[$key]);
      }
    }
  }
  
  return $this->renderer->render($response, 'employees.phtml', ['employees' =>$employees, 'vista'=> 'todos', 'email'=> $email]);
});
  
$app->get('/empleados/[{id}]', function (Request $request, Response $response, $args){
  $id = $request->getAttribute('id');
  $contents = file_get_contents("storage/employees.json");
  $employees = json_decode($contents, true);
  $employeeSelected = [];
  foreach ($employees as $employee) {
    if ($employee['id'] == $id) {
      $employee['str_skills'] = '';
      foreach ($employee['skills'] as $skill) {
        $employee['str_skills'] .= $skill['skill']." ";
      }
      $employeeSelected[] =  $employee;
      break;
    }
  }
  return $this->renderer->render($response, 'employees.phtml', ['employees' => $employeeSelected, 'vista'=> 'solo']);
});


$app->post('/empleadosservice', function (Request $request){
  $maxSalary = $request->getParsedBodyParam('max_salary');
  $minSalary = $request->getParsedBodyParam('min_salary');
  $contents = file_get_contents("storage/employees.json");
  $employees = json_decode($contents, true);
  $replaceChars = ['$', ','];
  
  foreach ($employees as $key => $employee) {
    $salary = str_replace($replaceChars, "", $employee['salary']);
    if ($salary < $minSalary || $salary > $maxSalary) {
      unset($employees[$key]);
    }
  }
  
  $xml = array2xml($employees, false);
  return $xml;
});


//funcion recursiva para crear el xml
function array2xml($array, $xml = false){
  if($xml === false){
    $xml = new SimpleXMLElement('<result/>');
  }
  foreach($array as $key => $value){
    if(is_array($value)){
      $tag = (is_int($key)) ? 'employee': $key;
      array2xml($value, $xml->addChild($tag));
    } else {
      $xml->addChild($key, $value);
    }
  }
  return $xml->asXML();
}