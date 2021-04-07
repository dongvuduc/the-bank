<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'admin@admin.com',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
        ]);

        \App\Models\User::create([
            'name' => 'user@user.com',
            'email' => 'user@user.com',
            'password' => Hash::make('12345678'),
        ]);

        DB::table('oauth_clients')->insert([
            'id' => '931e54e1-8741-42c4-8dad-b6ff7e2f5199',
            'user_id' => '',
            'name' => 'Laravel Personal Access Client',
            'secret' => 'sQYT8Loq3dSeSGZcYBW3spCBfsgjS0xHuur70QfY',
            'provider' => '',
            'redirect' => 'http://localhost',
            'personal_access_client' => '1',
            'password_client' => '0',
            'revoked' => '0'
        ]);

        DB::table('oauth_clients')->insert([
            'id' => '931e54e1-8e2c-4d68-9acb-876caece37bd',
            'user_id' => '',
            'name' => 'Laravel Password Grant Client',
            'secret' => '3SiCAuMY1eVtrqduFm2n0l9hS4LtTbiPw0aDmdbD',
            'provider' => 'users',
            'redirect' => 'http://localhost',
            'personal_access_client' => '0',
            'password_client' => '1',
            'revoked' => '0'
        ]);

        DB::table('oauth_clients')->insert([
            'id' => '931f0006-4bbf-4773-bd9a-9584c8c62548',
            'user_id' => '',
            'name' => 'The Office',
            'secret' => 'XUaDLBSBsjMt5NYmCNjp4DGVcSt4rfRLEx5gTRkq',
            'provider' => '',
            'redirect' => 'http://localhost:8080/callback',
            'personal_access_client' => '0',
            'password_client' => '0',
            'revoked' => '0'
        ]);

        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => '931e54e1-8741-42c4-8dad-b6ff7e2f5199'
        ]);
    }
}
