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
                <div class="d-flex justify-content-end">
                    <a href="{{ route('scrapeAll') }}" class="btn btn-primary btn-lg">Scraping Data</a>
                </div>
                <div class="page-heading">
                    <h3>Data Publikasi dan Sitasi Dosen Fakultas ..</h3>

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
                                    @forelse ($artikels as $artikel)
                                        <tr>
                                            <td>{{ $artikel->user->name }}</td>
                                            <td>{{ $artikel->user->prodi->prodi_name }}</td>
                                            <td>{{ $artikel->tittle }}</td>
                                            <td>'N/A'</td>
                                            <td>'N/A'</td>
                                            <td>'N/A'</td>
                                            <td>                                                
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center text-mute" colspan="4">Data Fakultas Tidak Ditemukan
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section">
                <div class="page-heading">
                    <h3>Perbandingan Jumlah Sitasi Dosen Antar Prodi</h3>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table tablex">
                                <thead>
                                    <tr>
                                        <th>Program Studi</th>
                                        <th>Tahun</th>
                                        <th>Jumlah Sitasi</th>
                                        <th>Sumber</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Pendidikan Biologi</td>
                                        <td>
                                            <div class="d-flex">
                                                <input type="number" class="form-control form-control-sm me-1"
                                                    placeholder="Dari" value="2010">
                                                <input type="number" class="form-control form-control-sm"
                                                    placeholder="Sampai" value="2015">
                                            </div>
                                        </td>
                                        <td>751</td>
                                        <td>Scopus</td>
                                    </tr>
                                    <tr>
                                        <td>Pendidikan Matematika</td>
                                        <td>
                                            <div class="d-flex">
                                                <input type="number" class="form-control form-control-sm me-1"
                                                    placeholder="Dari" value="2010">
                                                <input type="number" class="form-control form-control-sm"
                                                    placeholder="Sampai" value="2015">
                                            </div>
                                        </td>
                                        <td>700</td>
                                        <td>Scholar</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section">
                <div class="page-heading">
                    <h3>Perbandingan Statistik Jumlah Sitasi Dosen Antar Fakultas</h3>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table tablex">
                                <thead>
                                    <tr>
                                        <th>Fakultas</th>
                                        <th>Tahun</th>
                                        <th>Jumlah Sitasi</th>
                                        <th>Sumber</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>FKIP</td>
                                        <td>
                                            2018
                                        </td>
                                        <td>751</td>
                                        <td>Scopus</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section">
                <div class="page-heading">
                    <h3>Histori Publikasi Dosen Fakultas ...</h3>
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
                                        <th>Sumber</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Totok</td>
                                        <td>PTIK</td>
                                        <td>Cara Mengawinkan Silang Sapi dengan Kambing</td>
                                        <td>
                                            2015
                                        </td>
                                        <td>Scopus</td>
                                    </tr>
                                    <tr>
                                        <td>Totok</td>
                                        <td>Pendidikan Agama</td>
                                        <td>Cara Mati Tanpa Dosa</td>
                                        <td>
                                            2018
                                        </td>
                                        <td>Scholar</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
