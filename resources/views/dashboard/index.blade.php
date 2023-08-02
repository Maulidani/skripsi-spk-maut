@extends('layout')

@section('content')
<!-- Content -->
<div class="content" style=" height: 100vh;">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!-- Widgets  -->
        <div class="row">

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-4">
                                <i class="fa fa-bar-chart-o"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text">Total KWB</div>
                                    <div class="stat-heading">{{ $count }}</div>
                                    <br>
                                    <!-- <form method="POST" action="#">
                                    @csrf
                                        <input type="hidden" class="form-control" name="id" value="" required >
                                        <button type="submit" class="btn btn-info">Export</button>
                                    </form> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- .animated -->
</div>
<!-- /.content -->
@endsection
