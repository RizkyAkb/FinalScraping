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
                ['title' => 'Jumlah Fakultas', 'icon' => 'iconly-boldProfile', 'value' => $fakultas, 'color' => 'blue'],
                ['title' => 'Jumlah Program Studi', 'icon' => 'iconly-boldProfile', 'value' => $prodi, 'color' => 'blue'],
                ['title' => 'Jumlah Dosen', 'icon' => 'iconly-boldAdd-User ', 'value' => $dosen, 'color' => 'green'],
                ['title' => 'Jumlah Artikel Jurnal', 'icon' => 'iconly-boldShow', 'value' => $artikel, 'color' => 'purple'],
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
                <select id="filter-prodi" class="form-select">
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
                <select id="filter-dosen" class="form-select">
                    <option value="">Semua Dosen</option>
                    @foreach ($dosens as $dosen)
                        <option value="{{ $dosen->id }}">{{ $dosen->name }}</option>
                    @endforeach
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
        </section>
    </div>
</div>