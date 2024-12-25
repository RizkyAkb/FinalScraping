@auth
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dosen - Admin</title>

        <link rel="shortcut icon"
            href="data:image/svg+xml,%3csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2033%2034'%20fill-rule='evenodd'%20stroke-linejoin='round'%20stroke-miterlimit='2'%20xmlns:v='https://vecta.io/nano'%3e%3cpath%20d='M3%2027.472c0%204.409%206.18%205.552%2013.5%205.552%207.281%200%2013.5-1.103%2013.5-5.513s-6.179-5.552-13.5-5.552c-7.281%200-13.5%201.103-13.5%205.513z'%20fill='%23435ebe'%20fill-rule='nonzero'/%3e%3ccircle%20cx='16.5'%20cy='8.8'%20r='8.8'%20fill='%2341bbdd'/%3e%3c/svg%3e"
            type="image/x-icon">
        <link rel="shortcut icon"
            href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
            type="image/png">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" href="../assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">

        <link rel="stylesheet" href="../assets/compiled/css/table-datatable-jquery.css">
        <link rel="stylesheet" href="../assets/compiled/css/app.css">
        <link rel="stylesheet" href="../assets/compiled/css/app-dark.css">

        <link href="{{ asset('assets/compiled/css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/compiled/css/app-dark.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/compiled/css/iconly.css') }}" rel="stylesheet">
    </head>

    <body onload=getDataUniversitas()>
        <script src="assets/static/js/initTheme.js"></script>
        <div id="app">
            <div id="sidebar">
                <div class="sidebar-wrapper active">
                    <div class="sidebar-header position-relative">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20"
                                    height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                    <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                            opacity=".3"></path>
                                        <g transform="translate(-210 -1)">
                                            <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                            <circle cx="220.5" cy="11.5" r="4"></circle>
                                            <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                                <div class="form-check form-switch fs-6">
                                    <input class="form-check-input  me-0" type="checkbox" id="toggle-dark"
                                        style="cursor: pointer">
                                    <label class="form-check-label"></label>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    aria-hidden="true" role="img" class="iconify iconify--mdi" width="20"
                                    height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                                    </path>
                                </svg>
                            </div>
                            <div class="sidebar-toggler  x">
                                <a href="#" class="sidebar-hide d-xl-none d-block"><i
                                        class="bi bi-x bi-middle"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-menu">
                        <ul class="menu">
                            @if (Auth::user()->role === 'admin')
                                <li class="sidebar-title">Menu</li>

                                <li class="sidebar-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Dashboard</span>
                                    </a>
                                </li>

                                <li class="sidebar-title">Pages</li>

                                <li class="sidebar-item {{ Route::is('admin.statistik') ? 'active' : '' }}">
                                    <a href="{{ route('admin.statistik') }}" class="sidebar-link">
                                        <i class="bi bi-envelope-fill"></i>
                                        <span>Statistik</span>
                                    </a>
                                </li>

                                <li class="sidebar-item {{ Route::is('admin.listFakultas') ? 'active' : '' }}">
                                    <a href="{{ route('admin.listFakultas') }}" class="sidebar-link">
                                        <i class="bi bi-chat-dots-fill"></i>
                                        <span>Fakultas</span>
                                    </a>

                                </li>
                                <li class="sidebar-item {{ Route::is('admin.listProdi') ? 'active' : '' }}">
                                    <a href="{{ route('admin.listProdi') }}" class="sidebar-link">
                                        <i class="bi bi-image-fill"></i>
                                        <span>Program Studi</span>
                                    </a>
                                </li>

                                <li class="sidebar-item {{ Route::is('admin.listDosen') ? 'active' : '' }}">
                                    <a href="{{ route('admin.listDosen') }}" class="sidebar-link">
                                        <i class="bi bi-basket-fill"></i>
                                        <span>Dosen</span>
                                    </a>
                                </li>


                                <li
                                    class="sidebar-item has-sub {{ Route::is('admin.listAdminFakultas', 'admin.listAdminProdi') ? 'active' : '' }}">
                                    <a href="#" class="sidebar-link">
                                        <i class="bi bi-person-circle"></i>
                                        <span>Admin</span>
                                    </a>
                                    <ul class="submenu">
                                        <li
                                            class="submenu-item {{ Route::is('admin.listAdminFakultas') ? 'active' : '' }}">
                                            <a href="{{ route('admin.listAdminFakultas') }}" class="submenu-link">Admin
                                                Fakultas</a>
                                        </li>
                                        <li class="submenu-item {{ Route::is('admin.listAdminProdi') ? 'active' : '' }}">
                                            <a href="{{ route('admin.listAdminProdi') }}" class="submenu-link">Admin
                                                Prodi</a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- Continue similarly for other menu items -->
                            @endif
                            @if (Auth::user()->role === 'fakultas')
                                <li class="sidebar-title">Menu</li>

                                <li class="sidebar-item {{ Route::is('fakultas.dashboard') ? 'active' : '' }}">
                                    <a href="{{ route('fakultas.dashboard') }}" class="sidebar-link">
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Dashboard</span>
                                    </a>
                                </li>

                                <li class="sidebar-title">Pages</li>

                                <li class="sidebar-item {{ Route::is('fakultas.statistik') ? 'active' : '' }}">
                                    <a href="{{ route('fakultas.statistik') }}" class="sidebar-link">
                                        <i class="bi bi-envelope-fill"></i>
                                        <span>Statistik</span>
                                    </a>
                                </li>
                                <li class="sidebar-item {{ Route::is('fakultas.listProdi') ? 'active' : '' }}">
                                    <a href="{{ route('fakultas.listProdi') }}" class="sidebar-link">
                                        <i class="bi bi-image-fill"></i>
                                        <span>Program Studi</span>
                                    </a>
                                </li>

                                <li class="sidebar-item {{ Route::is('fakultas.listDosen') ? 'active' : '' }}">
                                    <a href="{{ route('fakultas.listDosen') }}" class="sidebar-link">
                                        <i class="bi bi-basket-fill"></i>
                                        <span>Dosen</span>
                                    </a>
                                </li>

                                <li
                                    class="sidebar-item has-sub {{ Route::is('dosenAdminFakultas', 'fakultas.listAdminProdi') ? 'active' : '' }}">
                                    <a href="#" class="sidebar-link">
                                        <i class="bi bi-person-circle"></i>
                                        <span>Admin</span>
                                    </a>
                                    <ul class="submenu">
                                        <li class="submenu-item {{ Route::is('fakultas.listDosen') ? 'active' : '' }}">
                                            <a href="{{ route('fakultas.listDosen') }}" class="submenu-link">Dosen</a>
                                        </li>
                                        <li
                                            class="submenu-item {{ Route::is('fakultas.listAdminProdi') ? 'active' : '' }}">
                                            <a href="{{ route('fakultas.listAdminProdi') }}" class="submenu-link">Admin
                                                Prodi</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if (Auth::user()->role === 'prodi')
                                <li class="sidebar-title">Menu</li>

                                <li class="sidebar-item {{ Route::is('fakultas.dashboard') ? 'active' : '' }}">
                                    <a href="{{ route('prodi.dashboard') }}" class="sidebar-link">
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Dashboard</span>
                                    </a>
                                </li>

                                <li class="sidebar-title">Pages</li>

                                <li class="sidebar-item {{ Route::is('statistikAdminFakultas') ? 'active' : '' }}">
                                    <a href="{{ route('prodi.dashboard') }}" class="sidebar-link">
                                        <i class="bi bi-envelope-fill"></i>
                                        <span>Statistik</span>
                                    </a>
                                </li>

                                <li class="sidebar-item {{ Route::is('prodi.listDosen') ? 'active' : '' }}">
                                    <a href="{{ route('prodi.listDosen') }}" class="sidebar-link">
                                        <i class="bi bi-basket-fill"></i>
                                        <span>Dosen</span>
                                    </a>
                                </li>

                                <li
                                    class="sidebar-item has-sub {{ Route::is('dosenAdminFakultas', 'adminProdiFakultas') ? 'active' : '' }}">
                                    <a href="#" class="sidebar-link">
                                        <i class="bi bi-person-circle"></i>
                                        <span>Admin</span>
                                    </a>
                                    <ul class="submenu">
                                        <li class="submenu-item {{ Route::is('dosenAdminFakultas') ? 'active' : '' }}">
                                            <a href="{{ route('prodi.dashboard') }}" class="submenu-link">Dosen</a>
                                        </li>
                                        <li class="submenu-item {{ Route::is('adminProdiFakultas') ? 'active' : '' }}">
                                            <a href="{{ route('prodi.dashboard') }}" class="submenu-link">Admin Prodi</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if (Auth::user()->role === 'dosen')
                                <li class="sidebar-title">Menu</li>

                                <li class="sidebar-item {{ Route::is('dosen.dashboard') ? 'active' : '' }}">
                                    <a href="{{ route('dosen.dashboard') }}" class="sidebar-link">
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Dashboard</span>
                                    </a>
                                </li>

                                <li class="sidebar-title">Pages</li>

                                <li class="sidebar-item {{ Route::is('statistikAdminFakultas') ? 'active' : '' }}">
                                    <a href="{{ route('dosen.dashboard') }}" class="sidebar-link">
                                        <i class="bi bi-envelope-fill"></i>
                                        <span>Statistik</span>
                                    </a>
                                </li>

                                <li class="sidebar-item {{ Route::is('dosen.listDosen') ? 'active' : '' }}">
                                    <a href="{{ route('dosen.listDosen') }}" class="sidebar-link">
                                        <i class="bi bi-basket-fill"></i>
                                        <span>Dosen</span>
                                    </a>
                                </li>

                                <li
                                    class="sidebar-item has-sub {{ Route::is('dosenAdminFakultas', 'adminProdiFakultas') ? 'active' : '' }}">
                                    <a href="#" class="sidebar-link">
                                        <i class="bi bi-person-circle"></i>
                                        <span>Admin</span>
                                    </a>
                                    <ul class="submenu">
                                        <li class="submenu-item {{ Route::is('dosenAdminFakultas') ? 'active' : '' }}">
                                            <a href="{{ route('dosen.dashboard') }}" class="submenu-link">Dosen</a>
                                        </li>
                                        <li class="submenu-item {{ Route::is('adminProdiFakultas') ? 'active' : '' }}">
                                            <a href="{{ route('dosen.dashboard') }}" class="submenu-link">Admin Prodi</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="bi bi-person-circle"></i>
                                    <span>Account</span>
                                </a>

                                <ul class="submenu ">

                                    <li class="submenu-item  ">
                                        <a href="{{ route('profile.edit') }}" class="submenu-link">Profile</a>

                                    </li>

                                    <li class="submenu-item">
                                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                            @csrf
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); this.closest('form').submit();"
                                                class="submenu-link">Logout</a>
                                        </form>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                @yield('container')

            </div>
            <script src="../assets/static/js/components/dark.js"></script>
            <script src="../assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
            <script src="../assets/compiled/js/app.js"></script>
            <!-- Need: Apexcharts -->

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/collect.js/4.36.1/collect.min.js" integrity="sha512-aub0tRfsNTyfYpvUs0e9G/QRsIDgKmm4x59WRkHeWUc3CXbdiMwiMQ5tTSElshZu2LCq8piM/cbIsNwuuIR4gA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script>
                window.onload = function () {
                    // Render chart with initial data
                    const initialData = JSON.parse(document.getElementById('initial-data').textContent);
                    renderChart(initialData);
                };

                function renderChart(data) {
                    const ctx = document.getElementById('universitas').getContext('2d');
                    if (window.myChart) {
                        window.myChart.destroy();
                    }
                    window.myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.map(item => item.year),
                            datasets: [{
                                label: 'Jumlah Artikel',
                                data: data.map(item => item.total),
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }

                function filterChart() {
                    const dosenId = document.getElementById('filter-dosen').value;

                    // Kirim permintaan AJAX
                    fetch(`/prodi/dashboard?dosen_id=${dosenId}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Data yang diterima:', data); // Tambahkan log untuk memastikan data diterima
                        renderChart(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }

            </script>


    </body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    </html>
@endauth