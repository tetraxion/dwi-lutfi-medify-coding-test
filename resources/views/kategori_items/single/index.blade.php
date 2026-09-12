@extends('layouts.app')

@section('content')
<div class="container-fluid px-3 px-md-4">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2 mb-3">
                <a href="{{url('kategori-items')}}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Kategori
                </a>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{url('kategori-items/export-pdf/'.$kategori->id)}}" class="btn btn-danger btn-sm btn-export-pdf" target="_blank">
                        <i class="bi bi-file-earmark-pdf"></i> Download PDF
                    </a>
                    <a class="btn btn-info btn-sm text-white" href="{{url('kategori-items/form/edit')}}/{{$kategori->id}}">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a class="btn btn-danger btn-sm btn-confirm-delete" href="{{url('kategori-items/delete')}}/{{$kategori->id}}">
                        <i class="bi bi-trash"></i> Delete
                    </a>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-2 px-3">
                    <span class="fw-semibold"><i class="bi bi-tag text-primary me-1"></i> Detail Kategori Item</span>
                </div>

                <div class="card-body p-3">
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-sm-6">
                            <small class="text-muted d-block">Kode Kategori</small>
                            <span class="badge bg-secondary font-monospace fs-6">{{$kategori->kode}}</span>
                        </div>
                        <div class="col-12 col-sm-6">
                            <small class="text-muted d-block">Nama Kategori</small>
                            <span class="fw-bold text-dark fs-6">{{$kategori->nama}}</span>
                        </div>
                    </div>

                    <hr class="my-3 text-muted">

                    <h6 class="fw-bold text-slate-800 mb-2">
                        <i class="bi bi-boxes me-1 text-primary"></i> Daftar Item dalam Kategori Ini ({{$kategori->masterItems->count()}})
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <th width="40">No</th>
                                    <th>Kode Item</th>
                                    <th>Nama Item</th>
                                    <th>Jenis</th>
                                    <th>Supplier</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th width="90" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kategori->masterItems as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><span class="badge bg-light text-dark border">{{ $item->kode }}</span></td>
                                        <td class="fw-semibold text-dark">{{ $item->nama }}</td>
                                        <td>{{ $item->jenis }}</td>
                                        <td>{{ $item->supplier }}</td>
                                        <td>Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                                        <td class="fw-bold text-primary">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <a href="{{url('master-items/view/'.$item->kode)}}" class="btn btn-primary btn-sm">View</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-3">Belum ada item yang menggunakan kategori ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection
