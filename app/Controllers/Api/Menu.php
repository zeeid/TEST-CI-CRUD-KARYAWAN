<?php

namespace App\Controllers\Api; //Nama Folder

use App\Models\KaryawanModel;

use App\Controllers\BaseController;

class Menu extends BaseController
{
    protected $KaryawanModel;
    
    public function __construct(){
        $this->KaryawanModel = new KaryawanModel();
        
    }


    public function index()
    {
        $menunya    = $this->request->getVar('menu');

        if ($menunya == 'Karyawan') {
            $data = [
                'judul' => $menunya
            ];
            return view('dashboard/karyawan', $data);
        }
        elseif ($menunya == 'Tambah Karyawan') {
            $id = $this->request->getVar('id');
            
            $listkaryawan = $this->KaryawanModel->where('id', $id)
            ->first();;
            
            $data = [
                'judul'      => $menunya,
                'listkaryawan' => $listkaryawan,
            ];
            return view('dashboard/karyawan_form', $data);
        }


        else{
            // throw new \CodeIgniter\Exceptions\PageNotFoundException('Menu tidak ditemukan !');
            $data = [
                'status'    => 201,
                'menu'      => $menunya,
                'pesan'     => 'Menu Tidak ditemukan !',
            ];

            dd($data);
        }
    }
}
