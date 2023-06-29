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
@if (session()->has('danger_message'))
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fa fa-close"></i> Alert!</h5>
    {{ session('danger_message') }}
  </div>
@endif
<!-- modal detail -->
<div class="modal fade" id="modalDetail" role="dialog" 
aria-labelledby="favoritesModalLabel">
<div class="modal-dialog" role="document">
  <div class="modal-content" style="border-radius: 17px;">
    <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;">
      <h4 style="color:white;">Detail Data Pasien</h4>
      <button type="button" class="close" 
      data-dismiss="modal" 
      aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
      <div class="form-group">
        <label>Nama:</label>
        <p id="lblNamaDetail"></p>
        <label>Tanggal Lahir:</label>
        <p id="lblTtlDetail"></p>
        <label>Alamat:</label>
        <p id="lblAlamatDetail"></p>
        <label>Telp:</label>
        <p id="lblTelpDetail"></p>
      </div>
      <div class="form-group">
        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
        <input type="hidden" id="txtIdEdit" name="txtIdEdit" value="{!!csrf_token()!!}">
        <button class="btn btn-primary pull-left" data-dismiss="modal">Keluar</button>
      </div>
    </div>
  </div>
</div>
</div>
<!-- tutup modal detail-->

<!-- modal ic -->
<div class="modal fade" id="modalIc" role="dialog" 
aria-labelledby="favoritesModalLabel">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content" style="border-radius: 17px;">
    <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;">
      <h4 style="color:white;">Detail Data Pasien Bayi</h4>
      <button type="button" class="close" 
      data-dismiss="modal" 
      aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
      <FORM method="post" action="<?php echo URL::to('/kecamatan/edit')?>">
        <div class="form-group">
          <p>Informed Consent Pasien <span id="lblNamaIc" style="font-weight: bold"></span></p>
          <!-- <img id="imgIc" style="width:100%; height:100%;" src=""> -->
          <div id="dpIC">
            <input type="file" id="input-file-now" class="dropify" data-show-remove="false"/>
          </div>
        </div>
        <div class="form-group">
          <input type="hidden" name="_token" value="{!!csrf_token()!!}">
          <input type="hidden" id="txtIdEdit" name="txtIdEdit" value="{!!csrf_token()!!}">
          <button class="btn btn-primary pull-left" data-dismiss="modal">Keluar</button>&nbsp
          <button id="btnSimpanIc" class="btn btn-danger">Simpan</button>
        </div>
      </FORM>
    </div>
  </div>
</div>
</div>
<!-- tutup modal ic-->

<!-- modal tambah -->
<div class="modal fade" id="modalTambah" role="dialog" 
aria-labelledby="favoritesModalLabel">
<div class="modal-dialog" role="document">
  <div class="modal-content" style="border-radius: 17px;">
    <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;">
      <h4 style="color:white;">Tambah Data Bayi Klinik</h4>
      <button type="button" class="close" 
      data-dismiss="modal" 
      aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
      <FORM method="post" action="<?php echo URL::to('/kecamatan/edit')?>">
        <div class="form-group">
          <label>Nama:</label>
          <input type="text" class="form-control" id="txtNamaLayanan" name="txtNamaLayanan" placeholder="Nama Layanan" required>
          <label>Tanggal Lahir:</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right datepicker" id="datepicker">
            </div>
            <label>B.B.L:</label>
            <input type="text" class="form-control" id="txtBBL" name="txtBBL" placeholder="Berat Badan Lahir" required>
            <label>Cara Persalinan:</label>
            <select class="form-control" id="cbxCaraPersalinan" style="width: 100%;">
              <option>Caesar</option>
              <option>Normal</option>
            </select>
            <label>Alamat:</label>
            <textarea class="form-control" rows="3" id="txtAlamat" placeholder="Alamat" required></textarea>
            <label>Nama Ayah:</label>
            <input type="text" class="form-control" id="txtNamaAyah" name="txtNamaAyah" placeholder="Nama Ayah" required>
            <label>Nama Ibu:</label>
            <input type="text" class="form-control" id="txtNamaIbu" name="txtNamaIbu" placeholder="Nama Ibu" required>
            <label>Telepon:</label>
            <input type="text" class="form-control" id="txtTelp" name="txtTelp" placeholder="Telepon" required>
            <label>Informed Consent:</label>
            <input type="file" id="input-file-now" class="dropify" data-show-remove="false"/>
          </div>
          <div class="form-group">
            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
            <button class="btn btn-default pull-left" data-dismiss="modal">Batal</button>&nbsp
            <button class="btn btn-danger">Tambah</button>
          </div>
        </FORM>
      </div>
    </div>
  </div>
