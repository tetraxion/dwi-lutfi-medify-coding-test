<?php

namespace Database\Seeders;

use App\Models\KategoriItem;
use App\Models\MasterItem;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $kategoriObat = KategoriItem::firstOrCreate(
            ['kode' => 'KAT-0001'],
            ['nama' => 'Obat-obatan']
        );

        $kategoriAlkes = KategoriItem::firstOrCreate(
            ['kode' => 'KAT-0002'],
            ['nama' => 'Alat Kesehatan']
        );

        $kategoriMatkes = KategoriItem::firstOrCreate(
            ['kode' => 'KAT-0003'],
            ['nama' => 'Material Kesehatan']
        );

        $item1 = MasterItem::firstOrCreate(
            ['kode' => '00001'],
            [
                'nama' => 'Paracetamol 500mg Tab',
                'harga_beli' => 12000,
                'laba' => 15,
                'supplier' => 'Tokopaedi',
                'jenis' => 'Obat',
            ]
        );

        $item2 = MasterItem::firstOrCreate(
            ['kode' => '00002'],
            [
                'nama' => 'Tensimeter Digital',
                'harga_beli' => 250000,
                'laba' => 20,
                'supplier' => 'TokoBagas',
                'jenis' => 'Alkes',
            ]
        );

        $item1->kategoriItems()->syncWithoutDetaching([$kategoriObat->id]);
        $item2->kategoriItems()->syncWithoutDetaching([$kategoriAlkes->id, $kategoriMatkes->id]);
    }
}
