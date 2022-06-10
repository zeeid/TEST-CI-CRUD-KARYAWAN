<?php

namespace App\Controllers\Api; //Nama Folder

use App\Models\KaryawanModel;
use App\Controllers\BaseController;

class Karyawan extends BaseController
{
    protected $KaryawanModel;
    public function __construct(){
        $this->KaryawanModel = new KaryawanModel();
    }
    public function index()
    {
        
    }

    public function simpan(){

        // dd($this->request->getVar());

        $mode   = $this->request->getVar('mode');
        $id     = $this->request->getVar('id');

        if ($mode=='update') {
            $datanya = [
                'nama'              => $this->request->getVar('nama'),
                'tanggal_lahir'    => $this->request->getVar('tanggal_lahir'),
                'gaji'              => $this->request->getVar('gaji'),
                'status_karyawan'   => $this->request->getVar('status_karyawan'),
            ];

            $simpan = $this->KaryawanModel->where('id', $id)
            ->set($datanya)
            ->update();
            
        }else{

            $simpan = $this->KaryawanModel->save([
                'nama'              => $this->request->getVar('nama'),
                'tanggal_lahir'    => $this->request->getVar('tanggal_lahir'),
                'gaji'              => $this->request->getVar('gaji'),
                'status_karyawan'   => $this->request->getVar('status_karyawan'),
            ]);
        }


        if ($simpan ==1) {
            $response = array(
                'status'    => 200, 
                'pesan'     => 'Berhasil menyimpan data Karyawan !', 
            );
        }else{
            $response = array(
                'status'    => 201, 
                'pesan'     => 'Gagal menyimpan data Karyawan !', 
            );
        }

        return json_encode($response);
    }

    public function listkaryawan(){
        $listkaryawan = $this->KaryawanModel->findAll();

        $data = [
            'listkaryawan' => $listkaryawan,
        ];

        return view('dashboard/tabel/tabel_karyawan',$data);
        
    }

    public function hapuskaryawan(){
        $id = $this->request->getVar('id');

            $cek = $this->db->query("SELECT * from karyawan WHERE id='$id'")->getNumRows();

            if ($cek > 0) {
                $hapus = $this->KaryawanModel
                ->where('id', $id)
                ->delete();

                if ($hapus == 1) {
                    $response = array(
                        'status'    => 200, 
                        'pesan'     => 'Berhasil menghapus Karyawan', 
                    );
                }else{
                    $response = array(
                        'status'    => 201, 
                        'pesan'     => 'Gagal menghapus Karyawan', 
                    );
                    
                }
            }else{
                $response = array(
                    'status'    => 201, 
                    'pesan'     => 'Karyawan Tidak ditemukan untuk dihapus', 
                );

            }

            return json_encode($response);
        
    }
}
