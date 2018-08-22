<?php
  class ChangeString {
    
    public function build($valor) {
      $letters = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','ñ','o','p','q','r','s','t','u','v','w','x','y','z'];
      $stringChangedArr = [];
      $valorArr = str_split($valor);
      
      foreach ($valorArr as $val) {
        if (ctype_alpha($val)) {
          $case =  ctype_upper($val) ? 'mayuscula': 'minuscula';
          $position = array_search(strtolower($val), $letters);
          $newPosition = ($position == 26) ? 0 : $position+1;
          if ($case == 'mayuscula') {
            $stringChangedArr[] = mb_strtoupper($letters[$newPosition]);
          } else {
            $stringChangedArr[] = $letters[$newPosition];
          }
        } else {
          $stringChangedArr[] = $val;
        }
      }
      return implode("", $stringChangedArr);
    }
  }
