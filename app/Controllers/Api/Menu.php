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
        elseif ($menunya == 'Profil') {
            // $id = $this->request->getVar('id');
            $status = $this->session->get('status');
            $id     = $this->session->get('id');
            $email  = $this->session->get('email');
            
            // echo "PROFIL";


            $dataKaryawan = $this->KaryawanModel->getkaryawanByID_Email($id,$email);
            
            $data = [
                'judul'      => $menunya,
                'listkaryawan' => $dataKaryawan,
            ];
            return view('dashboard/profil', $data);
        }
        elseif ($menunya == 'Soal 1 Koltiva') {
            
            $data = [
                'judul'      => $menunya,
            ];
            return view('dashboard/soalsatu', $data);
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
