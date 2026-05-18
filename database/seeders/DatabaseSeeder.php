<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Jalan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Default Regular User
        User::factory()->create([
            'nama' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'user',
            'password' => Hash::make('password123')
        ]);

        // 2. Seed Default Administrator User
        User::factory()->create([
            'nama' => 'Admin Incitrack',
            'email' => 'admin@incitrack.id',
            'role' => 'admin',
            'password' => Hash::make('admin123')
        ]);

        // 3. Seed Toll Roads (Jalan Tol Indonesia)
        $tolRoads = [
            ['nama_jalan' => 'Jalan Tol Jakarta-Cikampek (Japek)', 'kota' => 'Bekasi - Karawang', 'panjang' => 83.00],
            ['nama_jalan' => 'Jalan Tol Jagorawi', 'kota' => 'Jakarta - Bogor - Ciawi', 'panjang' => 59.00],
            ['nama_jalan' => 'Jalan Tol Cipularang', 'kota' => 'Cikampek - Purwakarta - Padalarang', 'panjang' => 58.50],
            ['nama_jalan' => 'Jalan Tol Tangerang-Merak', 'kota' => 'Tangerang - Serang - Cilegon - Merak', 'panjang' => 72.45],
            ['nama_jalan' => 'Jalan Tol Dalam Kota Jakarta', 'kota' => 'DKI Jakarta', 'panjang' => 47.00],
            ['nama_jalan' => 'Jalan Tol Purbaleunyi', 'kota' => 'Purwakarta - Bandung', 'panjang' => 90.00],
            ['nama_jalan' => 'Jalan Tol Trans-Jawa (Solo-Ngawi)', 'kota' => 'Solo - Sragen - Ngawi', 'panjang' => 90.43],
            ['nama_jalan' => 'Jalan Tol Bakauheni-Terbanggi Besar', 'kota' => 'Lampung', 'panjang' => 140.90],
        ];

        foreach ($tolRoads as $road) {
            Jalan::create($road);
        }
        
        echo "SUCCESS: Seeded 2 default users and " . count($tolRoads) . " toll roads successfully!\n";
    }
}
