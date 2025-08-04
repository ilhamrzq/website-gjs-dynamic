<?php

namespace Database\Seeders\CMS;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomepageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (DB::getDriverName() === 'mysql') {
            // Nonaktifkan foreign key checks untuk MySQL
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('cms_homepage')->truncate();
            // Aktifkan kembali foreign key checks untuk MySQL
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } elseif (DB::getDriverName() === 'pgsql') {
            // Nonaktifkan foreign key checks untuk PostgreSQL
            // Hapus data tanpa truncate

            // di pgsql
            // DB::table('cms_homepage')->delete();
            // DB::statement('ALTER SEQUENCE roles_id_seq RESTART WITH 1;'); // Reset auto increment untuk PostgreSQL

            // di navicat pgsql
            DB::statement('TRUNCATE cms_homepage RESTART IDENTITY CASCADE;');
        }

        $homepages = [
            [
                'lang_id' => 1,
                'hero_title' => 'Arena Billiard Modern dengan Fasilitas Lengkap & Nyaman',
                'hero_description' => 'Pro Billiard Center adalah pusat billiard modern dengan fasilitas lengkap dan suasana nyaman, cocok untuk bermain santai maupun turnamen. Nikmati pengalaman bermain billiard terbaik di lokasi strategis di pusat kota.',
                'feature_left_title' => 'Number One Billiard House in Indonesia',
                'feature_left_description' => 'PBC akan senantiasa membina atlet-atlet billiard dan menjadi pusat olahraga billiard di Indonesia dengan menyediakan fasilitas-fasilitas terbaik demi kenyamanan para pecinta billiard.',
                'feature_center_title' => 'Premium Equipment',
                'feature_center_description' => 'Kami menyediakan peralatan billiard premium untuk memastikan pengalaman bermain.',
                'feature_right_title' => 'Professional Coaching',
                'feature_right_description' => 'Pelatih profesional kami siap membantu Anda meningkatkan keterampilan billiard Anda.',
                'video_path' => '/assets/content/homepage/video.mp4',
                'video_name' => 'video.mp4',
                'video_size' => 90000,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                'lang_id' => 2,
                'hero_title' => 'Modern Billiard Arena with Complete & Cozy Facilities',
                'hero_description' => 'Pro Billiard Center is a modern billiard center with complete facilities and a comfortable atmosphere, perfect for casual play or tournaments. Enjoy the best billiard experience in a strategic location in the city center.',
                'feature_left_title' => 'Number One Billiard House in Indonesia',
                'feature_left_description' => 'PBC will always nurture billiard athletes and become the center of billiard sports in Indonesia by providing the best facilities for billiard enthusiasts.',
                'feature_center_title' => 'Premium Equipment',
                'feature_center_description' => 'We provide premium billiard equipment to ensure an exceptional playing experience.',
                'feature_right_title' => 'Professional Coaching',
                'feature_right_description' => 'Our professional coaches are ready to help you improve your billiard skills.',
                'video_path' => '/assets/content/homepage/video.mp4',
                'video_name' => 'video.mp4',
                'video_size' => 90000,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ]
        ];

        $homepage_images = [
            [
                'cms_homepage_id' => 1,
                'file_path' => '/assets/content/homepage/thumbnail.png',
                'file_name' => 'thumbnail.png',
                'file_size' => 50000,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1,
                'is_default' => 1
            ],
            [
                'cms_homepage_id' => 2,
                'file_path' => '/assets/content/homepage/thumbnail.png',
                'file_name' => 'thumbnail.png',
                'file_size' => 50000,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1,
                'is_default' => 1
            ]
        ];

        DB::table('cms_homepage')->insert($homepages);
        DB::table('cms_homepage_hero_image')->insert($homepage_images);
    }
}
