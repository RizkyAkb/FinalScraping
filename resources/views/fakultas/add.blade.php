@extends('layouts.sidebar')
@section('container')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <h3>Tambah Fakultas</h3>
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

                                    <form id="dosenForm" method="POST" enctype="multipart/form-data"
                                        action="{{ route('fakultas.store') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="name">Nama Fakultas</label>
                                                    <input type="text" id="fakultas_name" name="fakultas_name"
                                                        class="form-control" placeholder="Nama Fakultas">
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" name="user"
                                                    class="btn btn-primary me-1 mb-1">Submit</button>
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
        const fakultasSelect = document.getElementById("fakultas");
        const prodiSelect = document.getElementById("prodi");

        fakultasSelect.addEventListener("change", function() {
            const selectedFakultas = this.value;

            // Loop melalui semua opsi di prodi
            Array.from(prodiSelect.options).forEach(option => {
                if (selectedFakultas === "" || option.dataset.fakultas === selectedFakultas) {
                    option.style.display = ""; // Tampilkan opsi
                } else {
                    option.style.display = "none"; // Sembunyikan opsi
                }
            });

            // Reset nilai prodi ke default
            prodiSelect.value = "";
        });
    });
</script>
