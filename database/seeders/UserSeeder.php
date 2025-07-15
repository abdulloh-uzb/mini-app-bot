<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $teacher = Role::create(['name' => 'teacher']);
        $student = Role::create(['name' => 'student']);

        User::create([
            'name' => 'Admin User',
            'phone_number' => '+998931234567',
            'password' => bcrypt('password'),
        ])->assignRole($admin);

        User::create([
            'name' => 'Sevara',
            'phone_number' => '998919663427',
            'password' => bcrypt('password'),
        ])->assignRole($teacher);

        User::create([
            'name' => 'Hasan',
            'phone_number' => '+998912600094',
            'password' => bcrypt('password'),
        ])->assignRole($teacher);

        User::create([
            'name' => 'Ilhom',
            'phone_number' => '+998909001020',
            'password' => bcrypt('password'),
        ])->assignRole($teacher);

        User::create([
            'name' => 'Kozimjon Hamroqulov',
            'phone_number' => '+998901234500',
            'password' => bcrypt('password'),
        ])->assignRole($student);


        User::create([
            'name' => 'Bekzod Abdusamiyev',
            'phone_number' => '+998333435503',
            'password' => bcrypt('password'),
        ])->assignRole($student);

        User::create([
            'name' => 'Jahongir Sunnatov',
            'phone_number' => '+998884086612',
            'password' => bcrypt('password'),
        ])->assignRole($student);

    }
}
