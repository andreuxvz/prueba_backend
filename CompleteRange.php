<?php
  
  
  class CompleteRange {
    
    public function build($valor) {
      $ultimo = end($valor);
      $respuesta = [];
      
      for($i = $valor[0]; $i <= $ultimo; $i++){
        $respuesta[] = $i;
      }
      return $respuesta;
    }
  }
  