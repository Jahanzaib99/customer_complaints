<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables();
        $this->call(RolesPermissionsTablesSeeder::class);
        $this->call(UsersTableSeeder::class);
        $users = User::factory(5)->create();
        foreach ($users as $user) {
            $user->assignRole('csr');
        }
        $this->call(ComplaintSeeder::class);
        // Complaint::factory(50)->make();
    }

    public function truncateTables()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
