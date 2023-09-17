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
                        <strong class="card-title">KWB (Kelompok Wirausaha Bersama)</strong>
                    </div>
                    <div class="card-body">

                        <button type="button" class="btn btn-info mb-1" data-toggle="modal" data-target="#scrollmodal"> Tambah +</button>
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
                                    <th>Nama KWB</th>
                                    <!-- <th>Kecamatan</th> -->
                                    <th>Kategori KWB</th>
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
                                        <br>
                                        <a class="btn btn-warning mb-1" data-toggle="modal" data-target="#scrollmodal3{{ $i->id }}" >Edit</a>

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
                                                <h5 class="modal-title" id="scrollmodalLabel">Detail Data KWB</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form action="" method="post" class="form-horizontal">
                                                <div class="modal-body">
                                                @csrf
                                                    <div class="row form-group">
                                                        <div class="col-6">
                                                            <p>Nama KWB</p>
                                                            <input  name="name" type="text" placeholder="" class="form-control" value="{{ $i->name }}" required disabled>
                                                        </div>
                                                        <div class="col-6">
                                                            <p>Nama Penanggung Jawab</p>
                                                            <input  name="name_leader" type="text" placeholder="Nama" class="form-control" value="{{ $i->name_leader }}" required disabled>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col-6">
                                                            <p>Kategori Usaha</p>
                                                            <input  name="category_id" type="text" placeholder="" class="form-control" value="{{ $i->category_name }}" required disabled>
                                                        </div>
                                                        <div class="col-6">
                                                            <p>Jumlah Anggota</p>
                                                            <input name="member" type="text" placeholder="" class="form-control" value="{{ $i->member }}" required disabled>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col-6">
                                                            <p>Kecamatan Lokasi KWB</p>
                                                            <input name="kecamatan" type="text" placeholder="" class="form-control" value="{{ $i->kecamatan }}" required disabled>
                                                        </div>
                                                        <div class="col-6">
                                                            <p>Kelurahan Lokasi KWB</p>
                                                            <input name="kelurahan" type="text" placeholder="" class="form-control" value="{{ $i->kelurahan }}" required disabled>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col-12">
                                                            <p>Alamat KWB</p>
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
                                                <h5 class="modal-title" id="scrollmodalLabel">Edit Data KWB</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form action="{{ route('edit-data-kwb') }}" method="post" class="form-horizontal">
                                                <div class="modal-body">
                                                @csrf
                                                    <input type="hidden" name="id" value="{{ $i->id }}">

                                                    <div class="row form-group">
                                                        <div class="col-6">
                                                            <p>Nama KWB</p>
                                                            <input  name="name" type="text" placeholder="Masukkan nama KWB" class="form-control" value="{{ $i->name }}" required >
                                                        </div>
                                                        <div class="col-6">
                                                            <p>Nama Penanggung Jawab</p>
                                                            <input  name="name_leader" type="text" placeholder="Masukkan nama penanggung jawab KWB" class="form-control" value="{{ $i->name_leader }}" required >
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col-6">
                                                            <p>Kategori Usaha</p>
                                                            <select name="category_id" type="text" class="form-control" required >
                                                                <option value="{{ $i->category_id }}" selected >{{ $i->category_name }}</option>
                                                                @foreach ($category_kwb as $i)
                                                                    @if ($i->id != 1)
                                                                        <option value="{{ $i->id }}">{{ $i->name }}</option>
                                                                    @endif
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
                                                    <p>Kecamatan Lokasi KWB</p>
                                                    <select name="kecamatan" class="form-control" id="kecamatanDropdownEdit" required>
                                                        <option value="{{ $i->kecamatan }}" >{{ $i->kecamatan }} Pilih Kecamatan</option>
                                                        @foreach ($dataKecamatan as $kecamatan => $kelurahan)
                                                            <option value="{{ $kecamatan }}" >
                                                                {{ $kecamatan }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <p>Kelurahan Lokasi KWB</p>
                                                    <select name="kelurahan" class="form-control" id="kelurahanDropdownEdit" required>
                                                        <option value="{{ $i->kelurahan }}" >{{ $i->kelurahan }} Pilih Kelurahan</option>
                                                        @if (isset($i->kecamatan))
                                                            @foreach ($dataKecamatan[$i->kecamatan] as $kel)
                                                                <option value="{{ $kel }}">
                                                                    {{ $kel }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-12">
                                                    <p>Alamat KWB</p>
                                                    <textarea name="address" type="text" placeholder="Masukkan alamat KWB" class="form-control" required>{{ $i->address }}</textarea>
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
                                <h5 class="modal-title" id="scrollmodalLabel">Tambah Data KWB</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form action="{{ route('add-data-kwb') }}" method="post" class="form-horizontal">
                                <div class="modal-body">
                                @csrf

                                    <div class="row form-group">
                                        <div class="col-6">
                                            <p>Nama KWB</p>
                                            <input  name="name" type="text" placeholder="Masukkan nama KWB" class="form-control" required>
                                        </div>
                                        <div class="col-6">
                                            <p>Nama Penanggung Jawab</p>
                                            <input  name="name_leader" type="text" placeholder="Masukkan nama penananggung jawab KWB" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-6">
                                            <p>Kategori Usaha</p>
                                            <select name="category_id" type="text" class="form-control" required>
                                                <option value="" disabled selected >Pilih kategori usaha</option>
                                                @foreach ($category_kwb as $i)
                                                    @if ($i->id != 1)
                                                        <option value="{{ $i->id }}">{{ $i->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                         </div>
                                        <div class="col-6">
                                            <p>Jumlah Anggota</p>
                                            <input name="member" type="number" placeholder="Masukkan jumlah anggota KWB" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-6">
                                            <p>Kecamatan Lokasi KWB</p>
                                            <select name="kecamatan" class="form-control" id="kecamatanDropdown" required>
                                                <option value="">Pilih Kecamatan</option>
                                                @foreach ($dataKecamatan as $kecamatan => $kelurahan)
                                                    <option value="{{ $kecamatan }}" {{ $i->kecamatan == $kecamatan ? 'selected' : '' }}>
                                                        {{ $kecamatan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <p>Kelurahan Lokasi KWB</p>
                                            <select name="kelurahan" class="form-control" id="kelurahanDropdown" required>
                                                <option value="">Pilih Kelurahan</option>
                                                @if (isset($i->kecamatan))
                                                    @foreach ($dataKecamatan[$i->kecamatan] as $kel)
                                                        <option value="{{ $kel }}" {{ $i->kelurahan == $kel ? 'selected' : '' }}>
                                                            {{ $kel }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>


                                    <div class="row form-group">
                                        <div class="col-12">
                                            <p>Alamat KWB</p>
                                            <textarea name="address" type="text" placeholder="Masukkan alamat KWB" class="form-control" required></textarea>
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


<script>
    // Get references to the kecamatan and kelurahan dropdowns
    var kecamatanDropdown = document.getElementById('kecamatanDropdown');
    var kelurahanDropdown = document.getElementById('kelurahanDropdown');

    // Data for kelurahan options based on kecamatan
    var kelurahanData = @json($dataKecamatan);

    // Function to update the kelurahan dropdown options
    function updateKelurahanDropdown(selectedKecamatan) {
        kelurahanDropdown.innerHTML = '<option value="">Pilih Kelurahan</option>';
        if (selectedKecamatan && kelurahanData[selectedKecamatan]) {
            kelurahanData[selectedKecamatan].forEach(function (kel) {
                var option = document.createElement('option');
                option.value = kel;
                option.text = kel;
                kelurahanDropdown.appendChild(option);
            });
        }
    }

    // Initialize the kelurahan dropdown based on the initially selected kecamatan
    updateKelurahanDropdown(kecamatanDropdown.value);

    // Add event listener to kecamatan dropdown to update kelurahan dropdown
    kecamatanDropdown.addEventListener('change', function () {
        updateKelurahanDropdown(this.value);
    });
</script>

<script>
    // Get references to the kecamatan and kelurahan dropdowns in the edit modal
    var kecamatanDropdownEdit = document.getElementById('kecamatanDropdownEdit');
    var kelurahanDropdownEdit = document.getElementById('kelurahanDropdownEdit');

    // Data for kelurahan options based on kecamatan
    var kelurahanData = @json($dataKecamatan);

    // Function to update the kelurahan dropdown options in the edit modal
    function updateKelurahanDropdownEdit(selectedKecamatan) {
        kelurahanDropdownEdit.innerHTML = '<option value="">Pilih Kelurahan</option>';
        if (selectedKecamatan && kelurahanData[selectedKecamatan]) {
            kelurahanData[selectedKecamatan].forEach(function (kel) {
                var option = document.createElement('option');
                option.value = kel;
                option.text = kel;
                kelurahanDropdownEdit.appendChild(option);
            });
        }
    }

    // Initialize the kelurahan dropdown in the edit modal based on the initially selected kecamatan
    updateKelurahanDropdownEdit(kecamatanDropdownEdit.value);

    // Add event listener to kecamatan dropdown in the edit modal to update kelurahan dropdown
    kecamatanDropdownEdit.addEventListener('change', function () {
        updateKelurahanDropdownEdit(this.value);
    });
</script>

@endsection


