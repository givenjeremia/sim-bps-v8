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
            <span id="pesan_konfirmasi" style="display: none;">Apakah anda yakin ingin menyimpan data history yang bernilai <strong><span id="totalnya"></span></strong> ?</span>
          </div> 
          <div class="form-group"> 
            <button class="btn btn-default" data-dismiss="modal" aria-label="Close">Tutup</button> 
            <button class="btn btn-primary" style="display: none;" id="btn_simpan_history" onclick="submitForm()" data-dismiss="modal">Simpan</button> 
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
      <h3>Buat History Persalinan</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/ibu_hamil')}}">Pelayanan Ibu Hamil</a></li>
        <li class="breadcrumb-item active">Buat History Persalinan</li>
      </ol>
    </div>
  </div>
  <div class="row">

  </div>


  <div class="row">
    <div class="col-12">
      <!-- Custom Tabs -->
      <form method="post" action="{{url('/ibu_hamil_store_history_persalinan')}}">

      <input type="hidden" name="obatnya" id="obatnya">
      <input type="hidden" name="harga_layanannya" value="{{$layanan[0]->str_tarif_layanan}}">
      <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">Persalinan</h3>
        </div><!-- /.card-header -->
        <div class="card-body">
          
            @csrf
            <input type="hidden" name="id_layanan_ibu_hamil" value="{{$id}}">
            <div class="row">
              <label class="control-label col-lg-6">
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">Tempat</label>
                  <label class="control-label col-lg-6" for="nama">
                    <select class="form-control" id="txtTempat" name="txtTempat" onchange="showLain(this.value)">
                      <option value="rumah_pasien">Rumah Pasien</option>
                      <option value="polindes">Polindes</option>
                      <option value="pustu">Pustu</option>
                      <option value="puskesmas">Puskesmas</option>
                      <option value="puskesmas_poned">Puskesmas Poned</option>
                      <option value="bps">BPS</option>
                      <option value="dps">DPS</option>
                      <option value="rb">RB</option>
                      <option value="lainnya">Lainnya</option>
                    </select>
                  </label>
                </div>
                <div class="form-group" id="divlainnya" style="display: none;">
                  <label class="control-label col-lg-4" for="nama">Tempat Lainnya</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="text" class="form-control" id="txtTempatLain" name="txtTempatLain" placeholder="Tempat Lainnya">
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">Tanggal</label>
                  <label class="control-label col-lg-6" for="nama">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-calendar"></i>
                        </span>
                      </div>
                      <input type="text" name="txtTanggal" class="form-control pull-right datepicker" id="txtTanggal" onchange="writeDate(this.value)" required>
                    </div> 
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">Penolong</label>
                  <label class="control-label col-lg-6" for="nama">
                    <select class="form-control" id="txtPenolong" name="txtPenolong">
                      <option value="bidan">Bidan</option>
                      <option value="dokter">Dokter</option>
                      <option value="spog">SPOG</option>
                      <option value="dukun">Dukun</option>
                      <option value="lainnya">Lain-lain</option>
                    </select>
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">Nama</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="text" class="form-control" id="txtNamaPenolong" name="txtNamaPenolong" placeholder="" required>
                  </label> 
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">Proses Persalinan</label>
                  <label class="control-label col-lg-6" for="nama">
                    <select class="form-control" id="txtProsesPersalinan" name="txtProsesPersalinan">
                      <option value="normal">Normal</option>
                      <option value="drtp">Drtp</option>
                      <option value="vakum">Vakum</option>
                      <option value="curetage">Curetage</option>
                      <option value="plas_manual">Plas Manual</option>
                      <option value="sc">SC</option>
                      <option value="imo">IMO</option>
                    </select>
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">Komplikasi</label>
                  <label class="control-label col-lg-6" for="nama">
                    <select class="form-control" id="txtKomplikasi" name="txtKomplikasi">
                      <option value="i">I</option>
                      <option value="p">P</option>
                      <option value="s">S</option>
                      <option value="eklampsia">Eklampsia</option>
                      <option value="partus_lama">Partus Lama</option>
                      <option value="infeksi">Infeksi</option>
                      <option value="pendarahan">Pendarahan</option>
                    </select>
                  </label>
                </div>
              </label>
              <label class="control-label col-lg-6">
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">BB</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="number" class="form-control" id="txtBB" name="txtBB" placeholder="BB" oninput="writeBB(this.value)" style="text-align: right;" required>
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">PB</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="number" class="form-control" id="txtPB" name="txtPB" placeholder="PB" oninput="writePB(this.value)" style="text-align: right;" required>
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">LK</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="number" class="form-control" id="txtLK" name="txtLK" placeholder="LK" style="text-align: right;" required>
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">Keadaan</label>
                  <label class="control-label col-lg-6" for="nama">
                    <select class="form-control" id="txtKeadaan" name="txtKeadaan">
                      <option value="hidup">Hidup</option>
                      <option value="mati">Mati</option>
                    </select>
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">Keadaan Ibu</label>
                  <label class="control-label col-lg-6" for="nama">
                    <select class="form-control" id="txtKeadaanIbu" name="txtKeadaanIbu">
                      <option value="sehat">Sehat</option>
                      <option value="sakit">Sakit</option>
                      <option value="meninggal">Meninggal</option>
                    </select>
                  </label>
                </div>
              </label>
            </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">Surat Keterangan Lahir</h3>
        </div><!-- /.card-header -->
        <div class="card-body">
            @csrf
            <input type="hidden" name="id_layanan_ibu_hamil" value="{{$id}}">
            <div class="row">
              <label class="control-label col-lg-6">
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">Nama Ibu</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="text" class="form-control" id="txtNamaIbu" name="txtNamaIbu" placeholder="" value="{{$data_ibu[0]->nama}}" required>  
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">Nama Ayah</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="text" class="form-control" id="txtNamaAyah" name="txtNamaAyah" placeholder="" value="{{$data_ayah[0]->nama}}" required>  
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">Alamat</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="text" class="form-control" id="txtAlamat" name="txtAlamat" value="{{$data_ibu[0]->alamat}}" required>
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">Pada Hari</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="text" class="form-control" id="txtPadaHari" name="txtPadaHari" placeholder="" required>
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">Tanggal</label>
                  <label class="control-label col-lg-6" for="nama">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-calendar"></i>
                        </span>
                      </div>
                      <input type="text" name="txtTanggalnya" class="form-control pull-right datepicker" id="txtTanggalnya" required>
                    </div> 
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-lg-4" for="nama">Jam</label>
                  <label class="control-label col-lg-6" for="nama">
                    <div class="input-group clockpicker" data-placement="right" data-align="top" data-autoclose="true">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                      </div>
                      <input type="text" class="form-control" id="txtJam" name="txtJam" required>
                    </div>
                  </label>
                </div>
              </label>
              <label class="control-label col-lg-6">
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">Telah melahirkan seorang anak Laki-laki / Perempuan yang ke</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="number" class="form-control" id="txtAnakKe" name="txtAnakKe" placeholder="" required>
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">Berat Badan </label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="text" class="form-control" id="txtBeratBadan" name="txtBeratBadan" style="text-align: right;" placeholder="" required>
                  </label> 
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">Panjang Badan </label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="text" class="form-control" id="txtPanjangBadan" name="txtPanjangBadan" style="text-align: right;" placeholder="" required>
                  </label> 
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">Diberi Nama</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="text" class="form-control" id="txtDiberiNama" name="txtDiberiNama" placeholder="" required>
                  </label> 
                </div>
              </label>
            </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">Nifas</h3>
        </div><!-- /.card-header -->
        <div class="card-body">
            @csrf
            <input type="hidden" name="id_persalinan" value="{{$id}}">
            <div class="row">
              <label class="control-label col-lg-6">
                <div class="form-group row">
                  <label class="control-label col-lg-4" for="nama">Tanggal</label>
                  <label class="control-label col-lg-6" for="nama">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-calendar"></i>
                        </span>
                      </div>
                      <input type="text" name="txtTanggal" class="form-control pull-right datepicker" id="txtTanggal" required>
                    </div> 
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-lg-4" for="nama">Keluhan</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="text" class="form-control" id="txtKeluhan" name="txtKeluhan" placeholder="Keluhan" required>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-lg-4" for="nama">TD</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="text" class="form-control" id="txtTD" name="txtTD" placeholder="TD" value="" required>  
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-lg-4" for="nama">Nadi</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="text" class="form-control" id="txtNadi" name="txtNadi" placeholder="Nadi" required>
                  </label> 
                </div>
                <div class="form-group row">
                  <label class="control-label col-lg-4" for="nama">RR</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="text" class="form-control" id="txtRR" name="txtRR" placeholder="RR" required>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-lg-4" for="nama">Suhu</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="number" class="form-control" id="txtSuhu" name="txtSuhu" placeholder="Suhu" style="text-align: right;" required>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-lg-4" for="nama">Payudara</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="text" class="form-control" id="txtPayudara" name="txtPayudara" placeholder="Payudara" required>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-lg-4" for="nama">TFU</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="text" class="form-control" id="txtTFU" name="txtTFU" placeholder="TFU" required>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-lg-4" for="nama">Kontraksi Rahim</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="text" class="form-control" id="txtKontraksiRahim" name="txtKontraksiRahim" placeholder="Kontraksi Rahim" required>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-lg-4" for="nama">Pendarahan</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="text" class="form-control" id="txtPendarahan" name="txtPendarahan" placeholder="Pendarahan" required>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-lg-4" for="nama">Lochia</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="text" class="form-control" id="txtLochia" name="txtLochia" placeholder="Lochia" required>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-lg-4" for="nama">Oed</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="text" class="form-control" id="txtOed" name="txtOed" placeholder="Oed" required>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-lg-4" for="nama">BAB</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="text" class="form-control" id="txtBab" name="txtBab" placeholder="Bab" required>
                  </label>
                </div>
              </label>
              <label class="control-label col-lg-6">
                <div class="form-group row">
                  <label class="control-label col-lg-4" for="nama">BAK</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="text" class="form-control" id="txtBak" name="txtBak" placeholder="Bak" required>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-lg-4" for="nama">ASI Saja</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="text" class="form-control" id="txtAsiSaja" name="txtAsiSaja" placeholder="Asi Saja" required>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-lg-4" for="nama">Analisa Masalah</label>
                  <label class="control-label col-lg-6" for="nama">
                    <textarea rows="5" class="form-control" id="txtAnalisaMasalah" name="txtAnalisaMasalah" placeholder="Analisa Masalah" required></textarea>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-lg-4" for="nama">Terapi Tindakan</label>
                  <label class="control-label col-lg-6" for="nama">
                    <textarea rows="5" class="form-control" id="txtTerapiTindakan" name="txtTerapiTindakan" placeholder="Terapi Tindakan" required></textarea>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-lg-4" for="nama">Penyuluhan</label>
                  <label class="control-label col-lg-6" for="nama">
                    <textarea rows="5" class="form-control" id="txtPenyuluhan" name="txtPenyuluhan" placeholder="Penyuluhan" required></textarea>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-lg-4" for="nama">Rujuk Ke</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="text" class="form-control" id="txtRujukKe" name="txtRujukKe" placeholder="Rujuk Ke" required>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-lg-4" for="nama">Pemeriksa</label>
                  <label class="control-label col-lg-6" for="nama">
                    <input type="text" class="form-control" id="txtPemeriksa" name="txtPemeriksa" placeholder="Pemeriksa" required>
                  </label>
                </div>
              </label>
            </div>


            <hr>
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
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-4" for="nama">Harga Layanan</label>
              <label class="control-label col-lg-6" style="font-weight: normal;" for="nama">
                Rp.{{$layanan[0]->str_tarif_layanan}}
              </label>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-4" for="nama">Total Harga :</label>
              <label class="control-label col-sm-6" style="font-weight: normal;" id="lbl_total_harga">
                Rp.{{$layanan[0]->str_tarif_layanan}}
              </label>
            </div>

            <div class="form-group">
              <button type="button" name="simpan" class="btn btn-primary" onclick="opensimpanmodal()"><i class="fa fa-save nav-icon"></i> Simpan</button>
              <input type="submit" name="submit" style="display: none" id="btnSimpan">
            </div>
        </div>
      </div>
      </form>
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
<script src="{{asset('price_jquery/jquery.priceformat.min.js')}}"></script>
<script type="text/javascript" src="{{asset('clockpicker/dist/bootstrap-clockpicker.min.js')}}"></script>
<script src="{{asset('dropify/dist/js/dropify.min.js')}}"></script>
<script type="text/javascript">

  function showLain(value){
    if(value == "lainnya"){
      document.getElementById("divlainnya").style.display = "block";
      document.getElementById("txtTempatLain").required = true;
    }
    else{
      document.getElementById("divlainnya").style.display = "none";
      document.getElementById("txtTempatLain").required = false;
    }
  }

  function writeBB(value){
    document.getElementById("txtBeratBadan").value = value;
  }

  function writePB(value){
    document.getElementById("txtPanjangBadan").value = value;
  }

  function writeDate(value){
    document.getElementById("txtTanggalnya").value = value;
  }

  function submitForm(){
    document.getElementById("btnSimpan").click();
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

  function boleh_input_angka(evt, idcounter) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if ((charCode > 31 && (charCode < 48 || charCode > 57))|| charCode==13){
      return false;
    }
    return true;
  }

  function hitung_total_harga(){
    var hargaObatnya = 0;
    
    $('#tabelDataObat tr').each(function(index) {  
      if(index!=0){
        hargaObatnya += parseInt($(":nth-child(6)", $(this)).text().replace(',', ''));
      }
    });

    <?php 
    $temp = $layanan[0]->str_tarif_layanan;
    $temp = str_replace(",", "", $temp); 
    ?>
    var temp_harga = <?php echo $temp; ?>;
    var harga_layanan = temp_harga;
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

  function opensimpanmodal(){
    //modalSimpan.style.display = "block";

    var dataObatTerpakai = eachCell();
    document.getElementById('obatnya').value = dataObatTerpakai;    

    //document.getElementById('idSimpan').value = id;

    if(dataObatTerpakai.length>1){
      $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type:"POST",
        url:"{{URL::to('/klinik_cek_stok_obat')}}",
        data:{ obatnya:dataObatTerpakai },
        success:function(data){
          console.log(data);
          if(data==""){
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
      
      $("#modalSimpan").modal();
      pesan_error.style.display = "none";
      btn_simpan_history.style.display="inline";
      pesan_konfirmasi.style.display = "block";
      
    }
    document.getElementById('totalnya').innerHTML = $('#lbl_total_harga').text();
  }


  $(document).ready(function(){
    $('.clockpicker').clockpicker({
      autoclose: true
    });

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