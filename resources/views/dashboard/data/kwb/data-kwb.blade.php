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
                        <strong class="card-title">KWB</strong>
                    </div>
                    <div class="card-body">

                        <button type="button" class="btn btn-info mb-1" data-toggle="modal" data-target="#scrollmodal"> Tambah KWB +</button>
                        <br>

                        {{-- Message --}}
                        @if(session()->has('message-add-kwb'))
                            <br>
                            <div class="alert alert-success">
                                {{ session()->get('message-add-kwb') }}
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
                                    <th>Nama</th>
                                    <!-- <th>Kecamatan</th> -->
                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($kwb as $i)
                                <tr>
                                    <td style="display: none;"></th>
                                    <td>{{ $i->name }}</td>
                                    <!-- <td>{{ $i->kecamatan }}</td> -->
                                    <td>{{ $i->category_name }}</td>
                                    <td>

                                        <a class="btn btn-info mb-1" data-toggle="modal" data-target="#scrollmodal2{{ $i->id }}">Detail</a>
                                        <!-- <a class="btn btn-info mb-1" data-toggle="modal" data-target="#scrollmodal3{{ $i->id }}" >Edit</a> -->

                                        <form method="POST" action="{{ url('delete-data-kwb') }}">
                                        @csrf
                                            <input type="hidden" name="id" value="{{ $i->id }}" required>
                                            <button type="submit" class="btn btn-danger mb-1" data-toggle="#" data-target="#">Hapus</button>
                                        </form>

                                    </td>
                                </tr>

                                <!-- Detail -->
                                <div class="modal fade" id="scrollmodal2{{ $i->id }}" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="scrollmodalLabel">Scrolling Long Content Modal</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form action="" method="post" class="form-horizontal">
                                                <div class="modal-body">
                                                @csrf
                                                    <div class="row form-group">
                                                        <div class="col-6">
                                                            <p>Nama</p>
                                                            <input  name="name" type="text" placeholder="Nama" class="form-control" value="{{ $i->name}}" required disabled>
                                                        </div>
                                                        <div class="col-6">
                                                            <p>Nama Penanggung Jawab</p>
                                                            <input  name="name_leader" type="text" placeholder="Nama" class="form-control" value="{{ $i->name_leader }}" required disabled>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col-6">
                                                            <p>Kategori</p>
                                                            <select name="category_id" type="text" class="form-control" required disabled>
                                                                <option value="{{ $i->category_id }}" disabled selected >{{ $i->category_name }}</option>

                                                            </select>
                                                        </div>
                                                        <div class="col-6">
                                                            <p>Jumlah Anggota</p>
                                                            <input name="member" type="text" placeholder="Anggota" class="form-control" value="{{ $i->member }}" required disabled>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col-6">
                                                            <p>Kecamatan dan Kelurahan</p>
                                                            <input name="kecamatan" type="text" placeholder="Kecamatan" class="form-control" value="{{ $i->kecamatan }}" required disabled>
                                                            <input name="kelurahan" type="text" placeholder="Kelurahan" class="form-control" value="{{ $i->kelurahan }}" required disabled>
                                     
                                                            <!-- <select name="kecamatan" type="text" class="form-control"  required disabled>
                                                                <option value="{{ $i->kecamatan }}" disabled selected >{{ $i->kecamatan }}</option>

                                                            </select>
                                                            <select name="kelurahan" type="text" class="form-control"  required disabled>
                                                                 <option value="{{ $i->kelurahan }}" disabled selected >{{ $i->kelurahan }}</option>

                                                            </select> -->
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col-6">
                                                            <p>Alamat</p>
                                                            <textarea name="address" type="text" placeholder="Alamat" class="form-control"  required disabled>{{ $i->address }} </textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" data-dismiss="modal">Ok</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                                <!-- Edit -->
                                <div class="modal fade" id="scrollmodal3{{ $i->id }}" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="scrollmodalLabel">Scrolling Long Content Modal</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form action="{{ route('edit-data-kwb') }}" method="post" class="form-horizontal">
                                                <div class="modal-body">
                                                @csrf
                                                <input  name="id" type="text" placeholder="Nama" class="form-control" value="{{ $i->id }}" required disabled hidden>

                                                    <div class="row form-group">
                                                        <div class="col-6">
                                                            <p>Nama</p>
                                                            <input  name="name" type="text" placeholder="Nama" class="form-control" value="{{ $i->name }}" required >
                                                        </div>
                                                        <div class="col-6">
                                                            <p>Nama Penanggung Jawab</p>
                                                            <input  name="name_leader" type="text" placeholder="Nama" class="form-control" value="{{ $i->name_leader }}" required >
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col-6">
                                                            <p>Kategori</p>
                                                            <select name="category_id" type="text" class="form-control" required >
                                                                <option value="{{ $i->category_id }}"  selected >{{ $i->category_name }}</option>
                                                                @foreach ($category_kwb as $i)
                                                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-6">
                                                    <p>Jumlah Anggota</p>
                                                    <input name="member" type="text" placeholder="Anggota" class="form-control" value="{{ $i->member }}" required>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col-6">
                                                    <p>Kecamatan dan Kelurahan</p>
                                                    <input name="kecamatan" type="text" placeholder="Kecamatan" class="form-control" value="{{ $i->kecamatan }}" required>
                                                    <input name="kelurahan" type="text" placeholder="Kelurahan" class="form-control" value="{{ $i->kelurahan }}" required>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col-6">
                                                    <p>Alamat</p>
                                                    <textarea name="address" type="text" placeholder="Alamat" class="form-control" required>{{ $i->address }}</textarea>
                                                </div>
                                            </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary" >Edit</button>
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


                <div class="modal fade" id="scrollmodal" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="scrollmodalLabel">Scrolling Long Content Modal</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form action="{{ route('add-data-kwb') }}" method="post" class="form-horizontal">
                                <div class="modal-body">
                                @csrf

                                    <div class="row form-group">
                                        <div class="col-6">
                                            <p>Nama</p>
                                            <input  name="name" type="text" placeholder="Nama" class="form-control" required>
                                        </div>
                                        <div class="col-6">
                                            <p>Nama Penanggung Jawab</p>
                                            <input  name="name_leader" type="text" placeholder="Nama" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-6">
                                            <p>Kategori</p>
                                            <select name="category_id" type="text" class="form-control" required>
                                                <option value="" disabled selected >Kategori</option>
                                                @foreach ($category_kwb as $i)
                                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                                                @endforeach
                                            </select>
                                         </div>
                                        <div class="col-6">
                                            <p>Jumlah Anggota</p>
                                            <input name="member" type="number" placeholder="Anggota" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-6">
                                            <p>Kecamatan dan Kelurahan</p>
                                            <input name="kecamatan" type="text" placeholder="Kecamatan" class="form-control" required>
                                            <input name="kelurahan" type="text" placeholder="Kelurahan" class="form-control" required>
                                            <!-- <select name="kecamatan" type="text" class="form-control" required>
                                                <option value="" disabled selected >Kecamatan</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                            <select name="kelurahan" type="text" class="form-control" required>
                                                <option value="" disabled selected >Kelurahan</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select> -->
                                          </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-6">
                                            <p>Alamat</p>
                                            <textarea name="address" type="text" placeholder="Alamat" class="form-control" required></textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div><!-- .animated -->
</div><!-- .content -->

@endsection
