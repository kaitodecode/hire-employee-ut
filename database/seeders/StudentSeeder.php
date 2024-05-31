<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    \App\Models\HiredStudent::create([
        'branch_id' => 1,
        'name' => 'Adi Kurniawan',
        'age' => 18,
        'height' => 160,
        'weight' => 45,
        'experience' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia itaque obcaecati debitis voluptates ducimus tenetur est alias voluptate facilis excepturi.',
        'role' => 'mechanic'
    ]);

    \App\Models\HiredStudent::create([
        'branch_id' => 2,
        'name' => 'Budi Santoso',
        'age' => 20,
        'height' => 165,
        'weight' => 50,
        'experience' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia itaque obcaecati debitis voluptates ducimus tenetur est alias voluptate facilis excepturi.',
        'role' => 'operator'
    ]);

    \App\Models\HiredStudent::create([
        'branch_id' => 1,
        'name' => 'Citra Dewi',
        'age' => 22,
        'height' => 155,
        'weight' => 48,
        'experience' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia itaque obcaecati debitis voluptates ducimus tenetur est alias voluptate facilis excepturi.',
        'role' => 'mechanic'
    ]);

    \App\Models\HiredStudent::create([
        'branch_id' => 3,
        'name' => 'Dian Sari',
        'age' => 19,
        'height' => 162,
        'weight' => 47,
        'experience' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia itaque obcaecati debitis voluptates ducimus tenetur est alias voluptate facilis excepturi.',
        'role' => 'operator'
    ]);

    \App\Models\HiredStudent::create([
        'branch_id' => 2,
        'name' => 'Eko Prasetyo',
        'age' => 21,
        'height' => 170,
        'weight' => 55,
        'experience' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia itaque obcaecati debitis voluptates ducimus tenetur est alias voluptate facilis excepturi.',
        'role' => 'mechanic'
    ]);

    \App\Models\HiredStudent::create([
        'branch_id' => 1,
        'name' => 'Fita Rahayu',
        'age' => 23,
        'height' => 158,
        'weight' => 49,
        'experience' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia itaque obcaecati debitis voluptates ducimus tenetur est alias voluptate facilis excepturi.',
        'role' => 'operator'
    ]);

    \App\Models\HiredStudent::create([
        'branch_id' => 3,
        'name' => 'Gita Wijaya',
        'age' => 20,
        'height' => 165,
        'weight' => 52,
        'experience' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia itaque obcaecati debitis voluptates ducimus tenetur est alias voluptate facilis excepturi.',
        'role' => 'mechanic'
    ]);

    \App\Models\HiredStudent::create([
        'branch_id' => 2,
        'name' => 'Hadi Setiawan',
        'age' => 24,
        'height' => 175,
        'weight' => 60,
        'experience' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia itaque obcaecati debitis voluptates ducimus tenetur est alias voluptate facilis excepturi.',
        'role' => 'operator'
    ]);

    \App\Models\HiredStudent::create([
        'branch_id' => 1,
        'name' => 'Indah Permata',
        'age' => 25,
        'height' => 160,
        'weight' => 50,
        'experience' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia itaque obcaecati debitis voluptates ducimus tenetur est alias voluptate facilis excepturi.',
        'role' => 'mechanic'
    ]);

    \App\Models\HiredStudent::create([
        'branch_id' => 3,
        'name' => 'Joko Susilo',
        'age' => 22,
        'height' => 168,
        'weight' => 58,
        'experience' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia itaque obcaecati debitis voluptates ducimus tenetur est alias voluptate facilis excepturi.',
        'role' => 'operator'
    ]);
    }
}
