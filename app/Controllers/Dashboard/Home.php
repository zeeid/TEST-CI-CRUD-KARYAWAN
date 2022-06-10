<?php

namespace App\Controllers\Dashboard; //Nama Folder

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'tittle' => 'Dashboard',
        ];


        return view('dashboard/index', $data);
    }
}
