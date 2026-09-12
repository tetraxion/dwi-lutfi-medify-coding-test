<?php

namespace Tests\Feature;

use App\Models\KategoriItem;
use App\Models\MasterItem;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class KategoriItemsTest extends TestCase
{
    use DatabaseTransactions;

    public function test_can_create_and_search_kategori()
    {
        $response = $this->post('/kategori-items/form/new', [
            'kode' => 'KAT-0010',
            'nama' => 'Alat Steril'
        ]);

        $response->assertRedirect('/kategori-items');
        $this->assertDatabaseHas('kategori_items', [
            'kode' => 'KAT-0010',
            'nama' => 'Alat Steril'
        ]);

        $search = $this->get('/kategori-items/search?nama=Steril');
        $search->assertStatus(200)->assertJsonCount(1, 'data');
    }

    public function test_single_view_displays_attached_items()
    {
        $kategori = KategoriItem::create([
            'kode' => 'KAT-0099',
            'nama' => 'Matkes'
        ]);

        $item = MasterItem::create([
            'kode' => '00099',
            'nama' => 'Kain Kasa Steril',
            'harga_beli' => 5000,
            'laba' => 10,
            'supplier' => 'Tokopaedi',
            'jenis' => 'Matkes'
        ]);

        $item->kategoriItems()->attach($kategori->id);

        $response = $this->get('/kategori-items/view/' . $kategori->id);
        $response->assertStatus(200);
        $response->assertSee('KAT-0099');
        $response->assertSee('Matkes');
        $response->assertSee('Kain Kasa Steril');
    }

    public function test_can_export_kategori_pdf()
    {
        $kategori = KategoriItem::create([
            'kode' => 'KAT-0005',
            'nama' => 'Kategori PDF'
        ]);

        $response = $this->get('/kategori-items/export-pdf/' . $kategori->id);
        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
    }
}
