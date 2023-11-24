<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        'email' => 'admin@gmail.com', 
        'password' => bcrypt('12345678'), 
        'firstName' => 'Ahmad hilmy', 
        'lastName' => 'Ahmad hilmy',
        'jns_kelamin' =>  'Laki-laki'
        'role' => 0, 
        'email_verified_at' => now(),
        */

        $admins = [
            ['email' => 'admin@gmail.com', 'password' => bcrypt('12345678'), 'firstName' => 'Ahmad hilmy', 'lastName' => 'Ahmad hilmy', 'jns_kelamin' =>  'Laki-laki', 'role' => 0, 'email_verified_at' => now(),],
        ];

        foreach ($admins as $adminData) {
            $user = User::create([
                'email' => $adminData['email'],
                'firstName' => $adminData['firstName'],
                'lastName' => $adminData['lastName'],
                'password' => $adminData['password'],
                "email_verified_at" => $adminData['email_verified_at'],
                "role" => 0,
            ]);

            Admin::create([
                "user_id" => $user->id,
                "email" => $adminData["email"],
                "firstName" => $adminData["firstName"],
                "lastName" => $adminData["lastName"],
                "jns_kelamin" => $adminData["jns_kelamin"],
            ]);
        }
    }
}
