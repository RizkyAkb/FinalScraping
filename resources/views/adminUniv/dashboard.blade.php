@extends('layouts.sidebar')
@section('container')
    <div id="main">
        <header class="mb-3">
            <button class="btn btn-primary d-block d-xl-none" type="button">
                <i class="bi bi-justify fs-3"></i>
            </button>
        </header>

        <div class="page-heading mb-4">
            <h3>Dashboard</h3>
        </div>

        <div class="page-content">
            <section class="row">
                <!-- Statistik Cards -->
                <div class="col-12 col-lg-9">
                    <div class="row">
                        @php
                            $stats = [
                                [
                                    'title' => 'Jumlah Fakultas',
                                    'icon' => 'iconly-boldProfile',
                                    'value' => $fakultas,
                                    'color' => 'blue',
                                ],
                                [
                                    'title' => 'Jumlah Program Studi',
                                    'icon' => 'iconly-boldProfile',
                                    'value' => $prodi,
                                    'color' => 'blue',
                                ],
                                [
                                    'title' => 'Jumlah Dosen',
                                    'icon' => 'iconly-boldAdd-User',
                                    'value' => $dosen,
                                    'color' => 'green',
                                ],
                                [
                                    'title' => 'Jumlah Artikel Jurnal',
                                    'icon' => 'iconly-boldShow',
                                    'value' => $artikel,
                                    'color' => 'purple',
                                ],
                            ];
                        @endphp

                        @foreach ($stats as $stat)
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body d-flex align-items-center py-4 px-4">
                                        <div class="me-3 stats-icon {{ $stat['color'] }}">
                                            <i class="{{ $stat['icon'] }} fs-3"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-muted font-semibold">{{ $stat['title'] }}</h6>
                                            <h6 class="font-extrabold mb-0">{{ $stat['value'] }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Filter and Statistik Chart -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Statistik Artikel Berdasarkan Tahun</h4>
                            <div class="d-flex gap-2">
                                <select id="filter-year" class="form-select">
                                    <option value="">Semua Prodi</option>
                                    @foreach ($prodies as $prody)
                                        <option value="{{ $prody->id }}">{{ $prody->prodi_name }}</option>
                                    @endforeach
                                </select>

                                <select id="filter-faculty" class="form-select">
                                    <option value="">Semua Fakultas</option>
                                    @foreach ($faculties as $faculty)
                                        <option value="{{ $faculty->id }}">{{ $faculty->fakultas_name }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary" id="apply-filters">Terapkan</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="universitas" width="400" height="200"></canvas>
                            <script id="initial-data" type="application/json">
                            @json($publikasiData)
                        </script>
                        </div>

                    </div>
                </div>

                <!-- Profile Card -->
                <div class="col-12 col-lg-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar avatar-xl mb-3">
                                <img src="../assets/compiled/jpg/1.jpg" alt="Admin Profile" class="rounded-circle">
                            </div>
                            <h5 class="font-bold">{{ Auth::user()->name }}</h5>
                            <h6 class="text-muted mb-0">Admin Fakultas</h6>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @endsection

    <script src="../assets/static/js/components/dark.js"></script>
    <script src="../assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/compiled/js/app.js"></script>
    <!-- Need: Apexcharts -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"
        integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/collect.js/4.36.1/collect.min.js"
        integrity="sha512-aub0tRfsNTyfYpvUs0e9G/QRsIDgKmm4x59WRkHeWUc3CXbdiMwiMQ5tTSElshZu2LCq8piM/cbIsNwuuIR4gA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        window.onload = function() {
            // Render chart dengan data awal
            renderChart(JSON.parse(document.getElementById('initial-data').textContent));

            // Tombol untuk menerapkan filter
            document.getElementById('apply-filters').onclick = function() {
                var prodiId = document.getElementById('filter-year').value;
                var fakultasId = document.getElementById('filter-faculty').value;

                // Kirim request melalui AJAX
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/dashboard?fakultas_id=' + fakultasId + '&prodi_id=' + prodiId, true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var data = JSON.parse(xhr.responseText);
                        renderChart(data.publikasiData);
                    }
                };
                xhr.send();
            };
        };

        function renderChart(data) {
            var ctx = document.getElementById('universitas').getContext('2d');
            if (window.myChart) {
                window.myChart.destroy();
            }
            window.myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.map(function(item) {
                        return item.year;
                    }),
                    datasets: [{
                        label: 'Jumlah Artikel',
                        data: data.map(function(item) {
                            return item.total;
                        }),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>
