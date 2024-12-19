@extends('layouts.sidebar')
@section('container')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <h3>List Fakultas</h3>
            <a href="{{ route('fakultas.create') }}" class="btn btn-success btn-md mb-1">Tambah Fakultas</a>
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
                                        <th>Kode</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($faculties as $fakultas)
                                        <tr>
                                            <td>{{ $fakultas->fakultas_name }}</td>
                                            <td>'N/A'</td>
                                            <td>{{ $fakultas->user->where('role', 'dosen')->count() }}</td>
                                            <td>'N/A'</td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <a href="{{ route('fakultas.edit', $fakultas->id) }}"
                                                        class="btn btn-primary btn-md mb-1">Edit</a>
                                                    <form action="{{ route('fakultas.destroy', $fakultas->id) }}"
                                                        method="POST" id="deleteForm">
                                                        @csrf
                                                        @method('DELETE')
                                                        <!-- Tombol Trigger Modal -->
                                                        <button type="submit" class="btn btn-danger btn-md"
                                                            data-bs-toggle="modal" data-bs-target="#confirmModal">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
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
        </div>
    </div>
@endsection

<!-- Modal Konfirmasi -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Penghapusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak bisa dibatalkan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-danger" form="deleteForm">Hapus</button>
            </div>
        </div>
    </div>
</div>

