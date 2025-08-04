<?php

namespace Database\Seeders\CMS;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CMSMenuSeeder extends Seeder
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
            DB::table('cms_menus')->truncate();
            // Aktifkan kembali foreign key checks untuk MySQL
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } elseif (DB::getDriverName() === 'pgsql') {
            // Nonaktifkan foreign key checks untuk PostgreSQL
            // Hapus data tanpa truncate

            // di pgsql
            // DB::table('cms_menus')->delete();
            // DB::statement('ALTER SEQUENCE roles_id_seq RESTART WITH 1;'); // Reset auto increment untuk PostgreSQL

            // di navicat pgsql
            DB::statement('TRUNCATE cms_menus RESTART IDENTITY CASCADE;');
        }

        $menus = [
            [
                "lang_id" => 1,
                "category_name" => null,
                "menu_name" => "Beranda",
                "menu_path" => "/id",
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                "lang_id" => 1,
                "category_name" => null,
                "menu_name" => "Pemesanan",
                "menu_path" => "/id/pemesanan",
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                "lang_id" => 1,
                "category_name" => null,
                "menu_name" => "Toko",
                "menu_path" => "/id/toko",
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                "lang_id" => 1,
                "category_name" => null,
                "menu_name" => "Events",
                "menu_path" => "/id/events",
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                "lang_id" => 1,
                "category_name" => null,
                "menu_name" => "Kontak Kami",
                "menu_path" => "/id/kontak",
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                "lang_id" => 1,
                "category_name" => null,
                "menu_name" => "Galeri",
                "menu_path" => "/id/galeri",
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                "lang_id" => 2,
                "category_name" => null,
                "menu_name" => "Home",
                "menu_path" => "/en",
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                "lang_id" => 2,
                "category_name" => null,
                "menu_name" => "Bookings",
                "menu_path" => "/en/bookings",
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                "lang_id" => 2,
                "category_name" => null,
                "menu_name" => "Shops",
                "menu_path" => "/en/shops",
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                "lang_id" => 2,
                "category_name" => null,
                "menu_name" => "Events",
                "menu_path" => "/en/events",
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                "lang_id" => 2,
                "category_name" => null,
                "menu_name" => "Contact Us",
                "menu_path" => "/en/contact",
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                "lang_id" => 2,
                "category_name" => null,
                "menu_name" => "Gallery",
                "menu_path" => "/en/gallery",
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
        ];

        DB::table('cms_menus')->insert($menus);
    }
}
