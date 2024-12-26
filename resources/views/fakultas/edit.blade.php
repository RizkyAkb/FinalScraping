@extends('layouts.sidebar')
@section('container')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <h3>Update Data Fakultas</h3>
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

                                    <form class="form" action="{{ route('fakultas.update', $fakultas->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="name">Nama Fakultas</label>
                                                    <input type="text" id="fakultas_name" class="form-control"
                                                        placeholder="Nama Fakultas" name="fakultas_name"
                                                        value="{{ old('fakultas_name', $fakultas->fakultas_name) }}">
                                                </div>
                                            </div>    
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="year_founded">Tahun Berdiri</label>
                                                    <input type="number" id="year_founded" class="form-control"
                                                        placeholder="Nama Fakultas" name="year_founded"
                                                        value="{{ old('year_founded', $fakultas->year_founded) }}">
                                                </div>
                                            </div>                                        
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
