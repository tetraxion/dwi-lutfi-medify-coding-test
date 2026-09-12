<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; font-size: 11pt; }
        .title-header { background-color: #1e293b; color: #ffffff; font-size: 14pt; font-weight: bold; text-align: center; padding: 12px; }
        .meta-header { background-color: #f1f5f9; color: #334155; font-size: 10pt; padding: 6px; }
        .table-th { background-color: #0f172a; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #334155; padding: 8px; }
        .table-td { border: 1px solid #cbd5e1; padding: 6px; }
        .even-row { background-color: #f8fafc; }
        .odd-row { background-color: #ffffff; }
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .text-right { text-align: right; }
        .bold { font-weight: bold; }
        .currency { text-align: right; mso-number-format: "\Rp\ #\,\#\#0"; }
        .footer-total { background-color: #e2e8f0; font-weight: bold; border: 1px solid #94a3b8; padding: 8px; }
    </style>
</head>
<body>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th colspan="7" class="title-header">LAPORAN DATA MASTER ITEMS - MEDIFY APP</th>
        </tr>
        <tr>
            <td colspan="7" class="meta-header">
                <strong>Tanggal Export:</strong> {{ $export_datetime }} &nbsp;|&nbsp; 
                <strong>Total Items:</strong> {{ count($items) }} Data
            </td>
        </tr>
        <tr><td colspan="7" style="height: 10px; border: none;"></td></tr>
        <thead>
            <tr>
                <th class="table-th" style="width: 45px;">No</th>
                <th class="table-th" style="width: 180px;">Nama Kategori</th>
                <th class="table-th" style="width: 220px;">Nama Items</th>
                <th class="table-th" style="width: 160px;">Nama Supplier</th>
                <th class="table-th" style="width: 130px;">Harga Beli</th>
                <th class="table-th" style="width: 85px;">Laba (%)</th>
                <th class="table-th" style="width: 140px;">Harga Jual</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $index => $item)
            <tr class="{{ $index % 2 == 0 ? 'even-row' : 'odd-row' }}">
                <td class="table-td text-center">{{ $index + 1 }}</td>
                <td class="table-td text-left">{{ $item->nama_kategori_list ?: '-' }}</td>
                <td class="table-td text-left bold">{{ $item->nama }}</td>
                <td class="table-td text-left">{{ $item->supplier }}</td>
                <td class="table-td currency">Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                <td class="table-td text-center">{{ $item->laba }}%</td>
                <td class="table-td currency">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="footer-total text-right">TOTAL KESELURUHAN</td>
                <td class="footer-total currency">Rp {{ number_format($items->sum('harga_beli'), 0, ',', '.') }}</td>
                <td class="footer-total text-center">-</td>
                <td class="footer-total currency">Rp {{ number_format($items->sum('harga_jual'), 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
