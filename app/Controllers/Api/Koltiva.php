<?php

namespace App\Controllers\Api; //Nama Folder

use App\Controllers\BaseController;

class Koltiva extends BaseController
{

    public function index()
    {
        $killed = 1;
        $x_new = 1;

        $baru = 0;

        for ($x = 1; $x <= 10; $x++) {
            // $killed = $killed+$x-$killed;
            $killed = $x+$killed-1;
            $x_new = $x-$x_new; 

            $baru = $x_new-$killed;

            
            echo "The number is: ".$x." | ".$killed." |  <br>";

            
        }
    }

}