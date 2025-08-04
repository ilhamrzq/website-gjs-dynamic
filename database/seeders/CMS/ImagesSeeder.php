<?php

namespace Database\Seeders\CMS;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagesSeeder extends Seeder
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
            DB::table('cms_gallery_categories')->truncate();
            // Aktifkan kembali foreign key checks untuk MySQL
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } elseif (DB::getDriverName() === 'pgsql') {
            // Nonaktifkan foreign key checks untuk PostgreSQL
            // Hapus data tanpa truncate

            // di pgsql
            // DB::table('cms_gallery_categories')->delete();
            // DB::statement('ALTER SEQUENCE roles_id_seq RESTART WITH 1;'); // Reset auto increment untuk PostgreSQL

            // di navicat pgsql
            DB::statement('TRUNCATE cms_gallery_categories RESTART IDENTITY CASCADE;');
        }

        $galleryCategories = [
            [
                'category_name_id' => 'Semi VIP Room',
                'category_name_en' => 'Semi VIP Room',
                'category_slug_id' => 'semi-vip-room',
                'category_slug_en' => 'semi-vip-room',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                'category_name_id' => 'VIP Room',
                'category_name_en' => 'VIP Room',
                'category_slug_id' => 'vip-room',
                'category_slug_en' => 'vip-room',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                'category_name_id' => 'Regular Room',
                'category_name_en' => 'Regular Room',
                'category_slug_id' => 'regular-room',
                'category_slug_en' => 'regular-room',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                'category_name_id' => 'Bar',
                'category_name_en' => 'Bar',
                'category_slug_id' => 'bar',
                'category_slug_en' => 'bar',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                'category_name_id' => 'Restaurant',
                'category_name_en' => 'Restaurant',
                'category_slug_id' => 'restaurant',
                'category_slug_en' => 'restaurant',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ]
        ];

        $galleriesImages = [
            [
                'category_id' => 1,
                'file_path' => 'assets/content/galleries/00001.png',
                'file_name' => 'semi_vip_room_1.jpg',
                'file_size' => 12345,
                'is_default' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                'category_id' => 1,
                'file_path' => 'assets/content/galleries/00002.png',
                'file_name' => 'semi_vip_room_2.jpg',
                'file_size' => 12345,
                'is_default' => 0,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                'category_id' => 2,
                'file_path' => 'assets/content/galleries/00002.png',
                'file_name' => 'vip_room_1.jpg',
                'file_size' => 12345,
                'is_default' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                'category_id' => 3,
                'file_path' => 'assets/content/galleries/00001.png',
                'file_name' => 'regular_room_1.jpg',
                'file_size' => 12345,
                'is_default' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                'category_id' => 4,
                'file_path' => 'assets/content/galleries/00002.png',
                'file_name' => 'bar_1.jpg',
                'file_size' => 12345,
                'is_default' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
            [
                'category_id' => 5,
                'file_path' => 'assets/content/galleries/00001.png',
                'file_name' => 'restaurant_1.jpg',
                'file_size' => 12345,
                'is_default' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ]
        ];

        DB::table('cms_gallery_categories')->insert($galleryCategories);
        DB::table('cms_galleries_images')->insert($galleriesImages);
    }
}
