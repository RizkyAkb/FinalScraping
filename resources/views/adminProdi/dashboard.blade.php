@extends('layouts.sidebar')
@section('container')
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Dashboard</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon blue mb-2">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Jumlah Fakultas</h6>
                                        <h6 class="font-extrabold mb-0">{{ '1' }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon blue mb-2">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Jumlah Program Studi</h6>
                                        <h6 class="font-extrabold mb-0">{{ '1' }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon green mb-2">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Jumlah Dosen</h6>
                                        <h6 class="font-extrabold mb-0">{{ $dosenz }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon purple mb-2">
                                            <i class="iconly-boldShow"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Jumlah Artikel Jurnal</h6>
                                        <h6 class="font-extrabold mb-0">{{ $artikel }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Statistik Artikel Berdasarkan Tahun</h4>
                        <div class="d-flex gap-2">

                            <select id="filter-dosen" class="form-select">
                                <option value="">Semua Dosen</option>
                                @foreach ($dosen as $dosens)
                                <option value="{{ $dosens->id }}">{{ $dosens->name }}</option>
                                @endforeach
                            </select>
                            <select id="filter-source" class="form-select">
                                <option value="">Semua Source</option>
                                <option value="scopus">Scopus</option>
                                <option value="scholar">Scholar</option>
                            </select>

                            <button class="btn btn-primary" id="apply-filters" onclick="filterChart()">Terapkan</button>
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
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-body py-4 px-4">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img src="../assets/compiled/jpg/1.jpg" alt="Face 1">
                            </div>
                            <div class="ms-3 name">
                                <h5 class="font-bold">{{ Auth::user()->name }}</h5>
                                <h6 class="text-muted mb-0">Admin Fakultas</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/collect.js/4.36.1/collect.min.js" integrity="sha512-aub0tRfsNTyfYpvUs0e9G/QRsIDgKmm4x59WRkHeWUc3CXbdiMwiMQ5tTSElshZu2LCq8piM/cbIsNwuuIR4gA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    window.onload = function() {
        // Render chart with initial data
        const initialData = JSON.parse(document.getElementById('initial-data').textContent);
        renderChart(initialData);
    };

    function renderChart(data) {
        const ctx = document.getElementById('universitas').getContext('2d');
        if (window.myChart) {
            window.myChart.destroy();
        }
        window.myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.map(item => item.year),
                datasets: [{
                    label: 'Jumlah Artikel',
                    data: data.map(item => item.total),
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

    async function filterChart() {
        try {
            const dosenId = document.getElementById('filter-dosen').value;
            const source = document.getElementById('filter-source').value;

            // Kirim permintaan AJAX
            const response = await fetch(`/prodi/dashboard?dosen_id=${dosenId}&source=${source}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            console.log('Data yang diterima:', data); // Tambahkan log untuk memeriksa data
            renderChart(data);
        } catch (error) {
            console.error('Error:', error);
        }

    }
</script>
@endsection