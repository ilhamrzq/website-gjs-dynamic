<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
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
            DB::statement('TRUNCATE products_categories RESTART IDENTITY CASCADE;');
        }

        $productCategory = [
            [
                "product_category_name" => "Merchandise",
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1,
                'is_active' => 1
            ],
        ];

        DB::table('products_categories')->insert($productCategory);
    }
}
