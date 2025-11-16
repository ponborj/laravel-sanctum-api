<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // add user
        $user = new \App\Models\User();
        $user->name = 'Matheus';
        $user->email = 'matheus@email.com';
        $user->password = bcrypt('123');
        $user->save();

        $user2 = new \App\Models\User();
        $user2->name = 'Pedro';
        $user2->email = 'pedro@email.com';
        $user2->password = bcrypt('123');
        $user2->save();
    }
}
