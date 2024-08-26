@extends('layout')

@section('title', 'Form - Iot Project')

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
                    <h3>Form</h3>
                    <p class="text-subtitle text-muted">Multiple form layout you can use</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Vertical form layout section start -->
        <section id="basic-vertical-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form</h4>
                            @if ($errors->any())
                                {{-- <div class="alert alert-danger"><i class="bi bi-file-excel"></i> This is danger
                                    alert.
                                </div> --}}
                                <div class="alert alert-light-danger color-danger">
                                    <h5 class="alert-heading"><i class="bi bi-exclamation-circle"></i> Danger</h5>
                                    <p></p>
                                    @foreach ($errors->all() as $error)
                                        <p><i class="bi bi-exclamation-circle"></i> {{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-vertical" method="POST" action="{{ route('water.store') }}">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="date-vertical">Date</label>
                                                    <input type="date" id="date-vertical"
                                                        class="form-control" name="date">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="select-vertical">Days</label>
                                                    <input type="text" id="days-vertical"
                                                        class="form-control" name="days" readonly placeholder="Days...">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="time-vertical">Time</label>
                                                    <input type="time" id="time-vertical"
                                                        class="form-control" name="time" readonly placeholder="Time">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="water-level-vertical">Water Level</label>
                                                    <input type="number" id="water-level-vertical"
                                                        class="form-control" name="level"
                                                        placeholder="Water Level">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="action-vertical">Action</label>
                                                    <input type="text" id="action-vertical"
                                                        class="form-control" name="action" readonly placeholder="Action...">
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit"
                                                    class="btn btn-primary me-1 mb-1" type="submit">Submit</button>
                                                <button type="reset"
                                                    class="btn btn-light-secondary me-1 mb-1" type="reset">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- // Basic Vertical form layout section end -->
        
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