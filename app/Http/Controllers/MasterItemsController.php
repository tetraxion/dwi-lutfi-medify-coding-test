<?php

namespace App\Http\Controllers;

use App\Models\KategoriItem;
use App\Models\MasterItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MasterItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('master_items.index.index');
    }

    public function search(Request $request)
    {
        $kode = $request->kode;
        $nama = $request->nama;
        $hargamin = $request->hargamin;
        $hargamax = $request->hargamax;

        $data_search = MasterItem::with('kategoriItems');

        if ($request->filled('kode')) {
            $data_search->where('kode', 'LIKE', '%' . $kode . '%');
        }
        if ($request->filled('nama')) {
            $data_search->where('nama', 'LIKE', '%' . $nama . '%');
        }
        if ($request->filled('hargamin')) {
            $data_search->where('harga_beli', '>=', (int)$hargamin);
        }
        if ($request->filled('hargamax')) {
            $data_search->where('harga_beli', '<=', (int)$hargamax);
        }

        $data_search = $data_search->orderBy('id')->get();

        return response()->json([
            'status' => 200,
            'data' => $data_search
        ]);
    }

    public function formView($method, $id = 0)
    {
        if ($method == 'new') {
            $item = new MasterItem();
            $selected_categories = [];
        } else {
            $item = MasterItem::with('kategoriItems')->findOrFail($id);
            $selected_categories = $item->kategoriItems->pluck('id')->toArray();
        }

        $categories = KategoriItem::orderBy('nama')->get();

        $data['item'] = $item;
        $data['method'] = $method;
        $data['categories'] = $categories;
        $data['selected_categories'] = $selected_categories;

        return view('master_items.form.index', $data);
    }

    public function singleView($kode)
    {
        $data['data'] = MasterItem::with('kategoriItems')->where('kode', $kode)->firstOrFail();
        return view('master_items.single.index', $data);
    }

    public function formSubmit(Request $request, $method, $id = 0)
    {
        if ($method == 'new') {
            $data_item = new MasterItem;
            $count = MasterItem::withTrashed()->count() + 1;
            $kode = str_pad($count, 5, '0', STR_PAD_LEFT);
        } else {
            $data_item = MasterItem::findOrFail($id);
            $kode = $data_item->kode;
        }

        if ($request->hasFile('foto')) {
            if ($data_item->foto && Storage::disk('public')->exists($data_item->foto)) {
                Storage::disk('public')->delete($data_item->foto);
            }
            $path = $request->file('foto')->store('items', 'public');
            $data_item->foto = $path;
        }

        $data_item->nama = $request->nama;
        $data_item->harga_beli = $request->harga_beli;
        $data_item->laba = $request->laba;
        $data_item->kode = $kode;
        $data_item->supplier = $request->supplier;
        $data_item->jenis = $request->jenis;
        $data_item->save();

        $data_item->kategoriItems()->sync($request->categories ?? []);

        return redirect('master-items')->with('success', 'Master Item berhasil disimpan!');
    }

    public function delete($id)
    {
        MasterItem::findOrFail($id)->delete();
        return redirect('master-items')->with('success', 'Master Item berhasil dihapus!');
    }

    public function exportExcel()
    {
        $items = MasterItem::with('kategoriItems')->orderBy('id')->get();
        $export_datetime = date('d-m-Y H:i:s');
        $filename = 'master_items_' . date('Ymd_His') . '.xls';

        $headers = [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control' => 'max-age=0',
        ];

        $content = view('master_items.excel.template', [
            'items' => $items,
            'export_datetime' => $export_datetime,
        ])->render();

        return response($content, 200, $headers);
    }

    public function updateRandomData()
    {
        $data = MasterItem::get();
        foreach ($data as $item) {
            $kode = str_pad($item->id, 5, '0', STR_PAD_LEFT);

            $item->harga_beli = rand(100, 1000000);
            $item->laba = rand(10, 99);
            $item->kode = $kode;
            $item->supplier = $this->getRandomSupplier();
            $item->jenis = $this->getRandomJenis();
            $item->save();
        }
    }

    private function getRandomSupplier()
    {
        $array = ['Tokopaedi', 'Bukulapuk', 'TokoBagas', 'E Commurz', 'Blublu'];
        return $array[rand(0, 4)];
    }

    private function getRandomJenis()
    {
        $array = ['Obat', 'Alkes', 'Matkes', 'Umum', 'ATK'];
        return $array[rand(0, 4)];
    }
}
