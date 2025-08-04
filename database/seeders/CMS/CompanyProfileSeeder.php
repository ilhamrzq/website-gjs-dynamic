<?php

namespace Database\Seeders\CMS;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyProfileSeeder extends Seeder
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
            DB::table('cms_company_profile')->truncate();
            // Aktifkan kembali foreign key checks untuk MySQL
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } elseif (DB::getDriverName() === 'pgsql') {
            // Nonaktifkan foreign key checks untuk PostgreSQL
            // Hapus data tanpa truncate

            // di pgsql
            // DB::table('cms_company_profile')->delete();
            // DB::statement('ALTER SEQUENCE roles_id_seq RESTART WITH 1;'); // Reset auto increment untuk PostgreSQL

            // di navicat pgsql
            DB::statement('TRUNCATE cms_company_profile RESTART IDENTITY CASCADE;');
        }
        
        $companyProfile = [
            "company_email" => "admin@pbc.com",
            "company_address" => "iNews Tower, MNC Center, lt 2, Kebon Sirih, Menteng, Central Jakarta City, Jakarta 10340",
            "company_iframe_maps_url" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.600620015994!2d106.82954427402457!3d-6.1841711605910925!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5002219c23f%3A0xeee35a453ed56a0b!2sPro%20Billiard%20Center!5e0!3m2!1sid!2sid!4v1750389676838!5m2!1sid!2sid",
            "company_phone_number" => "628152349069",
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
            'is_active' => 1
        ];
            
        DB::table('cms_company_profile')->insert($companyProfile);
    }
}
