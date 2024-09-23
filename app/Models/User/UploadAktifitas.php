<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadAktifitas extends Model
{
    use HasFactory;

    protected $table = 'data_aktifitas';
    protected $fillable = ['uuid', 'uuid_user', 'tanggal', 'judul', 'keterangan', 'foto', 'is_verified'];
}
