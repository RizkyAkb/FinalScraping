@extends('layouts.sidebar')
@section('container')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <h3>Scrape berdasarkan Tahun</h3>
        </div>
        <div class="page-content">
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-4">

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
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form id="dosenForm" method="POST" enctype="multipart/form-data"
                            action="{{ route('scrape.publications') }}">
                            @csrf
                            <div class="card">
                                <h5 class="card-header">Masukkan Tahun</h5>
                                <div class="card-body">
                                    <div class="mb-3 row">
                                        <label for="startYear" class="col-md-4 col-form-label">From</label>
                                        <div class="col-md-8">
                                            <input class="form-control" type="number" name="startYear" id="startYear"
                                                placeholder="2018">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="endYear" class="col-md-4 col-form-label">To</label>
                                        <div class="col-md-8">
                                            <input class="form-control" type="number" name="endYear" id="endYear"
                                                placeholder="2023">
                                        </div>
                                    </div>
                                    {{-- hidden --}}
                                    <input type="text" name="dosen_id" id="dosen_id" value="">
                                    <input type="text" name="prodi_id" id="prodi_id" value="">
                                    <input type="text" name="fakultas_id" id="fakultas_id" value="">
                                    <div class="mb-3 row">
                                        <button type="submit" class="btn btn-primary">Generate
                                            Batch Report</button>
                                    </div>
                                </div>
                            </div>
                            @auth
                                @if (Auth::user()->role === 'admin')
                                @endif
                                @if (Auth::user()->role === 'fakultas')
                                @endif

                            @endauth
                    </div>
                    </form>
                </div>
        </div>
    </div>
@endsection
