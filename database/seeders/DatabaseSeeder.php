<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\CMS\BookingPolicySeeder;
use Database\Seeders\CMS\CMSMenuSeeder;
use Database\Seeders\CMS\CompanyProfileSeeder;
use Database\Seeders\CMS\FacilitiesSeeder;
use Database\Seeders\CMS\HomepageSeeder;
use Database\Seeders\CMS\ImagesSeeder;
use Database\Seeders\CMS\LocalAreaSeeder;
use Database\Seeders\CMS\PriceListSeeder;
use Database\Seeders\CMS\SocialMediaSeeder;
use Database\Seeders\CMS\VideoSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            MenuSeeder::class,
            ProductCategorySeeder::class,
            ProductPriceTypeSeeder::class,
            ProductDiscountTypeSeeder::class,
            LanguageSeeder::class,
            BookingPolicySeeder::class,
            PriceListSeeder::class,
            CMSMenuSeeder::class,
            CompanyProfileSeeder::class,
            SocialMediaSeeder::class,
            FacilitiesSeeder::class,
            LocalAreaSeeder::class,
            
            // VenueSeeder::class,
            // MembershipSeeder::class,
            // EventSeeder::class,
            // HomepageSeeder::class,
            // ImagesSeeder::class,
            // VideoSeeder::class,
        ]);
    }
}
