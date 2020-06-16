<?php


namespace App\Http\Util;


use App\Http\Controllers\Controller;

class IdGenerador extends  Controller{
    public static function generaId()
    {
        $fecha_actual = getdate();
        $random = rand(1000, 10000);
        $random2 = rand(1000, 10000);
        $id = $fecha_actual[0] . $random . $random2;
        return $id;
    }
}
