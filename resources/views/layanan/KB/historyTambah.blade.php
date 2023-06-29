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
      <h3>Kunjungan Ulang KB</h3>
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
                        : &nbsp; <span> {{$layanankbArr[0]['no_regis_pasien_dewasa']}}</span>
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-4" for="nama">Nama Pasien</label>
                      <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                        : &nbsp; <span> {{$layanankbArr[0]->pasienDewasa->nama}}</span>
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-4" for="nama">Tanggal Lahir</label>
                      <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                        <div class="input-group">
                          : &nbsp; <span> {{date('d-m-Y', strtotime($layanankbArr[0]->pasienDewasa->tanggal_lahir))}}</span>
                        </div> 
                      </label>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-sm-4" for="nama">Agama</label>
                      <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                        : &nbsp; <span> {{$layanankbArr[0]->pasienDewasa->agama}}</span>
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-4" for="nama">Alamat</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span> {{$layanankbArr[0]->pasienDewasa->alamat}}</span>
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-4" for="nama">No. Telp</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span> {{$layanankbArr[0]->pasienDewasa->telp}}</span>
                      </label>
                    </div>                                                           
                  </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  
  <form class="form-horizontal" id="form_submit" method="POST" action="{{url('/layanan-kb/store-tambah-history')}}">
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
                      <label class="control-label col-sm-3" for="nama">Tanggal Haid</label>
                      <label class="control-label col-sm-6" for="nama">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                          </div>
                          <input type="text" class="form-control datepicker2" id="txtTanggalHaid" name="txtTanggalHaid">
                        </div>  
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Berat Badan</label>
                      <label class="control-label col-sm-6" for="nama">
                        <input type="text" class="form-control" id="txtBB" name="txtBB" placeholder="Berat Badan Pasien" style="text-align: right;" required>
                      </label>
                    </div>
                    <label class="control-label col-sm-4" for="nama">Tekanan Darah :</label>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama" style="font-weight: normal;">- Sistole</label>
                      <label class="control-label col-sm-6" for="nama">
                        <input type="number" class="form-control" id="txtTekDarahAtas" name="txtTekDarahAtas" placeholder="Tekanan Darah Sistole" style="text-align: right;" required>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama" style="font-weight: normal;">- Diastole</label>
                      <label class="control-label col-sm-6" for="nama">
                        <input type="number" class="form-control" id="txtTekDarahBawah" name="txtTekDarahBawah" placeholder="Tekanan Darah Diastole" style="text-align: right;" required>
                      </label>
                    </div>
                    <label class="control-label col-sm-2" for="nama">Keluhan :</label>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama" style="font-weight: normal;">- Efek Samping</label>
                      <label class="control-label col-sm-6" for="nama">
                        <!-- <input type="number" class="form-control" id="txtEfekSampingKeluhan" name="txtEfekSampingKeluhan" placeholder="Keluhan Efek Samping" required> -->
                        <textarea rows="5" class="form-control" id="txtEfekSampingKeluhan" name="txtEfekSampingKeluhan" placeholder="Keluhan Efek Samping"></textarea>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama" style="font-weight: normal;">- Komplikasi</label>
                      <label class="control-label col-sm-6" for="nama">
                        <textarea rows="5"  class="form-control" id="txtKomplikasi" name="txtKomplikasi" placeholder="Kompilkasi"></textarea>
                      </label>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Tindakan</label>
                      <label class="control-label col-sm-6" for="nama">
                        <!-- <input type="number" class="form-control" id="txtTindakan" name="txtTindakan" placeholder="Tindakan" required> -->
                        <textarea rows="5"  class="form-control" id="txtTindakan" name="txtTindakan" placeholder="Tindakan"></textarea>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Efek Samping</label>
                      <label class="control-label col-sm-6" for="nama">
                        <!-- <input type="number" class="form-control" id="txtEfekSamping" name="txtEfekSamping" placeholder="Tindakan" required> -->
                        <textarea rows="5"  class="form-control" id="txtEfekSamping" name="txtEfekSamping" placeholder="Tindakan"></textarea>
                      </label>
                    </div> 
                    <div class="form-group row"> 
                      <label class="control-label col-sm-3">Alat Kontrasepsi</label> 
                      <label class="control-label col-lg-5" style="font-weight: normal;">
                        <span id="jenis_kb_text">{{$nama_layanan}}</span>
                        <select class="form-control" id="cboJenisKB" name="cboJenisKB" onchange="changePrice()" style="display: none;">
                          <?php foreach ($layanan as $key => $value): ?>
                              <?php if($key == 0){ ?>
                                  <option value="{{$value->id}}" selected>{{$value->nama}}</option>
                              <?php }else { ?>
                                  <option value="{{$value->id}}">{{$value->nama}}</option>
                              <?php } ?>
                          <?php endforeach ?>
                        </select>  
                      </label>
                      <label class="control-label col-lg-3" style="font-weight: normal;">
                        <div class="form-group">
                          <button type="button" class="btn btn-primary" onclick="changeKB(this, 1)" id="btnChange"><i class="fa fa-edit"></i></button>
                          <button type="button" class="btn btn-danger" onclick="changeKB(this, 2)" id="btnClose" style="display: none;"><i class="fa fa-close"></i></button>
                        </div>
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
            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
              <div class="row">
                <div class="col-sm-12 col-md-6">
                </div>
              </div>
              <div class="form-group">
                <div class="form-group">
                  <label style="font-weight: normal;">
                    <input type="checkbox" class="flat-red" id="chkActiveObat" name="chkActiveObat"> Gunakan tabel obat
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-1" for="nama">Obat</label>
                  <label class="control-label col-sm-4" for="nama">
                    <select class="form-control" id="txtObat" name="txtObat" disabled>
                      <?php foreach ($obat as $key => $value): ?>
                          <?php if($key == 0){ ?>
                              <option value="{{$value->id}}" value2="{{$value->harga}}" selected>{{$value->nama}}</option>
                          <?php }else { ?>
                              <option value="{{$value->id}}" value2="{{$value->harga}}">{{$value->nama}}</option>
                          <?php } ?>
                      <?php endforeach ?>
                    </select>
                  </label>
                  <input type="hidden" id="harga_obat" name="harga_obat"></input>
                  <label class="control-label col-sm-2" for="nama"><input type="button" id="btnTambah" class="btn btn-primary" onclick="tambah_tabel()" value="Tambah" disabled></input></label>
                </div>
                <div class="row" id="divTable" style="display: none;">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Obat yang dipakai</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0">
                        <table class="table table-bordered table-striped" id="tabelDataObat">
                          <tr id="tambahDataObat">
                            <th>Nama</th>
                            <th>Kuantitas</th>
                            <th>Satuan</th>
                            <th>Harga Satuan</th>
                            <th>Total</th>
                            <th></th>
                          </tr>
                          <tr>

                          </tr>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                </div><!-- /.row -->
                <div class="form-group" id="divTotalObat" style="display: none;">
                  <label class="control-label col-sm-2" for="nama">Total Harga Obat : </label>
                  <label class="control-label col-sm-4" for="nama" style="font-weight: normal;" id="lblGrandTotal">
                    Rp. 0,-
                  </label>
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
                      Rp. <span id="harga_layanan">{{$layanankbArr[0]->layanan->tarif_layanan}}</span> ,-
                    </label>
                  </div> 
                  <span id="titleObat"></span>
                  <div id="list_obat">

                  </div>
                  <div class="form-group"> 
                    <label class="control-label col-sm-3">Total Harga :</label> 
                    <label class="control-label col-lg-8">
                      Rp. <span id="totalHarga">0</span> ,-
                    </label>
                  </div>
                  @php
                      // dd($layanankbArr[0]);
                  @endphp
                  <div class="form-group">
                    <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                    <input type="hidden" id="txtIdObat" name="txtIdObat">
                    <input type="hidden" id="txtIdLayanan" name="txtIdLayanan" value="{{$layanankbArr[0]['id_jenis_layanan']}}">
                    <input type="hidden" id="txtIdKartu" name="txtIdKartu" value="{{$layanankbArr[0]['id']}}">
                    <input type="hidden" id="txtQtyObat" name="txtQtyObat">
                    <input type="hidden" id="txtGrandtotalObatTambah" name="txtGrandtotalObatTambah">
                    <input type="hidden" name="detectChangeKB" id="detectChangeKB" value="0"></input>
                    <input type="hidden" name="detectUseObat" id="detectUseObat" value="0"></input>
                    <input type="hidden" name="txtTotalObat" id="txtTotalObat"></input>
                    <input type="hidden" name="txtIdPasien" id="txtIdPasien" value="{{$layanankbArr[0]['no_regis']}}"></input>
                    <input type="hidden" name="obat_id" id="obat_id"></input>
                    <input type="hidden" name="txtTarifLayanan" id="txtTarifLayanan" value="{{$layanankbArr[0]->layanan->tarif_layanan}}"></input>
                    <input type="hidden" name="txtTarifTotal" id="txtTarifTotal"></input>
                    <button class="btn btn-primary"><i class="fa fa-save nav-icon"></i> Simpan</button>
                  </div>
                </div>
              </div>
            </div> 
          </div>  
        </div>
      </div>
    </div>
  </form>
