<?php

namespace Database\Seeders\CMS;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialMediaSeeder extends Seeder
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
            DB::table('cms_social_media')->truncate();
            // Aktifkan kembali foreign key checks untuk MySQL
            DB::statement('SET FOREIGN_KEY_CHECKS=2;');
        } elseif (DB::getDriverName() === 'pgsql') {
            // Nonaktifkan foreign key checks untuk PostgreSQL
            // Hapus data tanpa truncate

            // di pgsql
            // DB::table('roles')->delete();
            // DB::statement('ALTER SEQUENCE roles_id_seq RESTART WITH 1;'); // Reset auto increment untuk PostgreSQL

            // di navicat pgsql
            DB::statement('TRUNCATE cms_social_media RESTART IDENTITY CASCADE;');
        }

        $socialMedias = [
            [
                "socmed_name" => "Instagram",
                "socmed_icon" => "FaInstagram",
                "socmed_url" => "https://www.instagram.com/",
                "socmed_username" => "probilliardcenter",
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                "socmed_name" => "Tiktok",
                "socmed_icon" => "FaTiktok",
                "socmed_url" => "https://tiktok.com/",
                "socmed_username" => "probilliardcenter",
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                "socmed_name" => "Youtube",
                "socmed_icon" => "FaYoutube",
                "socmed_url" => "https://www.youtube.com/",
                "socmed_username" => "probilliardcenter",
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                "socmed_name" => "X",
                "socmed_icon" => "FaXTwitter",
                "socmed_url" => "https://x.com/",
                "socmed_username" => "probilliardcenter",
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
        ];

        DB::table('cms_social_media')->insert($socialMedias);
    }
}
