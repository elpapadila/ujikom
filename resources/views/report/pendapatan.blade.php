<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pendapatan Bulanan</title>
    <style>
        table {
            width: 100%;
            max-width: 900px; /* Maksimal lebar tabel */
            border-collapse: collapse;
            margin: 20px auto; /* Memberi jarak dan menengahkan tabel */
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        td {
            background-color: #fff;
        }
        tr:nth-child(even) td {
            background-color: #f9f9f9;
        }
        tr:hover td {
            background-color: #f1f1f1;
        }
        .text-center {
            text-align: center;
        }
        .section-title {
            background-color: #007bff;
            color: white;
            padding: 8px;
            text-align: center;
            font-size: 20px;
            margin-bottom: 10px;
        }
        ul {
            list-style: none;
            padding-left: 0;
        }
        ul li {
            background-color: #f4f4f4;
            padding: 8px;
            margin-bottom: 5px;
            border-radius: 5px;
        }
        .container {
            width: 90%;
            max-width: 1000px; /* Lebar maksimal container */
            margin: 0 auto;
            padding: 20px;
        }
        .report-title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }
        .report-header {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="report-header">
            <h1 class="report-title">Laporan Pendapatan Bulanan</h1>
            <h3>Bulan: {{ DateTime::createFromFormat('!m', $bulan)->format('F') }}</h3>
        </div>

        <!-- Tabel Pendapatan per Outlet -->
        <div class="section-title">Pendapatan per Outlet</div>
        <table>
            <thead>
                <tr>
                    <th>Outlet</th>
                    <th>Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendapatanPerOutlet as $outlet)
                    <tr>
                        <td>{{ $outlet->id_outlet == 2 ? 'Cempaka' : ($outlet->id_outlet == 3 ? 'Mawar' : 'Amanah') }}</td>
                        <td>Rp {{ number_format($outlet->total_pendapatan, 2) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td><strong>Total Pendapatan</strong></td>
                    <td><strong>Rp {{ number_format($totalPendapatanAllOutlet, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>

        <!-- Tabel Jumlah Transaksi per Outlet -->
        <div class="section-title">Jumlah Transaksi per Outlet</div>
        <table>
            <thead>
                <tr>
                    <th>Outlet</th>
                    <th>Jumlah Transaksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jumlahTransaksiPerOutlet as $outlet)
                    <tr>
                        <td>{{ $outlet->id_outlet == 2 ? 'Cempaka' : ($outlet->id_outlet == 3 ? 'Mawar' : 'Amanah') }}</td>
                        <td>{{ $outlet->jumlah_transaksi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tabel Pendapatan per Paket -->
        <div class="section-title">Pendapatan per Paket</div>
        <table>
            <thead>
                <tr>
                    <th>Nama Paket</th>
                    <th>Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendapatanPerPaket as $paket)
                    <tr>
                        <td>{{ $paket->nama_paket }}</td>
                        <td>Rp {{ number_format($paket->total_pendapatan, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Rincian Keuangan Lainnya -->
        <div class="section-title">Rincian Keuangan Lainnya</div>
        <ul>
            <li><strong>Jumlah Customer Baru: </strong>{{ $jumlahCustomerBaru }}</li>
            <li><strong>Total Biaya Tambahan: </strong>Rp {{ number_format($biayaTambahanTotal, 2) }}</li>
        </ul>
    </div>
</body>
</html>
