<form method="POST">
    @csrf
    <div class="form-group mb-2">
        <label>Kode Kategori</label>
        <input type="text" class="form-control" name="kode" value="{{$kategori->kode ?? ''}}" placeholder="Otomatis jika dikosongkan">
    </div>

    <div class="form-group mb-2">
        <label>Nama Kategori</label>
        <input type="text" class="form-control" name="nama" required value="{{$kategori->nama ?? ''}}">
    </div>

    <button class="btn btn-primary mt-3">Submit</button>
</form>
