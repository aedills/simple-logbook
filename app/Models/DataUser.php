<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUser extends Model
{
    use HasFactory;
    protected $table = 'data_user';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid', 'nama', 'username', 'p4ssw0rd', 'foto', 'tgl_mulai', 'tgl_selesai', 'role'
    ];

    public function aktifitas()
    {
        return $this->hasMany(AktifitasModel::class, 'uuid_user', 'uuid');
    }
}
