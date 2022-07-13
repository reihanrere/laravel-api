<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{

    protected $table = 'mahasiswa';
    
    protected $fillable = ['nama_mahasiswa','no_telp','email','alamat','keterangan'];

    protected $primaryKey = 'id';
}
