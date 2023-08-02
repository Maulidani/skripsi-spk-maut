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
                        <strong class="card-title">Tambah</strong>
                    </div>
                    <div class="card-body">

                        <form action="#" method="post" class="form-horizontal">
                        @csrf

                            <div class="row form-group">
                                <!-- <div class="col-6"> -->
                                    <!-- <p>Pilih KWB</p> -->
                                    <!-- <p>Bla bla bla</p> -->
                                    <!-- <input type="text" placeholder="Pilih KWB" class="form-control"> -->
                                    <!-- <button type="submit" class="btn btn-info mb-1" data-toggle="modal" data-target="#scrollmodal" form="category_selected"> Pilih KWB </button> -->
                                <!-- </div> -->
                                <div class="col-6">
                                    <!-- <p>Details</p> -->
                                    {{-- Message --}}
                                    @if(session()->has('message-add-checked'))

                                        <p> Total KWB Dipilih : {{ session()->get('message-add-checked') }} </p>

                                    @endif

                                    @if(session()->has('message-error-checked'))

                                    <div class="alert alert-danger">
                                       <p>{{ session()->get('message-error-checked') }}</p>
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
                                </div>
                            </div>

                            <br><br>
                            <button type="button" class="btn btn-primary btn-lg btn-block"  data-toggle="modal" data-target="#scrollmodal">Pilih KWB</button>

                        </form>

                        {{-- Message --}}
                        @if(session()->has('message-add-spk-maut'))
                            <br>
                            <div class="alert alert-success">
                                {{ session()->get('message-add-spk-maut') }}
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

                    </div>
                </div>

                <form id="checked_form" action="{{ route('spk-maut-checked-kwb') }}" method="post" class="form-horizontal">
                @csrf

                <div class="modal fade" id="scrollmodal" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="scrollmodalLabel">Scrolling Long Content Modal</h5>
                                <p>{{ $kwb[0]->category_name }}</p>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="display: none;"></th>
                                            <th>Nama</th>
                                            <th>Bantuan</th>
                                            <th>Sekret</th>
                                            <th>Struktural</th>
                                            <th>Skill</th>
                                            <th>Pilih</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($kwb as $i)
                                            <tr>
                                                <td style="display: none;"></th>
                                                <td>{{$i->name}}</td>
                                                <td>
                                                <select name="bantuan[]" type="text" class="form-control" >
                                                    <option value="0" disabled selected >Pilih</option>
                                                    <option value="1, {{ $i->id }}">Sudah Punya</option>
                                                    <option value="2, {{ $i->id }}">Pernah Punya</option>
                                                    <option value="3, {{ $i->id }}">Belum Punya</option>
                                                </select>
                                                </td>
                                                <td>
                                                <select name="secretariat[]" type="text" class="form-control">
                                                    <option value="0" disabled selected >Pilih</option>
                                                    <option value="1, {{ $i->id }}">Tidak punya</option>
                                                    <option value="2, {{ $i->id }}">Punya dan tidak layak</option>
                                                    <option value="3, {{ $i->id }}">Punya dan layak</option>
                                                </select>
                                                </td>
                                                <td>
                                                <!-- <input  name="" type="text" placeholder="Nama" class="form-control" value="{{ $i->name_leader }}" required > -->
                                                <select name="structural[]" tyPilihpe="text" class="form-control">
                                                    <option value="0" disabled selected >Pilih</option>
                                                    <option value="1, {{ $i->id }}">Tidak punya</option>
                                                    <option value="2, {{ $i->id }}">Punya dan tidak lengkap</option>
                                                    <option value="3, {{ $i->id }}">Punya dan lengkap</option>
                                                </select>
                                                </td>
                                                <td>
                                                <select name="skill[]" type="text" class="form-control">
                                                    <option value="0" disabled selected >Pilih</option>
                                                    <option value="1, {{ $i->id }}">Tidak ahli</option>
                                                    <option value="2, {{ $i->id }}">Cukup ahli</option>
                                                    <option value="3, {{ $i->id }}">Ahli</option>
                                                </select>
                                                </td>
                                                <td>
                                                    <input id="kwb_id_{{ $loop->iteration }}" value="{{ $i->id }}" name="kwb_id[]" type="checkbox" {{ $i->checked == 1 ? 'checked' : '' }} />
                                                </td>
                                            </tr>
                                        @endforeach

                                        <input name="bantuan_id" type="text" placeholder="" class="form-control" value="{{$bantuan}}" required hidden>

                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary" form="checked_form" id="kwb_checked" >Proses Maut</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>

            </div>

        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection

<script>

</script>
