<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktifitasModel extends Model
{
    use HasFactory;

    protected $table = 'data_aktifitas';
    protected $fillable = ['uuid_user', 'tanggal','keterangan', 'foto', 'is_verified'] ;

}
