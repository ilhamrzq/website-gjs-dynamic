<?php

namespace Database\Seeders;

use App\Models\Configuration\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
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
            DB::statement('TRUNCATE users RESTART IDENTITY CASCADE;');
            DB::statement('TRUNCATE roles RESTART IDENTITY CASCADE;');
        }

        $users = [
            [
                'name' => 'superadmin',
                'email' => 'superadmin@gmail.com',
                'phone' => '087883864673',
                'email_verified_at' => now(),
                'password' => bcrypt("@B512Indonesia")
            ],

            [
                'name' => 'Admin Social Media',
                'email' => 'admin@pbc.com',
                'phone' => '08152349069',
                'email_verified_at' => now(),
                'password' => bcrypt("adminpbc2025")
            ],

            [
                'name' => 'Admin SAT',
                'email' => 'sat@probilliardcenter.com',
                'phone' => '08152349068',
                'email_verified_at' => now(),
                'password' => bcrypt("@SatPBC123")
            ]
        ];

        DB::table('users')->insert($users);

        $roles = [
            ['name' => 'superadmin'],
            ['name' => 'admin'],
        ];

        $default = [
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 0,
            'updated_by' => 0,
        ];

        foreach ($roles as &$row) {
            $row = array_merge($row, $default);
        }

        // Seeding roles
        DB::table('roles')->insert($roles);


        // Assign role to the users;
        $superadmin = User::where('email', 'superadmin@gmail.com')->first();
        $adminsat = User::where('email', 'sat@probilliardcenter.com')->first();
        $admin_social_media = User::where('email', 'admin@pbc.com')->first();

        $superadmin->assignRole('superadmin');
        $adminsat->assignRole('superadmin');
        $admin_social_media->assignRole('admin');
    }
}
