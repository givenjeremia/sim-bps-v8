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

<br>
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h3>Tambah Kartu Pasien Imunisasi</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/bayi_imunisasi')}}">Pelayanan Imunisasi</a></li>
        <li class="breadcrumb-item active">Tambah Pasien Imunisasi</li>
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
                    : &nbsp <span> {{$bayiArr[0]['cara_persalinan']}}</span>
                  </label>
                </div>  
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label col-sm-4" for="nama">Nama Ayah</label>
                  <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{$bayiArr[0]['nama_ayah']}}</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-4" for="nama">Nama Ibu</label>
                  <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{$bayiArr[0]['nama_ibu']}}</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-4" for="nama">Telepon</label>
                  <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{$bayiArr[0]['telp']}}</span>
                  </label>
                </div>
                <div class="form-group">
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

  <FORM method="post" action="{{ url('/layanan-imunisasi/tambah-kartu') }}" name="formPasienBaru" enctype="multipart/form-data">
  <div class="row">
      <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
          <div class="card-header d-flex p-0">
            <ul class="nav nav-pills p-2">
              <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab" onclick="setPaket(1);">Paketan</a></li>
              <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab" onclick="setPaket(2);">Satuan</a></li>
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

                          <div class="row">
                            <div class="col-lg-6">
                              <?php
                                $paketKiri = DB::select('SELECT * FROM layanan WHERE pelayanan = 1 AND status_hapus = 0');
                                if($paketKiri)
                                {
                                  // var_dump((array)$paket);die();  
                                  for($a=0; $a<round(count($paketKiri)/2,0,PHP_ROUND_HALF_UP); $a++) {
                                  // var_dump(count($paket));die(); 
                                 ?>
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
                                            <input id="dtp{{ $paketKiri[$a]->id }}" name2="dtpPaket1" type="text" class="form-control pull-right datepicker" name="dtp{{ $paketKiri[$a]->id }}" onchange="this.style.backgroundColor = 'white';" autocomplete="off">
                                          </div>
                                        </label>
                                        <!-- <button type="button" class="btn btn-default fa fa-check" disabled></button> -->
                                      </div>

                                    </div>
                                  </div>
                                </div>
                              <?php
                                  }
                                }
                              ?>
                            </div>

                            <div class="col-lg-6">
                                <?php
                                $paketKanan = DB::select('SELECT * FROM layanan WHERE pelayanan = 1 AND status_hapus = 0');
                                if($paketKanan)
                                {
                                  // var_dump((array)$paket);die();  
                                  for($i=round(count($paketKanan)/2,0,PHP_ROUND_HALF_UP); $i<count($paketKanan); $i++) {
                                  // var_dump(count($paket));die(); 
                                 ?>
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
                                            <input id="dtp{{ $paketKanan[$i]->id }}" name2="dtpPaket1" type="text" class="form-control pull-right datepicker" name="dtp{{ $paketKanan[$i]->id }}" onchange="this.style.backgroundColor = 'white';" autocomplete="off">
                                          </div>
                                        </label>
                                        <!-- <button type="button" class="btn btn-default fa fa-check" disabled></button> -->
                                      </div>

                                    </div>
                                  </div>
                                </div>
                              <?php
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
                                $satuanKiri = DB::select('SELECT * FROM layanan WHERE pelayanan = 2 AND status_hapus = 0');
                                if($satuanKiri)
                                {
                                  // var_dump((array)$paket);die();  
                                  for($c=0; $c<round(count($satuanKiri)/2,0,PHP_ROUND_HALF_UP); $c++) {
                                  // var_dump(count($paket));die(); 
                                 ?>
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
                                            <input id="dtp{{ $satuanKiri[$c]->id }}" name2="dtpPaket2" type="text" class="form-control pull-right datepicker" name="dtp{{ $satuanKiri[$c]->id }}" onchange="this.style.backgroundColor = 'white';" autocomplete="off">
                                          </div>
                                        </label>
                                        <!-- <button type="button" class="btn btn-default fa fa-check" disabled></button> -->
                                      </div>

                                    </div>
                                  </div>
                                </div>
                              <?php
                                  }
                                }
                              ?>
                            </div>

                            <div class="col-lg-6">
                                <?php
                                $satuanKanan = DB::select('SELECT * FROM layanan WHERE pelayanan = 2 AND status_hapus = 0');
                                if($satuanKanan)
                                {
                                  // var_dump((array)$paket);die();  
                                  for($d=round(count($satuanKanan)/2,0,PHP_ROUND_HALF_UP); $d<count($satuanKanan); $d++) {
                                  // var_dump(count($paket));die(); 
                                 ?>
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
                                            <input id="dtp{{ $satuanKanan[$d]->id }}" name2="dtpPaket2" type="text" class="form-control pull-right datepicker" name="dtp{{ $satuanKanan[$d]->id }}" onchange="this.style.backgroundColor = 'white';" autocomplete="off">
                                          </div>
                                        </label>
                                        <!-- <button type="button" class="btn btn-default fa fa-check" disabled></button> -->
                                      </div>

                                    </div>
                                  </div>
                                </div>
                              <?php
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
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- ./card -->
      </div>
      <!-- /.col -->
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row">

              <div class="col-lg-7">


                <div class="form-group">
                  <p>Lampiran</p>
                  <!-- <img id="imgIc" style="width:100%; height:100%;" src=""> -->
                  <div id="dpIC">
                    <input type="file" id="input-file-now" name="lampiran[]" multiple class="dropify" data-show-remove="true" data-height="500" data-allowed-file-extensions="jpg jpeg png"/>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row">

              <div class="col-lg-7">
                <div class="form-group float-sm-left">
                  <button type="button" class="btn btn-primary" onclick="submitData();"><i class="fa fa-plus-circle nav-icon"></i> Tambah Kartu</button>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <input type="hidden" name="_token" value="{!!csrf_token()!!}">
    <input type="hidden" name="txtPaket" id="txtPaket">
    <input type="hidden" name="txtNoReg" id="txtNoReg" value="{{$bayiArr[0]['id']}}">
    <input type="hidden" name="txtIdPasien" id="txtIdPasien" value="{{$bayiArr[0]['id']}}">

    </FORM>

  </div>
  @endsection
  <!-- plugin js -->
  @section('plugin_js')

  @endsection

  <!-- add js -->
  @section('add_js')
  <script>
    var isiPaket = 1; //default paketan
    function setPaket(paket)
    {
      isiPaket = paket;
    }
    function submitData()
    {
      if(cekPaket(isiPaket) == 1)
      {
        document.getElementById('txtPaket').value = isiPaket;
        document.formPasienBaru.submit();
        window.loading_screen = window.pleaseWait({
          logo: '{{ asset("logo-sima-small.png") }}',
          backgroundColor: 'white',
          loadingHtml: '<div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div'
        });
      }
    }
    function cekPaket(paket)
    {
      var returnClear = 1;
      if(paket==1)
      {
        var arrPaket = new Array();
        $("input:text[name2='dtpPaket2']").each(function(){
          arrPaket.push($(this).attr('id'));
        });
        for (var i = 0; i <arrPaket.length; i++) {
          document.getElementById(arrPaket[i]).style.backgroundColor ="white";
        }

        var arrPaket = new Array();
        $("input:text[name2='dtpPaket1']").each(function(){
          arrPaket.push($(this).attr('id'));
        });
        for (var i = 0; i <arrPaket.length; i++) {
          document.getElementById(arrPaket[i]).style.backgroundColor ="white";
          if(document.getElementById(arrPaket[i]).value=="")
          {
            document.getElementById(arrPaket[i]).style.backgroundColor ="#ffe6e6";
            document.documentElement.scrollTop = 0;
            returnClear = 2;
          }
        }
        
      }
      else if(paket==2)
      {
        var arrPaket = new Array();
        $("input:text[name2='dtpPaket1']").each(function(){
          arrPaket.push($(this).attr('id'));
        });
        for (var i = 0; i <arrPaket.length; i++) {
          document.getElementById(arrPaket[i]).style.backgroundColor ="white";
        }

        var arrPaket = new Array();
        $("input:text[name2='dtpPaket2']").each(function(){
          arrPaket.push($(this).attr('id'));
        });
        for (var i = 0; i <arrPaket.length; i++) {
          document.getElementById(arrPaket[i]).style.backgroundColor ="white";
          if(document.getElementById(arrPaket[i]).value=="")
          {
            document.getElementById(arrPaket[i]).style.backgroundColor ="#ffe6e6";
            document.documentElement.scrollTop = 0;
            returnClear = 2;
          }
        }
        
      }
      return returnClear;
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