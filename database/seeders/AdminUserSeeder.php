<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::create([
        'name' => 'Administrador',
        'email' => 'admin@admin',
        'password' => bcrypt('secret'),
        'role_id' => 1,
       ]);
    }
}
