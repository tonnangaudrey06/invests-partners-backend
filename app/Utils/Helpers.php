<?php

namespace App\Utils;

class Helpers
{
  static function numberFormat($number)
  {
    return number_format((int) $number, 0, ',', ' ');
  }
  
}
