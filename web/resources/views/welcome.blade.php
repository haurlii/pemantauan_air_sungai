@extends('layout')

@section('title', 'Dashboard - Iot Project')

@section('content')
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h3>Dashboard</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">

            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> ESP32 </h4>
                    </div>
                    <div class="card-body">
                        <p><span id="ketinggian">?</span> cm</p>
                        <p id="action">?</p>
                        <button class="btn btn-danger" id="redButton">Merah</button>
                        <button class="btn btn-success" id="greenButton">Hijau</button>
                        <button class="btn btn-primary" id="blueButton">Biru</button>
                        <button class="btn btn-dark" id="offdButton">Hitam / Off</button>
                    </div>

                    <form class="form form-vertical" id="waterLevelForm" method="POST" action="{{ route('water.store') }}" style="display: none">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="hidden" id="date-vertical"
                                            class="form-control" name="date">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="hidden" id="days-vertical"
                                            class="form-control" name="days" readonly placeholder="Days...">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="hidden" id="time-vertical"
                                            class="form-control" name="time" readonly placeholder="Time">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="hidden" id="water-level-vertical"
                                            class="form-control" name="level"
                                            placeholder="Water Level">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="hidden" id="action-vertical"
                                            class="form-control" name="action" readonly placeholder="Action...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

            {{-- Diagram --}}
                <section class="section">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Ketinggian Air</h4>
                                </div>
                                <div class="card-body">
                                    <div id="area"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            {{-- End Diagram --}}

            <!-- Table -->
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            Simple Datatable
                        </div>

                        <div class="card-body">
                            <a href="{{ route('water.create') }}" class="btn btn-primary"> <i class="bi bi-plus"></i> Primary</a>
                        </div>
        
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Days</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Water Level</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($waters as $water)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $water->days }}</td>
                                        <td>{{ $water->date }}</td>
                                        <td>{{ $water->time }}</td>
                                        <td>{{ $water->level }} cm</td>
                                        <td>
                                            @if ($water->action == "Danger")
                                                <span class="badge bg-danger">{{ $water->action }}</span>
                                            @elseif ($water->action == "Warning")
                                                <span class="badge bg-warning">{{ $water->action }}</span>
                                            @else 
                                                <span class="badge bg-success">{{ $water->action }}</span>
                                            @endif
                                        </td>
        
                                    </tr>
                                    
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            <!-- End Table -->
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
    <script id="chartData" type="hidden/json">
        @json($chartData)
    </script>
{{-- End Diagram js --}}

@endsection