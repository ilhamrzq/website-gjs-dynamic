<?php

namespace App\Services;

use App\Models\Master\PackageDetail;
use App\Models\Master\PackageHeader;
use Illuminate\Support\Facades\Auth;

class PackageService
{
    /**
     * Simpan atau perbarui data Package dan Detail itemnya
     *
     * @param array $validated
     * @param PackageHeader|null $package
     * @return PackageHeader
     */

    //  ?PackageHeader (nullable type hinting) parameter opsional dan bisa null
    // pake = null, artinya opsional, ketika function ini dipanggil bisa hanya berisikan 1 paramete, kalo $package ngga disertakan maka otomatis null
    // savePackage($validated)

    // kalo ngga pake = null, sebaliknya, ketika memanggil function ini harus selalu dipanggil dengan 2 parameter, dan paramater kedua diisi null
    // savePackage($validaded, null)

    public static function savePackage(array $validated, ?PackageHeader $package = null)
    {
        $user = Auth::user();

        // Kalo null, maka create
        if (!$package) {
            $package = new PackageHeader();
            $package->created_by = $user->id;
        }

        // Update Package Header
        $package->product_id = $validated['product_id'];
        $package->package_name = $validated['package_name'];
        $package->package_description = $validated['package_description'];
        $package->is_contact_us = $validated['is_contact_us'];
        $package->updated_by = $user->id;
        $package->is_active = 1;
        $package->save();

        // Simpan Package Detail
        PackageDetail::updateOrCreate(
            ['package_header_id' => $package->id],
            [
                'uom_id' => $validated['uom_id'],
                'uom_qty' => $validated['uom_qty'],
                'updated_by' => $user->id,
                'is_active' => 1,
            ]
        );

        // Simpan Harga ke Tabel Pivot price_types
        $priceData = $validated['price_data'] ?? [];
        $prices = [];
        foreach ($priceData as $key => $value) {
            $parts = explode('_', $key, 2);
            $priceTypeId = $parts[0];
            $prices[$priceTypeId] = ['price' => $value];
        }

        $package->priceTypes()->sync($prices);

        return $package;
    }
}
