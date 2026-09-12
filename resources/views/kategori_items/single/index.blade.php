@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="form-group mb-2 d-flex justify-content-between">
                <a href="{{url('kategori-items')}}" class="btn btn-secondary">Kembali ke Daftar Kategori</a>
                <a href="{{url('kategori-items/export-pdf/'.$kategori->id)}}" class="btn btn-danger" target="_blank">
                    <i class="bi bi-file-pdf"></i> Download PDF
                </a>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Detail Kategori Item</span>
                </div>

                <div class="card-body">
                    <table class="table table-borderless w-auto mb-4">
                        <tr>
                            <th>Kode Kategori</th>
                            <td>:</td>
                            <td><strong>{{$kategori->kode}}</strong></td>
                        </tr>
                        <tr>
                            <th>Nama Kategori</th>
                            <td>:</td>
                            <td><strong>{{$kategori->nama}}</strong></td>
                        </tr>
                    </table>

                    <div class="mt-4">
                        <h5>Daftar Item dalam Kategori Ini</h5>
                        <table class="table table-striped table-bordered mt-2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Item</th>
                                    <th>Nama Item</th>
                                    <th>Jenis</th>
                                    <th>Supplier</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kategori->masterItems as $index => $item)
                                    @php
                                        $hargaJual = round($item->harga_beli + ($item->harga_beli * $item->laba / 100));
                                    @endphp
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->kode }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->jenis }}</td>
                                        <td>{{ $item->supplier }}</td>
                                        <td>Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($hargaJual, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{url('master-items/view/'.$item->kode)}}" class="btn btn-primary btn-sm">View Item</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">Belum ada item yang menggunakan kategori ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <a class="btn btn-info text-white" href="{{url('kategori-items/form/edit')}}/{{$kategori->id}}">Edit Kategori</a>
                        <a class="btn btn-danger" href="{{url('kategori-items/delete')}}/{{$kategori->id}}" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">Delete Kategori</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@endsection
