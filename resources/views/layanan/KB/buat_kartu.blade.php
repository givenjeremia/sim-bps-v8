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
  <!-- NOTIFIKASI -->
  <div id="notif">
    @if (session()->has('message'))
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fa fa-close"></i> Alert!</h5>
        {{ session('message') }}
      </div>
    @endif      
  </div>
  <!-- END NOTIFIKASI -->

  <div class="row mb-2">
    <div class="col-sm-6">
      <h3>Buat Kartu KB</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item active">Buat Kartu KB</li>
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
                    <div class="form-group row">
                      <label class="control-label col-sm-4" for="nama">Nomor Registrasi</label>
                      <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                        : &nbsp; <span> {{$pasienArr[0]['no_regis']}}</span>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-4" for="nama">Nama Pasien</label>
                      <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                        : &nbsp; <span> {{$pasienArr[0]['nama']}}</span>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-4" for="nama">Tanggal Lahir</label>
                      <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                        <div class="input-group">
                          : &nbsp; <span> {{date('d-m-Y', strtotime($pasienArr[0]['tanggal_lahir']))}}</span>
                        </div> 
                      </label>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="control-label col-sm-4" for="nama">Agama</label>
                      <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                        : &nbsp; <span> {{ucfirst($pasienArr[0]['agama'])}}</span>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-4" for="nama">Alamat</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span> {{$pasienArr[0]['alamat']}}</span>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-4" for="nama">No. Telp</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span> {{$pasienArr[0]['telp']}}</span>
                      </label>
                    </div>                                                           
                  </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

  <FORM method="POST" action="{{ route('layanan-kb.store') }}" id="form_submit" enctype="multipart/form-data">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h6><b>STATUS PESERTA KB</label>
              </div>
            </div>

            <div class="form-group"> 
              <label class="control-label">1. Baru</label> 
            </div> 
            <div class="form-group"> 
              <label class="control-label">2.</label> 
              <label class="control-label col-lg-4">
                <select class="form-control" id="txtStatusKb" name="txtStatusKb">
                  <option value="sudah bersalin" selected>Sesudah Bersalin</option>
                  <option value="keguguran">Keguguran</option>
                  <option value="kb terakhir">KB Terakhir</option>
                </select>
              </label>
              <label class="control-label col-lg-4">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                  </div>
                  <input type="text" class="form-control datepicker" id="txtTglStatusKb" name="txtTglStatusKb" required>
                </div> 
              </label>
            </div>
            <label class="control-label">3. Jumlah anak hidup :</label> 
            <div class="form-group"> 
              <label class="control-label col-sm-2" style="font-weight: normal;">- Laki</label> 
              <label class="control-label col-lg-3">
                <input type="number" class="form-control" id="txtAnakLaki" name="txtAnakLaki" style="text-align: right;" value="0" min="0" required>
              </label>
            </div> 
            <div class="form-group"> 
              <label class="control-label col-sm-2" style="font-weight: normal;">- Perempuan</label> 
              <label class="control-label col-lg-3">
                <input type="number" class="form-control" id="txtAnakPerempuan" name="txtAnakPerempuan" style="text-align: right;" value="0" min="0" required>
              </label>
            </div>   
          </div>
        </div>

      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row mb-2">
              <div class="col-sm-6">
                <label>PEMERIKSAAN</label>
              </div>
            </div>

            <div class="col-md-12">
              <div class="row">
                  <div class="col-md-6"> 
                    <div class="form-group"> 
                      <label class="control-label col-sm-3"style>1. K.U.</label> 
                      <label class="control-label col-lg-8">
                        <input type="text" class="form-control" id="txtKU" name="txtKU" placeholder="K.U." required>
                      </label>
                    </div> 
                    <div class="form-group"> 
                      <label class="control-label col-sm-3"style>2. Haid Terakhir</label> 
                      <label class="control-label col-lg-8">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                          </div>
                          <input type="text" class="form-control datepicker" id="txtHaidTerakhir" name="txtHaidTerakhir" required>
                        </div>                
                      </label>
                    </div>  
                    <label class="control-label col-sm-6">5. Keadaan calon peserta saat ini :</label> 
                    <div class="form-group"> 
                      <label class="control-label col-sm-3" style="font-weight: normal;">- Sakit Kuning</label> 
                      <label class="control-label col-lg-6">
                        <select class="form-control" id="txtSakitKuning" name="txtSakitKuning">
                          <option value="ya" selected>Ya</option>
                          <option value="tidak">Tidak</option>
                        </select>
                      </label>
                    </div> 
                    <div class="form-group"> 
                      <label class="control-label col-sm-3"style="font-weight: normal;">- Perd. Per Vag.</label> 
                      <label class="control-label col-lg-6">
                        <select class="form-control" id="txtPerVag" name="txtPerVag">
                          <option value="ya" selected>Ya</option>
                          <option value="tidak">Tidak</option>
                        </select>
                      </label>
                    </div>                
                    <div class="form-group"> 
                      <label class="control-label col-sm-3"style="font-weight: normal;">- Tumor Payudara</label> 
                      <label class="control-label col-lg-6">
                        <select class="form-control" id="txtTumorPayudara" name="txtTumorPayudara">
                          <option value="ya" selected>Ya</option>
                          <option value="tidak">Tidak</option>
                        </select>
                      </label>
                    </div>
                    <label class="control-label col-sm-4">6. Keluhan :</label> 
                    <div class="form-group"> 
                      <label class="control-label col-sm-3" style="font-weight: normal;">- Fluoralbus</label> 
                      <label class="control-label col-lg-6">
                        <select class="form-control" id="txtFluoralbus" name="txtFluoralbus">
                          <option value="normal" selected>Normal</option>
                          <option value="gatal">Gatal</option>
                          <option value="seperti_susu">Seperti Susu</option>
                          <option value="busa">Busa</option>
                          <option value="cair">Cair</option>
                        </select>
                      </label>
                    </div>
                    <div class="form-group"> 
                      <label class="control-label col-sm-3">8. Alat Kontrasepsi</label> 
                      <label class="control-label col-lg-6">
                          <select class="form-control" id="cboJenisKB" name="cboJenisKB" onchange="changePrice()">
                            <?php foreach ($layanan as $key => $value): ?>
                                <?php if($key == 0){ ?>
                                    <option value="{{$value->id}}" selected>{{$value->nama}}</option>
                                <?php }else { ?>
                                    <option value="{{$value->id}}">{{$value->nama}}</option>
                                <?php } ?>
                            <?php endforeach ?>
                          </select>              
                      </label>
                    </div>
                    <div class="form-group"> 
                      <label class="control-label col-sm-3" style="font-weight: normal;">- Tanggal dilayani</label> 
                      <label class="control-label col-lg-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                          </div>
                          <input type="text" class="form-control datepicker" id="txtTglLayani" name="txtTglLayani" required>
                        </div> 
                      </label>
                    </div>
                    <div class="form-group"> 
                      <label class="control-label col-sm-3" style="font-weight: normal;">- Tanggal dipesan kembali</label> 
                      <label class="control-label col-lg-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                          </div>
                          <input type="text" class="form-control datepicker" id="txtTglPesanKemb" name="txtTglPesanKemb" required>
                        </div> 
                      </label>
                    </div>
                    <div class="form-group"> 
                      <label class="control-label col-sm-3" style="font-weight: normal;">- Tanggal dilepas</label> 
                      <label class="control-label col-lg-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                          </div>
                          <input type="text" class="form-control datepicker" id="txtTglLepas" name="txtTglLepas" required>
                        </div> 
                      </label>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group"> 
                      <label class="control-label col-sm-3"style>3. Tensi</label> 
                      <label class="control-label col-lg-4">
                        <input type="number" class="form-control" id="txtTensiAtas" name="txtTensiAtas" placeholder="Tensi Atas" style="text-align: right;" required>
                      </label>
                      <label class="control-label col-lg-4">
                        <input type="number" class="form-control" id="txtTensiBawah" name="txtTensiBawah" placeholder="Tensi Bawah" style="text-align: right;" required>
                      </label>
                    </div> 
                    <div class="form-group"> 
                      <label class="control-label col-sm-3"style>4. Berat Badan</label> 
                      <label class="control-label col-lg-8">
                        <input type="text" class="form-control" id="txtBeratBadan" name="txtBeratBadan" placeholder="Berat Badan Pasien (Kg)" style="text-align: right;" required>
                      </label>
                    </div>
                    <label class="control-label col-sm-8">7. Calon Aks. IUD dilakukan pemeriksaan :</label> 
                    <div class="form-group"> 
                      <label class="control-label col-sm-3" style="font-weight: normal;">- Tanda Radang</label> 
                      <label class="control-label col-lg-6">
                        <select class="form-control" id="txtTandaRadang" name="txtTandaRadang">
                          <option value="ya" selected>Ya</option>
                          <option value="tidak">Tidak</option>
                        </select>
                      </label>
                    </div> 
                    <div class="form-group"> 
                      <label class="control-label col-sm-3"style="font-weight: normal;">- Tumor</label> 
                      <label class="control-label col-lg-6">
                        <select class="form-control" id="txtTumor" name="txtTumor">
                          <option value="ya" selected>Ya</option>
                          <option value="tidak">Tidak</option>
                        </select>
                      </label>
                    </div>                
                    <div class="form-group"> 
                      <label class="control-label col-sm-3"style="font-weight: normal;">- Posisi Rahim</label> 
                      <label class="control-label col-lg-6">
                        <select class="form-control" id="txtPosisiRahim" name="txtPosisiRahim">
                          <option value="retro" selected>Retro</option>
                          <option value="antefleksi">Antefleksi</option>
                        </select>
                      </label>
                    </div>
                    <div class="form-group"> 
                      <label class="control-label col-sm-3"style="font-weight: normal;">- Genetalia Luar/Dalam</label> 
                      <label class="control-label col-lg-6">
                        <select class="form-control" id="txtGenetalia" name="txtGenetalia">
                          <option value="normal" selected>Normal</option>
                          <option value="varices">Varices</option>
                          <option value="jengger">Jengger</option>
                          <option value="condilo">Condilo</option>
                          <option value="barholintis">Barholintis</option>
                        </select>
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
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row mb-2">
              <div class="col-sm-6">
                <label>PERHITUNGAN HARGA</label>
              </div>
            </div>

            <div class="col-md-16">
              <div class="row">
                <div class="col-md-8"> 
                  <div class="form-group"> 
                    <label class="control-label col-sm-3"style>1. Harga Layanan :</label> 
                    <label class="control-label col-lg-8" style="font-weight: normal;">
                      Rp. <span id="harga_layanan">0</span> ,-
                    </label>
                  </div> 
                  <label class="control-label col-sm-4"style>2. Obat yang diberikan :</label>
                  <div id="list_obat">

                  </div>
                  <div class="form-group"> 
                    <label class="control-label col-sm-3">Total Harga :</label> 
                    <label class="control-label col-lg-8">
                      Rp. <span id="totalHarga">0</span> ,-
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
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row">

              <div class="col-lg-10">


                <div class="form-group">
                  <p>INFORMED CONSENT PASIEN</p>
                  <!-- <img id="imgIc" style="width:100%; height:100%;" src=""> -->
                  <div id="dpIC">
                    <input type="file" id="input-file-now" name="lampiran[]" multiple class="dropify" data-show-remove="true" data-height="500" data-allowed-file-extensions="jpg jpeg png"/>
                  </div>
                </div>

                <div class="form-group">
                  <input type="hidden" name="tipe" id="tipe" value="buat_kartu"></input>
                  <input type="hidden" name="txtIdPasien" id="txtIdPasien" value="{{$pasienArr[0]['no_regis']}}"></input>
                  <input type="hidden" name="txtTotalObat" id="txtTotalObat"></input>
                  <input type="hidden" name="obat_id" id="obat_id"></input>
                  <input type="hidden" name="txtTarifLayanan" id="txtTarifLayanan"></input>
                  <input type="hidden" name="txtTarifTotal" id="txtTarifTotal"></input>
                  <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                  <button class="btn btn-primary"><i class="fa fa-save nav-icon"></i> Simpan</button>
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>
    </div>    
  </FORM>
