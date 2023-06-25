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
        <FORM method="post" action="{{ route('klinik.tambah.pasien.history') }}"> 
          <div class="form-group"> 
            <span id="pesan_error" style="display: none;"></span>
            <span id="pesan_konfirmasi" style="display: none;">Apakah anda yakin ingin menyimpan data history yang bernilai <strong><span id="totalnya"></span></strong> ?</span>
          </div> 
          <div class="form-group"> 
            <input type="hidden" name="_token" value="{!!csrf_token()!!}"> 
            {{-- <input type="hidden" name="idSimpan" id="idSimpan" value=""> --}}
            <input type="hidden" name="jenis_pasien" value="dewasa">
            <input type="hidden" name="namanya" id="namanya" value="">
            <input type="hidden" name="tlnya" id="tlnya" value="">
            <input type="hidden" name="agamanya" id="agamanya" value="">
            <input type="hidden" name="alamatnya" id="alamatnya" value="">
            <input type="hidden" name="notelpnya" id="notelpnya" value="">
            <input type="hidden" name="keluhannya" id="keluhannya" value="">
            <input type="hidden" name="tindakannya" id="tindakannya" value="">
            <input type="hidden" name="obatnya" id="obatnya" value="">
            <input type="hidden" name="harga_layanannya" id="harga_layanannya" value="">
            <button class="btn btn-default" data-dismiss="modal" aria-label="Close">Tutup</button> 
            <button class="btn btn-primary" style="display: none;" id="btn_simpan_history" onclick="load()">Simpan</button> 
          </div> 
        </FORM> 
      </div> 
    </div> 
  </div> 
</div>
<!-- tutup modal simpan -->
<!-- modal simpan -->
<div class="modal fade" id="modalSimpan2" role="dialog" aria-labelledby="favoritesModalLabel"> 
  <div class="modal-dialog" role="document"> 
    <div class="modal-content" style="border-radius: 17px;"> 
      <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;"> 
        <h4 style="color:white;">Simpan Data History</h4> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
          <span aria-hidden="true">&times;</span>
        </button> 
      </div> 
      <div class="modal-body"> 
        <FORM method="post" action="<?php echo URL::to('/klinik_tambah_pasien_bayi_history')?>"> 
          <div class="form-group"> 
            <span id="pesan_error2" style="display: none;"></span>
            <span id="pesan_konfirmasi2" style="display: none;">Apakah anda yakin ingin menyimpan data history yang bernilai <strong><span id="totalnya2"></span></strong> ?</span>
          </div> 
          <div class="form-group"> 
            <input type="hidden" name="_token" value="{!!csrf_token()!!}"> 
            <!-- <input type="hidden" name="idSimpan" id="idSimpan" value=""> -->
            <input type="hidden" name="jenis_pasien" value="bayi">
            <input type="hidden" name="namanya2" id="namanya2" value="">
            <input type="hidden" name="tlnya2" id="tlnya2" value="">
            <input type="hidden" name="agamanya2" id="agamanya2" value="">
            <input type="hidden" name="alamatnya2" id="alamatnya2" value="">
            <input type="hidden" name="notelpnya2" id="notelpnya2" value="">
            <input type="hidden" name="keluhannya2" id="keluhannya2" value="">
            <input type="hidden" name="tindakannya2" id="tindakannya2" value="">
            <input type="hidden" name="obatnya2" id="obatnya2" value="">
            <input type="hidden" name="kelurahan2" id="kelurahan2" value="">
            <input type="hidden" name="asalwilayah2" id="asalwilayah2" value="">
            <input type="hidden" name="kelamin2" id="kelamin2" value="">
            <input type="hidden" name="harga_layanannya2" id="harga_layanannya2" value="">
            <button class="btn btn-default" data-dismiss="modal" aria-label="Close">Tutup</button> 
            <button class="btn btn-primary" style="display: none;" id="btn_simpan_history2" onclick="load()">Simpan</button> 
          </div> 
        </FORM> 
      </div> 
    </div> 
  </div> 
</div>
<!-- tutup modal simpan -->

