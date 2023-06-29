@extends('layouts.adminlte')
<!-- plugin css -->
@section('plugin_css')
<link rel="stylesheet" href="{{asset('dropify/dist/css/dropify.min.css')}}">
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

.labelId {
text-align:left; margin-top:3%;
}

.inputId {
margin-top:5%;
}

@endsection
<!-- content -->
@section('content')
<!-- modal reschecule -->
<div class="modal fade" id="modalReschecule" role="dialog"> 
  <div class="modal-dialog" role="document"> 
    <div class="modal-content" style="border-radius: 17px;"> 
      <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;"> 
        <h4 style="color:white;">Reschedule</h4> 
        <button type="button" class="close"  
        data-dismiss="modal"  
        aria-label="Close"> 
        <span aria-hidden="true">&times;</span></button> 
      </div> 
      <div class="modal-body"> 
        Apakah anda yakin ingin merubah jadwal yang terpilih?
        <FORM method="post" name="formReschedule" action="{{ url('/layanan-imunisasi/rechedule') }}" >
          <div class="button-group">
            <BR>
              <button class="btn btn-default pull-left" data-dismiss="modal">Batal</button>&nbsp
              <button class="btn btn-danger">Reschedule</button>
              <br>
              <input type="hidden" name="_token" value="{!!csrf_token()!!}">
              <input type="hidden" name="txtTanggalRes" id="txtTanggalRes" value="">
              <input type="hidden" name="txtJenisLayananRes" id="txtJenisLayananRes" value="">
              <input type="hidden" name="txtNoRegRes" id="txtNoReg" value="{{$bayiArr[0]['id']}}">
            </div>
          </FORM>
        </div> 
      </div> 
    </div> 
  </div>
  <!-- tutup modal reschecule -->
