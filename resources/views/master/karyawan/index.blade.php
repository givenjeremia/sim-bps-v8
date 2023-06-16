@extends('layouts.adminlte')
<!-- plugin css -->
@section('plugin_css')
<link rel="stylesheet" href="{{asset('dropify/dist/css/dropify.min.css')}}">
@endsection
<!-- css -->
@section('add_css')
/* Mark input boxes that gets an error on validation: */
input.invalid {
background-color: #ffdddd;
}
@endsection
<!-- content -->
@section('content')
<!-- modal Add -->
<div class="modal fade" id="modalAdd" role="dialog" aria-labelledby="favoritesModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 17px;">
            <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;">
                <h4 style="color:white;">Tambah Data Karyawan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="regForm" action="{{ route('karyawan.store') }}" aria-label="{{ __('Register') }}">
                    <!-- @csrf -->
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">{{ __('NIK') }}</label>

                        <div class="col-md-6">
                            <input id="nik" type="text" class="form-control" name="nik" value="{{ old('nik') }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">{{ __('Alamat') }}</label>

                        <div class="col-md-6">
                            <textarea id="alamat" type="text" class="form-control" name="alamat" value="{{ old('alamat') }}" required autofocus rows="5"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">{{ __('No. Telp') }}</label>

                        <div class="col-md-6">
                            <input type="number" maxlength="12" placeholder="No. Telp (ex: 082231656xxx)" id="telp" class="form-control" name="telp" value="{{ old('telp') }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">{{ __('Tanggal Lahir') }}</label>

                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="text" class="form-control datepicker" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required autofocus>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">{{ __('Tanggal Gabung') }}</label>

                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="text" class="form-control datepicker" id="tanggal_gabung" name="tanggal_gabung" value="{{ old('tanggal_gabung') }}" required autofocus>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="username" class="col-md-4 col-form-label">{{ __('Username') }}</label>

                        <div class="col-md-6">
                            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" oninput="this.className = 'form-control'" required>
                            <span id="error-password" style="color: red;"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" oninput="this.className = 'form-control'" required>
                            <span id="error-confirm-password" style="color: red;"></span>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                            <button type="submit" class="btn btn-primary" onclick="checkValidate()">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- tutup modal Add-->

<!-- modal Edit -->
<div class="modal fade" id="modalEdit" role="dialog" aria-labelledby="favoritesModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 17px;">
            <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;">
                <h4 style="color:white;">Edit Data Karyawan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <FORM method="post" id="editForm">
                  @method('put')
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">NIK:</label>
                        <input type="number" class="form-control col-md-6" id="txtNikEdit" name="txtNikEdit" placeholder="NIK" required>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Nama Karyawan:</label>
                        <input type="text" class="form-control col-md-6" id="txtNamaKaryawanEdit" name="txtNamaKaryawanEdit" placeholder="Nama Karyawan" required>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Alamat:</label>
                        <textarea class="form-control col-md-6" id="txtAlamatEdit" name="txtAlamatEdit" placeholder="Alamat" required rows="5"></textarea>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">No. Telp:</label>
                        <input type="number" maxlength="12" class="form-control col-md-6" id="txtPhoneNumberEdit" name="txtPhoneNumberEdit" placeholder="No. Telp (ex: 082231656xxx)" required>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Username:</label>
                        <input type="text" class="form-control col-md-6" id="txtUsernameEdit" name="txtUsernameEdit" placeholder="Username" required>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Password:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="txtPasswordEdit" name="txtPasswordEdit" placeholder="Password" oninput="this.className = 'form-control'" required>
                            <span id="error-password-edit" style="color: red;"></span>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
          <label class="col-md-4 col-form-label text-md-right">Confirm Password:</label>
          <div class="col-md-6">
            <input type="text" class="form-control" id="txtConfirmPassEdit" name="txtConfirmPassEdit" placeholder="Confirm Password" oninput="this.className = 'form-control'" required>
            <span id="error-confirm-password-edit" style="color: red;"></span>            
          </div>
        </div>  -->
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Tanggal Lahir:</label>

                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="text" class="form-control datepicker" id="txtBirthDateEdit" name="txtBirthDateEdit">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Tanggal Bergabung:</label>

                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="text" class="form-control datepicker" id="txtJoinDateEdit" name="txtJoinDateEdit">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                        <input type="hidden" name="txtID" id="txtID">
                        <button class="btn btn-danger">Simpan</button>
                    </div>
                </FORM>
            </div>
        </div>
    </div>
</div>
<!-- tutup modal Edit -->

