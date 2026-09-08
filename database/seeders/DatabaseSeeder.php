<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BranchSeeder::class,
            ProductSeeder::class,
        ]);

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Gunakan firstOrCreate agar aman jika data sudah ada
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );

        // 1. Admin Pusat
        User::updateOrCreate(
            ['email' => 'adminpusat@gmail.com'],
            [
                'name' => 'Admin Pusat',
                'password' => bcrypt('password'),
                'role' => 'admin_pusat',
                'jenis_pelanggan' => 'perorangan',
                'is_active' => 1,
            ]
        );

        // 2. Admin Cabang
        User::updateOrCreate(
            ['email' => 'admincabang@gmail.com'],
            [
                'name' => 'Admin Cabang',
                'password' => bcrypt('password'),
                'role' => 'admin_cabang',
                'jenis_pelanggan' => 'perorangan',
                'branch_id' => 1, // Terikat ke cabang pertama
                'is_active' => 1,
            ]
        );

        // 3. Tenaga Ahli
        User::updateOrCreate(
            ['email' => 'tenagaahli@gmail.com'],
            [
                'name' => 'Tenaga Ahli',
                'password' => bcrypt('password'),
                'role' => 'tenaga_ahli',
                'jenis_pelanggan' => 'perorangan',
                'is_active' => 1,
            ]
        );
    }
}