<br>
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h3>Kelola Jadwal Imunisasi</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/bayi_imunisasi')}}">Tambah Pasien Imunisasi</a></li>
        <li class="breadcrumb-item active">Kelola Jadwal Imunisasi</li>
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
                {{-- <div class="form-group">
                  <label class="control-label col-sm-4" for="nama">Nomor Registrasi</label>
                  <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{$bayiArr[0]['no_registrasi']}}</span>
                  </label>
                </div> --}}
                <div class="form-group">
                  <label class="control-label col-sm-4" for="nama">Nama Pasien</label>
                  <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{$bayiArr[0]['nama']}}</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-4" for="nama">Tanggal Lahir</label>
                  <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                    <div class="input-group">
                      : &nbsp <span> {{date('d-m-Y', strtotime($bayiArr[0]['tanggal_lahir']))}}</span>
                    </div> 
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-4" for="nama">B.B.L.</label>
                  <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                    <div class="input-group">
                      : &nbsp <span> {{$bayiArr[0]['bbl']}} KG</span>
                    </div> 
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-4" for="nama">Cara Persalinan</label>
                  <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                    : &nbsp <span><?php if($bayiArr[0]['cara_persalinan']=='1'){ echo 'Caesar'; }else echo 'Normal'; ?></span>
                  </label>
                </div>  
              </div>

              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">Nama Ayah</label>
                  <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{$bayiArr[0]['nama_ayah']}}</span>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">Nama Ibu</label>
                  <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{$bayiArr[0]['nama_ibu']}}</span>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">Telepon</label>
                  <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{$bayiArr[0]['telp']}}</span>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">Alamat</label>
                  <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{$bayiArr[0]['alamat']}}</span>
                  </label>
                </div> 

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

 <div class="row">
      <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
          <div class="card-header d-flex p-0">
            <ul class="nav nav-pills p-2">
              <li class="nav-item"><a id="tab1" class="nav-link" href="#tab_1" data-toggle="tab">Paketan</a></li>
              <li class="nav-item"><a id="tab2" class="nav-link" href="#tab_2" data-toggle="tab">Satuan</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">

                <div class="row">
                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                          @if (Session::get('notif_berhasil'))
                          <div class="alert alert-success"></span><a href="#" class="close" data-dismiss="alert">&times;</a><strong>BERHASIL!</strong><BR> 
                          {!! session::get('notif_berhasil') !!}
                          </div>
                          @endif
                          @if (Session::get('notif_gagal'))
                          <div class="alert alert-danger"></span><a href="#" class="close" data-dismiss="alert">&times;</a><strong>GAGAL!</strong><BR> 
                            {!! session::get('notif_gagal') !!}
                          </div>
                          @endif
                          <div class="row">
                            <div class="col-lg-6">

                              

                              <?php
                                $paketKiri = DB::select('SELECT * FROM layanan WHERE pelayanan = 1');
                                if($paketKiri)
                                {
                                  // var_dump((array)$paket);die();  
                                  for($a=0; $a<round(count($paketKiri)/2,0,PHP_ROUND_HALF_UP); $a++) {
                                  $id_layanan_imunisasi = DB::select("SELECT * FROM layanan_imunisasi WHERE id_pasien_bayi="."'".$bayiArr[0]['id']."'");
                                  $cek1 = DB::select("SELECT * FROM imunisasi_jenis_layanan WHERE id_jenis_layanan=".$paketKiri[$a]->id." AND id_layanan_imunisasi=".$id_layanan_imunisasi[0]->id); 
                                  if($cek1){
                                 ?>
                                 <FORM method="post" name="formPasienBaru" action="{{ url('/layanan-imunisasi-history') }}" >
                                  <div class="form-group">
                                    <div class="card" >
                                      <div class="card-header" style="background-color:#F5F5F5;">
                                        <h3 class="card-title">{{ $paketKiri[$a]->nama }}</h3>
                                      </div>
                                      <div class="card-body">

                                        <div class="form-group">
                                          <label class="control-label col-sm-7" for="nama">
                                            <div class="input-group">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i>
                                                </div>
                                                <input id="dtp{{ $paketKiri[$a]->id }}" type="text" class="form-control pull-right datepicker" name="dtpTanggal" autocomplete="off">
                                                <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                                                <input type="hidden" name="txtIdLayanan" id="txtIdLayanan" value="{{ $paketKiri[$a]->id }}">
                                                <input type="hidden" name="txtId" id="txtNoReg" value="{{$bayiArr[0]['id']}}">
                                                
                                              </div>
                                            </label>
                                            <?php 
                                            if($cek1 && $cek1[0]->status_imunisasi == 0){ ?>
                                            <button type="submit" class="btn btn-primary fa fa-check"></button>
                                            <button type="button" onclick="reschedule({{ $paketKiri[$a]->id }});" class="btn btn-info fa fa-exchange"></button>
                                            <?php } else if($cek1 && $cek1[0]->status_imunisasi == 1){?>
                                              <li class="fa fa-check-circle"></li>
                                            <?php } ?>
                                          </div>

                                        </div>
                                      </div>
                                    </div>
                                  </FORM>
                              <?php
                                  }
                                }
                              }
                              ?>
                            </div>

                            <div class="col-lg-6">
                                <?php
                                $paketKanan = DB::select('SELECT * FROM layanan WHERE pelayanan = 1');
                                if($paketKanan)
                                {
                                  // var_dump((array)$paket);die();  
                                  for($i=round(count($paketKanan)/2,0,PHP_ROUND_HALF_UP); $i<count($paketKanan); $i++) {
                                  $cek2 = DB::select("SELECT * FROM imunisasi_jenis_layanan WHERE id_jenis_layanan=".$paketKanan[$i]->id." AND id_layanan_imunisasi=".$id_layanan_imunisasi[0]->id);
                                  if($cek2){
                                 ?>
                                 <FORM method="post" name="formPasienBaru" action="<?php echo URL::to('/bayi_imunisasi_history_tambah') ?>" >
                                  <div class="form-group">
                                  <div class="card" >
                                    <div class="card-header" style="background-color:#F5F5F5;">
                                      <h3 class="card-title">{{ $paketKanan[$i]->nama }}</h3>
                                    </div>
                                    <div class="card-body">

                                      <div class="form-group">
                                      <label class="control-label col-sm-7" for="nama">
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i>
                                            </div>
                                            <input id="dtp{{ $paketKanan[$i]->id }}" type="text" class="form-control pull-right datepicker" name="dtpTanggal" autocomplete="off">
                                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                                            <input type="hidden" name="txtIdLayanan" id="txtIdLayanan" value="{{ $paketKanan[$i]->id }}">
                                            <input type="hidden" name="txtNoReg" id="txtNoReg" value="{{$bayiArr[0]['no_registrasi']}}">
                                          </div>
                                        </label>
                                        <?php 
                                        if($cek2 && $cek2[0]->status_imunisasi == 0){ ?>
                                        <button type="submit" class="btn btn-primary fa fa-check"></button>
                                        <button type="button" onclick="reschedule({{ $paketKanan[$i]->id }});" class="btn btn-info fa fa-exchange"></button>
                                        <?php } else{?>
                                          <li class="fa fa-check-circle"></li>
                                        <?php } ?>
                                      </div>

                                    </div>
                                  </div>
                                </div>

                              </form>
                              <?php
                                  }
                                }
                              }
                              ?>
                            </div>

                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">

                          <div class="row">
                            <div class="col-lg-6">
                              <?php
                                $satuanKiri = DB::select('SELECT * FROM layanan WHERE pelayanan = 2');
                                if($satuanKiri)
                                {
                                  // var_dump((array)$paket);die();  
                                  for($c=0; $c<round(count($satuanKiri)/2,0,PHP_ROUND_HALF_UP); $c++) {
                                  $cek3 = DB::select("SELECT * FROM imunisasi_jenis_layanan WHERE id_jenis_layanan=".$satuanKiri[$c]->id." AND id_layanan_imunisasi=".$id_layanan_imunisasi[0]->id);
                                  if($cek3) {
                                 ?>
                                 <FORM method="post" name="formPasienBaru" action="<?php echo URL::to('/bayi_imunisasi_history_tambah') ?>" >
                                  <div class="form-group">
                                  <div class="card" >
                                    <div class="card-header" style="background-color:#F5F5F5;">
                                      <h3 class="card-title">{{ $satuanKiri[$c]->nama }}</h3>
                                    </div>
                                    <div class="card-body">

                                      <div class="form-group">
                                      <label class="control-label col-sm-7" for="nama">
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i>
                                            </div>
                                            <input id="dtp{{ $satuanKiri[$c]->id }}" type="text" class="form-control pull-right datepicker" name="dtpTanggal" autocomplete="off">
                                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                                            <input type="hidden" name="txtIdLayanan" id="txtIdLayanan" value="{{ $satuanKiri[$c]->id }}">
                                            <input type="hidden" name="txtNoReg" id="txtNoReg" value="{{$bayiArr[0]['no_registrasi']}}">
                                          </div>
                                        </label>
                                        <?php 
                                        if($cek3 && $cek3[0]->status_imunisasi == 0){ ?>
                                        <button type="submit" class="btn btn-primary fa fa-check"></button>
                                        <button type="button" onclick="reschedule({{ $satuanKiri[$c]->id }});" class="btn btn-info fa fa-exchange"></button>
                                        <?php } else{?>
                                          <li class="fa fa-check-circle"></li>
                                        <?php } ?>
                                      </div>

                                    </div>
                                  </div>
                                </div>
                                </FORM>
                              <?php
                                  }
                                }
                              }
                              ?>
                              </form>
                            </div>

                            <div class="col-lg-6">
                                <?php
                                $satuanKanan = DB::select('SELECT * FROM layanan WHERE pelayanan = 2');
                                if($satuanKanan)
                                {
                                  // var_dump((array)$paket);die();  
                                  for($d=round(count($satuanKanan)/2,0,PHP_ROUND_HALF_UP); $d<count($satuanKanan); $d++) {
                                  $cek4 = DB::select("SELECT * FROM imunisasi_jenis_layanan WHERE id_jenis_layanan=".$satuanKanan[$d]->id." AND id_layanan_imunisasi=".$id_layanan_imunisasi[0]->id);
                                  if($cek4) {
                                 ?>
                                 <FORM method="post" name="formPasienBaru" action="<?php echo URL::to('/bayi_imunisasi_history_tambah') ?>" >
                                  <div class="form-group">
                                  <div class="card" >
                                    <div class="card-header" style="background-color:#F5F5F5;">
                                      <h3 class="card-title">{{ $satuanKanan[$d]->nama }}</h3>
                                    </div>
                                    <div class="card-body">

                                      <div class="form-group">
                                      <label class="control-label col-sm-7" for="nama">
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i>
                                            </div>
                                            <input id="dtp{{ $satuanKanan[$d]->id }}" name="dtpTanggal" type="text" class="form-control pull-right datepicker" autocomplete="off">
                                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                                            <input type="hidden" name="txtIdLayanan" id="txtIdLayanan" value="{{ $satuanKanan[$d]->id }}">
                                            <input type="hidden" name="txtNoReg" id="txtNoReg" value="{{$bayiArr[0]['no_registrasi']}}">                                            
                                          </div>
                                        </label>
                                        <?php
                                        if($cek4 && $cek4[0]->status_imunisasi == 0){ ?>
                                        <button type="submit" class="btn btn-primary fa fa-check"></button>
                                        <button type="button" onclick="reschedule({{ $satuanKanan[$d]->id }});" class="btn btn-info fa fa-exchange"></button>
                                        <?php } else{?>
                                          <li class="fa fa-check-circle"></li>
                                        <?php } ?>
                                      </div>

                                    </div>
                                  </div>
                                </div>
                                </FORM>
                              <?php
                                  }
                                }
                              }
                              ?>
                              </form>
                            </div>

                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>

              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- ./card -->
      </div>
      <!-- /.col -->
    </div>

