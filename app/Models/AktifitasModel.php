<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktifitasModel extends Model
{
    use HasFactory;

    protected $table = 'data_aktifitas';
    protected $fillable = ['uuid_user', 'tanggal', 'model', 'keterangan', 'foto', 'is_verified'];

    protected $primaryKey = 'id';
    protected $keyType = 'string';
}
