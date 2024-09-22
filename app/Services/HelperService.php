<?php

namespace App\Services;

class HelperService
{
    public static function dtf($date_string, $format='0'): string
    {
        switch ($format) {
            case '1':
            $date = date('m/d/Y H:i:s',strtotime($date_string));
            break;
            case '2':
            #for date only
            $date = date('Y/m/d',strtotime($date_string));
            break;
        
            default:
            $date = date('d-M-Y h:i A',strtotime($date_string));
            break;
          }
          return $date;
    }
}
