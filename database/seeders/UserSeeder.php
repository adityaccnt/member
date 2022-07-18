<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 6; $i++) User::create([
            'name'      => 'user' . $i,
            'email'     => 'user' . $i . '@domain.com',
            'phone'     => '081' . $i . rand(10000000,99999999),
        ]);
    }
}
