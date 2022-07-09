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
        $mode       = $this->request->getVar('mode');
        $id         = $this->request->getVar('id');
        $foto_old   = $this->request->getVar('foto_old');
        
        $validasi       = \Config\Services::validation();
        // ========= VALIDASI ==========
            if (!$this->validate([
                'nama'              => 'required',
                'email'             => 'required|valid_email',
                'password'          => 'required',
                'tanggal_lahir'     => 'required',
                'gaji'              => 'required|numeric',
                'status_karyawan'   => 'required',
                
                'fotonya'           => [
                    'rules'         => 'max_size[fotonya, 1024]|is_image[fotonya]|mime_in[fotonya,image/jpg,image/jpeg,image/png]',
                    'errors'        => [
                        'max_size'  => 'Gambar kebesaran',
                        'is_image'  => 'Bukan Gambar Broo',
                        'mime_in'   => 'Bukan Gambar Broo'
                    ]
                ],
            ])) {
                // return redirect()->to('/crud/tambah')->withInput();
                if(isset($validasi)){
                    // $error_list = $validasi->listErrors();
                    // $error_nama = ($validasi->hasError('nama')) ? 'is-invalid' : '';
                    // $error_nama_detail = ($validasi->hasError('nama')) ? $validasi->getError('nama') : '';

                    $error_kunciku          = ($validasi->hasError('kunciku')) ? 'Token Habis Silahkan Reload Halaman' : '';
                    $error_mode             = ($validasi->hasError('mode')) ? 'Modenya apa ?' : '';
                    $error_gambar           = ($validasi->hasError('fotonya')) ? $validasi->getError('fotonya') : '';
                    $error_nama             = ($validasi->hasError('nama')) ? $validasi->getError('nama') : '';
                    $error_tanggal_lahir    = ($validasi->hasError('tanggal_lahir')) ? $validasi->getError('tanggal_lahir') : '';
                    $error_gaji             = ($validasi->hasError('gaji')) ? $validasi->getError('gaji') : '';
                    $error_status_karyawan  = ($validasi->hasError('status_karyawan')) ? $validasi->getError('status_karyawan') : '';
                    $error_email            = ($validasi->hasError('email')) ? $validasi->getError('email') : '';
                    $error_password         = ($validasi->hasError('password')) ? $validasi->getError('password') : '';

                    $data = array(
                        'status'    => 201,
                        'e_kunciku' => $error_kunciku, 
                        'e_mode'    => $error_mode, 
                        'e_gambar'  => $error_gambar, 
                        'pesan'     => 'ERROR UPLOAD GAMBARNYA', 
                    );
                    return json_encode($data);
                }
            }
        // ======================================

         // ============ SIMPAN FILE ===============
            $filenya    = $this->request->getFile('fotonya');
            $namafilez  = $filenya->getName();
            // ==== CEK JIKA UPLOAD KOSONG ====
                if ($foto_old=='') {
                    
                    if ($filenya->getError() == 4) {
                        // $namafile_random = 'default.jpg';
                        $data = array(
                            'status'    => 201,
                            'e_kunciku' => '-', 
                            'e_mode'    => '-', 
                            'e_gambar'  => '-', 
                            'pesan'     => 'Gambar belum dipilih', 
                        );
                        return json_encode($data);
                    }else{
    
                        // ==== generate Nama file random  ===
                        $namafile_random = $filenya->getRandomName();
                        // ==== PINDAH FILE KE FOLDER ===
                        $filenya->move('upload',$namafile_random);
            
                        // $filenya->move('img');
                        // ==== AMBIL NAMA FILE Kalau nama file seperti yg diupload ====
                        // $namafile   = $filenya->getName();
            
                        // dd($namafile);
                    }
                }
                else{
                    if ($filenya->getError() == 4) {
                        $getdatakaryawan = $this->KaryawanModel->getkaryawan($id);

                        // dd($getdatakaryawan);
                        $namafile_random = $getdatakaryawan['fotonya'];

                    }else{
    
                        // ==== generate Nama file random  ===
                        $namafile_random = $filenya->getRandomName();
                        // ==== PINDAH FILE KE FOLDER ===
                        $filenya->move('upload',$namafile_random);
            
                        // $filenya->move('img');
                        // ==== AMBIL NAMA FILE Kalau nama file seperti yg diupload ====
                        // $namafile   = $filenya->getName();
            
                        // dd($namafile);
                    }
                    
                }
        // ============ SIMPAN FILE ===============

        // die();
        
        $datanya = [
            'email'             => $this->request->getVar('email'),
            'password'          => $this->request->getVar('password'),
            'fotonya'           => $namafile_random,
            'nama'              => $this->request->getVar('nama'),
            'tanggal_lahir'     => $this->request->getVar('tanggal_lahir'),
            'gaji'              => $this->request->getVar('gaji'),
            'status_karyawan'   => $this->request->getVar('status_karyawan'),
        ];

        if ($mode=='update') {

            $simpan = $this->KaryawanModel->where('id', $id)
            ->set($datanya)
            ->update();
        }else{
            $simpan = $this->KaryawanModel->save($datanya);
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