</div>
@endsection
<!-- plugin js -->
@section('plugin_js')

@endsection

<!-- add js -->
@section('add_js')
<script src="{{asset('dropify/dist/js/dropify.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    changePrice();
    $('.select2').select2();
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

<script>
  function submitForm(){
    document.getElementById("form_submit").submit();
    window.loading_screen = window.pleaseWait({
        logo: '{{ asset("logo-sima-small.png") }}',
        backgroundColor: 'white',
        loadingHtml: '<div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div'
      });
  }

  $(document).on('submit', '#form_submit', function (event) {
    event.preventDefault();
    var id = document.getElementById('obat_id').value;
    var id_layanan = document.getElementById('cboJenisKB').value;
    var url = '{{ url("/layanan-kb/cekStokObat") }}';
    $.ajax({
      type:"POST",
      url:url,
      data:{obat_id:id, id_layanan:id_layanan,_token:"{{ csrf_token() }}"},
      success:function(data){
          var resp = $.parseJSON(data);
          console.log(resp);
          if(resp == true){
            // boleh submit
            document.getElementById("pesan_konfirmasi").style.display = "block";
            document.getElementById("pesan_error").style.display = "none";
            document.getElementById("btn_simpan_history").style.display = "inline";
            $("#modalSimpan").modal();
            
          }
          else{
            // tidak boleh submit
            // document.body.scrollTop = 0; // For Safari
            // document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
            // document.getElementById("notif").innerHTML = '<div class="alert alert-danger alert-dismissible">'+
            //       '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
            //       '<h5><i class="icon fa fa-close"></i> Alert!</h5>'+
            //       'Stok obat untuk layanan ini tidak mencukupi. Harap melakukan restock terlebih dahulu'+
            //     '</div>';

            // $(".alert").fadeTo(2000, 3000).slideUp(1000, function(){
            //   $(".alert").slideUp(1000);
            // });
            // modalSimpan.style.display = "block";
            
            $("#modalSimpan").modal();
            document.getElementById("pesan_konfirmasi").style.display = "none";
            document.getElementById("btn_simpan_history").style.display = "none";
            document.getElementById("pesan_error").style.display = "block";
            document.getElementById("pesan_error").innerHTML = 'Stok obat untuk layanan ini tidak mencukupi. Harap melakukan restock terlebih dahulu';
          }
        }
    });
  });


  function changePrice(){
    var id = document.getElementById("cboJenisKB").value;
    var url = "{{ url('/layanan-kb/getHargaLayanan') }}";
    $.ajax({
      type:"POST",
      url:url,
      data:{layanan_id:id,_token:'{{ csrf_token() }}'},
      success:function(data){
          var resp = $.parseJSON(data);
          console.log(resp);
          document.getElementById("list_obat").innerHTML = "";
          document.getElementById('obat_id').value = "";
          var total_obat = 0;
          for(var i = 0; i < resp.length; i++)
          {
            total_obat += parseInt(resp[i].subtotal);

            document.getElementById("list_obat").innerHTML += '<div class="form-group">'+
                      '<label class="control-label col-sm-3" style="font-weight: normal;">- '+resp[i].nama+'</label> '+
                      '<label class="control-label col-lg-6" style="font-weight: normal;">'+
                        'Rp. <span id="hargaObat3">'+resp[i].str_subtotal+'</span> ,-'+
                      '</label>'+
                    '</div>';
            document.getElementById('obat_id').value += resp[i].id_obat+";";
          }

          document.getElementById('totalHarga').innerHTML = resp[0].str_tarif_total;
          document.getElementById('harga_layanan').innerHTML = resp[0].str_tarif_layanan;

          document.getElementById('txtTotalObat').value = total_obat;
          document.getElementById('txtTarifLayanan').value = resp[0].tarif_layanan;
          document.getElementById('txtTarifTotal').value = resp[0].tarif_total;
        }
    });
  }
</script>
@endsection