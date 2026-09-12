<?php

namespace App\Http\Controllers;

use App\Models\KategoriItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class KategoriItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('kategori_items.index.index');
    }

    public function search(Request $request)
    {
        $kode = $request->kode;
        $nama = $request->nama;

        $data_search = KategoriItem::query();

        if ($request->filled('kode')) {
            $data_search->where('kode', 'LIKE', '%' . $kode . '%');
        }
        if ($request->filled('nama')) {
            $data_search->where('nama', 'LIKE', '%' . $nama . '%');
        }

        $data = $data_search->orderBy('id')->get();

        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }

    public function formView($method, $id = 0)
    {
        if ($method == 'new') {
            $kategori = new KategoriItem();
        } else {
            $kategori = KategoriItem::findOrFail($id);
        }

        $data['kategori'] = $kategori;
        $data['method'] = $method;

        return view('kategori_items.form.index', $data);
    }

    public function formSubmit(Request $request, $method, $id = 0)
    {
        if ($method == 'new') {
            $kategori = new KategoriItem();
            $kode = $request->kode;
            if (empty($kode)) {
                $count = KategoriItem::withTrashed()->count() + 1;
                $kode = 'KAT-' . str_pad($count, 4, '0', STR_PAD_LEFT);
            }
            $kategori->kode = $kode;
        } else {
            $kategori = KategoriItem::findOrFail($id);
            if ($request->filled('kode')) {
                $kategori->kode = $request->kode;
            }
        }

        $kategori->nama = $request->nama;
        $kategori->save();

        return redirect('kategori-items')->with('success', 'Kategori Item berhasil disimpan!');
    }

    public function singleView($id)
    {
        $kategori = KategoriItem::with('masterItems')->findOrFail($id);
        $data['kategori'] = $kategori;

        return view('kategori_items.single.index', $data);
    }

    public function delete($id)
    {
        KategoriItem::findOrFail($id)->delete();
        return redirect('kategori-items')->with('success', 'Kategori Item berhasil dihapus!');
    }

    public function exportPdf($id)
    {
        $kategori = KategoriItem::with('masterItems')->findOrFail($id);
        $print_datetime = date('d-m-Y H:i:s');

        $pdf = Pdf::loadView('kategori_items.pdf.template', [
            'kategori' => $kategori,
            'print_datetime' => $print_datetime,
        ]);

        return $pdf->download('kategori_' . $kategori->kode . '.pdf');
    }
}
