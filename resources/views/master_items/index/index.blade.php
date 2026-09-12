@extends('layouts.app')

@section('content')
<div class="container-fluid px-3 px-md-4">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-11">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2 mb-3">
                <div>
                    <h5 class="fw-bold mb-0 text-slate-800">Master Items</h5>
                    <small class="text-muted">Kelola data master barang dan filter harga</small>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{url('master-items/form/new')}}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-plus-lg"></i> Item Baru
                    </a>
                    <div class="dropdown">
                        <button class="btn btn-success btn-sm dropdown-toggle fw-semibold" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-download me-1"></i> Export Data
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="exportDropdown">
                            <li>
                                <a class="dropdown-item py-2 btn-export-excel" href="{{url('master-items/export-excel')}}">
                                    <i class="bi bi-file-earmark-excel text-success me-2 fs-6"></i> Export Excel (.xls)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2 btn-export-csv" href="{{url('master-items/export-csv')}}">
                                    <i class="bi bi-filetype-csv text-info me-2 fs-6"></i> Export CSV (.csv)
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header py-2 px-3 bg-white">
                    <span class="fw-semibold text-dark"><i class="bi bi-list-task me-1 text-primary"></i> Daftar Master Items</span>
                </div>
                <div class="card-body p-3">
                    @include('master_items.index.filter')
                    @include('master_items.index.table')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@include('master_items.index.js')
@endsection