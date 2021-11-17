<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adm = new User();
        $adm->name = 'Admin';
        $adm->email = 'admin@gmail.com';
        $adm->password = Hash::make('password');
        $adm->user_type = 'admin';
        $adm->save();
    }
}
