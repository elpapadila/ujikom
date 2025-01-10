<x-layout title="Dashboard">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Selamat Datang, {{$user->name}}</h1>
        <form action="{{ url('dashboard') }}" method="GET" class="d-flex align-items-center">
            <!-- Dropdown Filter Bulan -->
            <select name="bulan" class="form-control mr-3" onchange="this.form.submit()" style="width: 200px;">
                @foreach(range(1, 12) as $bulanFilter)
                    <option value="{{ $bulanFilter }}" {{ request('bulan') == $bulanFilter ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $bulanFilter)->format('F') }}
                    </option>
                @endforeach
            </select>

            <!-- Tombol Generate Report -->
            <a href="{{ route('generateReport', ['bulan' => request('bulan')]) }}" target="_blank" class="btn btn-primary shadow-sm ml-2" style="black-space: nowrap;">
                <i class="fas fa-download fa-sm text-white-50"></i> Generate PDF Report
            </a>
        </form>
    </div>

    <!-- Content Row -->
    <div class="row">
        @foreach([
            ['color' => 'warning', 'title' => 'Pendapatan Seluruh Laundry', 'value' => $totalPendapatan->total_pendapatan ?? 0, 'id_outlet' => null],
            ['color' => 'primary', 'title' => 'Pendapatan Laundry Cempaka', 'value' => $pendapatanCempaka->total_pendapatan ?? 0, 'id_outlet' => 2],
            ['color' => 'success', 'title' => 'Pendapatan Laundry Mawar', 'value' => $pendapatanMawar->total_pendapatan ?? 0, 'id_outlet' => 3],
            ['color' => 'danger', 'title' => 'Pendapatan Laundry Amanah', 'value' => $pendapatanAmanah->total_pendapatan ?? 0, 'id_outlet' => 4],
        ] as $card)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-{{ $card['color'] }} shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-{{ $card['color'] }} text-uppercase mb-1">
                                    {{ $card['title'] }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($card['value'], 2) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Tombol Lihat Detail yang mengarah ke halaman transaksi -->
                    <div class="card-footer text-center">
                        <!-- Misalnya dalam card pendapatan outlet -->
                        <a href="{{ url('transaksi/' . $card['id_outlet']) }}" class="btn btn-sm btn-{{ $card['color'] }}">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <!-- Content Row -->
    <div class="row d-flex align-items-stretch">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4 h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pendapatan Overview</h6>
                    <form action="{{ url('dashboard') }}" method="GET">
                        <select name="bulan" class="form-control" onchange="this.form.submit()">
                            @foreach(range(1, 12) as $bulanFilter)
                                <option value="{{ $bulanFilter }}"
                                    {{ $bulan == $bulanFilter ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $bulanFilter)->format('F') }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="stackedBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4 h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Status Cucian</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data Pie Chart
        var baru = {{ $baru }};
        var proses = {{ $proses }};
        var diambil = {{ $diambil }};
        var selesai = {{ $selesai }};

        var ctxPie = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ["Baru", "Proses", "Diambil", "Selesai"],
                datasets: [{
                    data: [baru, proses, diambil, selesai],
                    backgroundColor: ['#4e73df', '#1cc88a', '#e74a3b', '#f39c12'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#f39c12'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: true,
                aspectRatio: 1.5,
                layout: {
                    padding: {
                        bottom: -10, // Tambahkan jarak antara grafik dan legenda
                        },
                    },
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom', // Label di bawah
                        labels: {
                            boxWidth: 20,    // Ukuran kotak warna
                            font: {
                                size: 12,    // Ukuran font label
                            },
                            padding: 20,     // Jarak antar label
                        },
                    },
                    tooltip: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                },
            },
        });


        // Data Bar Chart
        var pendapatanBulanan = @json($pendapatanBulanan);
        var bulan = [];
        var cempaka = [];
        var mawar = [];
        var amanah = [];

        pendapatanBulanan.forEach(item => {
            bulan.push(item.bulan);
            cempaka.push(item.cempaka || 0);
            mawar.push(item.mawar || 0);
            amanah.push(item.amanah || 0);
        });

        var ctxBar = document.getElementById("stackedBarChart");
        var myBarChart = new Chart(ctxBar, {
            type: 'bar',
                data: {
                    labels: bulan,
                    datasets: [
                        { label: "Cempaka", backgroundColor: "#4e73df", data: cempaka },
                        { label: "Mawar", backgroundColor: "#1cc88a", data: mawar },
                        { label: "Amanah", backgroundColor: "#e74a3b", data: amanah },
                    ],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom', // Letakkan label di bawah
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return 'Rp ' + tooltipItem.raw.toLocaleString();
                                }
                            },
                        },
                    },
                scales: {
                    x: {
                        stacked: false,
                        title: {
                            display: true,
                            text: 'Bulan', // Judul untuk sumbu x
                        },
                    },
                    y: {
                        stacked: false,
                        title: {
                            display: true,
                            text: 'Pendapatan (Rp)', // Judul untuk sumbu y
                        },
                    },
                },
            },
        });

    </script>

</x-layout>
