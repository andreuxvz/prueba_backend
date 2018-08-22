<?php

  class ClearPar {

    public function build($valor){
      $valorArr = str_split($valor);
      $resultado = '';
    
      for ($i = 0; $i < count($valorArr)-1; $i++) {
        if ($valorArr[$i] == '(' && $valorArr[$i+1] == ')') {
          $resultado .= $valorArr[$i].$valorArr[$i+1];
          $i++;
        }
      }
      return $resultado;
    }
  }
  