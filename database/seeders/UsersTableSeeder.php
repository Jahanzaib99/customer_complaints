<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@domain.com',
            'phone' => '03088522079',
            'password' => bcrypt('123456')
        ]);
        $admin->assignRole('admin');
        
        $admin2 = User::create([
            'name' => 'Admin 2',
            'email' => 'admin2@domain.com',
            'phone' => '03088522079',
            'password' => bcrypt('123456')
        ]);
        $admin2->assignRole('admin');

        $csr = User::create([
            'name' => 'Jahanzaib khan',
            'email' => 'agent@domain.com',
            'phone' => '03088522078',
            'password' => bcrypt('123456')
        ]);
        $csr->assignRole('csr');
    }
}
