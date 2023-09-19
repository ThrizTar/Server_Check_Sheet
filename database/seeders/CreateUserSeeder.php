<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create seeder
        $user = [
            [
                'username' => 'admin.test',
                'email' => 'Admin_Test@tanaka.co.th',
                'first_name' => 'Admin',
                'last_name' => 'Test',
                'name' => 'Admin Test',
                'is_admin' => '1',
                'password' => bcrypt('1234')
            ]
        ];

        foreach($user as $key => $value){
            User::create($value);
        }
    }
}
