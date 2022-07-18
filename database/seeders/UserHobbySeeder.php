<?php

namespace Database\Seeders;

use App\Models\UserHobby;
use Illuminate\Database\Seeder;

class UserHobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 6; $i++) UserHobby::create(['user_id' => rand(1, 3), 'hobby_id' => $i]);
    }
}
