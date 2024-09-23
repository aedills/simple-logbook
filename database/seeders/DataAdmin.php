<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::factory()->create([
            'name' => 'Super Admin',
            'username' => 'admin',
            'p4ssw0rd' => '$2y$12$vfTNvOeY8nJIDkSJWdNAre8.mhqmoA1/Ttuo5ireTvPjAxnFwRCEK',
            'is_change_pass' => 0,
            'role' => 'admin',
        ]);
    }
}