<!-- modal Delete -->
<div class="modal fade" id="modalHapus" role="dialog" aria-labelledby="favoritesModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 17px;">
            <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;">
                <h4 style="color:white;">Hapus Data Karyawan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <FORM method="post" id='FormDeleteSingle'>
                    @method('delete')

                    <div class="form-group">
                        Apakah anda yakin ingin menghapus data karyawan bernama <b><span id="nametext"></span></b> ?
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                        <input type="hidden" name="txtIDDelete" id="txtIDDelete">
                        <input type="hidden" name="jenis_delete" value="single">
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">Tutup</button>
                        <button class="btn btn-danger">Hapus</button>
                    </div>
                </FORM>
            </div>
        </div>
    </div>
</div>
<!-- tutup modal Delete -->

<!-- modal Delete All-->
<div class="modal fade" id="modalHapusSemua" role="dialog" aria-labelledby="favoritesModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 17px;">
            <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;">
                <h4 style="color:white;">Hapus Data Karyawan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <FORM method="post" id='FormDeleteAll'>
                    @method('delete')
                    <div class="form-group">
                        <span id="textdel"></span>
                    </div>
                    <div class="form-group" id="field_input">
                        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                        <input type="hidden" name="jenis_delete" value="all">
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">Tutup</button>
                        <button class="btn btn-danger" id="btnConfirmHapus">Hapus</button>
                    </div>
                </FORM>
            </div>
        </div>
    </div>
</div>
<!-- tutup modal Delete All-->

<!-- modal detail -->
<div class="modal fade" id="modalDetail" role="dialog" aria-labelledby="favoritesModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 17px;">
            <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;">
                <h4 style="color:white;">Detail Data Karyawan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="form-group row">
                        <label class="control-label col-sm-4" for="nama">NIK</label>
                        <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                            : &nbsp <span id="lblNik"> </span>
                        </label>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-4" for="nama">Nama</label>
                        <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                            : &nbsp <span id="lblNama"> </span>
                        </label>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-4" for="nama">Username</label>
                        <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                            : &nbsp <span id="lblUsername"> </span>
                        </label>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-4" for="nama" id="textPass">Password</label>
                        <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                            : &nbsp <span id="lblPassword"> </span>
                        </label>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-4" for="nama">Alamat</label>
                        <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                            : &nbsp <span id="lblAlamat"> </span>
                        </label>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-4" for="nama">No. Telp</label>
                        <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                            : &nbsp <span id="lblPhone"> </span>
                        </label>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-4" for="nama">Tanggal Lahir</label>
                        <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                            : &nbsp <span id="lblTglLahir"> </span>
                        </label>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-4" for="nama">Tanggal Bergabung</label>
                        <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                            : &nbsp <span id="lblTglGabung"> </span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                    <button class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- tutup modal detail-->

<!-- modal Import-->
<div class="modal fade" id="modalImport" role="dialog" aria-labelledby="favoritesModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 17px;">
            <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;">
                <h4 style="color:white;">Import Data Karyawan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <FORM method="post" action="<?php echo URL::to('/karyawanImport')?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" id="input-file-now" name="input-file-now" class="dropify" data-show-remove="true" data-allowed-file-extensions="xlsx" data-height="300" />
                    </div>
                    <div class="form-group" id="field_input">
                        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">Tutup</button>
                        <button class="btn btn-danger" id="btnImport">Import</button>
                    </div>
                    <div class="form-group">
                        Gunakan file dengan format .xlsx. Download template <a href="<?php echo URL::to('/karyawanExport')?>">disini</a>
                    </div>
                </FORM>
            </div>
        </div>
    </div>
</div>
<!-- tutup modal Import-->

