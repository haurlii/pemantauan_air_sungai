<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '')</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">

    {{-- Table css --}}
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
    {{-- End Table css --}}

    {{-- Diagram css --}}
    <link rel="stylesheet" href="{{ asset('assets/vendors/apexcharts/apexcharts.css') }}">
    {{-- End Diagram css --}}

    <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="/">IoT Project</a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        {{-- Dashboard --}}
                            <li class="sidebar-item {{ request()->is('/') ? 'active' : '' }}" id="dashboardActive">
                                <a href="/" class='sidebar-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                        {{-- End Dasboard --}}

                        {{-- Table and Diagram --}}
                            <li class="sidebar-item {{ request()->is('water') ? 'active' : '' }}" id="tableActive">
                                <a href="{{ route('water.index') }}" class='sidebar-link'>
                                    <i class="bi bi-table"></i>
                                    <span>Table</span>
                                </a>
                            </li>
                            
                            <li class="sidebar-item {{ request()->is('diagram') ? 'active' : '' }}" id="diagramActive">
                                <a href="/diagram" class='sidebar-link'>
                                    <i class="bi bi-bar-chart-fill"></i>
                                    <span>Diagram</span>
                                </a>
                            </li>
                        {{-- End Table and Diagram --}}

                        <li class="sidebar-title">Raise Support</li>
                        
                        <li class="sidebar-item  ">
                            <a href="/" class='sidebar-link'>
                                <i class="bi bi-box-arrow-left"></i>
                                <span>Log out</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>

        {{-- Main Page --}}
        <div id="main">
            @yield('content')
        </div>
        {{-- End Main Page --}}

    </div>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/vendors/dayjs/dayjs.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/pages/ui-apexchart.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

    

    {{-- MQTT --}}
        <script src="{{ asset('assets/js/mqtt/mqtt.min.js') }}"></script>
        <script>
        // An mqtt variable will be initialized globally
        console.log(mqtt)
        </script>
        <script src="{{ asset('assets/js/mqtt/mqtt_function.js') }}"></script>
    {{-- MQTT --}}
    
    {{-- Table js --}}
        <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
        <script>
            // Simple Datatable
            let table1 = document.querySelector('#table1');
            let dataTable = new simpleDatatables.DataTable(table1);
        </script>
    {{-- End Table js --}}

    {{-- Hari, Tanggal, Jam --}}
        <script>
            document.getElementById('date-vertical').addEventListener('change', function() {
            // Mendapatkan tanggal yang dipilih oleh pengguna
            const selectedDate = new Date(this.value);
            const today = new Date();

            // Mendapatkan nama hari berdasarkan tanggal yang dipilih
            const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            const dayName = daysOfWeek[today.getDay()];

            // Mengisi input 'dayName' dengan nama hari
            document.getElementById('days-vertical').value = dayName;

            // Mendapatkan waktu saat ini dalam format HH:MM
            const currentHours = today.getHours().toString().padStart(2, '0');
            const currentMinutes = today.getMinutes().toString().padStart(2, '0');
            const currentTime = `${currentHours}:${currentMinutes}`;

            // Mengisi input 'time' dengan waktu saat ini jika belum ada nilai yang diisi
            if (!document.getElementById('time-vertical').value) {
                document.getElementById('time-vertical').value = currentTime;
            }
            });
        </script>
    {{-- End Hari, Tanggal, Jam --}}

    {{-- Water Level --}}
        <script>
            document.getElementById('water-level-vertical').addEventListener('input', function() {
            const waterLevel = parseFloat(this.value);
            const actionInput = document.getElementById('action-vertical');
            
            if (waterLevel > 3) {
                actionInput.value = "Danger";
            } else if (waterLevel <= 3 && waterLevel >= 1) {
                actionInput.value = "Warning";
            } else if (waterLevel < 1 && waterLevel >= 0) {
                actionInput.value = "Safe";
            } else {
                actionInput.value = "";
            }
            });
        </script>
    {{-- End Water Level --}}

    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>