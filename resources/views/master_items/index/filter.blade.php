<div id="filter-container">
    <h4><i class="bi bi-funnel me-1 text-primary"></i> Filter Data</h4>
    <div class="row g-2">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="form-group">
                <label>Kode</label>
                <input type="text" class="form-control form-control-sm" id="filter-kode" placeholder="Cari Kode...">
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control form-control-sm" id="filter-nama" placeholder="Cari Nama...">
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="form-group">
                <label>Harga Min</label>
                <input type="number" class="form-control form-control-sm" id="filter-harga-min" placeholder="Min Rp">
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="form-group">
                <label>Harga Max</label>
                <input type="number" class="form-control form-control-sm" id="filter-harga-max" placeholder="Max Rp">
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