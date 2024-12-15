@extends('layouts.sidebar')
@section('container')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <h3>List Prodi</h3>
            <a href="./tambahDosenFakultas.html" class="btn btn-success btn-md mb-1">Tambah Prodi</a>
        </div>
        <div class="page-content">
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Tahun Berdiri</th>
                                        <th>Jumlah Dosen</th>
                                        <th>Fakultas</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($prodis as $prodi)
                                        <tr>
                                            <td>{{ $prodi->prodi_name }}</td>
                                            <td>'N/A'</td>
                                            <td>{{ $prodi->user->where('role', 'dosen')->count() }}</td>
                                            <td>{{ $prodi->fakultas->fakultas_name ?? 'N/A' }}</td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <a href="./editDosenFakultas.html"
                                                        class="btn btn-primary btn-md mb-1">Edit</a>
                                                    <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center text-mute" colspan="4">Data Prodi Tidak Ditemukan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </div>
@endsection
