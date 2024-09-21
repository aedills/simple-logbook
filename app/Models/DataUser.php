<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUser extends Model
{
    use HasFactory;
    protected $table = 'data_user';
    protected $primarykey = 'id';
    protected $fillable = [
        'uuid', 'nama', 'username', 'p4ssw0rd', 'foto', 'tgl_mulai', 'tgl_selesai', 'role'
    ];
}
