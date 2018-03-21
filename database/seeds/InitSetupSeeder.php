<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class InitSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
        ]);

        DB::statement("SET FOREIGN_KEY_CHECKS=0;");

        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_id' => 1,
            'model_type' => 'App\\Models\\User',
        ]);

        DB::table('permissions')->insert([
            'id' => 1,
            'name' => 'update profile',
            'guard_name' => 'web',
        ]);

        DB::table('role_has_permissions')->insert([
            'permission_id' => 1,
            'role_id' => 1,
        ]);

        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        DB::statement("SET FOREIGN_KEY_CHECKS=1;");
    }
}
