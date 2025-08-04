<?php

namespace Database\Seeders\CMS;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Periksa jenis koneksi database
        if (DB::getDriverName() === 'mysql') {
            // Nonaktifkan foreign key checks untuk MySQL
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('cms_local_areas')->truncate();
            // Aktifkan kembali foreign key checks untuk MySQL
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } elseif (DB::getDriverName() === 'pgsql') {
            // Nonaktifkan foreign key checks untuk PostgreSQL
            // Hapus data tanpa truncate

            // di pgsql
            // DB::table('cms_local_areas')->delete();
            // DB::statement('ALTER SEQUENCE roles_id_seq RESTART WITH 1;'); // Reset auto increment untuk PostgreSQL

            // di navicat pgsql
            DB::statement('TRUNCATE cms_local_areas RESTART IDENTITY CASCADE;');
        }

        $local_areas = [
            [
                "place_name" => "Park Hyatt Jakarta",
                "file_path" => "assets/pbc/images/local-areas/20250708_000001.png",
                "file_name" => "20250708_000001.png",
                "file_size" => "000000",
                "created_at" => now(),
                "updated_at" => now(),
                "created_by" => 1,
                "updated_by" => 1,
                "is_active" => 1
            ],
            [
                "place_name" => "Center Point Restaurant",
                "file_path" => "assets/pbc/images/local-areas/20250708_000002.png",
                "file_name" => "20250708_000002.png",
                "file_size" => "000000",
                "created_at" => now(),
                "updated_at" => now(),
                "created_by" => 1,
                "updated_by" => 1,
                "is_active" => 1
            ],
            [
                "place_name" => "Woollomooloo Restaurant",
                "file_path" => "assets/pbc/images/local-areas/20250708_000003.png",
                "file_name" => "20250708_000003.png",
                "file_size" => "000000",
                "created_at" => now(),
                "updated_at" => now(),
                "created_by" => 1,
                "updated_by" => 1,
                "is_active" => 1
            ],
            [
                "place_name" => "Wasabae Restaurant",
                "file_path" => "assets/pbc/images/local-areas/20250708_000004.png",
                "file_name" => "20250708_000004.png",
                "file_size" => "000000",
                "created_at" => now(),
                "updated_at" => now(),
                "created_by" => 1,
                "updated_by" => 1,
                "is_active" => 1
            ],
            [
                "place_name" => "Masjid Bimantara",
                "file_path" => "assets/pbc/images/local-areas/20250708_000005.png",
                "file_name" => "20250708_000005.png",
                "file_size" => "000000",
                "created_at" => now(),
                "updated_at" => now(),
                "created_by" => 1,
                "updated_by" => 1,
                "is_active" => 1
            ],
            [
                "place_name" => "Stasiun Gondangdia",
                "file_path" => "assets/pbc/images/local-areas/20250708_000006.png",
                "file_name" => "20250708_000006.png",
                "file_size" => "000000",
                "created_at" => now(),
                "updated_at" => now(),
                "created_by" => 1,
                "updated_by" => 1,
                "is_active" => 1
            ],
            [
                "place_name" => "Halte Bus Gondangdia",
                "file_path" => "assets/pbc/images/local-areas/20250708_000007.png",
                "file_name" => "20250708_000007.png",
                "file_size" => "000000",
                "created_at" => now(),
                "updated_at" => now(),
                "created_by" => 1,
                "updated_by" => 1,
                "is_active" => 1
            ],
            [
                "place_name" => "Stasiun MRT Bundaran HI",
                "file_path" => "assets/pbc/images/local-areas/20250708_000008.png",
                "file_name" => "20250708_000008.png",
                "file_size" => "000000",
                "created_at" => now(),
                "updated_at" => now(),
                "created_by" => 1,
                "updated_by" => 1,
                "is_active" => 1
            ],
            [
                "place_name" => "Sarinah",
                "file_path" => "assets/pbc/images/local-areas/20250708_000009.png",
                "file_name" => "20250708_000009.png",
                "file_size" => "000000",
                "created_at" => now(),
                "updated_at" => now(),
                "created_by" => 1,
                "updated_by" => 1,
                "is_active" => 1
            ],
        ];

        DB::table("cms_local_areas")->insert($local_areas);
    }
}
