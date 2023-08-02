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

                        <form action="{{ route('spk-maut-add') }}" method="get" class="form-horizontal">
                        @csrf

                            <div class="row form-group">
                                <div class="col-6">
                                    <p>Bantuan</p>
                                    <select name="bantuan_id" type="text" class="form-control" required>
                                        <option value="" disabled selected >Bantuan</option>

                                        @foreach ($bantuan as $i)
                                        <option value="{{ $i->id }}">{{ $i->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- <div class="col-6">
                                    <p>Details</p>
                                    <p>Details</p>
                                </div> -->
                            </div>
                            <!-- <div class="row form-group">
                                <div class="col-6">
                                    <p>Kriteria</p>
                                    <select name="secretariat" type="text" class="form-control" required>
                                        <option value="" disabled selected >Mempunyai Sekretariat</option>
                                        <option value="1">Punya</option>
                                        <option value="0">Tidak pPunya</option>
                                    </select>
                                    <br>
                                    <select name="structural" type="text" class="form-control" required>
                                        <option value="" disabled selected >Mempunyai Struktural organisasi</option>
                                        <option value="1">Punya</option>
                                        <option value="0">Tidak pPunya</option>
                                    </select>
                                    <br>
                                    <select name="skill" type="text" class="form-control" required>
                                        <option value="" disabled selected >Keahlian menggunakan barang bantuan</option>
                                        <option value="1">Sangat kurang</option>
                                        <option value="2">Kurang</option>
                                        <option value="3">Sedang</option>
                                        <option value="4">Ahli</option>
                                        <option value="5">Sangat ahli</option>
                                    </select>
                                    <br>
                                </div>
                            </div> -->

                            <br><br>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Pilih KWB</button>

                        </form>

                        {{-- Message --}}
                        @if(session()->has('message-select-bantuan'))
                            <br>
                            <div class="alert alert-danger">
                                {{ session()->get('message-select-bantuan') }}
                            </div>
                        @endif


                    </div>
                </div>
            </div>

        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection

<script>

</script>
