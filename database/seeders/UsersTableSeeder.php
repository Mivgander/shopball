<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'elosiema',
            'email' => 'patrykw-01@wp.pl',
            'password' => Hash::make('elosiema1234'),
            'remember_token' => Str::random(10)
        ]);
    }
}
