<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Kategori {{ $kategori->kode }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            padding: 0;
        }
        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .info-table td {
            padding: 4px 8px;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .data-table th, .data-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .data-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: right;
            font-size: 10px;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 5px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Detail Data Kategori Item</h2>
    </div>

    <table class="info-table">
        <tr>
            <td width="120"><strong>Kode Kategori</strong></td>
            <td width="10">:</td>
            <td>{{ $kategori->kode }}</td>
        </tr>
        <tr>
            <td><strong>Nama Kategori</strong></td>
            <td>:</td>
            <td>{{ $kategori->nama }}</td>
        </tr>
    </table>

    <h3>Daftar Item dalam Kategori Ini</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th width="30">No</th>
                <th>Kode Item</th>
                <th>Nama Item</th>
                <th>Jenis</th>
                <th>Supplier</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kategori->masterItems as $index => $item)
                @php
                    $hargaJual = round($item->harga_beli + ($item->harga_beli * $item->laba / 100));
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->kode }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jenis }}</td>
                    <td>{{ $item->supplier }}</td>
                    <td>Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($hargaJual, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada item dalam kategori ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ $print_datetime }}
    </div>

</body>
</html>
