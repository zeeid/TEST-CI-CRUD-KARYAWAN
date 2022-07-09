<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\KaryawanModel;
use CodeIgniter\Config\Services;
use App\Controllers\BaseController;

class Auth extends BaseController
{
    protected $AuthModel;
    protected $KaryawanModel;
    public function __construct(){
        $this->AuthModel = new AuthModel();
        $this->KaryawanModel = new KaryawanModel();
    }
    
    public function index()
    {
        $data = [
            'tittle' => 'Login',
        ];
        return view('layout/auth/layout_login', $data);
    }

    public function login(){
        $validation =  \Config\Services::validation();
        
        $email  = $this->request->getVar('email');
        $sandi  = $this->request->getVar('sandi');

        if (!$this->validate([
            // 'email'     => 'required|valid_email',
            'email'     => 'required',
            'sandi'     => 'required'
        ])) {
            $errors = $validation->getErrors();

            $response = array(
                'status'    => 501, 
                'Pesan'     => 'Silahkan Periksan Email / Password anda !', 
                'data'      => $errors
            );
        }
        else{
            $cek = $this->AuthModel->where('email', $email)
            ->where('sandi', $sandi)
            ->where('is_active', 1)
            ->first();

            if ($cek == null) {

                $get_karyawan = $this->KaryawanModel->loginKaryawan($email,$sandi);
                // dd($get_karyawan);

                if ($get_karyawan != null) {

                    $newdata = [
                        'id'            => $get_karyawan['id'],
                        'username'      => $get_karyawan['email'],
                        'email'         => $get_karyawan['email'],
                        'wa'            => '-',
                        'kode_pasangan' => '-',
                        'nama_user'     => $get_karyawan['nama'],
                        'logged_in'     => true,
                        'status'        => 'karyawan',
                    ];
                    
                    $this->session->set($newdata);
    
                    $response = array(
                        'status'    => 200, 
                        'Pesan'     => 'Berhasil Login', 
                        'data'      => '-'
                    );
                }else{
                    $response = array(
                        'status'    => 500, 
                        'Pesan'     => 'Silahkan Periksan Email / Password anda !', 
                        'data'      => 'User tidak ditemukan'
                    );
                }

            }else{

                // ====== SET SESSION =========
                $newdata = [
                    'id'            => $cek['id'],
                    'username'      => $cek['username'],
                    'email'         => $cek['email'],
                    'wa'            => $cek['wa'],
                    'kode_pasangan' => $cek['kode_pasangan'],
                    'nama_user'     => $cek['nama_user'],
                    'logged_in'     => true,
                    'status'        => 'super',
                ];
                
                $this->session->set($newdata);

                $response = array(
                    'status'    => 200, 
                    'Pesan'     => 'Berhasil Login', 
                    'data'      => '-'
                );
            }
            
        }

        return json_encode($response);
    }

    public function logout(){
        $logout = $this->session->destroy();
        // echo "logout";
        
        $data = [
            'tittle' => 'Login',
        ];
        return view('layout/auth/layout_login', $data);
    }
}
