<form method="POST" enctype="multipart/form-data">
    @csrf
    @if($method == 'edit')
    <div class="form-group mb-2">
        <label>Kode Barang</label>
        <input type="text" class="form-control" name="kode_barang" required readonly value="{{$item->kode ?? ''}}">
    </div>
    @endif

    <div class="form-group mb-2">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama" required value="{{$item->nama ?? ''}}">
    </div>

    <div class="form-group mb-2">
        <label>Foto</label>
        <input type="file" class="form-control" name="foto" accept="image/*">
        @if(!empty($item->foto))
            <div class="mt-2">
                <small class="d-block text-muted">Foto saat ini:</small>
                <img src="{{asset('storage/'.$item->foto)}}" width="100" class="img-thumbnail mt-1">
            </div>
        @endif
    </div>

    <div class="form-group mb-2">
        <label>Harga Beli</label>
        <input type="number" class="form-control" name="harga_beli" required value="{{$item->harga_beli ?? ''}}">
    </div>

    <div class="form-group mb-2">
        <label>Laba (dalam persen)</label>
        <input type="number" class="form-control" name="laba" required value="{{$item->laba ?? ''}}">
    </div>

    @php $selected = $item->supplier ?? ''; @endphp
    <div class="form-group mb-2">
        <label>Supplier</label>
        <select class="form-control" required name="supplier">
            <option @if($selected == '') selected @endif value="">--Pilih--</option>
            <option @if($selected == 'Tokopaedi') selected @endif>Tokopaedi</option>
            <option @if($selected == 'Bukulapuk') selected @endif>Bukulapuk</option>
            <option @if($selected == 'TokoBagas') selected @endif>TokoBagas</option>
            <option @if($selected == 'E Commurz') selected @endif>E Commurz</option>
            <option @if($selected == 'Blublu') selected @endif>Blublu</option>
        </select>
    </div>

    @php $selected = $item->jenis ?? ''; @endphp
    <div class="form-group mb-2">
        <label>Jenis</label>
        <select class="form-control" required name="jenis">
            <option @if($selected == '') selected @endif value="">--Pilih--</option>
            <option @if($selected == 'Obat') selected @endif>Obat</option>
            <option @if($selected == 'Alkes') selected @endif>Alkes</option>
            <option @if($selected == 'Matkes') selected @endif>Matkes</option>
            <option @if($selected == 'Umum') selected @endif>Umum</option>
            <option @if($selected == 'ATK') selected @endif>ATK</option>
        </select>
    </div>

    <div class="form-group mb-2">
        <label>Kategori</label>
        <div class="border p-2 rounded" style="max-height: 150px; overflow-y: auto;">
            @forelse($categories as $cat)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="categories[]" value="{{$cat->id}}" id="cat_{{$cat->id}}" @if(in_array($cat->id, $selected_categories ?? [])) checked @endif>
                    <label class="form-check-label" for="cat_{{$cat->id}}">
                        {{$cat->kode}} - {{$cat->nama}}
                    </label>
                </div>
            @empty
                <small class="text-muted">Belum ada data kategori. <a href="{{url('kategori-items/form/new')}}" target="_blank">Tambah Kategori</a></small>
            @endforelse
        </div>
    </div>

    <button class="btn btn-primary mt-3">Submit</button>
</form>