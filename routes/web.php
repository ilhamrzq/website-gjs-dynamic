<?php

use App\Http\Controllers\CMS\BookingPageController;
use App\Http\Controllers\CMS\BookingPolicyController;
use App\Http\Controllers\CMS\CMSMenuController;
use App\Http\Controllers\CMS\CompanyProfileController;
use App\Http\Controllers\CMS\HomepageController;
use App\Http\Controllers\CMS\LocalAreaController;
use App\Http\Controllers\CMS\PriceListController;
use App\Http\Controllers\CMS\SocialMediaController;
use App\Http\Controllers\CMS\SponsorshipController;
use App\Http\Controllers\CMS\VideoController;
use App\Http\Controllers\Configurations\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\BilliardTableCategoryController;
use App\Http\Controllers\Master\EventController;
use App\Http\Controllers\Master\LanguageController;
use App\Http\Controllers\Master\MembershipController;
use App\Http\Controllers\Master\ProductDiscountTypeController;
use App\Http\Controllers\Master\ProductPriceTypeController;
use App\Http\Controllers\Master\TableDiscountTypeController;
use App\Http\Controllers\Master\TablePriceTypeController;
use App\Http\Controllers\Master\VenueController;
use App\Http\Controllers\Master\VenueRoomController;
use App\Http\Controllers\Product\ProductCategoryController;
use App\Http\Controllers\Table\BilliardTableController;
use App\Models\CMS\GalleryCategory;
use App\Models\CMS\GalleryImage;
use App\Models\Master\Event;
use Illuminate\Foundation\Application;
use Inertia\Inertia;
use App\Http\Controllers\CMS\GalleryController;
use App\Http\Controllers\Configurations\MenuController;
use App\Http\Controllers\Configurations\PermissionController;
use App\Http\Controllers\Configurations\RoleController;
use App\Http\Controllers\Master\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return Inertia::render("ID/Homepage/index", [
        "title" => "Global Jasa Sejahtera",
    ]);
})->name('homepage');

Route::prefix('id')->name('id.')->group(function () {
    Route::get('/', function () {
        return Inertia::render("ID/Homepage/index", [
            "title" => "Global Jasa Sejahtera",
        ]);
    })->name('homepage');

    Route::get('/tentang', function () {
        return Inertia::render("ID/About/index", [
            "title" => "Ikhtisar Perusahaan - Global Jasa Sejahtera",
        ]);
    })->name('tentang');

    Route::get('/tentang/manajemen', function () {
        return Inertia::render("ID/About/[details]/management", [
            "title" => "Manajemen & Direksi - Global Jasa Sejahtera",
        ]);
    })->name('tentang.manajemen');

    Route::get('/tentang/portofolio', function () {
        return Inertia::render("ID/About/[details]/portofolio", [
            "title" => "Portofolio - Global Jasa Sejahtera",
        ]);
    })->name('tentang.portofolio');

    Route::get('/tentang/klien', function () {
        return Inertia::render("ID/About/[details]/client", [
            "title" => "Klien - Global Jasa Sejahtera",
        ]);
    })->name('tentang.klien');

    Route::get('/tentang/struktur', function () {
        return Inertia::render("ID/About/[details]/structure", [
            "title" => "Struktur Perusahaan - Global Jasa Sejahtera",
        ]);
    })->name('tentang.struktur');

    Route::get('/tentang/penghargaan', function () {
        return Inertia::render("ID/About/[details]/award", [
            "title" => "Sertifikat - Global Jasa Sejahtera",
        ]);
    })->name('tentang.penghargaan');


    Route::get('/tentang/suratizin', function () {
        return Inertia::render("ID/About/[details]/license", [
            "title" => "Surat Izin Operasional - Global Jasa Sejahtera",
        ]);
    })->name('tentang.suratizin');

    Route::get('/tentang/karir', function () {
        return Inertia::render("ID/About/[details]/career/index", [
            "title" => "Karir - Global Jasa Sejahtera",
        ]);
    })->name('tentang.karir');

    Route::get('/tentang/karir/{id}', function ($id) {
        return Inertia::render("ID/About/[details]/career/[id]/index", [
            "title" => "Detail Karir - Global Jasa Sejahtera",
            "id" => $id,
        ]);
    })->name('tentang.karirDetail');

    Route::get('/layanan/manajemen-properti', function () {
        return Inertia::render("ID/Services/[details]/management", [
            "title" => "Manajemen Properti - Global Jasa Sejahtera",
        ]);
    })->name('layanan.manajemen-properti');

    Route::get('/layanan/pengamanan', function () {
        return Inertia::render("ID/Services/[details]/consultancy", [
            "title" => "Jasa Pengamanan & Konsultasi Keamanan - Global Jasa Sejahtera",
        ]);
    })->name('layanan.pengamanan');

    Route::get('/layanan/pusat-pelatihan', function () {
        return Inertia::render("ID/Services/[details]/training", [
            "title" => "Pusat Pelatihan - Global Jasa Sejahtera",
        ]);
    })->name('layanan.pusat-pelatihan');

    Route::get('/layanan/supervisi-desain', function () {
        return Inertia::render("ID/Services/[details]/design", [
            "title" => "Supervisi & Desain - Global Jasa Sejahtera",
        ]);
    })->name('layanan.supervisi-desain');

    Route::get('/produk/web-aplikasi', function () {
        return Inertia::render("ID/Product/[details]/webApp", [
            "title" => "Portal Klien GJS - Global Jasa Sejahtera",
        ]);
    })->name('produk.web-aplikasi');

    Route::get('/produk/mobile-aplikasi', function () {
        return Inertia::render("ID/Product/[details]/mobileApp", [
            "title" => "Mobile Aplikasi GJS - Global Jasa Sejahtera",
        ]);
    })->name('produk.mobile-aplikasi');

    Route::get('/berita', function () {
        return Inertia::render("ID/News/index", [
            "title" => "Berita - Global Jasa Sejahtera",
        ]);
    })->name('berita');

    Route::get('/berita/{id}', function ($id) {
        return Inertia::render("ID/News/[detail]/index", [
            "id" => $id,
            "title" => "News - Global Jasa Sejahtera",
        ]);
    })->name('berita.detail');
 
    Route::get('/kontak', function () {
        return Inertia::render("ID/Contact/index", [
            "title" => "Kontak - Global Jasa Sejahtera",
        ]);
    })->name('kontak');
});

