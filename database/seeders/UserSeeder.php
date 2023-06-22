<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'MD BIPLOB MIA',
                'email' => 'admin@gmail.com',
                'phone' => '01725361208',
                'password' => bcrypt('password'),
                'user_type' => 1,
            ],
            [
                'name' => 'MASUD RANA',
                'email' => 'employee@gmail.com',
                'phone' => '01930384220',
                'password' => bcrypt('password'),
                'user_type' => 2,
            ]
        ];

        foreach ($users as $user) {
            $newUser = User::create($user);

            if ($newUser->user_type == 1) {
                $newUser->assignRole('admin');
            } else if ($newUser->user_type == 2) {
                $newUser->assignRole('employee');

                $employee = new Employee();

                $employee->user_id = $newUser->id;
                $employee->address = '93/A, Bashir Uddin Road, Kalabagan, Dhaka-1205';
                $employee->emergency_contact = '01722222222';
                $employee->save();
            }
        }

        // $user = [
        //     'name' => 'MD BIPLOB MIA',
        //     'email' => 'admin@gmail.com',
        //     'phone' => '01725361208',
        //     'password' => bcrypt('password'),
        //     'user_type' => 1,
        // ];

        // User::create($user);

        // $user = User::find(1);
        // $user->assignRole('admin');
    }
}
