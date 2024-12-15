@extends('layouts.sidebar')
@section('container')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <h3>Tambah Dosen</h3>
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
                                        action="{{ route('user.store') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="name">Nama Dosen</label>
                                                    <input type="text" id="name" name="name" class="form-control"
                                                        placeholder="Nama Dosen">
                                                </div>
                                            </div>

                                            @auth
                                                @if (Auth::user()->role === 'admin')
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="fakultas">Fakultas</label>
                                                            <fieldset class="form-group">
                                                                <select class="form-select" id="fakultas" name="fakultas">
                                                                    @foreach ($fakultas as $fakultasItem)
                                                                        <option value="{{ $fakultasItem->id }}">
                                                                            {{ $fakultasItem->fakultas_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="prodi">Program Studi</label>
                                                            <fieldset class="form-group">
                                                                <select class="form-select" id="prodi" name="prodi">
                                                                    @foreach ($prodis as $prodiItem)
                                                                        <option value="{{ $prodiItem->id }}">
                                                                            {{ $prodiItem->prodi_name }}</option>
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
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="prodi">Program Studi</label>
                                                            <fieldset class="form-group">
                                                                <select class="form-select" id="prodi" name="prodi">
                                                                    @foreach ($prodis as $prodiItem)
                                                                        @if ($prodiItem->fakultas_id == Auth::user()->fakultas_id)
                                                                            <option value="{{ $prodiItem->id }}">
                                                                                {{ $prodiItem->prodi_name }}
                                                                            </option>
                                                                        @endif
                                                                    @endforeach

                                                                </select>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (Auth::user()->role === 'prodi')
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
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="prodi">Program Studi</label>
                                                            <fieldset class="form-group">
                                                                <select class="form-select" id="prodi" name="prodi"
                                                                    disabled>
                                                                    @foreach ($prodis as $prodiItem)
                                                                        <option value="{{ $prodiItem->id }}">
                                                                            {{ $prodiItem->prodi_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <!-- Hidden input to submit the value -->
                                                                <input type="hidden" name="prodi"
                                                                    value="{{ $selectedProdiId }}">
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endauth
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" id="email" class="form-control"
                                                        placeholder="Email" name="email">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" id="password" class="form-control"
                                                        placeholder="Password" name="password">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="role">Status</label>
                                                    <input type="text" id="role" name="role"
                                                        class="form-control" placeholder="Dosen" value="dosen" readonly>                                                        
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="scholar_id">ID Scholar</label>
                                                    <input type="text" id="scholar_id" class="form-control"
                                                        name="scholar_id" placeholder="ID Scholar">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="scopus_id">ID Scopus</label>
                                                    <input type="text" id="scopus_id" class="form-control"
                                                        name="scopus_id" placeholder="ID Scopus">
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
