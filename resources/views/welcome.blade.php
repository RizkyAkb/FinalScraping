<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Manajemen Sitasi</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

    <!-- Font Awesome icons -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i"
        rel="stylesheet">

    <!-- Core theme CSS -->
    <link href="assets/css/styles.css" rel="stylesheet">

    <!-- Vite Integration -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        /* Adding animations */
        .masthead-heading {
            animation: fadeInDown 1.5s;
        }

        .masthead-subheading {
            animation: fadeInUp 1.5s;
        }

        @keyframes fadeInDown {
            0% {
                opacity: 0;
                transform: translateY(-50px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(50px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .bg-circle {
            animation: rotate 10s infinite linear;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* Color theme */
        :root {
            --primary-color: #0C3B83;
            --secondary-color: #8BC34A;
        }

        body {
            background-color: var(--primary-color);
            color: #fff;
        }

        .btn-primary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-primary:hover {
            background-color: #659c2b;
            border-color: #659c2b;
        }
    </style>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container px-2">
            <img src="/assets/img/uns.png" alt="Logo" style="height: 40px; margin-right: 10px;">
            <a class="navbar-brand d-none d-lg-block" href="#page-top">UNIVERSITAS SEBELAS MARET</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                @if (Route::has('login'))
                    <ul class="navbar-nav ms-auto">
                        @auth
                            <li class="nav-item">
                                <a href="{{ route(Auth::user()->role === 'admin' ? 'admin.dashboard' : (Auth::user()->role === 'fakultas' ? 'fakultas.dashboard' : (Auth::user()->role === 'prodi' ? 'prodi.dashboard' : 'dosen.dashboard'))) }}"
                                    class="nav-link">
                                    Dashboard
                                </a>
                            </li>
                        @else
                            <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Log in</a></li>
                            @if (Route::has('register'))
                                <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                            @endif
                        @endauth
                    </ul>
                @endif
            </div>
        </div>
    </nav>
    
    <!-- Header Section -->
    <header class="masthead text-center text-white">
        <div class="masthead-content">
            <div class="container px-5">
                <h1 class="masthead-heading mb-0">Sistem Manajemen Sitasi</h1>
                <h2 class="masthead-subheading mb-0">Universitas Sebelas Maret</h2>
                <a class="btn btn-primary btn-xl rounded-pill mt-5" href="{{ route('/') }}">Get Started</a>
            </div>
        </div>
        <div class="bg-circle-1 bg-circle"></div>
        <div class="bg-circle-2 bg-circle"></div>
        <div class="bg-circle-3 bg-circle"></div>
        <div class="bg-circle-4 bg-circle"></div>
    </header>

    <!-- Content Section 1 -->
    <section id="scroll" class="pt-5 pb-3">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="p-3">
                        <img class="img-fluid rounded-circle" src="assets/img/01.jpg" alt="Person" style="width: 300px; height: 300px;">
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="p-3">
                        <h2 class="display-4">Rizky Akbar</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam
                            sit iste esse assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione
                            voluptatum molestiae adipisci, beatae obcaecati.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>    

    <!-- Content Section 2 -->
    <section class="py-3">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6">
                    <div class="p-3">
                        <img class="img-fluid rounded-circle" src="assets/img/02.jpg" alt="Person" style="width: 300px; height: 300px;">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-3">
                        <h2 class="display-4">Riyan Bagas</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam
                            sit iste esse assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione
                            voluptatum molestiae adipisci, beatae obcaecati.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section 3 -->
    <section class="py-3">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="p-3">
                        <img class="img-fluid rounded-circle" src="assets/img/03.jpg" alt="Person" style="width: 300px; height: 300px;">
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="p-3">
                        <h2 class="display-4">Reza Thalib</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam
                            sit iste esse assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione
                            voluptatum molestiae adipisci, beatae obcaecati.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4 text-center text-sm text-black bg-white">
        <div class="container">
            Copyright &copy; Sistem Manajemen Sitasi UNS 2024
        </div>
    </footer>


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/scripts.js"></script>
</body>

</html>
