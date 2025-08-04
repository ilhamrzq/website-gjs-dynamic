<?php

namespace Database\Seeders;

use App\Models\Configuration\Menu;
use App\Traits\HasMenuPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    use HasMenuPermission;

    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        if (env('DB_CONNECTION') === 'mysql') {
            // nonaktifkan foreign key
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            DB::table('role_has_permissions')->truncate();
            DB::table('menu_permission')->truncate();

            DB::table('permissions')->truncate();
            DB::table('menus')->truncate();

            // aktifin foreign key lagi
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } else if (DB::getDriverName() === 'pgsql') {

            // // hapus data dari tabel anak
            // DB::table('role_has_permissions')->truncate();
            // DB::table('menu_permission')->truncate();

            // // hapus data dari tabel parent
            // DB::table('permissions')->truncate();
            // DB::table('menus')->truncate();

            // Atur ulang sequence auto-increment untuk PostgreSQL secara manual
            // DB::statement('ALTER SEQUENCE permissions_id_seq RESTART WITH 1;');
            // DB::statement('ALTER SEQUENCE menus_id_seq RESTART WITH 1;');

            // di navicat pqsl
            // tabel anak
            DB::statement('TRUNCATE TABLE role_has_permissions RESTART IDENTITY CASCADE;');
            DB::statement('TRUNCATE TABLE menu_permission RESTART IDENTITY CASCADE;');

            // tabel parent
            DB::statement('TRUNCATE TABLE permissions RESTART IDENTITY CASCADE;');
            DB::statement('TRUNCATE TABLE menus RESTART IDENTITY CASCADE;');
        }

        Cache::forget('menus');

        // Dashboard
        $mm = Menu::updateOrCreate(
            ['url' => 'dashboard'],
            ['name' => 'Dashboard', 'category' => 'DASHBOARD', 'icon' => 'ri-bar-chart-fill', 'orders' => 1]
        );
        $this->attachMenuPermission($mm, ['read'], ['superadmin', 'admin']);

        // Menu configurations
        $mm = Menu::updateOrCreate(
            ['url' => 'configurations'],
            ['name' => 'Configurations', 'category' => 'CONFIGURATIONS', 'icon' => 'ri-settings-4-fill', 'orders' => 2]
        );
        $this->attachMenuPermission($mm, ['read'], ['superadmin', 'admin']);

        // Buat submenu Menus
        $sm = $mm->subMenus()->create([
            'name' => 'Menus',
            'url' => $mm->url . '/menu',
            'icon' => 'ri-menu-4-line',
            'category' => $mm->category,
            'orders' => 3
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);

        // Buat submenu Admin
        $sm = $mm->subMenus()->create([
            'name' => 'Admin',
            'url' => $mm->url . '/admin',
            'icon' => 'ri-group-fill',
            'category' => $mm->category,
            'orders' => 4
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);
        
        // Buat submenu Roles
        $sm = $mm->subMenus()->create([
            'name' => 'Roles',
            'url' => $mm->url . '/role',
            'icon' => 'ri-shield-user-fill',
            'category' => $mm->category,
            'orders' => 5
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);

        // Buat submenu Permissions hanya untuk superadmin
        $sm = $mm->subMenus()->create([
            'name' => 'Permissions',
            'url' => $mm->url . '/permission',
            'icon' => 'ri-shield-keyhole-fill',
            'category' => $mm->category,
            'orders' => 6
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);

        $mm = Menu::updateOrCreate(
            ['url' => 'master'],
            ['name' => 'Master', 'category' => 'Master', 'icon' => 'ri-stack-fill', 'orders' => 7]
        );
        $this->attachMenuPermission($mm, ['read'], ['superadmin', 'admin']);

        // Submenu Languages
        $sm = $mm->subMenus()->create([
            'name' => 'Languages',
            'url' => $mm->url . '/languages',
            'icon' => 'ri-translate-2',
            'category' => $mm->category,
            'orders' => 8
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);

        $mm = Menu::updateOrCreate(
            ['url' => 'cms'],
            ['name' => 'CMS', 'category' => 'CMS', 'icon' => 'ri-layout-fill', 'orders' => 9]
        );
        $this->attachMenuPermission($mm, ['read'], ['superadmin', 'admin']);

        // Submenu CMS Menu
        $sm = $mm->subMenus()->create([
            'name' => 'CMS Menus',
            'url' => $mm->url . '/menu',
            'icon' => 'ri-menu-4-line',
            'category' => $mm->category,
            'orders' => 10
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);
        
        // Submenu Homepage
        $sm = $mm->subMenus()->create([
            'name' => 'Homepages',
            'url' => $mm->url . '/homepage',
            'icon' => 'ri-window-fill',
            'category' => $mm->category,
            'orders' => 11
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);
        
        // Submenu Booking Page
        $sm = $mm->subMenus()->create([
            'name' => 'Booking Pages',
            'url' => $mm->url . '/booking-page',
            'icon' => 'ri-window-fill',
            'category' => $mm->category,
            'orders' => 12
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);
        
        // Submenu Local Area
        $sm = $mm->subMenus()->create([
            'name' => 'Local Areas',
            'url' => $mm->url . '/local-areas',
            'icon' => 'ri-map-pin-range-fill',
            'category' => $mm->category,
            'orders' => 13
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);
        
        // Submenu Company Profile
        $sm = $mm->subMenus()->create([
            'name' => 'Company Profiles',
            'url' => $mm->url . '/profile',
            'icon' => 'ri-community-fill',
            'category' => $mm->category,
            'orders' => 14
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);
        
        // Submenu Company Profile
        $sm = $mm->subMenus()->create([
            'name' => 'Social Media',
            'url' => $mm->url . '/social-media',
            'icon' => 'ri-at-fill',
            'category' => $mm->category,
            'orders' => 15
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);
        
        // Submenu Price List
        $sm = $mm->subMenus()->create([
            'name' => 'Price Lists',
            'url' => $mm->url . '/price-lists',
            'icon' => 'ri-money-dollar-circle-fill',
            'category' => $mm->category,
            'orders' => 16
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);
        
        // Submenu Booking Policy
        $sm = $mm->subMenus()->create([
            'name' => 'Booking Policies',
            'url' => $mm->url . '/booking-policies',
            'icon' => 'ri-key-2-fill',
            'category' => $mm->category,
            'orders' => 17
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);
        
        // Submenu Gallery
        $sm = $mm->subMenus()->create([
            'name' => 'Galleries',
            'url' => $mm->url . '/galleries',
            'icon' => 'ri-image-fill',
            'category' => $mm->category,
            'orders' => 18
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);
        
        // Submenu Video
        $sm = $mm->subMenus()->create([
            'name' => 'Videos',
            'url' => $mm->url . '/videos',
            'icon' => 'ri-video-fill',
            'category' => $mm->category,
            'orders' => 19
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);
        
        // Submenu Sponsorship
        $sm = $mm->subMenus()->create([
            'name' => 'Sponsorships',
            'url' => $mm->url . '/sponsorships',
            'icon' => 'ri-layout-bottom-fill',
            'category' => $mm->category,
            'orders' => 20
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);

        // Memberships
        $mm = Menu::updateOrCreate(
            ['url' => 'memberships'],
            ['name' => 'Memberships', 'category' => 'MEMBERSHIPS', 'icon' => 'ri-vip-crown-fill', 'orders' => 21]
        );
        $this->attachMenuPermission($mm, ['read'], ['superadmin', 'admin']);

        $sm = $mm->subMenus()->create([
            'name' => 'Types',
            'url' => $mm->url . '/type',
            'icon' => 'ri-vip-diamond-fill',
            'category' => $mm->category,
            'orders' => 22
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);

        // Products
        $mm = Menu::updateOrCreate(
            ['url' => 'products'],
            ['name' => 'Products', 'category' => 'PRODUCTS', 'icon' => 'ri-shopping-bag-3-fill', 'orders' => 23]
        );
        $this->attachMenuPermission($mm, ['read'], ['superadmin', 'admin']);

        // Submenu Categories
        $sm = $mm->subMenus()->create([
            'name' => 'Categories',
            'url' => $mm->url . '/categories',
            'icon' => 'ri-palette-fill',
            'category' => $mm->category,
            'orders' => 24
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);
        
        // Submenu Price Type
        $sm = $mm->subMenus()->create([
            'name' => 'Price Types',
            'url' => $mm->url . '/price/type',
            'icon' => 'ri-money-dollar-circle-fill',
            'category' => $mm->category,
            'orders' => 25
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);
        
        // Submenu Discount Type
        $sm = $mm->subMenus()->create([
            'name' => 'Discount Types',
            'url' => $mm->url . '/discount/type',
            'icon' => 'ri-price-tag-3-fill',
            'category' => $mm->category,
            'orders' => 26
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);

        // Submenu Items
        $sm = $mm->subMenus()->create([
            'name' => 'Items',
            'url' => $mm->url . '/items',
            'icon' => 'ri-shopping-basket-fill',
            'category' => $mm->category,
            'orders' => 27
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);

        // Venues
        $mm = Menu::updateOrCreate(
            ['url' => 'venues'],
            ['name' => 'Venues', 'category' => 'VENUES', 'icon' => 'ri-database-fill', 'orders' => 28]
        );
        $this->attachMenuPermission($mm, ['read'], ['superadmin', 'admin']);

        // Submenu Venues
        $sm = $mm->subMenus()->create([
            'name' => 'Venues',
            'url' => $mm->url . '/places',
            'icon' => 'ri-building-4-fill',
            'category' => $mm->category,
            'orders' => 29
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);

        // Submenu Venue Rooms
        $sm = $mm->subMenus()->create([
            'name' => 'Rooms',
            'url' => $mm->url . '/rooms',
            'icon' => 'ri-home-4-fill',
            'category' => $mm->category,
            'orders' => 30
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);

        // Submenu Events
        $sm = $mm->subMenus()->create([
            'name' => 'Events',
            'url' => $mm->url . '/events',
            'icon' => 'ri-flag-2-fill',
            'category' => $mm->category,
            'orders' => 31
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);

        // Billiard Tables
        $mm = Menu::updateOrCreate(
            ['url' => 'tables'],
            ['name' => 'Billiard Tables', 'category' => 'TABLES', 'icon' => 'ri-checkbox-blank-fill', 'orders' => 32]
        );
        $this->attachMenuPermission($mm, ['read'], ['superadmin', 'admin']);

        // Submenu Price Type
        $sm = $mm->subMenus()->create([
            'name' => 'Price Types',
            'url' => $mm->url . '/price/type',
            'icon' => 'ri-money-dollar-circle-fill',
            'category' => $mm->category,
            'orders' => 33
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);
        
        // Submenu Discount Type
        $sm = $mm->subMenus()->create([
            'name' => 'Discount Types',
            'url' => $mm->url . '/discount/type',
            'icon' => 'ri-price-tag-3-fill',
            'category' => $mm->category,
            'orders' => 34
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);

        // Submenu Billiard Table Categories
        $sm = $mm->subMenus()->create([
            'name' => 'Categories',
            'url' => $mm->url . '/categories',
            'icon' => 'ri-billiards-line',
            'category' => $mm->category,
            'orders' => 35
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);

        // Submenu Billiard Table Lists
        $sm = $mm->subMenus()->create([
            'name' => 'Tables',
            'url' => $mm->url . '/lists',
            'icon' => 'ri-projector-fill',
            'category' => $mm->category,
            'orders' => 36
        ]);
        $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);
        
        //  // Menu Transaction
        // $mm = Menu::updateOrCreate(
        //     ['url' => 'transaction'],
        //     ['name' => 'Transactions', 'category' => 'TRANSACTION', 'icon' => 'ri-folder-shield-2-fill', 'orders' => 36]
        // );
        // $this->attachMenuPermission($mm, ['read'], ['superadmin', 'admin']);

        // // Submenu Order
        // $sm = $mm->subMenus()->create([
        //     'name' => 'Order',
        //     'url' => $mm->url . '/order',
        //     'icon' => 'ri-shopping-cart-fill',
        //     'category' => $mm->category,
        //     'orders' => 37
        // ]);
        // $this->attachMenuPermission($sm, null, ['superadmin', 'admin']);
    }
}