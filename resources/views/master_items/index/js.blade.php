<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    var start_date = '';
    var end_date = '';
    var data_per_fetch = 500;
    var data_fetched = 0;

    $(document).ready(function() {
        $('#table').DataTable({
            searching: false,
            order: [[0, 'desc']],
        });
        getData();
    });

    $('.btn-get-data').click(function() {
        getData();
    });

    function getData(){
        $('#loading-filter').show();
        var dataTableObj = $('#table').DataTable();
        var filter_kode = $('#filter-kode').val();
        var filter_nama = $('#filter-nama').val();
        var filter_harga_min = $('#filter-harga-min').val();
        var filter_harga_max = $('#filter-harga-max').val();
        dataTableObj.clear().draw();

        $.ajax({
            url: '{{url("master-items/search")}}',
            dataType: 'json',
            tryCount: 0,
            retryLimit: 3,
            data: 'kode=' + encodeURIComponent(filter_kode) + 
                  '&nama=' + encodeURIComponent(filter_nama) + 
                  '&hargamin=' + encodeURIComponent(filter_harga_min) + 
                  '&hargamax=' + encodeURIComponent(filter_harga_max),
            success: function(results) {
                var data = results.data;

                $.each(data, function(index, item) {
                    var harga_jual = Math.round(item.harga_beli + (item.harga_beli * item.laba / 100));
                    var kode = item.kode;

                    var fotoHtml = item.foto 
                        ? `<img src="{{asset('storage')}}/${item.foto}" width="50" height="50" class="img-thumbnail" style="object-fit:cover;">`
                        : `<span class="badge bg-secondary">No Image</span>`;

                    var categories = [];
                    if (item.kategori_items && item.kategori_items.length > 0) {
                        $.each(item.kategori_items, function(i, kat) {
                            categories.push(kat.nama);
                        });
                    }
                    var kategoriStr = categories.length > 0 ? categories.join(', ') : '-';

                    var actionBtn = `<a href="{{url('master-items/view/')}}/${kode}" class="btn btn-primary btn-sm">View</a>`;

                    var rowData = [
                        item.kode,
                        item.nama,
                        fotoHtml,
                        kategoriStr,
                        item.jenis,
                        item.harga_beli,
                        harga_jual,
                        item.supplier,
                        actionBtn
                    ];

                    dataTableObj.row.add(rowData).draw(true);
                });
                $('#loading-filter').hide();
            },
            error: function(xhr, textStatus, errorThrown) {
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                    return;
                }
                alert('Terjadi kesalahan server, tidak dapat mengambil data');
                $('#loading-filter').hide();
            }
        });
    }
</script>