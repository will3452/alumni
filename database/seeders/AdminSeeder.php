<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'User Administrator',
            'email' => 'admin',
            'password' => bcrypt('admin'),
            'type' => User::TYPE_ADMIN,
        ]);
    }
}
