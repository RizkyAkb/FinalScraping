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
                    <a href="{{ route('prodi.scrape', ['id' => Auth::user()->prodi_id]) }}" class="btn btn-primary btn-lg"
                        id="scrapeButton">Scraping Data</a>
                </div>

                <div class="page-heading">
                    <h3>Data Publikasi dan Sitasi Dosen Prodi {{ Auth::user()->prodi->prodi_name }}</h3>
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
                    <h3>Statistik Sitasi Dosen Antar Prodi</h3>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div style="margin: auto; max-width: 100%;">
                            <canvas id="pieChart" width="500" height="500"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('pieChart').getContext('2d');
        const chartData = @json($chartData);

        const labels = chartData.map(data => data.prodi);
        const data = chartData.map(data => data.citation);

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Citation',
                    data: data,
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
                layout: {
                    padding: {
                        top: 20,
                        bottom: 20,
                        left: 20,
                        right: 20,
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom', // Geser legenda ke bawah chart untuk lebih banyak ruang
                        labels: {
                            boxWidth: 10, // Ukuran kotak warna pada label
                        }
                    }
                }
            }
        });
    </script>
@endsection
