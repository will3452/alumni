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
        $user = User::create([
            'email' => 'super@admin.com',
            'password' => bcrypt('password'),
            'name' => 'administrator',
            'status' => 'active', 
            'type' => User::TYPE_ADMIN,
            'email_verified_at' => now(), 
        ]);
    }
}