</div>

@endsection
<!-- plugin js -->
@section('plugin_js')

@endsection

<!-- add js -->
@section('add_js')
<script>
  var counter = 1;
  var idTerpilih = new Array();
  function tambah_tabel(){
    var value = parseInt(document.getElementById('txtObat').value);
    if (idTerpilih.includes(value))
    {
      alert('Anda menambahkan obat yang sama'); 
    }
    else
    {
      var newTextBoxDiv = $(document.createElement('tr')).attr("id", 'trdata'+ counter);

      var namaobat =  $('#txtObat option:selected').text();
      var harga =  $('#txtObat option:selected')[0].getAttribute('value2');

      newTextBoxDiv.after().html(
        '<td>'+namaobat+'</td>'+
        '<td contenteditable style="text-align: right;" name="qtyobat[]" onkeyup="return countSubtotalObat('+harga+', this, '+counter+')" onkeypress="return isNumberKey(event, '+harga+', this)">1</td>'+
        '<td>PCS/BUTIR</td>'+
        '<td>'+harga+'</td>'+
        '<td id="totalhargaobat'+counter+'" name="totalhargaobat[]">'+harga+'</td>'+
        '<td><span class="btn btn-danger" onclick="kurang_tabel('+counter+','+document.getElementById('txtObat').value+')"><i class="fa fa-times-circle"></i></span></td>');

      newTextBoxDiv.appendTo("#tabelDataObat");
      var idObatInt = parseInt(document.getElementById('txtObat').value);
      idTerpilih.push(idObatInt);
      // listSubtotal.push(document.getElementById("totalhargaobat"+counter).textContent);
      countGrandtotal();
      document.getElementById('txtIdObat').value = idTerpilih;
      console.log("TAMBAH TABLE");
      console.log(idTerpilih);
      counter++;
    }
    
  }

  function kurang_tabel(counterr, id){
    if(counter==1){
      alert("No more textbox to remove");
      return false;
    }
    else
    {
      counter--;
    }

    //counter--;
    $("#trdata" + counterr).remove();
    countGrandtotal();
    // removeA(idTerpilih, ''+id+'');
    var index = idTerpilih.indexOf(id);
    if (index !== -1) {
      idTerpilih.splice(index, 1);
    }
    console.log("KURANG TABLE");
    console.log(idTerpilih);
    // removeA(listSubtotal, ''+id+'');
    document.getElementById('txtIdObat').value = idTerpilih;
  }

  function removeA(arr) {
    var what, a = arguments, L = a.length, ax;
    while (L > 1 && arr.length) {
      what = a[--L];
      while ((ax= arr.indexOf(what)) !== -1) {
        arr.splice(ax, 1);
      }
    }
    return arr;
  }

  function changeKB(btn, idx){
    if(idx == 1){
      document.getElementById('jenis_kb_text').style.display = 'none';
      document.getElementById('cboJenisKB').style.display = 'block';
      btn.style.display = "none";
      document.getElementById('btnClose').style.display = "block";
      document.getElementById('detectChangeKB').value = "1";
      changePrice();
    }
    else{
      document.getElementById('jenis_kb_text').style.display = 'block';
      document.getElementById('cboJenisKB').style.display = 'none';
      btn.style.display = "none";
      document.getElementById('btnChange').style.display = "block";
      document.getElementById('detectChangeKB').value = "0";
      changePrice();
    }
  }

  function changePrice(){
    if(document.getElementById("detectChangeKB").value == "0"){
      var id = document.getElementById("txtIdLayanan").value;
      document.getElementById("titleObat").innerHTML = '';
      document.getElementById("list_obat").innerHTML = '';
      document.getElementById('obat_id').value = "";
      document.getElementById('harga_layanan').innerHTML = (<?php echo $layanankbArr[0]->layanan->tarif_layanan ?>).toLocaleString();
      document.getElementById('txtTarifLayanan').value = <?php echo $layanankbArr[0]->layanan->tarif_layanan ?>;
      countAllPayment();
    }
    else{
      var id = document.getElementById("cboJenisKB").value;
      var url = "{{ url('/layanan-kb/getHargaLayanan') }}";
      $.ajax({
        type:"POST",
        url:url,
        data:{layanan_id:id,_token:"{{ csrf_token() }}"},
        success:function(data){
            var resp = $.parseJSON(data);
            console.log(resp);
            document.getElementById("list_obat").innerHTML = "";
            document.getElementById('obat_id').value = "";

            var total_obat = 0;
            for(var i = 0; i < resp.length; i++)
            {
              total_obat += parseInt(resp[i].subtotal);
              document.getElementById("titleObat").innerHTML = '<label class="control-label col-sm-4"style>2. Obat yang diberikan :</label>';
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
            // document.getElementById('txtTarifTotal').value = resp[0].tarif_total;
            countAllPayment();
          }
      });
    }
  }

  function activeObat() {
    document.getElementById('txtObat').disabled = true;
    document.getElementById('btnTambah').disabled = true;
  }

  function isNumberKey(evt, harga, val)
  {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){
      return false;
    }

    return true;
  }

  function countSubtotalObat(harga, val, counter){
    document.getElementById("totalhargaobat"+counter).innerHTML = (val.textContent * harga).toLocaleString();
    countGrandtotal();
  }

  function countGrandtotal(){
    var grandtotalobat = 0;
    var totalhargaobat = document.getElementsByName("totalhargaobat[]");
    
    for(var i = 0; i < totalhargaobat.length; i++){
      var str_harga = totalhargaobat[i].textContent;
      var tothargaobat = str_harga.replace(",", "");
      grandtotalobat += parseInt(tothargaobat);
    }
    document.getElementById("lblGrandTotal").innerHTML = "Rp. "+(grandtotalobat).toLocaleString()+",-";
    document.getElementById("txtGrandtotalObatTambah").value = grandtotalobat;

    countAllPayment();
  }

  function countAllPayment(){
    var grandtotalobat = ((document.getElementById("txtGrandtotalObatTambah").value != "") ? document.getElementById("txtGrandtotalObatTambah").value : 0);
    if(document.getElementById("detectChangeKB").value == "0"){
      var allpayment = parseInt(grandtotalobat) + parseInt(document.getElementById("txtTarifLayanan").value);
    }
    else{
      var allpayment = parseInt(grandtotalobat) + parseInt(document.getElementById("txtTotalObat").value) + parseInt(document.getElementById("txtTarifLayanan").value); 
    }

    document.getElementById("totalHarga").innerHTML = allpayment.toLocaleString();
    document.getElementById("txtTarifTotal").value = allpayment;
  }

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
    var idQty = new Array();
    var idQty2 = new Array();
    var idObat = new Array();
    if(document.getElementById("detectChangeKB").value == "1"){
      var id = document.getElementById("cboJenisKB").value;
      var url = <?php echo "'".URL::to('/getHargaLayanan')."'"; ?>;
      $.ajax({
        type:"GET",
        url:url,
        data:{layanan_id:id},
        success:function(data){
            var resp = $.parseJSON(data);
            document.getElementById('txtIdObat').value = "";
            for(var i = 0; i < resp.length; i++)
            {
                idObat.push(resp[i].id_obat);
                idQty2.push(resp[i].qty);
            }
            
            if(document.getElementById("detectUseObat").value == "1"){
                var qtyobat = document.getElementsByName("qtyobat[]");

                for(var i = 0; i < qtyobat.length; i++){
                    var idqtyInt = parseInt(qtyobat[i].textContent);
                    idQty.push(idqtyInt);
                }

                for(var a = 0; a < idTerpilih.length; a++)
                {
                  if(idObat.indexOf(idTerpilih[a]) != -1){
                    var index = idObat.indexOf(idTerpilih[a]);
                    var jmlh_qty = idQty2[index] + idQty[a];
                    idQty2.splice(index, 1, jmlh_qty); //hapus value berdasarkan indexnya dan digantikan value yg dihapus tersebut dengan jmlh_qty
                  }
                  else{
                    idObat.push(idTerpilih[a]);
                    idQty2.push(idQty[a]);
                  }
                }


                document.getElementById('txtIdObat').value = idObat;
                document.getElementById('txtQtyObat').value = idQty2;

                console.log("id terpilih1");
                console.log(idObat);
                console.log("id qty1");
                console.log(idQty2);

                if(idQty2.includes('0') && idQty2.includes(''))
                {
                  alert('Kuantitas obat tidak boleh Nol');
                }
                else
                {
                  if(idObat.length != idQty2.length){
                    alert("Terjadi kesalahan");
                  }
                  else{
                    var url = "{{ url('/layanan-kb/cekStokObat2') }}";
                    $.ajax({
                      type:"POST",
                      url:url,
                      data:{txtIdObat:idObat, "txtQtyObat":idQty2,_token:"{{ csrf_token() }}"},
                      success:function(data){
                          var resp = $.parseJSON(data);
                          if(resp == true){
                            $("#modalSimpan").modal();
                            document.getElementById("pesan_konfirmasi").style.display = "block";
                            document.getElementById("pesan_error").style.display = "none";
                            document.getElementById("btn_simpan_history").style.display = "inline";
                          }
                          else{
                            $("#modalSimpan").modal();
                            document.getElementById("pesan_konfirmasi").style.display = "none";
                            document.getElementById("btn_simpan_history").style.display = "none";
                            document.getElementById("pesan_error").style.display = "block";
                            document.getElementById("pesan_error").innerHTML = 'Stok obat untuk layanan ini tidak mencukupi. Harap melakukan restock terlebih dahulu';
                          }
                        }
                    });
                  }
                }
            }
            else{
              console.log("id terpilih");
              console.log(idObat);
              console.log("id qty");
              console.log(idQty2);
              if(idObat.length != idQty2.length){
                alert("Terjadi kesalahan");
              }
              else{
                var url =  "{{ url('/layanan-kb/cekStokObat2') }}";
                $.ajax({
                  type:"POST",
                  url:url,
                  data:{txtIdObat:idObat, "txtQtyObat":idQty2,_token:"{{ csrf_token() }}"},
                  success:function(data){
                      var resp = $.parseJSON(data);
                      if(resp == true){
                        $("#modalSimpan").modal();
                        document.getElementById('txtIdObat').value = idObat;
                        document.getElementById('txtQtyObat').value = idQty2;

                        document.getElementById("pesan_konfirmasi").style.display = "block";
                        document.getElementById("pesan_error").style.display = "none";
                        document.getElementById("btn_simpan_history").style.display = "inline";
                      }
                      else{
                        $("#modalSimpan").modal();
                        document.getElementById("pesan_konfirmasi").style.display = "none";
                        document.getElementById("btn_simpan_history").style.display = "none";
                        document.getElementById("pesan_error").style.display = "block";
                        document.getElementById("pesan_error").innerHTML = 'Stok obat untuk layanan ini tidak mencukupi. Harap melakukan restock terlebih dahulu';
                      }
                    }
                });
              }
            }
          }
      });
    }
    else{
      if(document.getElementById("detectUseObat").value == "1"){
          var qtyobat = document.getElementsByName("qtyobat[]");

          for(var i = 0; i < qtyobat.length; i++){
              var idqtyInt = parseInt(qtyobat[i].textContent);
              idQty.push(idqtyInt);
          }        

          document.getElementById('txtIdObat').value = idTerpilih;
          document.getElementById('txtQtyObat').value = idQty;

          console.log("id terpilih2");
          console.log(idTerpilih);
          console.log("id qty2");
          console.log(idQty);

          if(idQty.includes('0') && idQty.includes(''))
          {
            alert('Kuantitas obat tidak boleh Nol');
          }
          else
          {
            if(idTerpilih.length != idQty.length){
              alert("Terjadi kesalahan");
            }
            else{
              var url =  "{{ url('/layanan-kb/cekStokObat2') }}";
              $.ajax({
                type:"POST",
                url:url,
                data:{txtIdObat:idTerpilih, "txtQtyObat":idQty,_token:"{{ csrf_token() }}"},
                success:function(data){
                    var resp = $.parseJSON(data);
                    if(resp == true){
                      $("#modalSimpan").modal();
                      document.getElementById("pesan_konfirmasi").style.display = "block";
                      document.getElementById("pesan_error").style.display = "none";
                      document.getElementById("btn_simpan_history").style.display = "inline";
                    }
                    else{
                      $("#modalSimpan").modal();
                      document.getElementById("pesan_konfirmasi").style.display = "none";
                      document.getElementById("btn_simpan_history").style.display = "none";
                      document.getElementById("pesan_error").style.display = "block";
                      document.getElementById("pesan_error").innerHTML = 'Stok obat untuk layanan ini tidak mencukupi. Harap melakukan restock terlebih dahulu';
                    }
                  }
              });
            }
          }
      }
      else{
        $("#modalSimpan").modal();
        document.getElementById("pesan_konfirmasi").style.display = "block";
        document.getElementById("pesan_error").style.display = "none";
        document.getElementById("btn_simpan_history").style.display = "inline";
      }
    }
  });
</script>

<script src="{{asset('dropify/dist/js/dropify.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    countAllPayment();

    $('input').on('ifChecked', function(event){
      document.getElementById('txtObat').disabled = false;
      document.getElementById('btnTambah').disabled = false;
      document.getElementById('detectUseObat').value = "1";
      document.getElementById("divTable").style.display = "block";
      document.getElementById("divTotalObat").style.display = "block";
    });

    $('input').on('ifUnchecked', function(event){
      document.getElementById('txtObat').disabled = true;
      document.getElementById('btnTambah').disabled = true;
      document.getElementById('detectUseObat').value = "0";
      document.getElementById("divTable").style.display = "none";
      document.getElementById("divTotalObat").style.display = "none";
      if(document.getElementById("tabelDataObat").rows.length){
        $("#tabelDataObat td").remove();
        countGrandtotal();
        idTerpilih = [];
      }
    });

    $('.datepicker2').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy',
      endDate: new Date()
    });

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
@endsection