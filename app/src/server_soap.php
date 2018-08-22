<?php
  class Server {
    public function __counstruc() {
      
    }
    
    public function getEmployees($min_salary, $max_salary) {
      
    }
  }
  $params = ['uri' => ''];
  $server = new SoapServer(NULL, $params);
  $server->setClass('server');
  $server->handle();  