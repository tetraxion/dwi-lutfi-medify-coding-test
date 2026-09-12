<div id="filter-container">
    <h4><i class="bi bi-funnel me-1 text-primary"></i> Filter Kategori</h4>
    <div class="row g-2">
        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label>Kode</label>
                <input type="text" class="form-control form-control-sm" id="filter-kode" placeholder="Cari Kode Kategori...">
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control form-control-sm" id="filter-nama" placeholder="Cari Nama Kategori...">
            </div>
        </div>
    </div>
    <div class="mt-2 d-flex align-items-center gap-2">
        <button class="btn btn-primary btn-sm btn-get-data">
            <i class="bi bi-search"></i> Terapkan Filter
        </button>
        <span id="loading-filter" class="spinner-border spinner-border-sm text-primary" style="display: none;" role="status"></span>
    </div>
</div>