Route::prefix('en')->name('en.')->group(function () {
    Route::get('/', function () {
        return Inertia::render("EN/Homepage/index", [
            "title" => "Global Jasa Sejahtera",
        ]);
    })->name('homepage');

    Route::get('/about', function () {
        return Inertia::render("EN/About/index", [
            "title" => "Company Overview - Global Jasa Sejahtera",
        ]);
    })->name('about');

    Route::get('/about/management', function () {
        return Inertia::render("EN/About/[details]/management", [
            "title" => "Management and Board of Directors - Global Jasa Sejahtera",
        ]);
    })->name('about.management');

    Route::get('/about/portfolio', function () {
        return Inertia::render("EN/About/[details]/portofolio", [
            "title" => "Portfolio - Global Jasa Sejahtera",
        ]);
    })->name('about.portfolio');

    Route::get('/about/clients', function () {
        return Inertia::render("EN/About/[details]/client", [
            "title" => "Clients - Global Jasa Sejahtera",
        ]);
    })->name('about.clients');

    Route::get('/about/structure', function () {
        return Inertia::render("EN/About/[details]/structure", [
            "title" => "Corporate Structure - Global Jasa Sejahtera",
        ]);
    })->name('about.structure');

    Route::get('/about/awards', function () {
        return Inertia::render("EN/About/[details]/award", [
            "title" => "Certificates - Global Jasa Sejahtera",
        ]);
    })->name('about.awards');

    Route::get('/about/license', function () {
        return Inertia::render("EN/About/[details]/license", [
            "title" => "Operating License - Global Jasa Sejahtera",
        ]);
    })->name('about.license');

    Route::get('/about/career/', function () {
        return Inertia::render("EN/About/[details]/career/index", [
            "title" => "Career - Global Jasa Sejahtera",
        ]);
    })->name('about.career');

    Route::get('/about/career/{id}', function () {
        return Inertia::render("EN/About/[details]/career/[id]/index", [
            "title" => "Career Detail - Global Jasa Sejahtera",
            "id" => $id,
        ]);
    })->name('about.careerDetail');

    Route::get('/services/building-management', function () {
        return Inertia::render("EN/Services/[details]/management", [
            "title" => "Building Management - Global Jasa Sejahtera",
        ]);
    })->name('services.building-management');

    Route::get('/services/consultancy-security', function () {
        return Inertia::render("EN/Services/[details]/consultancy", [
            "title" => "Security & Consultancy - Global Jasa Sejahtera",
        ]);
    })->name('services.consultancy-security');

    Route::get('/services/training-center', function () {
        return Inertia::render("EN/Services/[details]/training", [
            "title" => "Training Center - Global Jasa Sejahtera",
        ]);
    })->name('services.training-center');

    Route::get('/services/design-supervision', function () {
        return Inertia::render("EN/Services/[details]/design", [
            "title" => "Design & Supervision - Global Jasa Sejahtera",
        ]);
    })->name('services.design-supervision');

    Route::get('/product/web-app', function () {
        return Inertia::render("EN/Product/[details]/webApp", [
            "title" => "GJS Client Portal - Global Jasa Sejahtera",
        ]);
    })->name('product.web-app');

    Route::get('/product/mobile-app', function () {
        return Inertia::render("EN/Product/[details]/mobileApp", [
            "title" => "GJS Mobile Application - Global Jasa Sejahtera",
        ]);
    })->name('product.mobile-app');

    Route::get('/news', function () {
        return Inertia::render("EN/News/index", [
            "title" => "News - Global Jasa Sejahtera",
        ]);
    })->name('news');

    Route::get('/news/{id}', function ($id) {
        return Inertia::render("EN/News/[detail]/index", [
            "id" => $id,
            "title" => "News - Global Jasa Sejahtera",
        ]);
    })->name('news.detail');

    Route::get('/contact', function () {
        return Inertia::render("EN/Contact/index", [
            "title" => "Contact - Global Jasa Sejahtera",
        ]);
    })->name('contact');
});

