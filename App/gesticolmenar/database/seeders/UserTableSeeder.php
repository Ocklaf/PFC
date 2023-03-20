<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->explotation_code = 'ES07031984';
        $user->name = 'José Vicente';
        $user->surname = 'Falcó Milla';
        $user->dni = '33563120W';
        $user->email = 'ocklaf@gmail.com';
        $user->password = bcrypt('12345678');
        $user->save();
    }
}
