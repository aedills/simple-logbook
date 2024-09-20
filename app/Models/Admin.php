<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'data_admin';
    protected $primary_key = 'uuid';
    protected $fillable = [
        'uuid', 'nama', 'username', 'p4ssw0rd', 'is_change_pass', 'foto', 'role'
    ];
}
