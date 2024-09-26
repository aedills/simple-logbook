<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktifitasModel extends Model
{
    use HasFactory;

    protected $table = 'data_aktifitas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid_user', 'tanggal', 'model', 'keterangan', 'foto', 'is_verified', 'verified_by_uuid'
    ];

    public function verif_by()
    {
        return $this->HasOne(Admin::class, 'uuid', 'verified_by_uuid');
    }

    public function upload_by()
    {
        return $this->HasOne(DataUser::class, 'uuid', 'uuid_user');
    }
}