<br>
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h3>Tambah Pasien Pelayanan Klinik</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/klinik')}}">Pelayanan Klinik</a></li>
        <li class="breadcrumb-item active">Tambah Pasien Pelayanan Klinik</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <!-- <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-1 col-4" data-toggle="tooltips" title="Tambah">
              <button type="button" class="btn btn-block btn-primary btn-sm" id="btnAdd" data-toggle="modal" 
              data-target="#modalTambah"><i class="fa fa-plus-circle nav-icon"></i> Tambah</button>
            </div>
          </div>
        </div>
      </div>
    </div> -->
  </div>


  <div class="row">
    <div class="col-12">
      <!-- Custom Tabs -->
      <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">Pasien</h3>
          <ul class="nav nav-pills ml-auto p-2">
            <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Dewasa</a></li>
            <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Bayi</a></li>
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
              <!-- <form class="form-horizontal" action="#"> -->
                <div class="form-group row">
                  <label class="control-label col-sm-2" for="nama">Nama</label>
                  <label class="control-label col-sm-4" for="nama">
                    <input type="text" class="form-control" id="txtNama" name="txtNama" placeholder="Nama Pasien" value="" oninput='txtNama.style.backgroundColor = "#FFF"'>  
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-2" for="nama">Tanggal Lahir</label>
                  <label class="control-label col-sm-4" for="nama">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-calendar"></i>
                        </span>
                      </div>
                      <input type="text" name="txtTAnggalLahir" class="form-control pull-right datepicker" id="txtTAnggalLahir"  onchange='txtTAnggalLahir.style.backgroundColor = "#FFF"'>
                    </div> 
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-2" for="nama">Agama</label>
                  <label class="control-label col-sm-4" for="nama">
                    <select class="form-control" id="txtAgama" name="txtAgama" onchange='txtAgama.style.backgroundColor = "#FFF"'>
                      <option selected disabled value="">Agama...</option>
                      <option value="atheis">Atheis</option>
                      <option value="budha">Budha</option>
                      <option value="hindu">Hindu</option>
                      <option value="islam">Islam</option>
                      <option value="kristen">Kristen</option>
                    </select>
                  </label> 
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-2" for="nama">Alamat</label>
                  <label class="control-label col-sm-4" for="nama">
                    <textarea rows="5" class="form-control" id="txtAlamat" name="txtAlamat" placeholder="Alamat" oninput='txtAlamat.style.backgroundColor = "#FFF"'></textarea>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-2" for="nama">No. Telp</label>
                  <label class="control-label col-sm-4" for="nama">
                    <input type="text" class="form-control" id="txtNoTelp" name="txtNoTelp" placeholder="0813" oninput='txtNoTelp.style.backgroundColor = "#FFF"'>
                  </label> 
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-2" for="nama">Keluhan</label>
                  <label class="control-label col-sm-4" for="nama">
                    <textarea class="form-control" id="txtKeluhan" name="txtKeluhan" placeholder="keluhan yang diderita" oninput='txtKeluhan.style.backgroundColor = "#FFF"' rows="5" required></textarea>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-2" for="nama">Tindakan</label>
                  <label class="control-label col-sm-4" for="nama">
                    <textarea class="form-control" id="txtTindakan" name="txtTindakan" placeholder="tindakan yang diberikan" oninput='txtTindakan.style.backgroundColor = "#FFF"' rows="5" required></textarea>
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="nama">Obat</label>
                  <label class="control-label col-sm-4" for="nama">
                    <select class="form-control" id="txtObat" name="txtObat" >
                      <option selected disabled value="">Obat...</option>
                      <?php
                      $obat = DB::table('obat')->where('status_hapus',0)->where('total_pcs','>',0)->get();
                      ?>
                      @foreach($obat as $value)
                      <option value="{{$value->id}}" data-value="{{$value->harga}}" stok-value="{{$value->total_pcs}}">{{$value->nama}}</option>
                      @endforeach
                      <!-- <option value="paramex">Paramex</option>
                      <option value="konidin">Konidin</option>
                      <option value="komix">komix</option>
                      <option value="obh">OBH</option>
                      <option value="promaag">Promaag</option> -->
                    </select>
                  </label>
                  <label class="control-label col-sm-2" for="nama"><span class="btn btn-primary" onclick="tambah_tabel()">Tambah</span></label>
                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Obat yang dipakai</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0">
                        <table class="table table-bordered table-striped" id="tabelDataObat">
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kuantitas</th>
                            <th>Satuan</th>
                            <th>Harga Satuan</th>
                            <th>Total</th>
                            <th></th>
                          </tr>
                          <!-- <tr>
                            <td>1</td>
                            <td>Paramex</td>
                            <td contenteditable style="text-align: right;">1</td>
                            <td>Tablet</td>
                            <td style="text-align: right;">10.000</td>
                            <td style="text-align: right;">10.000</td>
                            <td><span class="btn btn-danger">X</span></td>
                          </tr> -->
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                </div><!-- /.row -->
                <div class="form-group">
                  <label class="control-label col-sm-2" for="nama">Harga Layanan (Rp)</label>
                  <label class="control-label col-sm-4" for="nama">
                    <input type="text" class="form-control" id="txtHargaLayanan" name="txtHargaLayanan" onkeyup="hitung_total_harga()" placeholder="" style="text-align: right;" value="0" >
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="nama">Total Harga :</label>
                  <label class="control-label col-sm-4" style="font-weight: normal;" id="lbl_total_harga">
                    Rp. 0
                  </label>
                </div>

                <div class="form-group">
                  <button type="submit" name="simpan" class="btn btn-primary" onclick="opensimpanmodal()"><i class="fa fa-save nav-icon"></i> Simpan</button>
                  <!-- <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-save nav-icon"></i> Simpan</button> -->
                </div>

              <!-- </form> -->

            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">
              <!-- <form class="form-horizontal" action="#"> -->
                <div class="form-group row">
                  <label class="control-label col-sm-2" for="nama">Nama Bayi</label>
                  <label class="control-label col-sm-4" for="nama">
                    <input type="text" class="form-control" id="txtNama2" name="txtNama2" placeholder="Nama Pasien" oninput='txtNama2.style.backgroundColor = "#FFF"' > 
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-2" for="nama">Jenis Kelamin</label>
                  <label class="control-label col-sm-4" for="nama">
                    <select class="form-control" id="cbxKelamin" name="cbxKelamin" style="width: 100%;">
                      <option value="L">Laki-laki</option>
                      <option value="P">Perempuan</option>
                    </select>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-2" for="nama">Tanggal Lahir</label>
                  <label class="control-label col-sm-4" for="nama">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-calendar"></i>
                        </span>
                      </div>
                      <input type="text" name="txtTAnggalLahir2" class="form-control pull-right datepicker" id="txtTAnggalLahir2" onchange='txtTAnggalLahir2.style.backgroundColor = "#FFF"'>
                    </div> 
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-2" for="nama">Agama:</label>
                  <label class="control-label col-sm-4" for="nama">
                    <select class="form-control" id="txtAgama2" name="txtAgama2" onchange='txtAgama2.style.backgroundColor = "#FFF"'>
                      <option selected disabled value="">Agama...</option>
                      <option value="atheis">Atheis</option>
                      <option value="budha">Budha</option>
                      <option value="hindu">Hindu</option>
                      <option value="islam">Islam</option>
                      <option value="kristen">Kristen</option>
                    </select>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-2" for="nama">Kelurahan</label>
                  <label class="control-label col-sm-4" for="nama">
                    <input type="text" class="form-control" id="txtKelurahan" name="txtKelurahan" placeholder="Kelurahan" autocomplete="off" oninput='this.style.backgroundColor = "#FFF"' required>
                  </label>                
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-2" for="nama">Asal Wilayah</label>
                  <label class="control-label col-sm-4" for="nama">
                    <input type="text" class="form-control" id="txtAsalWilayah" name="txtAsalWilayah" placeholder="Asal Wilayah" autocomplete="off" oninput='this.style.backgroundColor = "#FFF"' required>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-2" for="nama">Alamat</label>
                  <label class="control-label col-sm-4" for="nama">
                    <textarea rows="5" class="form-control" id="txtAlamat2" name="txtAlamat2" placeholder="Alamat"
                    oninput='txtAlamat2.style.backgroundColor = "#FFF"'></textarea>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-2" for="nama">No. Telp Orang Tua</label>
                  <label class="control-label col-sm-4" for="nama">
                    <input type="text" class="form-control" id="txtNoTelp2" name="txtNoTelp2" placeholder="0813" 
                    oninput='txtNoTelp2.style.backgroundColor = "#FFF"'>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-2" for="nama">Keluhan</label>
                  <label class="control-label col-sm-4" for="nama">
                    <textarea rows="5" class="form-control" id="txtKeluhan2" name="txtKeluhan2" placeholder="keluhan yang diderita" oninput='txtKeluhan2.style.backgroundColor = "#FFF"'></textarea>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-2" for="nama">Tindakan</label>
                  <label class="control-label col-sm-4" for="nama">
                    <textarea rows="5" class="form-control" id="txtTindakan2" name="txtTindakan2" placeholder="tindakan yang diberikan" oninput='txtTindakan2.style.backgroundColor = "#FFF"'></textarea>
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="nama">Obat</label>
                  <label class="control-label col-sm-4" for="nama">
                    <select class="form-control" id="txtObat2" name="txtObat2" >
                      <option selected disabled value="">Obat...</option>
                      <?php
                      $obat = DB::table('obat')->where('status_hapus',0)->where('total_pcs','>',0)->get();
                      ?>
                      @foreach($obat as $value)
                      <option value="{{$value->id}}" data-value="{{$value->harga}}" stok-value="{{$value->total_pcs}}">{{$value->nama}}</option>
                      @endforeach
                      <!-- <option value="paramex">Paramex</option>
                      <option value="konidin">Konidin</option>
                      <option value="komix">komix</option>
                      <option value="obh">OBH</option>
                      <option value="promaag">Promaag</option> -->
                    </select>
                  </label>
                  <label class="control-label col-sm-2" for="nama"><span class="btn btn-primary" onclick="tambah_tabel2()">Tambah</span></label>
                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Obat yang dipakai</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0">
                        <table class="table table-hover" id="tabelDataObat2">
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kuantitas</th>
                            <th>Satuan</th>
                            <th>Harga Satuan</th>
                            <th>Total</th>
                            <th></th>
                          </tr>
                          <!-- <tr>
                            <td>1</td>
                            <td>Paramex</td>
                            <td contenteditable style="text-align: right;">1</td>
                            <td>Tablet</td>
                            <td style="text-align: right;">10.000</td>
                            <td style="text-align: right;">10.000</td>
                            <td><span class="btn btn-danger">X</span></td>
                          </tr> -->
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                </div><!-- /.row -->
                <div class="form-group">
                  <label class="control-label col-sm-2" for="nama">Harga Layanan (Rp)</label>
                  <label class="control-label col-sm-4" for="nama">
                    <input type="text" class="form-control" id="txtHargaLayanan2" name="txtHargaLayanan2" onkeyup="hitung_total_harga2()" placeholder="" style="text-align: right;" value="0" >
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="nama">Total Harga :</label>
                  <label class="control-label col-sm-4" style="font-weight: normal;" id="lbl_total_harga2">
                    Rp. 0
                  </label>
                </div>

                <div class="form-group">
                  <button type="submit" name="simpan" class="btn btn-primary"  onclick="opensimpanmodal2()"><i class="fa fa-save nav-icon"></i> Simpan</button>
                  <!-- <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-save nav-icon"></i> Simpan</button> -->
                </div>

              <!-- </form> -->
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
        </div><!-- /.card-body -->
      </div>
      <!-- ./card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <!-- END CUSTOM TABS -->