// Route::get("/bookings", function() {
//     return Inertia::render("Booking/index", [
//         "title" => "Bookings"
//     ]);
// })->name("booking");

// Route::get("/shops", function() {
//     return Inertia::render("Shop/index", [
//         "title" => "Shops"
//     ]);
// })->name("shop");

// Route::get("/shops/cart", function() {
//     return Inertia::render("Shop/Cart/index", [
//         "title" => "Cart"
//     ]);
// })->name("shop.cart");


// Route::get("/contact", function() {
//     return Inertia::render("Contact/index", [
//         "title" => "Contact"
//     ]);
// })->name("contact");

// Route::get('/events', function() {
//     return Inertia::render("Event/index", [
//         "title" => "Events"
//     ]);
// })->name("events");

// Route::get('/events/{event}', function(Event $event) {
//     return Inertia::render("Event/Details/index", [
//         "title" => "Event Detail",
//         "slug" => $event->event_slug,
//         "event" => $event
//     ]);
// })->name("events.detail");


Route::get('/signup', [MembershipController::class, 'signPage']);

// Nulis permission:read - jangan dipakein spasi nanti error
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('permission:read dashboard');
    
    Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
    Route::get('/profiles/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
    Route::patch('/profiles/update', [ProfileController::class, 'update'])->name('profiles.update');

    Route::prefix('configurations')->group(function () {
        // Menus
        Route::controller(MenuController::class)->group(function () {
            Route::put('/menu/sort', 'sort')->name('configurations.menu.sort');
            Route::get('/menu', 'index')->name('configurations.menu.index');
            Route::get('/menu/create', 'create')->name('configurations.menu.create');
            Route::post('/menu/store', 'store')->name('configurations.menu.store');
            Route::get('/menu/icon', 'icon')->name('configurations.menu.icon');
            Route::get('/menu/{menu}/edit', 'edit')->name('configurations.menu.edit');
            Route::post('/menu/update/{menu}', 'update')->name('configurations.menu.update');
            Route::get('/menu/show/{menu}', 'show')->name('configurations.menu.show');
            Route::post('/menu/destroy/{menu}', 'destroy')->name('configurations.menu.destroy');
            Route::post('/menu/bulk-delete', 'multipleDestroy')->name('configurations.menu.multiple.destroy');

        });

        // Admin
        Route::controller(AdminController::class)->group(function () {
            Route::get('/admin', 'index')->name('configurations.admin.index');
            Route::get('/admin/create', 'create')->name('configurations.admin.create');
            Route::post('/admin', 'store')->name('configurations.admin.store');
            Route::get('/admin/{admin}/show', 'show')->name('configurations.admin.show');
            Route::get('/admin/{admin}/edit', 'edit')->name('configurations.admin.edit');
            Route::post('/admin/{admin}/update', 'update')->name('configurations.admin.update');
            Route::post('/admin/{admin}/destroy', 'destroy')->name('configurations.admin.destroy');
            Route::post('/admin/bulk-delete', 'multipleDestroy')->name('configurations.admin.multiple.destroy');
        });

        // Roles
        Route::controller(RoleController::class)->group(function () {
            Route::get('/role', 'index')->name('configurations.role.index');
            Route::get('/role/create', 'create')->name('configurations.role.create');
            Route::post('/role', 'store')->name('configurations.role.store');
            Route::get('/role/{role}/show', 'show')->name('configurations.role.show');
            Route::get('/role/{role}/edit', 'edit')->name('configurations.role.edit');
            Route::post('/role/{role}/update', 'update')->name('configurations.role.update');
            Route::post('/role/{role}/destroy', 'destroy')->name('configurations.role.destroy');
            
            // Role Access
            Route::get('/role-access-menu/{role}/role', 'getPermissionByRole')->name('configurations.role.permission');
            Route::post('/role-access-menu/{role}/update-menu', 'updateRoleMenu')->name('configurations.role.permission.update');
            Route::post('/role-access-user/{role}/user', 'updateRoleUser')->name('configurations.role.user.update');
        });

        // Permissions
        Route::controller(PermissionController::class)->group(function () {
            Route::get('/permission', 'index')->name('configurations.permission.index');
            Route::get('/permission/create', 'create')->name('configurations.permission.create');
            Route::post('/permission', 'store')->name('configurations.permission.store');
            Route::get('/permission/{permission}/show', 'show')->name('configurations.permission.show');
            Route::get('/permission/{permission}/edit', 'edit')->name('configurations.permission.edit');
            Route::post('/permission/{permission}/update', 'update')->name('configurations.permission.update');
            Route::post('/permission/{permission}/destroy', 'destroy')->name('configurations.permission.destroy');
            Route::post('/permission/bulk-delete', 'multipleDestroy')->name('configurations.permission.multiple.delete');
        });
    });

    Route::prefix('master')->group(function () {
        // Language
        Route::controller(LanguageController::class)->group(function () {
            Route::get('/languages', 'index')->name('master.languages.index');
            Route::get('/languages/create', 'create')->name('master.languages.create');
            Route::post('/languages', 'store')->name('master.languages.store');
            Route::get('/languages/{language}/show', 'show')->name('master.languages.show');
            Route::get('/languages/{language}/edit', 'edit')->name('master.languages.edit');
            Route::post('/languages/{language}/update', 'update')->name('master.languages.update');
            Route::post('/languages/{language}/destroy', 'destroy')->name('master.languages.destroy');
            Route::post('/languages/bulk-destroy', 'multipleDestroy')->name('master.languages.multiple.destroy');
        });
    });

    Route::prefix('memberships')->group(function () {
        // Membership type
        Route::controller(MembershipController::class)->group(function () {
            Route::get('/type', 'index')->name('memberships.type.index');
            Route::get('/type/create', 'create')->name('memberships.type.create');
            Route::post('/type', 'store')->name('memberships.type.store');
            Route::get('/type/{category}/show', 'show')->name('memberships.type.show');
            Route::get('/type/{category}/edit', 'edit')->name('memberships.type.edit');
            Route::post('/type/{category}/update', 'update')->name('memberships.type.update');
            Route::post('/type/{category}/destroy', 'destroy')->name('memberships.type.destroy');
            Route::post('/type/bulk-destroy', 'multipleDestroy')->name('memberships.type.multiple.destroy');
        });
    });

    Route::prefix('cms')->group(function () {     
        // Menu
        Route::controller(CMSMenuController::class)->group(function () {
            Route::get('/menu', 'index')->name('cms.menu.index');
            Route::get('/menu/create', 'create')->name('cms.menu.create');
            Route::post('/menu', 'store')->name('cms.menu.store');
            Route::get('/menu/{menu}/show', 'show')->name('cms.menu.show');
            Route::get('/menu/{menu}/edit', 'edit')->name('cms.menu.edit');
            Route::post('/menu/{menu}/update', 'update')->name('cms.menu.update');
            Route::post('/menu/{menu}/destroy', 'destroy')->name('cms.menu.destroy');
            Route::post('/menu/bulk-destroy', 'multipleDestroy')->name('cms.menu.multiple.destroy');
        });

        // Homepage
        Route::controller(HomepageController::class)->group(function () {
            Route::get('/homepage', 'index')->name('cms.homepage.index');
            Route::get('/homepage/create', 'create')->name('cms.homepage.create');
            Route::post('/homepage', 'store')->name('cms.homepage.store');
            Route::get('/homepage/{homepage}/show', 'show')->name('cms.homepage.show');
            Route::get('/homepage/{homepage}/edit', 'edit')->name('cms.homepage.edit');
            Route::post('/homepage/{homepage}/update', 'update')->name('cms.homepage.update');
            Route::post('/homepage/{homepage}/destroy', 'destroy')->name('cms.homepage.destroy');
            Route::post('/homepage/bulk-destroy', 'multipleDestroy')->name('cms.homepage.multiple.destroy');

            // Banner Images
            Route::post('/homepage/upload-images/', 'uploadImages')->name('cms.homepage.upload.images');
            Route::post('/homepage/{homepage}/update-default-image', 'updateDefaultImage')->name('cms.homepage.update.default.image');
            Route::post('/homepage/{homepage}/delete-image-homepage-hero', 'deletehomepageHeroImage')->name('cms.homepage.delete.image');
        });
        
        // Booking Page
        Route::controller(BookingPageController::class)->group(function () {
            Route::get('/booking-page', 'index')->name('cms.booking-page.index');
            Route::get('/booking-page/create', 'create')->name('cms.booking-page.create');
            Route::post('/booking-page', 'store')->name('cms.booking-page.store');
            Route::get('/booking-page/{page}/show', 'show')->name('cms.booking-page.show');
            Route::get('/booking-page/{page}/edit', 'edit')->name('cms.booking-page.edit');
            Route::post('/booking-page/{page}/update', 'update')->name('cms.booking-page.update');
            Route::post('/booking-page/{page}/destroy', 'destroy')->name('cms.booking-page.destroy');
            Route::post('/booking-page/bulk-destroy', 'multipleDestroy')->name('cms.booking-page.multiple.destroy');

            // Banner Images
            Route::post('/booking-page/upload-images/', 'uploadImages')->name('cms.booking-page.upload.images');
            Route::post('/booking-page/{page}/update-default-image', 'updateDefaultImage')->name('cms.booking-page.update.default.image');
            Route::post('/booking-page/{page}/delete-image-booking-page-hero', 'deleteBookingPageImage')->name('cms.booking-page.delete.image');
        });

        // Local Areas
        Route::controller(LocalAreaController::class)->group(function () {
            Route::get('local-areas', 'index')->name('cms.local-areas.index');
            Route::get('local-areas/create', 'create')->name('cms.local-areas.create');
            Route::post('local-areas', 'store')->name('cms.local-areas.store');
            Route::get('local-areas/{page}/show', 'show')->name('cms.local-areas.show');
            Route::get('local-areas/{page}/edit', 'edit')->name('cms.local-areas.edit');
            Route::post('local-areas/{page}/update', 'update')->name('cms.local-areas.update');
            Route::post('local-areas/{page}/destroy', 'destroy')->name('cms.local-areas.destroy');
            Route::post('local-areas/bulk-destroy', 'multipleDestroy')->name('cms.local-areas.multiple.destroy');
        });

        // Company Profile
        Route::controller(CompanyProfileController::class)->group(function () {
            Route::get('/profile', 'index')->name('cms.profile.index');
            Route::get('/profile/create', 'create')->name('cms.profile.create');
            Route::post('/profile', 'store')->name('cms.profile.store');
            Route::get('/profile/{profile}/show', 'show')->name('cms.profile.show');
            Route::get('/profile/{profile}/edit', 'edit')->name('cms.profile.edit');
            Route::post('/profile/{profile}/update', 'update')->name('cms.profile.update');
            Route::post('/profile/{profile}/destroy', 'destroy')->name('cms.profile.destroy');
            Route::post('/profile/bulk-destroy', 'multipleDestroy')->name('cms.profile.multiple.destroy');
        });
        
        // Social Media
        Route::controller(SocialMediaController::class)->group(function () {
            Route::get('/social-media', 'index')->name('cms.social-media.index');
            Route::get('/social-media/create', 'create')->name('cms.social-media.create');
            Route::post('/social-media', 'store')->name('cms.social-media.store');
            Route::get('/social-media/{detail}/show', 'show')->name('cms.social-media.show');
            Route::get('/social-media/{detail}/edit', 'edit')->name('cms.social-media.edit');
            Route::post('/social-media/{detail}/update', 'update')->name('cms.social-media.update');
            Route::post('/social-media/{detail}/destroy', 'destroy')->name('cms.social-media.destroy');
            Route::post('/social-media/bulk-destroy', 'multipleDestroy')->name('cms.social-media.multiple.destroy');
        });

        // Price List
        Route::controller(PriceListController::class)->group(function () {
            Route::get('/price-lists', 'index')->name('cms.price-lists.index');
            Route::get('/price-lists/create', 'create')->name('cms.price-lists.create');
            Route::post('/price-lists', 'store')->name('cms.price-lists.store');
            Route::get('/price-lists/{pricelist}/show', 'show')->name('cms.price-lists.show');
            Route::get('/price-lists/{pricelist}/edit', 'edit')->name('cms.price-lists.edit');
            Route::post('/price-lists/{pricelist}/update', 'update')->name('cms.price-lists.update');
            Route::post('/price-lists/{pricelist}/destroy', 'destroy')->name('cms.price-lists.destroy');
            Route::post('/price-lists/bulk-destroy', 'multipleDestroy')->name('cms.price-lists.multiple.destroy');
        });

        // Booking Policy
        Route::controller(BookingPolicyController::class)->group(function () {
            Route::get('/booking-policies', 'index')->name('cms.booking-policies.index');
            Route::get('/booking-policies/create', 'create')->name('cms.booking-policies.create');
            Route::post('/booking-policies', 'store')->name('cms.booking-policies.store');
            Route::get('/booking-policies/{bookingpolicy}/show', 'show')->name('cms.booking-policies.show');
            Route::get('/booking-policies/{bookingpolicy}/edit', 'edit')->name('cms.booking-policies.edit');
            Route::post('/booking-policies/{bookingpolicy}/update', 'update')->name('cms.booking-policies.update');
            Route::post('/booking-policies/{bookingpolicy}/destroy', 'destroy')->name('cms.booking-policies.destroy');
            Route::post('/booking-policies/bulk-destroy', 'multipleDestroy')->name('cms.booking-policies.multiple.destroy');
        });

        // Gallery
        Route::controller(GalleryController::class)->group(function () {
            Route::get('/galleries', 'index')->name('cms.galleries.index');
            Route::get('/galleries/create', 'create')->name('cms.galleries.create');
            Route::post('/galleries', 'store')->name('cms.galleries.store');
            Route::get('/galleries/{gallery}/show', 'show')->name('cms.galleries.show');
            Route::get('/galleries/{gallery}/edit', 'edit')->name('cms.galleries.edit');
            Route::post('/galleries/{gallery}/update', 'update')->name('cms.galleries.update');
            Route::post('/galleries/{gallery}/destroy', 'destroy')->name('cms.galleries.destroy');
            Route::post('/galleries/bulk-destroy', 'multipleDestroy')->name('cms.galleries.multiple.destroy');

            // Gallery Images
            Route::post('/galleries/upload-images/', 'uploadImages')->name('cms.galleries.upload.images');
            Route::post('/galleries/{gallery}/update-default-image', 'updateDefaultImage')->name('cms.galleries.update.default.image');
            Route::post('/galleries/{gallery}/delete-image-gallery', 'deleteGalleryImage')->name('cms.galleries.delete.image');
        });

        // Video
        Route::controller(VideoController::class)->group(function () {
            Route::get('/videos', 'index')->name('cms.videos.index');
            Route::get('/videos/create', 'create')->name('cms.videos.create');
            Route::post('/videos', 'store')->name('cms.videos.store');
            Route::get('/videos/{gallery}/show', 'show')->name('cms.videos.show');
            Route::get('/videos/{gallery}/edit', 'edit')->name('cms.videos.edit');
            Route::post('/videos/{gallery}/update', 'update')->name('cms.videos.update');
            Route::post('/videos/{gallery}/destroy', 'destroy')->name('cms.videos.destroy');
            Route::post('/videos/bulk-destroy', 'multipleDestroy')->name('cms.videos.multiple.destroy');
        });

        // Sponsorship
        Route::controller(SponsorshipController::class)->group(function () {
            Route::get('/sponsorships', 'index')->name('cms.sponsorships.index');
            Route::get('/sponsorships/create', 'create')->name('cms.sponsorships.create');
            Route::post('/sponsorships', 'store')->name('cms.sponsorships.store');
            Route::get('/sponsorships/{gallery}/show', 'show')->name('cms.sponsorships.show');
            Route::get('/sponsorships/{gallery}/edit', 'edit')->name('cms.sponsorships.edit');
            Route::post('/sponsorships/{gallery}/update', 'update')->name('cms.sponsorships.update');
            Route::post('/sponsorships/{gallery}/destroy', 'destroy')->name('cms.sponsorships.destroy');
            Route::post('/sponsorships/bulk-destroy', 'multipleDestroy')->name('cms.sponsorships.multiple.destroy');

            // Gallery Images
            Route::post('/sponsorships/upload-images/', 'uploadImages')->name('cms.sponsorships.upload.images');
            Route::post('/sponsorships/{gallery}/update-default-image', 'updateDefaultImage')->name('cms.sponsorships.update.default.image');
            Route::post('/sponsorships/{gallery}/delete-image-gallery', 'deleteSponsorshipImage')->name('cms.sponsorships.delete.image');
        });

    });

    Route::prefix('products')->group(function () {

        // Product Categories
        Route::controller(ProductCategoryController::class)->group(function () {
            Route::get('/categories', 'index')->name('products.categories.index');
            Route::get('/categories/create', 'create')->name('products.categories.create');
            Route::post('/categories', 'store')->name('products.categories.store');
            Route::get('/categories/{category}/show', 'show')->name('products.categories.show');
            Route::get('/categories/{category}/edit', 'edit')->name('products.categories.edit');
            Route::post('/categories/{category}/update', 'update')->name('products.categories.update');
            Route::post('/categories/{category}/destroy', 'destroy')->name('products.categories.destroy');
            Route::post('/categories/bulk-destroy', 'multipleDestroy')->name('products.categories.multiple.destroy');
        });

        // Product Price Types
        Route::controller(ProductPriceTypeController::class)->group(function() {
            Route::get('/price/type', 'index')->name('products.price.type.index');
            Route::get('/price/type/create', 'create')->name('products.price.type.create');
            Route::post('/price/type', 'store')->name('products.price.type.store');
            Route::get('/price/type/{type}/show', 'show')->name('products.price.type.show');
            Route::get('/price/type/{type}/edit', 'edit')->name('products.price.type.edit');
            Route::post('/price/type/{type}/update', 'update')->name('products.price.type.update');
            Route::post('/price/type/{type}/destroy', 'destroy')->name('products.price.type.destroy');
            Route::post('/price/type/bulk-destroy', 'multipleDestroy')->name('products.price.type.multiple.destroy');
        });

        // Product Discount Types
        Route::controller(ProductDiscountTypeController::class)->group(function() {
            Route::get('/discount/type', 'index')->name('products.discount.type.index');
            Route::get('/discount/type/create', 'create')->name('products.discount.type.create');
            Route::post('/discount/type', 'store')->name('products.discount.type.store');
            Route::get('/discount/type/{type}/show', 'show')->name('products.discount.type.show');
            Route::get('/discount/type/{type}/edit', 'edit')->name('products.discount.type.edit');
            Route::post('/discount/type/{type}/update', 'update')->name('products.discount.type.update');
            Route::post('/discount/type/{type}/destroy', 'destroy')->name('products.discount.type.destroy');
            Route::post('/discount/type/bulk-destroy', 'multipleDestroy')->name('products.discount.type.multiple.destroy');
        });

        // Product Items
        Route::controller(ProductController::class)->group(function () {
            Route::get('/items', 'index')->name('products.items.index');
            Route::get('/items/create', 'create')->name('products.items.create');
            Route::post('/items', 'store')->name('products.items.store');
            Route::get('/items/{item}/show', 'show')->name('products.items.show');
            Route::get('/items/{item}/edit', 'edit')->name('products.items.edit');
            Route::post('/items/{item}/update', 'update')->name('products.items.update');
            Route::post('/items/{item}/destroy', 'destroy')->name('products.items.destroy');
            Route::post('/items/bulk-destroy', 'multipleDestroy')->name('products.items.multiple.destroy');

            // Product Items Images
            Route::post('/items/upload-images/', 'uploadImages')->name('products.items.upload.images');
            Route::post('/items/{item}/update-default-image', 'updateDefaultImage')->name('products.items.update.default.image');
            Route::post('/items/{item}/delete-image-product', 'deleteProductImage')->name('products.items.delete.image');
        });
    });

    Route::prefix('venues')->group(function () {

        // Venue
        Route::controller(VenueController::class)->group(function () {
            Route::get('/places', 'index')->name('venues.places.index');
            Route::get('/places/create', 'create')->name('venues.places.create');
            Route::post('/places', 'store')->name('venues.places.store');
            Route::get('/places/{venue}/show', 'show')->name('venues.places.show');
            Route::get('/places/{venue}/edit', 'edit')->name('venues.places.edit');
            Route::post('/places/{venue}/update', 'update')->name('venues.places.update');
            Route::post('/places/{venue}/destroy', 'destroy')->name('venues.places.destroy');
            Route::post('/places/bulk-destroy', 'multipleDestroy')->name('venues.places.multiple.destroy');

            // Venue Images
            Route::post('/venues/upload-images/', 'uploadImages')->name('venues.places.upload.images');
            Route::post('/venues/{venue}/update-default-image', 'updateDefaultImage')->name('venues.places.update.default.image');
            Route::post('/venues/{venue}/delete-image-venue', 'deleteVenueImage')->name('venues.places.delete.image');
        });

        // Event
        Route::controller(EventController::class)->group(function () {
            Route::get('/events', 'index')->name('venues.events.index');
            Route::get('/events/create', 'create')->name('venues.events.create');
            Route::post('/events', 'store')->name('venues.events.store');
            Route::get('/events/{event}/show', 'show')->name('venues.events.show');
            Route::get('/events/{event}/edit', 'edit')->name('venues.events.edit');
            Route::post('/events/{event}/update', 'update')->name('venues.events.update');
            Route::post('/events/{event}/destroy', 'destroy')->name('venues.events.destroy');
            Route::post('/events/bulk-destroy', 'multipleDestroy')->name('venues.events.multiple.destroy');

            // Event Images
            Route::post('/events/upload-images/', 'uploadImages')->name('venues.events.upload.images');
            Route::post('/events/upload-editor-image', 'uploadEditorImage')->name('venues.events.upload.editor.image');
            Route::post('/events/{event}/update-default-image', 'updateDefaultImage')->name('venues.events.update.default.image');
            Route::post('/events/{event}/delete-image-event', 'deleteEventImage')->name('venues.events.delete.image');
        });

        // Room
        Route::controller(VenueRoomController::class)->group(function () {
            Route::get('/rooms', 'index')->name('venues.rooms.index');
            Route::get('/rooms/create', 'create')->name('venues.rooms.create');
            Route::post('/rooms', 'store')->name('venues.rooms.store');
            Route::get('/rooms/{room}/show', 'show')->name('venues.rooms.show');
            Route::get('/rooms/{room}/edit', 'edit')->name('venues.rooms.edit');
            Route::post('/rooms/{room}/update', 'update')->name('venues.rooms.update');
            Route::post('/rooms/{room}/destroy', 'destroy')->name('venues.rooms.destroy');
            Route::post('/rooms/bulk-destroy', 'multipleDestroy')->name('venues.rooms.multiple.destroy');

            // Event Images
            Route::post('/rooms/upload-images/', 'uploadImages')->name('venues.rooms.upload.images');
            Route::post('/rooms/{room}/update-default-image', 'updateDefaultImage')->name('venues.rooms.update.default.image');
            Route::post('/rooms/{room}/delete-image-room', 'deleteVenueRoomImage')->name('venues.rooms.delete.image');
        });
    });

    Route::prefix('tables')->group(function () {
        // Billiard Table Category
        Route::controller(BilliardTableCategoryController::class)->group(function () {
            Route::get('/categories', 'index')->name('tables.categories.index');
            Route::get('/categories/create', 'create')->name('tables.categories.create');
            Route::post('/categories', 'store')->name('tables.categories.store');
            Route::get('/categories/{category}/show', 'show')->name('tables.categories.show');
            Route::get('/categories/{category}/edit', 'edit')->name('tables.categories.edit');
            Route::post('/categories/{category}/update', 'update')->name('tables.categories.update');
            Route::post('/categories/{category}/destroy', 'destroy')->name('tables.categories.destroy');
            Route::post('/categories/bulk-destroy', 'multipleDestroy')->name('tables.categories.multiple.destroy');
        });

        // Table Price Types
        Route::controller(TablePriceTypeController::class)->group(function() {
            Route::get('/price/type', 'index')->name('tables.price.type.index');
            Route::get('/price/type/create', 'create')->name('tables.price.type.create');
            Route::post('/price/type', 'store')->name('tables.price.type.store');
            Route::get('/price/type/{type}/show', 'show')->name('tables.price.type.show');
            Route::get('/price/type/{type}/edit', 'edit')->name('tables.price.type.edit');
            Route::post('/price/type/{type}/update', 'update')->name('tables.price.type.update');
            Route::post('/price/type/{type}/destroy', 'destroy')->name('tables.price.type.destroy');
            Route::post('/price/type/bulk-destroy', 'multipleDestroy')->name('tables.price.type.multiple.destroy');
        });

        // Table Discount Types
        Route::controller(TableDiscountTypeController::class)->group(function() {
            Route::get('/discount/type', 'index')->name('tables.discount.type.index');
            Route::get('/discount/type/create', 'create')->name('tables.discount.type.create');
            Route::post('/discount/type', 'store')->name('tables.discount.type.store');
            Route::get('/discount/type/{type}/show', 'show')->name('tables.discount.type.show');
            Route::get('/discount/type/{type}/edit', 'edit')->name('tables.discount.type.edit');
            Route::post('/discount/type/{type}/update', 'update')->name('tables.discount.type.update');
            Route::post('/discount/type/{type}/destroy', 'destroy')->name('tables.discount.type.destroy');
            Route::post('/discount/type/bulk-destroy', 'multipleDestroy')->name('tables.discount.type.multiple.destroy');
        });

        // Table Discount Types
        Route::controller(BilliardTableController::class)->group(function() {
            Route::get('/lists', 'index')->name('tables.lists.index');
            Route::get('/lists/create', 'create')->name('tables.lists.create');
            Route::post('/lists', 'store')->name('tables.lists.store');
            Route::get('/lists/{type}/show', 'show')->name('tables.lists.show');
            Route::get('/lists/{type}/edit', 'edit')->name('tables.lists.edit');
            Route::post('/lists/{type}/update', 'update')->name('tables.lists.update');
            Route::post('/lists/{type}/destroy', 'destroy')->name('tables.lists.destroy');
            Route::post('/lists/bulk-destroy', 'multipleDestroy')->name('tables.lists.multiple.destroy');
        });
    });
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