</div>
<!-- tutup modal tambah-->
<!-- modal simpan -->
<div class="modal fade" id="modalSimpan" name="modalSimpan" role="dialog" aria-labelledby="favoritesModalLabel"> 
  <div class="modal-dialog" role="document"> 
    <div class="modal-content" style="border-radius: 17px;"> 
      <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;"> 
        <h4 style="color:white;">Simpan Data History</h4> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
          <span aria-hidden="true">&times;</span>
        </button> 
      </div> 
      <div class="modal-body"> 
        <FORM method="post" action="{{ url('/layanan-imunisasi-history-store') }}" name="formPasienBaru"> 
          <div class="form-group"> 
            <span id="pesan_error" style="display: none;"></span>
            <span id="pesan_konfirmasi" style="display: none;">Apakah anda yakin ingin menyimpan data history yang bernilai <strong><span id="totalnya"></span></strong> ?</span>
          </div> 
          <div class="form-group"> 
            <input type="hidden" name="_token" value="{!!csrf_token()!!}"> 
            <input type="hidden" name="idSimpan" id="idSimpan" value="">
            <input type="hidden" name="keluhannya" id="keluhannya" value="">
            <input type="hidden" name="nasehatnya" id="nasehatnya" value="">
            <input type="hidden" name="umurnya" id="umurnya" value="">
            <input type="hidden" name="idLayananKonf" id="idLayananKonf" value="{{ $konfirmasiJadwal[0]['id_layanannya'] }}">
            <input type="hidden" name="tglKonf" id="tglKonf" value="{{ $konfirmasiJadwal[0]['tanggalnya'] }}">
            <input type="hidden" name="noregKonf" id="noregKonf" value="{{ $konfirmasiJadwal[0]['id'] }}">
            <input type="hidden" name="bbnya" id="bbnya" value="">
            <input type="hidden" name="totalAkhirnya" id="totalAkhirnya" value="">
            <input type="hidden" name="obatnya" id="obatnya" value="">
            <input type="hidden" name="harga_layanannya" id="harga_layanannya" value="">
            <input type="hidden" name="harga_layanan_paketnya" id="harga_layanan_paketnya" value="">
            <button class="btn btn-default" data-dismiss="modal" aria-label="Close">Tutup</button> 
            <button class="btn btn-primary" style="display: none;" id="btn_simpan_history" onclick="submitData();">Simpan</button> 
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
    <h3>Tambah Histori Pelayanan Imunisasi</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/bayi_imunisasi')}}">Pelayanan Imunisasi</a></li> 
        <li class="breadcrumb-item active">Tambah Histori Pelayanan Imunisasi</li>
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
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
            <div class="row">
              <div class="col-sm-12 col-md-6">
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-2" for="nama">B.B</label>
              <label class="control-label col-sm-4" for="nama">
                <input type="number" class="form-control" id="txtBb" name="txtBb" placeholder="Berat Badan" style="text-align: right;" oninput="this.style.backgroundColor = 'white'" required>
              </label>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-2" for="nama">Umur</label>
              <label class="control-label col-sm-1" for="nama">
                <input type="number" class="form-control" id="txtUmurTahun" name="txtUmurTahun" value="0" style="text-align: right;" oninput="this.style.backgroundColor = 'white'" required>
              </label>
              <label class="control-label col-sm-1" for="nama">Tahun</label>
              <label class="control-label col-sm-1" for="nama">
                <input type="number" class="form-control" id="txtUmurBulan" name="txtUmurBulan" value="0" style="text-align: right;" oninput="this.style.backgroundColor = 'white'" required>
              </label>
              <label class="control-label col-sm-1" for="nama">Bulan</label>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="nama"></label>
              <label class="control-label col-sm-4" for="nama">
              <input type="checkbox" class="flat-red icheckbox" name="cbxAddNasehat" id="cbxAddNasehat"><span> Tambah keluhan dan nasehat</span>
              </label>
            </div>

            <div id="tambahNasehat" style="display:none;">
              <div class="form-group row">
                <label class="control-label col-sm-2" for="nama">Keluhan</label>
                <label class="control-label col-sm-4" for="nama">
                  <textarea rows="5" class="form-control" id="txtKeluhan" name="txtKeluhan" placeholder="Keluhan" oninput="this.style.backgroundColor = 'white'" required></textarea>
                </label>
              </div>
              <div class="form-group row">
                <label class="control-label col-sm-2" for="nama">Nasehat</label>
                <label class="control-label col-sm-4" for="nama">
                  <textarea rows="5" class="form-control" id="txtNasehat" name="txtNasehat" placeholder="Pengobatan atau Nasehat" oninput="this.style.backgroundColor = 'white'" required></textarea>
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
            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
              <div class="row">
                <div class="col-sm-12 col-md-6">
                </div>
              </div>
              <div class="row">
                <div class="col-sm-8 col-md-6">
                  <div class="box">
                    <div class="box-header">
                    <?php $layanan =  DB::select("SELECT * FROM layanan WHERE id=".$konfirmasiJadwal[0]['id_layanannya']); ?>
                    <h5 class="box-title">Obat dari layanan <?php echo $layanan[0]->nama  ?></h5>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                      <table class="table table-striped" id="tabelDataObatLayanan">
                        <thead>
                          <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 3%; text-align:center;">
                              No
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 40%; text-align:center;">
                              Nama
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 30%; text-align:center;">
                              Jumlah
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 27%; text-align:center;">
                              Subtotal
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                         <?php $obat_layanan =  DB::select("SELECT o.id,o.nama,ol.qty,ol.subtotal FROM obat_layanan as ol, obat as o WHERE ol.id_obat = o.id AND ol.id_layanan=".$konfirmasiJadwal[0]['id_layanannya']); ?>
                         @foreach($obat_layanan as $key => $value) 
                         <tr>
                          <td style="text-align: center;">{{($key+1)}}</td>
                          <td data-value="{{$value->id}}">{{$value->nama}}</td>
                          <td data-value="{{$value->qty}}" style="text-align:right;">{{$value->qty}}</td>
                          <td style="text-align:right;">{{number_format($value->subtotal, 0, '.', ',')}}</td>

                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="form-group">
                <label class="control-label col-sm-4" for="nama">Tarif Layanan :</label>
                  <label class="control-label col-sm-4" style="font-weight: normal;" id="lbl_total_harga_layanan">
                    Rp. <?php echo number_format($layanan[0]->tarif_layanan, 0, '.', ',')  ?>
                  </label>
                </div>
                <div class="form-group">
                <label class="control-label col-sm-4" for="nama">Total Tarif Layanan :</label>
                  <label class="control-label col-sm-4" style="font-weight: normal;" id="lbl_total_harga_layanan">
                    Rp. <?php echo number_format($layanan[0]->tarif_total, 0, '.', ',')  ?>
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
                <label class="control-label col-sm-2" for="nama">Obat Tambahan</label>
                <label class="control-label col-sm-4" for="nama">
                  <select class="form-control" id="txtObat" name="txtObat" >
                    <?php
                    $obat = DB::table('obat')->where('status_hapus',0)->where('total_pcs','>',0)->get();
                    ?>
                    @foreach($obat as $value)
                    <option value="{{$value->id}}" data-value="{{$value->harga}}" stok-value="{{$value->total_pcs}}">{{$value->nama}}</option>
                    @endforeach
                </select>
              </label>
              <label class="control-label col-sm-2" for="nama"><span class="btn btn-primary" onclick="tambah_tabel()">Tambah</span></label>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Obat tambahan yang dipakai</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-striped dataTable" id="tabelDataObat">
                      <tr id="tambahDataObat">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kuantitas</th>
                        <th>Satuan</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                        <th></th>
                      </tr>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div><!-- /.row -->
            <div class="form-group">
              <label class="control-label col-sm-2" for="nama">Tarif Layanan (Rp)</label>
              <label class="control-label col-sm-4" for="nama">
                <input type="text" class="form-control" id="txtHargaLayanan" name="txtHargaLayanan" onkeyup="hitung_total_harga()" placeholder="" style="text-align: right;" value="0" required>
              </label>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="nama">Total Tarif Tambahan :</label>
              <label class="control-label col-sm-4" style="font-weight: normal;" id="lbl_total_harga">
                Rp. 0
              </label>
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
            <label class="control-label col-sm-2" for="nama">Total Tarif Akhir :</label>
            <label class="control-label col-sm-4" style="font-weight: normal;" id="lbl_total_akhir">
              Rp. <?php echo number_format($layanan[0]->tarif_total, 0, '.', ',') ?>
            </label>
            <div class="col-lg-7">
              <div class="form-group float-sm-left">
                <button type="submit" name="simpan" class="btn btn-primary" onclick="opensimpanmodal('{{ $konfirmasiJadwal[0]['id'] }}')"><i class="fa fa-save nav-icon"></i> Simpan</button>
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
  function submitData()
  {
    document.formPasienBaru.submit();
    window.loading_screen = window.pleaseWait({
      logo: '{{ asset("logo-sima-small.png") }}',
      backgroundColor: 'white',
      loadingHtml: '<div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div'
    });
  }

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

    var keluhannya = $('#txtKeluhan').val();
    var nasehatnya = $('#txtNasehat').val();
    var bbnya = $('#txtBb').val();
    var tahunumurnya = $('#txtUmurTahun').val();
    var bulanumurnya = $('#txtUmurBulan').val();

    document.getElementById("txtBb").style.backgroundColor ="white";
    document.getElementById("txtUmurTahun").style.backgroundColor ="white";
    document.getElementById("txtUmurBulan").style.backgroundColor ="white";
    document.getElementById("txtKeluhan").style.backgroundColor ="white";
    document.getElementById("txtNasehat").style.backgroundColor ="white";

    if(bbnya == ""){
      $stringhasil="1";
      document.getElementById("txtBb").style.backgroundColor ="#ffdddd";
      document.getElementById("txtBb").focus();
    }
    else if((tahunumurnya == "0" || tahunumurnya == "") && (bulanumurnya == "0" || bulanumurnya == "")){
      $stringhasil="1";
      document.getElementById("txtUmurTahun").style.backgroundColor ="#ffdddd";
      document.getElementById("txtUmurTahun").focus();
      document.getElementById("txtUmurBulan").style.backgroundColor ="#ffdddd";
      document.getElementById("txtUmurBulan").focus();
    }
    else
    {
      $stringhasil="";
    }

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
    $('#lbl_total_harga').html("Rp. "+parseInt( total_harga ).toLocaleString())
    $('#lbl_total_akhir').html("Rp. "+parseInt( total_harga + <?php echo $layanan[0]->tarif_total  ?> ).toLocaleString())

    
    document.getElementById('totalAkhirnya').value = parseInt( total_harga + <?php echo $layanan[0]->tarif_total  ?> );
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

  function opensimpanmodal(id){

    var dataObatTerpakai = eachCell();

    document.getElementById('idSimpan').value = id;
    document.getElementById('keluhannya').value = $('#txtKeluhan').val(); 
    document.getElementById('nasehatnya').value = $('#txtNasehat').val();
    document.getElementById('bbnya').value = $('#txtBb').val();
    document.getElementById('harga_layanannya').value = $('#txtHargaLayanan').val();
    document.getElementById('harga_layanan_paketnya').value = <?php echo $layanan[0]->tarif_layanan  ?>;
    var umur = "";
    if($('#txtUmurTahun').val() != 0)
      umur+= $('#txtUmurTahun').val()+" Tahun ";
    if($('#txtUmurBulan').val() != 0)
      umur+= $('#txtUmurBulan').val()+" Bulan";
    document.getElementById('umurnya').value = umur;
    document.getElementById('obatnya').value = dataObatTerpakai;

    document.getElementById('totalAkhirnya').value = (($('#lbl_total_akhir').text()).replace("Rp.","")).replace(/\s/g, '');
    
    if(dataObatTerpakai.length>1){
      $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type:"POST",
        url:"{{ url('/layanan-imunisasi/cek-stok-obat') }}",
        data:{ obatnya:dataObatTerpakai },
        success:function(data){
          console.log(validasi_form());
          if(data=="" && validasi_form()==""){
            $("#modalSimpan").modal("show");
            pesan_error.style.display = "none";
            btn_simpan_history.style.display="inline";
            pesan_konfirmasi.style.display = "block";

          }
          else if(data){
            $("#modalSimpan").modal("show");
            btn_simpan_history.style.display="none";
            pesan_konfirmasi.style.display = "none";
            pesan_error.style.display = "block";
            // alert(data);
            document.getElementById('pesan_error').innerHTML = data;
          }
        }
      });
    }
    else{
      if(validasi_form()==""){
        $("#modalSimpan").modal("show");
        pesan_error.style.display = "none";
        btn_simpan_history.style.display="inline";
        pesan_konfirmasi.style.display = "block";
      }
      else{
        // alert("masuk2");
        // btn_simpan_history.style.display="none";
        // pesan_konfirmasi.style.display = "none";
        // pesan_error.style.display = "block";
        // document.getElementById('pesan_error').innerHTML = validasi_form();
      }
    }
    document.getElementById('totalnya').innerHTML = $('#lbl_total_akhir').text();
  }

  function eachCell(){
    var idObatnyaLayanan = [];
    var qtyObatnyaLayanan = [];
    var idObatnya = [];
    var qtyObatnya = [];
    $('#tabelDataObat tr').each(function(index) {   
      if(index!=0){
        idObatnya.push($(":nth-child(2)", $(this)).attr('data-value'));
        qtyObatnya.push($(":nth-child(3)", $(this)).text());

      }
    });

    $('#tabelDataObatLayanan tr').each(function(index) {   
      if(index!=0){
        var idx = idObatnya.indexOf($(":nth-child(2)", $(this)).attr('data-value'));
        if(idx!=-1)
        {
          qtyObatnya[idx]=parseInt(qtyObatnya[idx])+parseInt(($(":nth-child(3)", $(this)).attr('data-value')));
        }
        else
        {
          idObatnya.push($(":nth-child(2)", $(this)).attr('data-value'));
          qtyObatnya.push($(":nth-child(3)", $(this)).text());  
        }
        
      }
    });

    var hasil =  idObatnya.join(",") + ';' + qtyObatnya.join(","); 


    return hasil;
  }

  function opendetailmodal(id, nama, ttl, alamat, telp)
  {
    document.getElementById('lblNamaDetail').innerHTML = nama;
    document.getElementById('lblTtlDetail').innerHTML = ttl;

    document.getElementById('lblAlamatDetail').innerHTML = alamat;
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

    document.getElementById('lblNamaIc').innerHTML = nama;
  }

</script>
<script src="{{asset('price_jquery/jquery.priceformat.min.js')}}"></script>
<script src="{{asset('dropify/dist/js/dropify.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){

    $("input:checkbox[name='cbxAddNasehat']").on('ifChecked', function(event){
      document.getElementById("tambahNasehat").style.display ="block";
    });
    $("input:checkbox[name='cbxAddNasehat']").on('ifUnchecked', function(event){
      document.getElementById("tambahNasehat").style.display ="none";
    });

    $('#txtHargaLayanan').priceFormat({ 
      clearPrefix: true, 
      clearSuffix: true, 
      prefix: '', 
      centsLimit: 0, 
      thousandsSeparator: ',' 
    }); 

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
    drDestroy = drDestroy.data('dropify');
    $('#toggleDropify').on('click', function(e){
      e.preventDefault();
      if (drDestroy.isDropified()) {
        drDestroy.destroy();
      } else {
        drDestroy.init();
      }
    });

  });
</script>
@endsection