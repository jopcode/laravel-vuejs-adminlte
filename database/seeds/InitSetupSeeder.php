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

        DB::statement("INSERT INTO `model_has_roles` (`role_id`, `model_id`, `model_type`) VALUES(1,1,'App\\Models\\User');");

        DB::statement("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES(1,'update profile','web','2018-03-15 19:09:37','2018-03-15 19:09:37');");

        DB::statement("INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES(1,1);");

        DB::statement("INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES (1,'admin','web','2018-01-28 00:24:29',NULL), (2,'customer','web','2018-03-15 18:51:32',NULL);");

        DB::statement("INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES (1,1,'2018-02-04 00:43:14','2018-02-04 00:43:14');");

        DB::statement("SET FOREIGN_KEY_CHECKS=1;");
    }
}
