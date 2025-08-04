<?php

namespace Database\Seeders\CMS;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideoSeeder extends Seeder
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
            DB::table('cms_videos')->truncate();
            // Aktifkan kembali foreign key checks untuk MySQL
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } elseif (DB::getDriverName() === 'pgsql') {
            // Nonaktifkan foreign key checks untuk PostgreSQL
            // Hapus data tanpa truncate

            // di pgsql
            // DB::table('cms_videos')->delete();
            // DB::statement('ALTER SEQUENCE roles_id_seq RESTART WITH 1;'); // Reset auto increment untuk PostgreSQL

            // di navicat pgsql
            DB::statement('TRUNCATE cms_videos RESTART IDENTITY CASCADE;');
        }

        $videos = [
            [
                'video_title_id' => 'Pro Billiard Center 9 Ball Tournament',
                'video_title_en' => 'Pro Billiard Center 9 Ball Tournament',
                'file_path' => 'assets/content/videos/video.mp4',
                'file_name' => 'pro-billiard-center-9-ball-tournament.mp4',
                'file_size' => 12345,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                'video_title_id' => 'Pro Billiard Center 8 Ball Tournament',
                'video_title_en' => 'Pro Billiard Center 8 Ball Tournament',
                'file_path' => 'assets/content/videos/video2.mp4',
                'file_name' => 'pro-billiard-center-8-ball-tournament.mp4',
                'file_size' => 12345,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                'video_title_id' => 'Pro Billiard Center 10 Ball Tournament',
                'video_title_en' => 'Pro Billiard Center 10 Ball Tournament',
                'file_path' => 'assets/content/videos/video.mp4',
                'file_name' => 'pro-billiard-center-10-ball-tournament.mp4',
                'file_size' => 12345,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                'video_title_id' => 'Pro Billiard Center 14.1 Tournament',
                'video_title_en' => 'Pro Billiard Center 14.1 Tournament',
                'file_path' => 'assets/content/videos/video2.mp4',
                'file_name' => 'pro-billiard-center-14-1-tournament.mp4',
                'file_size' => 12345,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                'video_title_id' => 'Pro Billiard Center 1 Pocket Tournament',
                'video_title_en' => 'Pro Billiard Center 1 Pocket Tournament',
                'file_path' => 'assets/content/videos/video.mp4',
                'file_name' => 'pro-billiard-center-1-pocket-tournament.mp4',
                'file_size' => 12345,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ]
        ];

        DB::table('cms_videos')->insert($videos);
    }
}
