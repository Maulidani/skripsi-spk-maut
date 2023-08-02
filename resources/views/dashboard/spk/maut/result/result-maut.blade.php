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
                        <strong class="card-title">Hasil</strong>
                    </div>
                    <div class="card-body">

                        <br><br>

                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="display: none;"></th>
                                    <th>Nama Bantuan</th>
                                    <th>Pembuatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($result as $i)
                                <tr>
                                    <td style="display: none;"></th>
                                    <td>{{ $i->name_bantuan }}</td>
                                    <td>{{ $i->created_at }}</td>
                                    <td>
                                        <form method="POST" action="{{ url('print-maut-result') }}">
                                        @csrf
                                            <input type="hidden" name="version_id" value="{{ $i->version }}" required>
                                            <button type="submit" class="btn btn-info mb-1">Cetak</button>
                                        </form>
                                    </td>
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
