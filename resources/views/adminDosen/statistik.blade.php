@extends('layouts.sidebar')
@section('container')
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-content">
        <section class="section">

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="d-flex justify-content-end">
                <a href="{{ route('dosen.scrape', ['id' => Auth::user()->id]) }}" class="btn btn-primary btn-lg"
                    id="scrapeButton">Scraping Data</a>

            </div>

            <div class="page-heading">
                <h3>Data Publikasi dan Sitasi Dosen</h3>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablex">
                            <thead>
                                <tr>
                                    <th>Penulis</th>
                                    <th>Program Studi</th>
                                    <th>Judul</th>
                                    <th>Tahun</th>
                                    <th>Jumlah Sitasi</th>
                                    <th>Sumber</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($artikels as $artikel)
                                <tr>
                                    <td>{{ $artikel->user->name }}</td>
                                    <td>{{ $artikel->user->prodi->prodi_name }}</td>
                                    <td>{{ $artikel->title }}</td>
                                    <td>{{ $artikel->publication_date ? substr($artikel->publication_date, 0, 4) : '-' }}
                                    </td>
                                    <td>{{ $artikel->citations }}</td>
                                    <td>{{ $artikel->source }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <div class="col-12">
            <div class="page-heading">
                <h3>Perbandingan Jumlah Sitasi Dosen Prodi {{ Auth::user()->prodi->prodi_name }}</h3>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Statistik Artikel Dosen Berdasarkan Tahun</h4>
                    <div class="d-flex gap-2">
                        <select id="yearFilterDosen" class="form-select">
                            <option value="" disabled selected>Select Year</option>
                            @foreach($years as $year)
                            <option value="{{ $year->year }}">{{ $year->year }}</option>
                            @endforeach
                        </select>

                        <button class="btn btn-primary" id="filters-dosen" onclick="filterChartDosen()">Terapkan</button>
                    </div>
                </div>
                <div class="card-body">
                    <div style="margin: auto; max-width: 100%;">
                        <canvas id="pieChart" width="400" height="400"></canvas>
                    </div>
                    <script id="initial-data" type="application/json">
                        @json($publikasiData)
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    window.onload = function() {
        // Render chart dengan data awal (semua tahun)
        const initialDataDosen = @json($chartDataDosen);
        renderChart(initialDataDosen);
    };

    function renderChart(dataDosen) {
        const ctx = document.getElementById('pieChart').getContext('2d');
        const labelsDosen = dataDosen.map(item => item.dosen);
        const citationData = dataDosen.map(item => item.citation);

        // Hancurkan chart sebelumnya jika ada
        if (window.myChart) {
            window.myChart.destroy();
        }

        // Tangani kasus tidak ada data
        if (dataDosen.length === 0) {
            alert('Data tidak ditemukan untuk tahun yang dipilih.');
            return;
        }

        // Render chart baru
        window.myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labelsDosen,
                datasets: [{
                    label: 'Jumlah Citation',
                    data: citationData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }





    async function filterChartDosen() {
        const year = document.getElementById('yearFilterDosen').value;
        if (!year) {
            alert('Silakan pilih tahun terlebih dahulu.');
            return;
        }

        try {
            const response = await fetch(`/dosen/statistik?year=${year}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) {
                console.error('Failed to fetch data:', response.statusText);
                return;
            }

            const data = await response.json();
            renderChart(data.chartDataDosen); // Render ulang chart dengan data terbaru
        } catch (error) {
            console.error('Error:', error);
        }
    }
</script>
@endsection