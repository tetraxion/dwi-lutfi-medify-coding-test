<?php

namespace Tests\Feature;

use App\Models\KategoriItem;
use App\Models\MasterItem;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

use App\Models\User;

class MasterItemsTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    public function test_can_create_master_item_with_photo_and_categories()
    {
        Storage::fake('public');

        $kategori = KategoriItem::create([
            'kode' => 'KAT-TEST-01',
            'nama' => 'Obat Test'
        ]);

        $file = UploadedFile::fake()->image('item.jpg');

        $response = $this->post('/master-items/form/new', [
            'nama' => 'Paracetamol Test Item',
            'harga_beli' => 10000,
            'laba' => 20,
            'supplier' => 'Tokopaedi',
            'jenis' => 'Obat',
            'foto' => $file,
            'categories' => [$kategori->id]
        ]);

        $response->assertRedirect('/master-items');

        $item = MasterItem::where('nama', 'Paracetamol Test Item')->first();
        $this->assertNotNull($item);
        $this->assertEquals('Paracetamol Test Item', $item->nama);
        $this->assertEquals(12000, $item->harga_jual);
        $this->assertTrue($item->kategoriItems->contains($kategori->id));

        Storage::disk('public')->assertExists($item->foto);
    }

    public function test_price_filter_min_and_max_search()
    {
        $uniqueMinCode = 'TEST-MIN-' . time();
        $uniqueMaxCode = 'TEST-MAX-' . time();

        MasterItem::create([
            'kode' => $uniqueMinCode,
            'nama' => 'Cheap Unique Test Item',
            'harga_beli' => 100,
            'laba' => 10,
            'supplier' => 'Tokopaedi',
            'jenis' => 'Obat',
        ]);

        MasterItem::create([
            'kode' => $uniqueMaxCode,
            'nama' => 'Expensive Unique Test Item',
            'harga_beli' => 99999999,
            'laba' => 15,
            'supplier' => 'Blublu',
            'jenis' => 'Alkes',
        ]);

        // Filter min only (very high min should only match expensive item)
        $resMin = $this->get('/master-items/search?hargamin=90000000');
        $resMin->assertStatus(200);
        $dataMin = json_decode($resMin->getContent(), true)['data'];
        $this->assertTrue(collect($dataMin)->contains('kode', $uniqueMaxCode));
        $this->assertFalse(collect($dataMin)->contains('kode', $uniqueMinCode));

        // Filter max only (very low max should only match cheap item)
        $resMax = $this->get('/master-items/search?hargamax=500');
        $resMax->assertStatus(200);
        $dataMax = json_decode($resMax->getContent(), true)['data'];
        $this->assertTrue(collect($dataMax)->contains('kode', $uniqueMinCode));
        $this->assertFalse(collect($dataMax)->contains('kode', $uniqueMaxCode));
    }

    public function test_can_export_master_items_excel()
    {
        $response = $this->get('/master-items/export-excel');
        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/vnd.ms-excel; charset=UTF-8');
        $response->assertSee('LAPORAN DATA MASTER ITEMS');
    }
}
