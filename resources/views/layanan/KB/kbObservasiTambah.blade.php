@extends('layouts.adminlte')
<!-- plugin css -->
@section('plugin_css')
<link rel="stylesheet" href="{{asset('dropify/dist/css/dropify.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('clockpicker/dist/bootstrap-clockpicker.min.css')}}">
@endsection
<!-- css -->
@section('add_css')
.buttonChecked:hover {transform: translateY(3px); cursor: pointer;}

.buttonChecked:active {
transform: translateY(5px);
}

.buttonPlus:hover {transform: translateY(3px); cursor: pointer;}

.buttonPlus:active {
transform: translateY(5px);

}
@endsection
<!-- content -->
@section('content')

<!-- modal simpan -->
<div class="modal fade" id="modalSimpan" role="dialog" aria-labelledby="favoritesModalLabel"> 
  <div class="modal-dialog" role="document"> 
    <div class="modal-content" style="border-radius: 17px;"> 
      <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;"> 
        <h4 style="color:white;">Simpan Data History</h4> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
          <span aria-hidden="true">&times;</span>
        </button> 
      </div> 
      <div class="modal-body"> 
        <div class="form-group"> 
          <span id="pesan_error" style="display: none;"></span>
          <span id="pesan_konfirmasi" style="display: none;">Apakah anda yakin ingin menyimpan data history ?</span>
        </div> 
        <div class="form-group"> 
          <button class="btn btn-default" data-dismiss="modal" aria-label="Close">Tutup</button> 
          <button class="btn btn-primary" style="display: none;" id="btn_simpan_history" onclick="submitForm()">Simpan</button> 
        </div>
      </div> 
    </div> 
  </div> 
</div>
<!-- tutup modal simpan -->

<br>
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h3>Observasi Kala I</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/kb/1 ')}}">History Pelayanan KB</a></li>
        <li class="breadcrumb-item active">Kunjungan Ulang KB</li>
      </ol>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="col-md-12">
              <div class="row">
                  <div class="col-md-6"> 
                    <div class="form-group">
                      <label class="control-label col-sm-4" for="nama">Nomor Registrasi</label>
                      <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                        : &nbsp; <span> {{$layanankbArr[0]['no_registrasi']}}</span>
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-4" for="nama">Nama Pasien</label>
                      <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                        : &nbsp; <span> {{$layanankbArr[0]['nama']}}</span>
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-4" for="nama">Tanggal Lahir</label>
                      <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                        <div class="input-group">
                          : &nbsp; <span> {{date('d-m-Y', strtotime($layanankbArr[0]['tanggal_lahir']))}}</span>
                        </div> 
                      </label>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-sm-4" for="nama">Agama</label>
                      <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                        : &nbsp; <span> {{$layanankbArr[0]['agama']}}</span>
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-4" for="nama">Alamat</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span> {{$layanankbArr[0]['alamat']}}</span>
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-4" for="nama">No. Telp</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span> {{$layanankbArr[0]['telp']}}</span>
                      </label>
                    </div>                                                           
                  </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  
  <form class="form-horizontal" id="form_submit" method="POST" action="{{url('/observasiKala/storeObservasi')}}">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6"> 
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Tanggal</label>
                      <label class="control-label col-sm-6" for="nama">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                          </div>
                          <input type="text" class="form-control datepicker2" id="txtTanggal" name="txtTanggal" required>
                        </div>  
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Jam</label>
                      <label class="control-label col-sm-6" for="nama">
                        <div class="input-group clockpicker" data-placement="right" data-align="top" data-autoclose="true">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                          </div>
                          <input type="text" class="form-control" id="txtJam" name="txtJam">
                        </div>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Djj</label>
                      <label class="control-label col-sm-6" for="nama">
                        <input type="text" class="form-control" id="txtDjj" name="txtDjj" placeholder="..." required>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Jumlah His 10"</label>
                      <label class="control-label col-sm-6" for="nama">
                        <input type="number" class="form-control" id="txtHis10" name="txtHis10" placeholder="..." style="text-align: right;" required>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Lama</label>
                      <label class="control-label col-sm-6" for="nama">
                        <input type="number" class="form-control" id="txtLama" name="txtLama" placeholder="... (Dalam Detik)" style="text-align: right;" required>
                      </label>
                    </div>
                    <label class="control-label col-sm-4" for="nama">Tensi :</label>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama" style="font-weight: normal;">- Sistole</label>
                      <label class="control-label col-sm-6" for="nama">
                        <input type="number" class="form-control" id="txtTensiAtas" name="txtTensiAtas" placeholder="..." style="text-align: right;" required>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama" style="font-weight: normal;">- Diastole</label>
                      <label class="control-label col-sm-6" for="nama">
                        <input type="number" class="form-control" id="txtTensiBawah" name="txtTensiBawah" placeholder="..." style="text-align: right;" required>
                      </label>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">VT. Keterangan.</label>
                      <label class="control-label col-sm-6" for="nama">
                        <textarea rows="5" class="form-control" id="txtKetVT" name="txtKetVT" placeholder="..." required></textarea>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Suhu</label>
                      <label class="control-label col-sm-6" for="nama">
                        <input type="number" class="form-control" id="txtSuhu" name="txtSuhu" placeholder="..." style="text-align: right;" required>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Nadi</label>
                      <label class="control-label col-sm-6" for="nama">
                        <input type="text" class="form-control" id="txtNadi" name="txtNadi" placeholder="..." required>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Keterangan</label>
                      <label class="control-label col-sm-6" for="nama">
                        <textarea rows="5"  class="form-control" id="txtKeterangan" name="txtKeterangan" placeholder="..."></textarea>
                      </label>
                    </div>
                    </div>
                  </div>
                </div>

                <BR>
                <div class="form-group">
                  <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                  <input type="hidden" name="idkartuobservasi" value="{{$idkartuobservasi}}">
                  <input type="hidden" name="idkartuibu" value="{{$layanankbArr[0]['idkartuibu']}}">
                  <button class="btn btn-primary"><i class="fa fa-save nav-icon"></i> Simpan</button>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection

<!-- add js -->
@section('add_js')
<script type="text/javascript" src="{{asset('clockpicker/dist/bootstrap-clockpicker.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.datepicker2').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    });

    $('.clockpicker').clockpicker({
      autoclose: true
    });

    $('#form_submit').on('submit', function(e){
      e.preventDefault();
      $("#modalSimpan").modal();
      document.getElementById("pesan_konfirmasi").style.display = "block";
      document.getElementById("pesan_error").style.display = "none";
      document.getElementById("btn_simpan_history").style.display = "inline";
    });
  });

  function submitForm(){
    document.getElementById("form_submit").submit();
    window.loading_screen = window.pleaseWait({
        logo: '{{ asset("logo-sima-small.png") }}',
        backgroundColor: 'white',
        loadingHtml: '<div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div'
      });
  }
</script>
@endsection