@extends('layouts.app')

@section('content')
<div class="container-fluid px-3 px-md-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{url('master-items')}}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Item
                </a>
                <div class="d-flex gap-2">
                    <a class="btn btn-info btn-sm text-white" href="{{url('master-items/form/edit')}}/{{$data->id}}">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a class="btn btn-danger btn-sm btn-confirm-delete" href="{{url('master-items/delete')}}/{{$data->id}}">
                        <i class="bi bi-trash"></i> Hapus
                    </a>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-2 px-3">
                    <span class="fw-semibold"><i class="bi bi-info-circle text-primary me-1"></i> Detail Master Item</span>
                </div>
                <div class="card-body p-3">
                    <div class="row g-3">
                        <div class="col-12 col-md-4 text-center">
                            @if(!empty($data->foto))
                                <img src="{{asset('storage/'.$data->foto)}}" class="img-fluid rounded border shadow-sm w-100" style="max-height:200px; object-fit:cover;">
                            @else
                                <div class="bg-light border rounded d-flex flex-column align-items-center justify-content-center py-4 text-muted" style="min-height: 150px;">
                                    <i class="bi bi-image fs-1 mb-1"></i>
                                    <small>Tidak Ada Foto</small>
                                </div>
                            @endif
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless align-middle mb-0">
                                    <tr>
                                        <th width="120">Kode Item</th>
                                        <td width="10">:</td>
                                        <td><span class="badge bg-secondary font-monospace">{{$data->kode}}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Item</th>
                                        <td>:</td>
                                        <td class="fw-semibold text-dark">{{$data->nama}}</td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td>:</td>
                                        <td>
                                            @if($data->kategoriItems->count() > 0)
                                                @foreach($data->kategoriItems as $cat)
                                                    <span class="badge bg-info text-dark me-1">{{$cat->nama}}</span>
                                                @endforeach
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Harga Beli</th>
                                        <td>:</td>
                                        <td>Rp {{number_format($data->harga_beli, 0, ',', '.')}}</td>
                                    </tr>
                                    <tr>
                                        <th>Laba (%)</th>
                                        <td>:</td>
                                        <td><span class="badge bg-success bg-opacity-10 text-success">{{$data->laba}}%</span></td>
                                    </tr>
                                    <tr>
                                        <th>Harga Jual</th>
                                        <td>:</td>
                                        <td class="fw-bold text-primary">Rp {{number_format($data->harga_jual, 0, ',', '.')}}</td>
                                    </tr>
                                    <tr>
                                        <th>Supplier</th>
                                        <td>:</td>
                                        <td>{{$data->supplier}}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis</th>
                                        <td>:</td>
                                        <td>{{$data->jenis}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection