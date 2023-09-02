@extends('layout')

@section('content')
<!-- Content -->
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>DATA</h1>
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
                        <strong class="card-title">Kriteria</strong>
                    </div>
                    <div class="card-body">

                        <button type="button" class="btn btn-info mb-1" data-toggle="modal" data-target="#scrollmodal"> Tambah +</button>
                        <br>

                        {{-- Message --}}
                        @if(session()->has('message-add-bantuan'))
                            <br>
                            <div class="alert alert-success">
                                {{ session()->get('message-add-bantuan') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <br>
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                       <br>
                       <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="display: none;"></th>
                                    <th>kriteria</th>
                                    <th>Bobot</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($result as $i)
                                <tr>
                                    <td style="display: none;"></th>
                                    <td>{{ $i->name }}</td>
                                    <td>{{ $i->bobot }}</td>
                                    <td>
                                        <a class="btn btn-warning mb-1" data-toggle="modal" data-target="#scrollmodal3{{ $i->id }}" >Edit</a>
                                    </td>                             
                                    </tr>

                                <!-- Edit -->
                                <div class="modal fade" id="scrollmodal3{{ $i->id }}" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="scrollmodalLabel">Edit Nilai Bobot</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form action="{{ route('data-kriteria-edit') }}" method="post" class="form-horizontal">
                                            <div class="modal-body">
                                            @csrf
                                                <input type="hidden" name="id" value="{{ $i->id }}">

                                                <div class="row form-group">
                                                    <div class="col-12">
                                                        <p>Kriteria</p>
                                                        <input name="" type="text" placeholder="" class="form-control" value="{{ $i->name }}" required disabled>
                                                      
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col-12">
                                                        <p>Deskripsi Kriteria</p>
                                                        <textarea name="" type="text" placeholder="" class="form-control" required disabled>{{ $i->detail }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col-12">
                                                        <p>Nilai Bobot</p>
                                                        <select name="bobot" type="text" class="form-control" required>
                                                            <option value="{{ $i->bobot }}" selected >{{ $i->bobot }}</option>
                                                            <option value="1">1 adalah</option>
                                                            <option value="2">2 adalah</option>
                                                        </select>                         
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Edit</button>
                                            </div>

                                        </form>

                                        </div>
                                    </div>
                                </div>

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