<br>
<div class="container-fluid">

    <!-- NOTIFIKASI -->
    @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fa fa-check"></i> Alert!</h5>
        {{ session('message') }}
    </div>
    @endif

    @if (session()->has('danger_message'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fa fa-close"></i> Alert!</h5>
        {{ session('danger_message') }}
    </div>
    @endif
    <!-- END NOTIFIKASI -->

    <div class="row mb-2">
        <div class="col-sm-6">
            <h3>Master Karyawan</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Master Karyawan</li>
            </ol>
        </div>
    </div>
    {{-- Route::resource('/jenis-layanan', JenisLayananController::class); --}}

    <?php if(true){ ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-1 col-4" title="Tambah">
                            <button type="button" class="btn btn-block btn-primary btn-sm" id="btnAdd" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus-circle nav-icon"></i> Tambah</button>
                        </div>
                        <div class="col-lg-1 col-4" title="Hapus">
                            <button type="button" class="btn btn-block btn-danger btn-sm" data-toggle="modal" data-target="#modalHapusSemua" onclick="opendeleteallmodal();"><i class="fa fa-times-circle nav-icon"></i> Hapus</button>
                        </div>
                        <!-- <div class="col-lg-2 col-4" title="Hapus">
                  <button type="button" class="btn btn-block btn-info btn-sm" data-toggle="modal" 
                  data-target="#modalImport"><i class="fa fa-upload nav-icon"></i> Import Excel</button>
                </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                            <?php if(true){ ?>
                                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="text-align: center;">
                                                #
                                            </th>
                                            <?php } ?>
                                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="text-align: center;">
                                                No
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%; text-align: center;">
                                                NIK
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 20%; text-align: center;">
                                                Nama Karyawan
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 30%; text-align: center;">
                                                Alamat
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%; text-align: center;">
                                                No . Telp
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 25%; text-align: center;">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($karyawan as $key => $value)
                                        <tr>
                                            {{-- Auth::user()->username == "super_admin" --}}
                                            <?php if(true){ ?>
                                            <td>
                                                <label>
                                                    <input type="checkbox" class="flat-red" id="checkbox<?php echo $key ?>" name="chkDel[]" value="<?php echo $value['id']; ?>">
                                                </label>
                                            </td>
                                            <?php } ?>
                                            <td style="text-align: center;">{{($key+1)}}</td>
                                            <td>{{$value['nik']}}</td>
                                            <td>{{$value['name']}}</td>
                                            <td>{{$value['alamat']}}</td>
                                            <td>{{$value['telp']}}</td>
                                            <td>
                                                <div class="form-group">
                                                    <div>
                                                        <button data-toggle="modal" data-target="#modalDetail" id="detail{{$key}}" onclick="opendetailmodal({{ $value['id'] }})" class="btn btn-info" data-toggle="tooltips" title="Edit" style="width:40px;">
                                                            <i class="fa fa-info"></i>
                                                        </button>
                                                        {{-- Auth::user()->username == "super_admin" --}}
                                                        <?php if(true){ ?>
                                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalEdit" title="Edit" id="<?php echo 'edit'.$key; ?>" onclick="openeditmodal({{ $value['id'] }});"><i class="fa fa-edit"></i></button>
                                                        <button class="btn btn-danger" data-toggle="modal" data-target="#modalHapus" title="Hapus" onclick="opendeletemodal(<?php echo "'".$value["id"]."'" ?>,<?php echo "'".$value["name"]."'" ?>)"><i class="fa fa-times"></i></button>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- plugin js -->
@section('plugin_js')

@endsection

<!-- add js -->
@section('add_js')
<script>
    $(document).ready(function() {
        $('div.alert').delay(3000).slideUp(300);
    });
    // FOR FORM ADD
    $(document).on('submit', '#regForm', function(event) {
        event.preventDefault();

        var password = document.getElementById("password").value;
        var confirm_password = document.getElementById("password-confirm").value;

        var arrPass = password.split("");
        var arrConfirmPass = confirm_password.split("");

        if (arrPass.length < 6) {
            // error di password dan confirm password
            document.getElementById("password").className += " invalid";
            document.getElementById("password-confirm").className += " invalid";
            document.getElementById("error-password").innerHTML = "Password harus mengandung minimal 6 karakter!";
        } else {
            if (password != confirm_password) {
                // error confirm password
                document.getElementById("password-confirm").className += " invalid";
                document.getElementById("error-password").innerHTML = "";
                document.getElementById("error-confirm-password").innerHTML = "Confirm password tidak sama dengan password!";
            } else {
                document.getElementById("error-confirm-password").innerHTML = "";
                document.getElementById("regForm").submit();
            }
        }
    });

    // FOR FORM EDIT
    $(document).on('submit', '#editForm', function(event) {
        event.preventDefault();

        var password = document.getElementById("txtPasswordEdit").value;
        // var confirm_password = document.getElementById("txtConfirmPassEdit").value;

        var arrPass = password.split("");
        // var arrConfirmPass = confirm_password.split("");

        if (arrPass.length < 6) {
            // error di password dan confirm password
            document.getElementById("txtPasswordEdit").className += " invalid";
            // document.getElementById("txtConfirmPassEdit").className += " invalid";
            document.getElementById("error-password-edit").innerHTML = "Password harus mengandung minimal 6 karakter!";
        } else {
            document.getElementById("editForm").submit();
            // if(password != confirm_password){
            //   // error confirm password
            //   document.getElementById("txtConfirmPassEdit").className += " invalid";
            //   document.getElementById("error-password-edit").innerHTML = "";
            //   document.getElementById("error-confirm-password-edit").innerHTML = "Confirm password tidak sama dengan password!";
            // }
            // else{
            //   document.getElementById("error-confirm-password-edit").innerHTML = "";
            //   document.getElementById("editForm").submit();
            // }
        }
    });
    // FOR DELETE CHECKED
    $('input').on('ifChecked', function(event) {
        // CREATE HIDDEN ELEMENT FOR SAVE ID'S CHOOSE
        var input = document.createElement("input");
        input.setAttribute('type', 'hidden');
        input.setAttribute('id', 'del' + $(this).val());
        input.setAttribute('name', 'txtDeleteAll[]');
        input.setAttribute('value', $(this).val());

        var parent = document.getElementById("field_input");
        parent.appendChild(input);
    });

    $('input').on('ifUnchecked', function(event) {
        var parent = document.getElementById("field_input");
        var element = document.getElementById('del' + $(this).val());
        parent.removeChild(element);
    });
    // ============ DELETE CHECKED END
    var btnAdd = document.getElementById('btnAdd');
    btnAdd.onclick = function() {
        modalAdd.style.display = "block";
    }

    function openeditmodal(id) {
      let action = "{{ route('karyawan.update', ':id') }}".replace(':id', id)
      $('#editForm').attr('action', action);
        var url = "{{ route('karyawan.edit', ':id') }}".replace(':id', id);
        $.ajax({
            type: "GET"
            , url: url
            , data: {
                karyawan_id: id
            }
            , success: function(data) {
                var resp = $.parseJSON(data);
                document.getElementById('txtNikEdit').value = resp.nik;
                document.getElementById('txtNamaKaryawanEdit').value = resp.name;
                document.getElementById('txtUsernameEdit').value = resp.username;
                document.getElementById('txtPasswordEdit').value = resp.password_plain;
                document.getElementById('txtAlamatEdit').value = resp.alamat;
                document.getElementById('txtPhoneNumberEdit').value = resp.telp;
                document.getElementById('txtBirthDateEdit').value = resp.tanggal_lahir;
                document.getElementById('txtJoinDateEdit').value = resp.tanggal_gabung;
                document.getElementById('txtID').value = id;
            }
        });
    }

    function opendeletemodal(id, nama) {
      let action = "{{ route('karyawan.destroy', ':id') }}".replace(':id', id)
      $('#FormDeleteSingle').attr('action', action);
        document.getElementById('nametext').innerHTML = nama;
        document.getElementById('txtIDDelete').value = id;
    }

    function opendeleteallmodal() {
      let action = "{{ route('karyawan.destroy', ':id') }}".replace(':id', 1)
      $('#FormDeleteAll').attr('action', action);
        $ischecked = false;
        for (var i = 0; i < document.getElementsByName('chkDel[]').length; i++) {
            if (document.getElementById('checkbox' + i).checked) {
                $ischecked = true;
            }
        }

        if ($ischecked) {
            document.getElementById("textdel").innerHTML = "Apakah anda yakin ingin menghapus data karyawan yang telah dipilih?";
            document.getElementById("btnConfirmHapus").style.visibility = "visible";
        } else {
            document.getElementById("textdel").innerHTML = "Tidak ada data karyawan yang dipilih";
            document.getElementById("btnConfirmHapus").style.visibility = "hidden";
        }
    }

    function opendetailmodal(id) {
        var url =  "{{ route('karyawan.show',':id') }}".replace(':id', id)
        $.ajax({
            type: "GET"
            , url: url
            , data: {
                karyawan_id: id
            }
            , success: function(data) {
                var resp = $.parseJSON(data);
                document.getElementById('lblNik').innerHTML = resp.nik;
                document.getElementById('lblNama').innerHTML = resp.name;
                document.getElementById('lblUsername').innerHTML = resp.username;

                // if(admin_active == 'super_admin'){
                //   document.getElementById('lblPassword').style.display = "inline-block";
                //   document.getElementById('textPass').style.display = "inline-block";

                //   document.getElementById('lblPassword').innerHTML = resp.password_plain;
                // }

                document.getElementById('lblAlamat').innerHTML = resp.alamat;
                document.getElementById('lblPhone').innerHTML = resp.telp;
                document.getElementById('lblTglLahir').innerHTML = resp.tanggal_lahir;
                document.getElementById('lblTglGabung').innerHTML = resp.tanggal_gabung;
            }
        });
    }

</script>


<script src="{{asset('dropify/dist/js/dropify.min.js')}}"></script>
<script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez'
                , replace: 'Glissez-déposez un fichier ou cliquez pour remplacer'
                , remove: 'Supprimer'
                , error: 'Désolé, le fichier trop volumineux'
            }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });

</script>
@endsection
