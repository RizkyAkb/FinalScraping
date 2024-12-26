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
                    <a href="{{ route('dosen.scrape', ['id' => Auth::user()->id]) }}" class="btn btn-primary btn-lg" id="scrapeButton">Scraping Data</a>

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
                                            <td>{{ $artikel->title }}</td>
                                            <td>{{ $artikel->publication_date }}</td>
                                            <td>{{ $artikel->citations }}</td>
                                            <td>{{ $artikel->source }}</td>                                            
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

<!-- Modal -->
<div class="modal fade" id="loadingModal" tabindex="-1" aria-labelledby="loadingModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="spinner-border text-primary mb-3" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p>Proses scraping sedang berlangsung, harap menunggu...</p>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('scrapeButton').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default link behavior

        // Show the loading modal
        const loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'));
        loadingModal.show();

        // Send the AJAX request
        fetch(this.href, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                // Hide the loading modal
                loadingModal.hide();

                // Display success message
                alert(data.message);
            })
            .catch(error => {
                // Hide the loading modal if there's an error
                loadingModal.hide();

                // Display error message
                alert('Terjadi kesalahan: ' + error.message);
            });
    });
</script>
