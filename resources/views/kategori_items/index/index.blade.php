@extends('layouts.app')

@section('content')
<div class="container-fluid px-3 px-md-4">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2 mb-3">
                <div>
                    <h5 class="fw-bold mb-0 text-slate-800">Kategori Items</h5>
                    <small class="text-muted">Kelola data kategori barang dan relasi ke item</small>
                </div>
                <div>
                    <a href="{{url('kategori-items/form/new')}}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-plus-lg"></i> Kategori Baru
                    </a>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header py-2 px-3 bg-white">
                    <span class="fw-semibold text-dark"><i class="bi bi-tags me-1 text-primary"></i> Daftar Kategori Items</span>
                </div>

                <div class="card-body p-3">
                    @include('kategori_items.index.filter')
                    @include('kategori_items.index.table')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@include('kategori_items.index.js')
@endsection
