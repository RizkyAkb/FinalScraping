@extends('layouts.sidebar')
@section('container')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <h3>Tambah Prodi</h3>
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
                                        action="{{ route('prodi.store') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="name">Nama Program Studi</label>
                                                    <input type="text" id="prodi_name" name="prodi_name"
                                                        class="form-control" placeholder="Nama Prodi">
                                                </div>
                                            </div>
                                            @auth
                                                @if (Auth::user()->role === 'admin')
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="fakultas">Fakultas</label>
                                                            <fieldset class="form-group">
                                                                <select class="form-select" id="fakultas_id" name="fakultas_id">
                                                                    <option value="">Pilih Fakultas</option>
                                                                    @foreach ($fakultas as $fakultasItem)
                                                                        <option value="{{ $fakultasItem->id }}">
                                                                            {{ $fakultasItem->fakultas_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (Auth::user()->role === 'fakultas')
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="fakultas">Fakultas</label>
                                                            <fieldset class="form-group">
                                                                <select class="form-select" id="fakultas" name="fakultas"
                                                                    disabled>
                                                                    <option value="{{ Auth::user()->fakultas_id }}">
                                                                        {{ Auth::user()->fakultas->fakultas_name }}</option>
                                                                </select>
                                                                <input type="hidden" name="fakultas"
                                                                    value="{{ Auth::user()->fakultas_id }}">
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                @endif

                                            @endauth
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