</div>
@endsection
<!-- plugin js -->
@section('plugin_js')

@endsection

<!-- add js -->
@section('add_js')
<script>
  /*orang dewasa*/
  var idxObat = [];
  var counterObat = [];
  var counter = 1;
  function tambah_tabel(){
    var newTextBoxDiv = $(document.createElement('tr')).attr("id", 'trdata'+ counter);
    var namaobat =  $('#txtObat option:selected').text();
    var idobat =  $('#txtObat option:selected').val();
    var harga_satuanObat = $('#txtObat option:selected').attr('data-value');
    var stoknya_obat = $('#txtObat option:selected').attr('stok-value');
    var total_hargaObat = harga_satuanObat * 1;

    if(idobat!=''){
      if(idxObat.indexOf(idobat) != -1)
      {  
        var idxCounter = counterObat[idxObat.indexOf(idobat)];
        var ttl_qty_obt = parseInt($('#qty_Obat'+idxCounter).text());
        $('#qty_Obat'+idxCounter).html(ttl_qty_obt+1);
        $('#total_harga'+idxCounter).html(((ttl_qty_obt+1)*harga_satuanObat).toLocaleString());
      }
      else{
        idxObat.push(idobat);
        counterObat.push(counter);
        newTextBoxDiv.after().html('<td>1</td>'+
          '<td data-value=\''+idobat+'\' id="obat'+counter+'">'+namaobat+'</td>'+
          '<td contenteditable style="text-align: right;" id="qty_Obat'+counter+'" onkeyup="ubah_total_harga_obat('+counter+')" onkeypress="return boleh_input_angka(event,'+counter+')">1</td>'+
          '<td>Tablet</td>'+
          '<td style="text-align: right;" id="harga_satuanObat'+counter+'">'+parseInt( harga_satuanObat ).toLocaleString()+'</td>'+
          '<td style="text-align: right;" id="total_harga'+counter+'">'+parseInt( total_hargaObat ).toLocaleString()+'</td>'+
          '<td><span class="btn btn-danger" onclick="kurang_tabel('+counter+')">X</span></td>');

        newTextBoxDiv.appendTo("#tabelDataObat");

        counter++;
      }
      
    }    
    hitung_total_harga();
  }

  function validasi_form(){

    var namanya = $('#txtNama').val();
    var tlnya = $('#txtTAnggalLahir').val();
    var agamanya = $('#txtAgama option:selected').val();
    var alamatnya = $('#txtAlamat').val();
    var notelpnya = $('#txtNoTelp').val();
    var keluhannya = $('#txtKeluhan').val();
    var tindakannya = $('#txtTindakan').val();


    if(keluhannya.length > 0 && tindakannya.length > 0 && namanya.length > 0 && tlnya.length > 0 && agamanya.length > 0 && alamatnya.length > 0 && notelpnya.length > 0){
      $stringhasil = "";
    }
    else{

      if(tindakannya.length == 0){
          txtTindakan.style.backgroundColor = "#ffdddd";
          txtTindakan.focus();
      }
      if(keluhannya.length == 0){
          txtKeluhan.style.backgroundColor = "#ffdddd";
          txtKeluhan.focus();
      }
      if(notelpnya.length == 0){
          txtNoTelp.style.backgroundColor = "#ffdddd";
          txtNoTelp.focus();
      }
      if(alamatnya.length == 0){
          txtAlamat.style.backgroundColor = "#ffdddd";
          txtAlamat.focus();
      }
      if(agamanya.length == 0){
          txtAgama.style.backgroundColor = "#ffdddd";
          txtAgama.focus();
      }
      if(tlnya.length == 0){
          txtTAnggalLahir.style.backgroundColor = "#ffdddd";
          // txtTAnggalLahir.focus();
      }
      if(namanya.length == 0){
          txtNama.style.backgroundColor = "#ffdddd";
          txtNama.focus();
      }
      
      $stringhasil = "data harus diisi dengan baik";
    }

    /*
    $stringhasil = keluhannya.length > 0 ? "" : "Teks keluhan harus diisi <br>";
    $stringhasil += tindakannya.length > 0 ? "" : "Teks tindakan harus diisi <br>";
    */

    return $stringhasil;
  }

  function hitung_total_harga(){
    var hargaObatnya = 0;
    
    $('#tabelDataObat tr').each(function(index) {  
      if(index!=0){
        hargaObatnya += parseInt($(":nth-child(6)", $(this)).text().replace(',', ''));
      }
    });
    
    var harga_layanan = $('#txtHargaLayanan').unmask() =="" ? 0 : $('#txtHargaLayanan').unmask();
    var total_harga = hargaObatnya + parseInt(harga_layanan);
    $('#lbl_total_harga').html("Rp. "+parseInt(total_harga).toLocaleString())

  }

  function ubah_total_harga_obat(id){
    var yang_gak_boleh = new Array("", "0");
    
    var qtynya = yang_gak_boleh.indexOf($('#qty_Obat'+id).text()) != -1 ? 1 : $('#qty_Obat'+id).text();
    if(yang_gak_boleh.indexOf($('#qty_Obat'+id).text()) != -1){
      $('#qty_Obat'+id).text(qtynya);
    } 
    var harga_satuannya = $('#harga_satuanObat'+id).text();
    var total_harganya = parseInt(harga_satuannya.replace(',', ''))*qtynya;
    $('#total_harga'+id).html(parseInt( total_harganya ).toLocaleString());
    hitung_total_harga();
  }

  function boleh_input_angka(evt, idcounter) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if ((charCode > 31 && (charCode < 48 || charCode > 57))|| charCode==13){
      return false;
    }
    return true;
  }

  function kurang_tabel(id){
    if(counter==1){
      alert("No more textbox to remove");
      return false;
    }   

    var idObat = $("#obat"+ id).attr('data-value');
    idxObat.pop(idObat);
    counterObat.pop(id);

    $("#trdata" + id).remove();
    hitung_total_harga();
  }

  function opensimpanmodal(){
    //modalSimpan.style.display = "block";

    var dataObatTerpakai = eachCell();

    // document.getElementById('idSimpan').value = id;

    document.getElementById('namanya').value = $('#txtNama').val();
    document.getElementById('tlnya').value = $('#txtTAnggalLahir').val();
    document.getElementById('agamanya').value = $('#txtAgama').val();
    document.getElementById('alamatnya').value = $('#txtAlamat').val();
    document.getElementById('notelpnya').value = $('#txtNoTelp').val();
    document.getElementById('keluhannya').value = $('#txtKeluhan').val(); 
    document.getElementById('tindakannya').value = $('#txtTindakan').val();
    document.getElementById('harga_layanannya').value = $('#txtHargaLayanan').val();
    document.getElementById('obatnya').value = dataObatTerpakai;

    if(dataObatTerpakai.length>1){
      $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type:"POST",
        url:"{{ route('klinik.cek.stok.obat') }}",
        data:{ obatnya:dataObatTerpakai },
        success:function(data){

          if(data=="" && validasi_form()==""){
            $("#modalSimpan").modal();
            pesan_error.style.display = "none";
            btn_simpan_history.style.display="inline";
            pesan_konfirmasi.style.display = "block";

          }
          else{
            $("#modalSimpan").modal();
            btn_simpan_history.style.display="none";
            pesan_konfirmasi.style.display = "none";
            pesan_error.style.display = "block";
            document.getElementById('pesan_error').innerHTML = data;
          }
        }
      });
    }
    else{
      if(validasi_form()==""){
        $("#modalSimpan").modal();
        pesan_error.style.display = "none";
        btn_simpan_history.style.display="inline";
        pesan_konfirmasi.style.display = "block";
      }
      else{
        /*
            btn_simpan_history.style.display="none";
            pesan_konfirmasi.style.display = "none";
            pesan_error.style.display = "block";
            document.getElementById('pesan_error').innerHTML = validasi_form()+data;
            */
      }
    }
    document.getElementById('totalnya').innerHTML = $('#lbl_total_harga').text();
  }

  function eachCell(){
    var idObatnya = [];
    var qtyObatnya = [];
    $('#tabelDataObat tr').each(function(index) {   
      if(index!=0){
        console.log($(":nth-child(2)", $(this))[0]);

        idObatnya.push($(":nth-child(2)", $(this)).attr('data-value'));
        qtyObatnya.push($(":nth-child(3)", $(this)).text());
      }
    });
    var hasil =  idObatnya.join(",") + ';' + qtyObatnya.join(",");
    return hasil;
  }
  /*end orang dewasa*/

  /*anak bayi*/
  var idxObat2 = [];
  var counterObat2 = [];
  var counter2 = 1;
  function tambah_tabel2(){
    var newTextBoxDiv = $(document.createElement('tr')).attr("id", '2trdata'+ counter);
    var namaobat =  $('#txtObat2 option:selected').text();
    var idobat =  $('#txtObat2 option:selected').val();
    var harga_satuanObat = $('#txtObat2 option:selected').attr('data-value');
    var stoknya_obat = $('#txtObat2 option:selected').attr('stok-value');
    var total_hargaObat = harga_satuanObat * 1;

    if(idobat!=''){
      if(idxObat2.indexOf(idobat) != -1)
      {  
        var idxCounter = counterObat2[idxObat2.indexOf(idobat)];
        var ttl_qty_obt = parseInt($('#2qty_Obat'+idxCounter).text());
        $('#2qty_Obat'+idxCounter).html(ttl_qty_obt+1);
        $('#2total_harga'+idxCounter).html(((ttl_qty_obt+1)*harga_satuanObat).toLocaleString());
      }
      else{
        idxObat2.push(idobat);
        counterObat2.push(counter);
        newTextBoxDiv.after().html('<td>1</td>'+
          '<td data-value=\''+idobat+'\' id="2obat'+counter2+'">'+namaobat+'</td>'+
          '<td contenteditable style="text-align: right;" id="2qty_Obat'+counter2+'" onkeyup="ubah_total_harga_obat2('+counter2+')" onkeypress="return boleh_input_angka(event,'+counter2+')">1</td>'+
          '<td>Tablet</td>'+
          '<td style="text-align: right;" id="2harga_satuanObat'+counter2+'">'+parseInt( harga_satuanObat ).toLocaleString()+'</td>'+
          '<td style="text-align: right;" id="2total_harga'+counter2+'">'+parseInt( total_hargaObat ).toLocaleString()+'</td>'+
          '<td><span class="btn btn-danger" onclick="kurang_tabel2('+counter2+')">X</span></td>');

        newTextBoxDiv.appendTo("#tabelDataObat2");

        counter2++;
      }
      
    }    
    hitung_total_harga2();
  }

  /*
  function validasi_form2(){

    var namanya = $('#txtNama2').val();
    var tlnya = $('#txtTAnggalLahir2').val();
    var agamanya = $('#txtAgama2 option:selected').val();
    var alamatnya = $('#txtAlamat2').val();
    var notelpnya = $('#txtNoTelp2').val();
    var keluhannya = $('#txtKeluhan2').val();
    var tindakannya = $('#txtTindakan2').val();
    $stringhasil = namanya.length > 0 ? "" : "Teks nama harus diisi <br>";
    $stringhasil += tlnya.length > 0 ? "" : "Teks tanggal lahir harus diisi <br>";
    $stringhasil += agamanya.length > 0 ? "" : "Teks agama harus diisi <br>";
    $stringhasil += alamatnya.length > 0 ? "" : "Teks alamat harus diisi <br>";
    $stringhasil += notelpnya.length > 0 ? "" : "Teks nomor telp harus diisi <br>";
    $stringhasil += keluhannya.length > 0 ? "" : "Teks keluhan harus diisi <br>";
    $stringhasil += tindakannya.length > 0 ? "" : "Teks tindakan harus diisi <br>";

    return $stringhasil;
  }
  */

  function validasi_form2(){

    var namanya = $('#txtNama2').val();
    var tlnya = $('#txtTAnggalLahir2').val();
    var agamanya = $('#txtAgama2 option:selected').val();
    var alamatnya = $('#txtAlamat2').val();
    var notelpnya = $('#txtNoTelp2').val();
    var keluhannya = $('#txtKeluhan2').val();
    var tindakannya = $('#txtTindakan2').val();
    var kelurahan = $('#txtKelurahan').val();
    var asalwilayah = $('#txtAsalWilayah').val();


    if(keluhannya.length > 0 && tindakannya.length > 0 && namanya.length > 0 && tlnya.length > 0 && agamanya.length > 0 && alamatnya.length > 0 && notelpnya.length > 0 && kelurahan.length > 0 && asalwilayah.length > 0){
      $stringhasil = "";
    }
    else{

      if(kelurahan.length == 0){
          txtKelurahan.style.backgroundColor = "#ffdddd";
          txtKelurahan.focus();
      }
      if(asalwilayah.length == 0){
          txtAsalWilayah.style.backgroundColor = "#ffdddd";
          txtAsalWilayah.focus();
      }
      if(tindakannya.length == 0){
          txtTindakan2.style.backgroundColor = "#ffdddd";
          txtTindakan2.focus();
      }
      if(keluhannya.length == 0){
          txtKeluhan2.style.backgroundColor = "#ffdddd";
          txtKeluhan2.focus();
      }
      if(notelpnya.length == 0){
          txtNoTelp2.style.backgroundColor = "#ffdddd";
          txtNoTelp2.focus();
      }
      if(alamatnya.length == 0){
          txtAlamat2.style.backgroundColor = "#ffdddd";
          txtAlamat2.focus();
      }
      if(agamanya.length == 0){
          txtAgama2.style.backgroundColor = "#ffdddd";
          txtAgama2.focus();
      }
      if(tlnya.length == 0){
          txtTAnggalLahir2.style.backgroundColor = "#ffdddd";
          // txtTAnggalLahir2.focus();
      }
      if(namanya.length == 0){
          txtNama2.style.backgroundColor = "#ffdddd";
          txtNama2.focus();
      }
      
      $stringhasil = "data harus diisi dengan baik";
    }

    /*
    $stringhasil = keluhannya.length > 0 ? "" : "Teks keluhan harus diisi <br>";
    $stringhasil += tindakannya.length > 0 ? "" : "Teks tindakan harus diisi <br>";
    */

    return $stringhasil;
  }

  function hitung_total_harga2(){
    var hargaObatnya = 0;
    
    $('#tabelDataObat2 tr').each(function(index) {  
      if(index!=0){
        hargaObatnya += parseInt($(":nth-child(6)", $(this)).text().replace(',', ''));
      }
    });
    
    var harga_layanan = $('#txtHargaLayanan2').unmask() =="" ? 0 : $('#txtHargaLayanan2').unmask();
    var total_harga = hargaObatnya + parseInt(harga_layanan);
    $('#lbl_total_harga2').html("Rp. "+parseInt(total_harga).toLocaleString())

  }

  function ubah_total_harga_obat2(id){
    var yang_gak_boleh = new Array("", "0");
    
    var qtynya = yang_gak_boleh.indexOf($('#2qty_Obat'+id).text()) != -1 ? 1 : $('#2qty_Obat'+id).text();
    if(yang_gak_boleh.indexOf($('#2qty_Obat'+id).text()) != -1){
      $('#2qty_Obat'+id).text(qtynya);
    } 
    var harga_satuannya = $('#2harga_satuanObat'+id).text();
    var total_harganya = parseInt(harga_satuannya.replace('.', ''))*qtynya;
    $('#2total_harga'+id).html(parseInt( total_harganya ).toLocaleString());
    hitung_total_harga2();
  }

  // function boleh_input_angka(evt, idcounter) {
  //   evt = (evt) ? evt : window.event;
  //   var charCode = (evt.which) ? evt.which : evt.keyCode;
  //   if ((charCode > 31 && (charCode < 48 || charCode > 57))|| charCode==13){
  //     return false;
  //   }
  //   return true;
  // }

  function kurang_tabel2(id){
    if(counter2==1){
      alert("No more textbox to remove");
      return false;
    }   

    var idObat = $("#2obat"+ id).attr('data-value');
    idxObat2.pop(idObat);
    counterObat2.pop(id);

    $("#2trdata" + id).remove();
    hitung_total_harga2();
  }

  function opensimpanmodal2(){
    //modalSimpan2.style.display = "block";

    var dataObatTerpakai = eachCell2();

    //document.getElementById('idSimpan').value = id;

    document.getElementById('namanya2').value = $('#txtNama2').val();
    document.getElementById('tlnya2').value = $('#txtTAnggalLahir2').val();
    document.getElementById('agamanya2').value = $('#txtAgama2').val();
    document.getElementById('alamatnya2').value = $('#txtAlamat2').val();
    document.getElementById('notelpnya2').value = $('#txtNoTelp2').val();
    document.getElementById('keluhannya2').value = $('#txtKeluhan2').val(); 
    document.getElementById('tindakannya2').value = $('#txtTindakan2').val();
    document.getElementById('harga_layanannya2').value = $('#txtHargaLayanan2').val();
    document.getElementById('kelurahan2').value = $('#txtKelurahan').val();
    document.getElementById('asalwilayah2').value = $('#txtAsalWilayah').val();
    document.getElementById('kelamin2').value = $('#cbxKelamin').val();
    document.getElementById('obatnya2').value = dataObatTerpakai;

    if(dataObatTerpakai.length>1){
      $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type:"POST",
        url:"{{URL::to('/klinik_cek_stok_obat')}}",
        data:{ obatnya:dataObatTerpakai },
        success:function(data){

          if(data=="" && validasi_form2()==""){
            $("#modalSimpan2").modal();
            pesan_error2.style.display = "none";
            btn_simpan_history2.style.display="inline";
            pesan_konfirmasi2.style.display = "block";

          }
          else{
            /*
            btn_simpan_history2.style.display="none";
            pesan_konfirmasi2.style.display = "none";
            pesan_error2.style.display = "block";
            document.getElementById('pesan_error2').innerHTML = validasi_form2()+data;
            */
          }
        }
      });
    }
    else{
      if(validasi_form2()==""){
        $("#modalSimpan2").modal();
        pesan_error2.style.display = "none";
        btn_simpan_history2.style.display="inline";
        pesan_konfirmasi2.style.display = "block";
      }
      else{
        /*
        btn_simpan_history2.style.display="none";
        pesan_konfirmasi2.style.display = "none";
        pesan_error2.style.display = "block";
        document.getElementById('pesan_error2').innerHTML = validasi_form2();
        */
      }
    }
    document.getElementById('totalnya2').innerHTML = $('#lbl_total_harga2').text();
  }

  function eachCell2(){
    var idObatnya = [];
    var qtyObatnya = [];
    $('#tabelDataObat2 tr').each(function(index) {   
      if(index!=0){
        console.log($(":nth-child(2)", $(this))[0]);

        idObatnya.push($(":nth-child(2)", $(this)).attr('data-value'));
        qtyObatnya.push($(":nth-child(3)", $(this)).text());
      }
    });
    var hasil =  idObatnya.join(",") + ';' + qtyObatnya.join(",");
    return hasil;
  }
  /*end anak bayi*/
  function load(){
        window.loading_screen = window.pleaseWait({
        logo: '{{ asset("logo-sima-small.png") }}',
        backgroundColor: 'white',
        loadingHtml: '<div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div'
      });
  }


</script>
<script src="{{asset('price_jquery/jquery.priceformat.min.js')}}"></script>
<script src="{{asset('dropify/dist/js/dropify.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){

    $('#txtHargaLayanan').priceFormat({ 
      clearPrefix: true, 
      clearSuffix: true, 
      prefix: '', 
      centsLimit: 0, 
      thousandsSeparator: ',' 
    }); 
    $('#txtHargaLayanan2').priceFormat({ 
      clearPrefix: true, 
      clearSuffix: true, 
      prefix: '', 
      centsLimit: 0, 
      thousandsSeparator: ',' 
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