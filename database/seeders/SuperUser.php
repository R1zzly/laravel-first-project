<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superuser = User::create([
            'name' => 'Superdd',
            'email' => 'super@google.com',
            'password' => Hash::make('12345678'),
            'is_admin' => true,
            'balance' => 100000,
        ]);

        //Role::create(['name' => 'super-user']);

        $superuser->assignRole('super-user');
//        $client = User::create([
//            'name' => 'Clientbeddk',
//            'email' => 'clientbek2004@google.com',
//            'password' => Hash::make('12345678'),
//            'is_admin' => false,
//            'balance' => 10000,
//        ]);
//
//
//        $client->assignRole('client');
    }
}
