@extends('layout')

@section('title', 'Diagram - Iot Project')

@section('content')
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Diagram Ketinggian Air</h3>
                <p class="text-subtitle text-muted">A chart for user </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Diagram</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Line Area Chart</h4>
                    </div>
                    <div class="card-body">
                        <div id="area"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- Footer --}}
    <footer>
        <div class="footer clearfix mb-0 text-muted">
            <div class="float-start">
                <p>2024 &copy; Kelompok Normal</p>
            </div>
            <div class="float-end">
                <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> 
                    by <a href="http://ahmadsaugi.com">Kelompok Normal</a>
                </p>
            </div>
        </div>
    </footer>
{{-- End Footer --}}

{{-- Diagram js --}}
        {{-- Data JSON disembunyikan dalam elemen script dengan ID --}}
        <script id="chartData" type="application/json">
            @json($chartData)
        </script>
    {{-- End Diagram js --}}

@endsection