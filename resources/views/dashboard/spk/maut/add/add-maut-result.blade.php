@extends('layout')

@section('content')
<!-- Content -->
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>SPK - MAUT</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Hasil SPK MAUT</strong>
                    </div>
                    <div class="card-body">

                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="display: none;"></th>
                                    <th>KWB</th>
                                    <th>Skor</th>
                                    <th>Rank</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($ranking as $rank => $kwb_id)
                                <tr>
                                    <!-- <td>{{ $kwb_id['shopId']}}</td> -->
                                    <th style="display: none;">{{ $rank }}</th>
                                    <td>{{ $kwb_id['shopName'] }}</td>
                                    <td>{{ $kwb_id['score']}}</td>
                                    <td>{{ $rank }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>


            </div>

        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection

<script>

</script>
