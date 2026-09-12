@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-group mb-2">
                <a href="{{url('master-items')}}" class="btn btn-secondary">Kembali ke Daftar Item</a>
            </div>
            <div class="card">
                <div class="card-header">Master Item</div>

                <div class="card-body">
                    @if(!empty($data->foto))
                        <div class="mb-3 text-center">
                            <img src="{{asset('storage/'.$data->foto)}}" width="200" class="img-fluid rounded border shadow-sm" style="max-height:250px; object-fit:cover;">
                        </div>
                    @endif

                    <table class="table table-borderless">
                        <tr>
                            <th width="150">Kode</th>
                            <td width="10">:</td>
                            <td>{{$data->kode}}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>:</td>
                            <td>{{$data->nama}}</td>
                        </tr>
                        <tr>
                            <th>Foto</th>
                            <td>:</td>
                            <td>
                                @if(!empty($data->foto))
                                    <a href="{{asset('storage/'.$data->foto)}}" target="_blank">Lihat Foto</a>
                                @else
                                    <span class="text-muted">Tidak Ada Foto</span>
                                @endif
                            </td>
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
                            <th>Laba</th>
                            <td>:</td>
                            <td>{{$data->laba}}%</td>
                        </tr>
                        <tr>
                            <th>Harga Jual</th>
                            <td>:</td>
                            <td>Rp {{number_format(round($data->harga_beli + $data->harga_beli * $data->laba / 100), 0, ',', '.')}}</td>
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
                    <div class="mt-3">
                        <a class="btn btn-info text-white" href="{{url('master-items/form/edit')}}/{{$data->id}}">Edit</a>
                        <a class="btn btn-danger" href="{{url('master-items/delete')}}/{{$data->id}}" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@endsection