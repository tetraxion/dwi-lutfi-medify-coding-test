<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#table').DataTable({
            searching: false,
            order: [[0, 'asc']],
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
        dataTableObj.clear().draw();

        $.ajax({
            url: '{{url("kategori-items/search")}}',
            dataType: 'json',
            tryCount: 0,
            retryLimit: 3,
            data: 'kode=' + encodeURIComponent(filter_kode) + '&nama=' + encodeURIComponent(filter_nama),
            success: function(results) {
                var data = results.data;

                $.each(data, function(index, item) {
                    var actionHtml = `<a href="{{url('kategori-items/view/')}}/${item.id}" class="btn btn-primary btn-sm">View</a>`;

                    var rowData = [
                        item.kode,
                        item.nama,
                        actionHtml
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
