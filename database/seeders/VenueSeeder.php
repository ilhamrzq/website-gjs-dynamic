<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VenueSeeder extends Seeder
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
            DB::table('roles')->truncate();
            // Aktifkan kembali foreign key checks untuk MySQL
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } elseif (DB::getDriverName() === 'pgsql') {
            // Nonaktifkan foreign key checks untuk PostgreSQL
            // Hapus data tanpa truncate

            // di pgsql
            // DB::table('roles')->delete();
            // DB::statement('ALTER SEQUENCE roles_id_seq RESTART WITH 1;'); // Reset auto increment untuk PostgreSQL

            // di navicat pgsql
            DB::statement('TRUNCATE master_venues RESTART IDENTITY CASCADE;');
        }

        $venues = [
            [
                "venue_name" => "Pro Billiard Center",
                "venue_address" => "iNews Tower, MNC Center, lt 2, Kebon Sirih, Menteng, Central Jakarta City, Jakarta 10340",
                "venue_price" => 100000,
                "venue_url" => "https://maps.app.goo.gl/ihFtLPa6zXczGETaA",
                "venue_slug" => "pro-billiard-center",
                "venue_opening_time" => "08:00:00",
                "venue_closing_time" => "22:00:00",
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ]
        ];

        $venueImage = [
            [
                "venue_id" => 1,
                "file_path" => "assets/images/venues/pro_billiard_center/000001.jpg",
                "file_name" => "000001.jpg",
                "file_size" => 123456,
                "is_default" => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ]
        ];

        DB::table('master_venues')->insert($venues);
        DB::table('venues_images')->insert($venueImage);
    }
}
