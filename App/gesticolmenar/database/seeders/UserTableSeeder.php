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
        $user->birth_date = '1984-03-07';
        $user->email = 'ocklaf@gamil.com';
        $user->password = bcrypt('12345678');
        $user->save();

        $user = new User();
        $user->explotation_code = 'ES09042010';
        $user->name = 'Noble';
        $user->surname = 'Falcó';
        $user->dni = '44674231Y';
        $user->birth_date = '2010-04-09';
        $user->email = 'noble@gmail.com';
        $user->password = bcrypt('12345678');
        $user->save();
    }
}