</div>
@endsection
<!-- plugin js -->
@section('plugin_js')

@endsection

<!-- add js -->
@section('add_js')
<script>
  $(document).ready(function(){

    <?php
    foreach ($jadwalArr as $key => $value) { ?>
      document.getElementById('dtp<?php echo $value["id_jenis_layanan"] ?>').value = <?php echo "'".date('d-m-Y', strtotime($value["tanggal"]))."'" ?>;

    <?php
    }
    $layanan_imunisasi = DB::table('layanan_imunisasi')->where('layanan_imunisasi.id_pasien_bayi', '=', $bayiArr[0]["id"])->get();
    if($layanan_imunisasi[0]->jenis_paket == 2)
    { ?>
      $("#tab_1").removeClass("active");
      $("#tab_2").addClass("active");
      $("#tab2").addClass("active");
      $("#tab_1").css({"display": "none"});
    
    <?php
    }
    if($layanan_imunisasi[0]->jenis_paket == 1)
    { ?>
      $("#tab_2").removeClass("active");
      $("#tab_1").addClass("active");
      $("#tab1").addClass("active"); 
      $("#tab_2").css({"display": "none"});
    <?php 
    }
    ?>

       

  });
  function reschedule(idJenisLayanan)
  {
    document.getElementById('txtJenisLayananRes').value = idJenisLayanan;
    document.getElementById('txtTanggalRes').value = document.getElementById('dtp'+idJenisLayanan).value;
    $('#modalReschecule').modal('show');

  }
  function opendetailmodal(id, nama, ttl, bbl, caraPersalinan, alamat, namaAyah, namaIbu, telp)
  {
    document.getElementById('lblNamaDetail').innerHTML = nama;
    document.getElementById('lblTtlDetail').innerHTML = ttl;
    document.getElementById('lblBblDetail').innerHTML = bbl+" KG";
    document.getElementById('lblCaraPersalinanDetail').innerHTML = caraPersalinan;
    document.getElementById('lblAlamatDetail').innerHTML = alamat;
    document.getElementById('lblNamaAyahDetail').innerHTML = namaAyah;
    document.getElementById('lblNamaIbuDetail').innerHTML = namaIbu;
    document.getElementById('lblTelpDetail').innerHTML = telp;
  }

  function openicmodal(id, ic, nama, status)
  {
    var dpf1 = $('#input-file-now').dropify(
    {
     defaultFile: ic
   });
    dpf = dpf1.data('dropify');
    dpf.resetPreview();
    dpf.clearElement();
    dpf.settings.defaultFile = ic;
    dpf.destroy();
    dpf.init();  


            // if(status == 1)
            // {
            //   $("#imgIc").show();
            //   $("#dpIC").hide();
            //   $("#btnSimpanIc").hide();
            //   document.getElementById('imgIc').src = ic;
            // }
            // if(status == 2)
            // {
            //   $("#imgIc").hide();
            //   $("#dpIC").show();
            //   $("#btnSimpanIc").show();
            // }
            
    document.getElementById('lblNamaIc').innerHTML = nama;
  }
</script>

<script src="{{asset('dropify/dist/js/dropify.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
          messages: {
            default: 'Glissez-déposez un fichier ici ou cliquez',
            replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
            remove:  'Supprimer',
            error:   'Désolé, le fichier trop volumineux'
          }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element){
          return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element){
          alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element){
          console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e){
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