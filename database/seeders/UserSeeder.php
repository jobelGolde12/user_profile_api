<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'Juan',
                'last_name' => 'dela Cruz',
                'email' => 'juan.delacruz@gmail.com',
                'contact_number' => '+639151234567',
                'address' => '123 Rizal Street, Manila, Metro Manila',
                'birthdate' => '1990-05-15',
                'gender' => 'Male',
                'profile_picture' => 'profile_juan.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Maria',
                'last_name' => 'Santos',
                'email' => 'maria.santos@gmail.com',
                'contact_number' => '+639152345678',
                'address' => '456 Bonifacio Avenue, Quezon City, Metro Manila',
                'birthdate' => '1992-08-22',
                'gender' => 'Female',
                'profile_picture' => 'profile_maria.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Jose',
                'last_name' => 'Reyes',
                'email' => 'jose.reyes@gmail.com',
                'contact_number' => '+639153456789',
                'address' => '789 Mabini Street, Cebu City, Cebu',
                'birthdate' => '1985-12-10',
                'gender' => 'Male',
                'profile_picture' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Ana',
                'last_name' => 'Gonzales',
                'email' => 'ana.gonzales@gmail.com',
                'contact_number' => '+639154567890',
                'address' => '321 Luna Street, Davao City, Davao del Sur',
                'birthdate' => '1993-03-30',
                'gender' => 'Female',
                'profile_picture' => 'profile_ana.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Pedro',
                'last_name' => 'Lopez',
                'email' => 'pedro.lopez@gmail.com',
                'contact_number' => null,
                'address' => null,
                'birthdate' => '1988-07-18',
                'gender' => 'Male',
                'profile_picture' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Carmen',
                'last_name' => 'Garcia',
                'email' => 'carmen.garcia@gmail.com',
                'contact_number' => '+639155678901',
                'address' => '654 Burgos Street, Iloilo City, Iloilo',
                'birthdate' => '1991-11-05',
                'gender' => 'Female',
                'profile_picture' => 'profile_carmen.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Antonio',
                'last_name' => 'Mendoza',
                'email' => 'antonio.mendoza@gmail.com',
                'contact_number' => '+639156789012',
                'address' => '987 Quezon Avenue, Baguio City, Benguet',
                'birthdate' => '1987-02-14',
                'gender' => 'Male',
                'profile_picture' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Teresa',
                'last_name' => 'Villanueva',
                'email' => 'teresa.villanueva@gmail.com',
                'contact_number' => '+639157890123',
                'address' => '147 Roxas Boulevard, Pasay City, Metro Manila',
                'birthdate' => '1994-09-25',
                'gender' => 'Female',
                'profile_picture' => 'profile_teresa.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Ricardo',
                'last_name' => 'Castillo',
                'email' => 'ricardo.castillo@gmail.com',
                'contact_number' => '+639158901234',
                'address' => '258 Aguinaldo Street, Makati City, Metro Manila',
                'birthdate' => '1989-04-12',
                'gender' => 'Male',
                'profile_picture' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Lourdes',
                'last_name' => 'Fernandez',
                'email' => 'lourdes.fernandez@gmail.com',
                'contact_number' => '+639159012345',
                'address' => '369 Legaspi Street, Cagayan de Oro City',
                'birthdate' => '1995-06-08',
                'gender' => 'Female',
                'profile_picture' => 'profile_lourdes.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Fernando',
                'last_name' => 'Ramirez',
                'email' => 'fernando.ramirez@gmail.com',
                'contact_number' => '+639160123456',
                'address' => '741 Kalaw Street, Manila, Metro Manila',
                'birthdate' => '1986-10-30',
                'gender' => 'Male',
                'profile_picture' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Sofia',
                'last_name' => 'Torres',
                'email' => 'sofia.torres@gmail.com',
                'contact_number' => '+639161234567',
                'address' => '852 Taft Avenue, Pasay City, Metro Manila',
                'birthdate' => '1992-01-18',
                'gender' => 'Female',
                'profile_picture' => 'profile_sofia.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        // Insert users into database
        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }
    }
}
