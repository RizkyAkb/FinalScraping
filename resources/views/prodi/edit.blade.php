@extends('layouts.sidebar')
@section('container')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <h3>Update Data Program Studi</h3>
        </div>

        <div class="page-content">
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif

                                    <form class="form" action="{{ route('prodi.update', $prodi->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="name">Nama Program Studi</label>
                                                    <input type="text" id="prodi_name" class="form-control"
                                                        placeholder="Nama Program Studi" name="prodi_name"
                                                        value="{{ old('prodi_name', $prodi->prodi_name) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="year_founded">Tahun Berdiri</label>
                                                    <input type="number" id="year_founded" class="form-control"
                                                        placeholder="Nama Program Studi" name="year_founded"
                                                        value="{{ old('year_founded', $prodi->year_founded) }}">
                                                </div>
                                            </div>
                                            @auth
                                                @if (Auth::user()->role === 'admin')
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="fakultas_id">Fakultas</label>
                                                            <select class="form-select" id="fakultas_id" name="fakultas_id">
                                                                <option value="">Pilih Fakultas</option>
                                                                @foreach ($fakultas as $fakultasItem)
                                                                    <option value="{{ $fakultasItem->id }}"
                                                                        {{ $fakultasItem->id == $prodi->fakultas_id ? 'selected' : '' }}>
                                                                        {{ $fakultasItem->fakultas_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (Auth::user()->role === 'fakultas')
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="fakultas_id">Fakultas</label>
                                                            <fieldset class="form-group">
                                                                <select class="form-select" id="fakultas_id" name="fakultas_id"
                                                                    disabled>
                                                                    <option value="{{ Auth::user()->fakultas_id }}">
                                                                        {{ Auth::user()->fakultas->fakultas_name }}</option>
                                                                </select>
                                                                <input type="hidden" name="fakultas_id"
                                                                    value="{{ Auth::user()->fakultas_id }}">
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endauth
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const fakultasSelect = document.getElementById("fakultas_id");
        const prodiSelect = document.getElementById("prodi_id");

        // Fungsi untuk memfilter opsi pada dropdown prodi
        function filterProdi() {
            const selectedFakultasId = fakultasSelect.value;

            // Loop melalui semua opsi pada dropdown prodi
            Array.from(prodiSelect.options).forEach(option => {
                // Ambil atribut data-fakultas dari opsi
                const fakultasId = option.getAttribute("data-fakultas");

                // Tampilkan atau sembunyikan opsi berdasarkan fakultas yang dipilih
                if (!selectedFakultasId || fakultasId === selectedFakultasId) {
                    option.style.display = ""; // Tampilkan
                } else {
                    option.style.display = "none"; // Sembunyikan
                }
            });

            // Reset nilai dropdown prodi jika opsi yang sebelumnya dipilih disembunyikan
            if (!Array.from(prodiSelect.options).some(option => option.value === prodiSelect.value && option
                    .style.display === "")) {
                prodiSelect.value = "";
            }
        }

        // Jalankan filterProdi setiap kali fakultas berubah
        fakultasSelect.addEventListener("change", filterProdi);

        // Panggil filterProdi saat halaman pertama kali dimuat
        filterProdi();
    });
</script>
