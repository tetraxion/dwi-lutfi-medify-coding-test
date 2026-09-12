@extends('layouts.app')

@section('content')
<div class="container-fluid px-3 px-md-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="mb-2">
                <a href="{{url('master-items')}}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Item
                </a>
            </div>
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-2 px-3">
                    <span class="fw-semibold">
                        @if($method == 'new')
                            <i class="bi bi-plus-circle text-primary me-1"></i> Buat Master Item Baru
                        @else
                            <i class="bi bi-pencil-square text-primary me-1"></i> Edit Master Item
                        @endif
                    </span>
                </div>
                <div class="card-body p-3">
                    @include('master_items.form.form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection