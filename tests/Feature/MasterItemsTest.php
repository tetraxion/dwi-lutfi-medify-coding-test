<?php

namespace Tests\Feature;

use App\Models\KategoriItem;
use App\Models\MasterItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MasterItemsTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_master_item_with_photo_and_categories()
    {
        Storage::fake('public');

        $kategori = KategoriItem::create([
            'kode' => 'KAT-001',
            'nama' => 'Obat'
        ]);

        $file = UploadedFile::fake()->image('item.jpg');

        $response = $this->post('/master-items/form/new', [
            'nama' => 'Paracetamol 500mg',
            'harga_beli' => 10000,
            'laba' => 20,
            'supplier' => 'Tokopaedi',
            'jenis' => 'Obat',
            'foto' => $file,
            'categories' => [$kategori->id]
        ]);

        $response->assertRedirect('/master-items');

        $item = MasterItem::first();
        $this->assertNotNull($item);
        $this->assertEquals('Paracetamol 500mg', $item->nama);
        $this->assertEquals(12000, $item->harga_jual);
        $this->assertTrue($item->kategoriItems->contains($kategori->id));

        Storage::disk('public')->assertExists($item->foto);
    }

    public function test_price_filter_min_and_max_search()
    {
        MasterItem::create([
            'kode' => '00001',
            'nama' => 'Cheap Item',
            'harga_beli' => 10000,
            'laba' => 10,
            'supplier' => 'Tokopaedi',
            'jenis' => 'Obat',
        ]);

        MasterItem::create([
            'kode' => '00002',
            'nama' => 'Expensive Item',
            'harga_beli' => 200000,
            'laba' => 15,
            'supplier' => 'Blublu',
            'jenis' => 'Alkes',
        ]);

        // Filter min only
        $resMin = $this->get('/master-items/search?hargamin=50000');
        $resMin->assertStatus(200)->assertJsonCount(1, 'data');

        // Filter max only
        $resMax = $this->get('/master-items/search?hargamax=50000');
        $resMax->assertStatus(200)->assertJsonCount(1, 'data');
    }

    public function test_can_export_master_items_excel()
    {
        $response = $this->get('/master-items/export-excel');
        $response->assertStatus(200);
        $response->assertHeader('content-type', 'text/csv; charset=UTF-8');
    }
}
