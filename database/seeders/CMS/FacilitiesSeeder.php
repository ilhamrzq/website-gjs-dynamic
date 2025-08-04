<?php

namespace Database\Seeders\CMS;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilitiesSeeder extends Seeder
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
            DB::table('cms_facilities')->truncate();
            // Aktifkan kembali foreign key checks untuk MySQL
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } elseif (DB::getDriverName() === 'pgsql') {
            // Nonaktifkan foreign key checks untuk PostgreSQL
            // Hapus data tanpa truncate

            // di pgsql
            // DB::table('cms_facilities')->delete();
            // DB::statement('ALTER SEQUENCE roles_id_seq RESTART WITH 1;'); // Reset auto increment untuk PostgreSQL

            // di navicat pgsql
            DB::statement('TRUNCATE cms_facilities RESTART IDENTITY CASCADE;');
        }

        $facilities = [
            [
                "lang_id" => 1,
                "facility_name" => "Area Parkir",
                "facility_description" => "Tersedia area parkir untuk kendaraan roda dua dan roda empat.",
                "facility_icon" => "IoCarOutline",
                "created_at" => now(),
                "updated_at" => now(),
                "created_by" => 1,
                "updated_by" => 1,
                "is_active" => 1
            ],
            [
                "lang_id" => 1,
                "facility_name" => "Wifi Gratis",
                "facility_description" => "Tersedia akses Wifi gratis dengan koneksi cepat untuk mendukung aktivitas online Anda.",
                "facility_icon" => "FaWifi",
                "created_at" => now(),
                "updated_at" => now(),
                "created_by" => 1,
                "updated_by" => 1,
                "is_active" => 1
            ],
            [
                "lang_id" => 1,
                "facility_name" => "Bar, Kafe & Resto",
                "facility_description" => "Nikmati beragam pilihan makanan dan minuman di area bar, kafe, dan restoran yang tersedia.",
                "facility_icon" => "ImSpoonKnife",
                "created_at" => now(),
                "updated_at" => now(),
                "created_by" => 1,
                "updated_by" => 1,
                "is_active" => 1
            ],
            [
                "lang_id" => 1,
                "facility_name" => "Tempat Pengisian Daya",
                "facility_description" => "Area khusus untuk mengisi daya baterai perangkat elektronik Anda dengan aman dan nyaman.",
                "facility_icon" => "RiBatteryChargeLine",
                "created_at" => now(),
                "updated_at" => now(),
                "created_by" => 1,
                "updated_by" => 1,
                "is_active" => 1
            ],
            [
                "lang_id" => 1,
                "facility_name" => "Ruang Loker",
                "facility_description" => "Disediakan ruang loker untuk menyimpan barang bawaan Anda dengan aman selama beraktivitas.",
                "facility_icon" => "PiLockers",
                "created_at" => now(),
                "updated_at" => now(),
                "created_by" => 1,
                "updated_by" => 1,
                "is_active" => 1
            ],
            [
                "lang_id" => 1,
                "facility_name" => "Area Bebas Rokok",
                "facility_description" => "Area bebas asap rokok di dalam gedung. Merokok hanya diperbolehkan di area khusus merokok yang telah disediakan.",
                "facility_icon" => "MdSmokeFree",
                "created_at" => now(),
                "updated_at" => now(),
                "created_by" => 1,
                "updated_by" => 1,
                "is_active" => 1
            ],
            [
                "lang_id" => 2,
                "facility_name" => "Parking Area",
                "facility_description" => "Parking area is available for motorcycles and cars.",
                "facility_icon" => "IoCarOutline",
                "created_at" => now(),
                "updated_at" => now(),
                "created_by" => 1,
                "updated_by" => 1,
                "is_active" => 1
            ],
            [
                "lang_id" => 2,
                "facility_name" => "Free Wifi",
                "facility_description" => "Free Wifi access with high-speed connection to support your online activities.",
                "facility_icon" => "FaWifi",
                "created_at" => now(),
                "updated_at" => now(),
                "created_by" => 1,
                "updated_by" => 1,
                "is_active" => 1
            ],
            [
                "lang_id" => 2,
                "facility_name" => "Bar, Cafe & Resto",
                "facility_description" => "Enjoy a variety of food and drink options at the available bar, café, and restaurant area.",
                "facility_icon" => "ImSpoonKnife",
                "created_at" => now(),
                "updated_at" => now(),
                "created_by" => 1,
                "updated_by" => 1,
                "is_active" => 1
            ],
            [
                "lang_id" => 2,
                "facility_name" => "Charging Spot",
                "facility_description" => "A dedicated area to safely and comfortably charge your electronic devices.",
                "facility_icon" => "RiBatteryChargeLine",
                "created_at" => now(),
                "updated_at" => now(),
                "created_by" => 1,
                "updated_by" => 1,
                "is_active" => 1
            ],
            [
                "lang_id" => 2,
                "facility_name" => "Locker Room",
                "facility_description" => "Lockers are provided to securely store your belongings while you are engaged in activities.",
                "facility_icon" => "PiLockers",
                "created_at" => now(),
                "updated_at" => now(),
                "created_by" => 1,
                "updated_by" => 1,
                "is_active" => 1
            ],
            [
                "lang_id" => 2,
                "facility_name" => "Free Smoking Area",
                "facility_description" => "A smoke-free area inside the building. Smoking is only allowed in designated smoking areas provided.",
                "facility_icon" => "MdSmokeFree",
                "created_at" => now(),
                "updated_at" => now(),
                "created_by" => 1,
                "updated_by" => 1,
                "is_active" => 1
            ],
        ];

        DB::table("cms_facilities")->insert($facilities);
    }
}
