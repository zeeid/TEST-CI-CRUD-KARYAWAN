<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    // ...
    protected $table      = 'karyawan';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['email','password','fotonya','nama', 'tanggal_lahir','gaji','status_karyawan'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getkaryawan($id = false){

        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(
            [
                'id'=>$id
            ]
        )->first();
    }
    public function getkaryawanByID_Email($id,$email){
        return $this->where(
            [
                'id'    =>$id,
                'email' =>$email,
            ]
        )->first();
    }
    public function loginKaryawan($email = false,$password = false){

        // dd($email." | ".$password);

        return $this->where(
            [
                'email'     =>$email,
                'password'  =>$password,
            ]
        )->first();
    }
}