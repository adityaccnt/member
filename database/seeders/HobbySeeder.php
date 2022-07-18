<?php

namespace Database\Seeders;

use App\Models\Hobby;
use Illuminate\Database\Seeder;

class HobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hobbies = array('Menyanyi', 'Menari', 'Memancing', 'Membaca', 'Menulis', 'Menonton Film');
        foreach ($hobbies as $value) Hobby::create(['name' => $value]);
    }
}
