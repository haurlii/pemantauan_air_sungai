@extends('layout')

@section('title', 'Table - Iot Project')

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
                <h3>DataTable</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
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
                            <td>{{ $water->level }} Meters</td>
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
@endsection