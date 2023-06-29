@extends('layouts.adminlte')
<!-- plugin css -->
@section('plugin_css')
<link rel="stylesheet" href="{{asset('dropify/dist/css/dropify.min.css')}}">
@endsection
<!-- css -->
@section('add_css')
.gallery img {
  width: 20%;
  height: 200px;
  border-radius: 5px;
  cursor: pointer;
  transition: .3s;
}
@endsection
<!-- content -->
@section('content')
<!-- modal add -->
<div class="modal fade" id="modalAdd" role="dialog" aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 17px;">
      <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;">
        <h4 style="color:white;">Tambah History Kunjungan</h4>
        <button type="button" class="close" 
        data-dismiss="modal" 
        aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <FORM method="post" action="<?php echo URL::to('/tambahKunjunganIbuHamil')?>">
          <input type="hidden" name="id_layanan" value="{{$layanan[0]->id}}">
          <div class="form-group">
            <label>Tanggal:</label>
            <div class="input-group date">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <input type="text" name="tglKunjungan" class="form-control datepicker" required>
              </div>
            </div>
            <label>Keluhan:</label>
            <input type="text" class="form-control" id="txtKeluhan" name="txtKeluhan" placeholder="Keluhan" autocomplete="off" required>
            <label>Bawa Buku Kia:</label>
            <select class="form-control" id="txtbukukia" name="txtbukukia">
              <option value="YA">Ya</option>
              <option value="TIDAK">Tidak</option>
            </select>
            <label>BB :</label>
            <input type="text" class="form-control" id="txtBB" name="txtBB" placeholder="BB" autocomplete="off" required>
            <label>TD :</label>
            <input type="text" class="form-control" id="txtTD" name="txtTD" placeholder="TD" autocomplete="off" required>
            <label>Nadi :</label>
            <input type="text" class="form-control" id="txtNadi" name="txtNadi" placeholder="Nadi" autocomplete="off" required>
            <label>RR :</label>
            <input type="text" class="form-control" id="txtRR" name="txtRR" placeholder="RR" autocomplete="off" required>
            <label>Abdomen :</label>
            <input type="text" class="form-control" id="txtAbdomen" name="txtAbdomen" placeholder="Abdomen" autocomplete="off" required>
            <label>oedem tungkai :</label>
            <input type="text" class="form-control" id="txtOedemTungkai" name="txtOedemTungkai" placeholder="Oedem Tungkai" autocomplete="off" required>
            <label>TFU :</label> 
            <input type="text" class="form-control" id="txtTFU" name="txtTFU" placeholder="TFU" autocomplete="off" required>
            <label>LT Janin :</label>
            <input type="text" class="form-control" id="txtLTJanin" name="txtLTJanin" placeholder="LTJanin" autocomplete="off" required>
            <label>DJJ :</label>
            <input type="text" class="form-control" id="txtDJJ" name="txtDJJ" placeholder="DJJ" autocomplete="off" required>
            <label>Gerak Janin :</label>
            <select class="form-control" id="txtgerakjanin" name="txtgerakjanin">
              <option value="AKTIF">Aktif</option>
              <option value="JARANG">Jarang</option>
            </select>
            <label>UK :</label>
            <input type="text" class="form-control" id="txtUK" name="txtUK" placeholder="UK" autocomplete="off" required>
            <label>LAB :</label>
            <input type="text" class="form-control" id="txtLab" name="txtLab" placeholder="Lab" autocomplete="off" required>
            <label>Skor :</label>
            <input type="text" class="form-control" id="txtSkor" name="txtSkor" placeholder="skor" autocomplete="off" required>
            <label>Analisa Masalah :</label>
            <input type="text" class="form-control" id="txtAnalisaMasalah" name="txtAnalisaMasalah" placeholder="analisa masalah" autocomplete="off" required>
            <label>Penyuluhan :</label>
            <input type="text" class="form-control" id="txtPenyuluhan" name="txtPenyuluhan" placeholder="Penyuluhan" autocomplete="off" required>
            <label>Terapi TT :</label>
            <input type="text" class="form-control" id="txtTerapiTT" name="txtTerapiTT" placeholder="Terapi TT" autocomplete="off" required>
            <label>Rujuk Ke :</label>
            <input type="text" class="form-control" id="txtRujukKe" name="txtRujukKe" placeholder="Rujuk Ke" autocomplete="off" required>
          </div> 
          <div class="form-group">
            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
            <button class="btn btn-danger" id="btnsubmitTambah">Tambah</button>
          </div>
        </FORM>
      </div>
    </div>
  </div>
</div>
<!-- tutup modal add-->

<!-- modal Import-->
<div class="modal fade" id="modalImportObservasi" role="dialog" aria-labelledby="favoritesModalLabel"> 
  <div class="modal-dialog" role="document"> 
    <div class="modal-content" style="border-radius: 17px;"> 
      <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;"> 
        <h4 style="color:white;">Import Data Lampiran</h4> 
        <button type="button" class="close" 
        data-dismiss="modal" 
        aria-label="Close"> 
        <span aria-hidden="true">&times;</span></button> 
      </div> 
      <div class="modal-body"> 
        <FORM method="post" action="<?php echo URL::to('/ibu_hamil/importObservasi')?>" enctype="multipart/form-data"> 
          <div class="form-group">
            <input type="file" id="input-file-now" name="lampiranobservasi[]" multiple class="dropify" data-show-remove="true" data-allowed-file-extensions="jpg jpeg png" data-height="300"/>
          </div> 
          <div class="form-group" id="field_input"> 
            <input type="hidden" name="_token" value="{!!csrf_token()!!}"> 
            <input type="hidden" name="noregisibu" value="{{$layanan[0]->no_registrasi}}"></input>
            <input type="hidden" name="idkartuibu" value="{{$layanan[0]->id}}"></input>
            <input type="hidden" name="idxjumlah" value="{{count($informed_consent)}}"></input>
            <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">Tutup</button> 
            <button class="btn btn-danger" id="btnImport">Import</button> 
          </div>
          <div class="form-group"> 
            Gunakan file dengan format .png/.jpg/.jpeg.
          </div> 
        </FORM> 
      </div> 
    </div> 
  </div> 
</div>
<!-- tutup modal Import-->

<br>
<div class="container-fluid">
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
  <div class="row mb-2">
    <div class="col-sm-6">
      <h3>Detail Histori Pelayanan Ibu Hamil</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/ibu_hamil')}}">Pelayanan Ibu Hamil</a></li>
        <li class="breadcrumb-item active">Detail Histori Pelayanan Ibu Hamil</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="card">
            <div class="card-header d-flex p-0">
              <h3 class="card-title p-3"></h3>
              <ul class="nav nav-pills ml-auto p-2">
                <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Riwayat Kehamilan Sekarang</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Pemeriksaan</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Rencana Persalinan</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="row">
                    <label class="control-label col-lg-6">
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">G </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->g}}  </label>  
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Haid </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->haid}}  </label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">hpht </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{date('d-m-Y', strtotime($layanan[0]->hpht))}} </label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">hpl </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{date('d-m-Y', strtotime($layanan[0]->hpl))}} </label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">bb sebelum hamil </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->bb_sebelum_hamil}} </label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">mual/muntah </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->mual_muntah}}</label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">ket mual/muntah </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->ket_mual_muntah}}</label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">pusing</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->pusing}}</label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">ket pusing</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->ket_pusing}}</label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">nyeri perut</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->nyeri_perut}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">ket nyeri perut</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->ket_nyeri_perut}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">gerak janin</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->gerak_janin}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">ket gerak janin</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->ket_gerak_janin}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">oedema</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->oedema}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">ket oedema</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->ket_oedema}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">nafsu makan</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->nafsu_makan}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">ket nafsu makan</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->ket_nafsu_makan}}</label>
                      </div> 
                    </label>

                    <label class="control-label col-lg-6">

                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">pendarahan</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->pendarahan}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">pendarahan sejak</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{date('d-m-Y', strtotime($layanan[0]->pendarahan_sejak))}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">keluhan utama</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->keluhan_utama}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">hasil skor kspr</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->hasil_skor_kspr}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">dotk</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->dotk}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">dom</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->dom}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">rujuk ke</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->rujuk_ke}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">penyakit diderita</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->penyakit_yang_diderita}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">riwayat penyakit keluarga</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->riwayat_penyakit_keluarga}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">kebiasaan ibu</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->kebiasaan_ibu}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">status tt</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->statustt}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">tanggal imunisasi</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->tanggal_imunisasi}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">resiko hiv</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->resiko_hiv}}</label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">penyebab hiv</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->penyebab_hiv}}</label>
                      </div>
                    </label>
                  </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                  <div class="row">
                    <label class="control-label col-lg-6">
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">TB </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->tb}}  </label>  
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">LILA </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->lila}}  </label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">IMT </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->imt}} </label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Bentuk Tubuh </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->bentuk_tubuh}} </label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Ket Bentuk Tubuh </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->ket_bentuk_tubuh}} </label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Kesadaran </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->kesadaran}}</label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Muka </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->muka}}</label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Ket Muka</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->ket_muka}}</label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Kulit</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->kulit}}</label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Ket Kulit</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->ket_kulit}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Mata</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->mata}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Ket Mata</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->ket_mata}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Mulut</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->mulut}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Ket Mulut</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->ket_mulut}}</label>
                      </div> 
                    </label>

                    <label class="control-label col-lg-6">
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Gigi</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->gigi}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Ket Gigi</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->ket_gigi}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Pembesaran Kel</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->pembesaran_kel}}</label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Ket Pembesaran Kel</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->ket_pembesaran_kel}}</label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Dada </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->dada}}</label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Ket Dada </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->ket_dada}}</label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Paru </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->paru}}</label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Ket Paru </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->ket_paru}}</label>
                      </div>  
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Jantung </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->jantung}}</label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Ket Jantung </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->ket_jantung}}</label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Payudara </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->payudara}}</label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Ket Payudara </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->ket_payudara}}</label>
                      </div>  
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Tangan Tungkai </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->tangan_tungkai}}</label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Refleks </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->refleks}}</label>
                      </div>            
                    </label>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
                <div class="tab-pane" id="tab_3">
                  <div class="row">
                    <label class="control-label col-lg-6">
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Golongan Darah Ibu </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->golongan_darah_ibu}}  </label>  
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Golongan Darah Suami </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->golongan_darah_suami}}  </label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Penolong </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->imt}} </label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Tempat </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->tempat}} </label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Pendamping </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->pendamping}} </label>
                      </div>
                    </label>

                    <label class="control-label col-lg-6">
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Calon Donor </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->calon_donor}}</label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Sticker P4K </label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->stiker_p4k}}</label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Dipasang Tanggal</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->dipasang_tanggal}}</label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">Kesimpulan Diagnosa</label> 
                        <label class="col-sm-3" style="font-weight: normal;">: {{$layanan[0]->kesimpulan_diagnosa}}</label>
                      </div>        
                    </label>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div>
            </div><!-- /.card-body -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header"><h3>Lampiran</h3></div>
        <div class="card-body">
          <div class="row">

            <div id="fb-root"></div>
            <div class="container">
              <div class="gallery">
                <?php
                if(count($informed_consent)>0)
                {
                  foreach ($informed_consent as $key => $value) {
                    $imageThumbURL =URL::to($value->url_gambar);
                    $imageURL = URL::to($value->url_gambar);
                    ?>
                    <a href="<?php echo $imageURL; ?>" data-fancybox="group" data-caption="<?php echo ""; ?>">
                      <img style="margin-left:2%;" src="<?php echo $imageThumbURL; ?>"/>
                    </a>
                    <?php }
                  } ?>
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
            <div class="col-lg-3 col-4" title="Tambah"> 
              <button type="button" class="btn btn-block btn-primary btn-sm" id="btnAdd"> 
                <a href="{{url('/createKunjunganIbuHamil/'.$layanan[0]->id)}}" style="color: white"> 
                  <i class="fa fa-plus-circle nav-icon"></i> Tambah History Kunjungan 
                </a> 
              </button> 
            </div>
            <div class="col-lg-3 col-4"  title="Tambah">
              <button type="button" class="btn btn-block btn-primary btn-sm" id="btnAdd">
                <a href="{{url('/layanan-ibu-hamil-kspr/'.$layanan[0]->id)}}" style="color: white">
                  <i class="fa fa-plus-circle nav-icon"></i> Tambah History KSPR 
                </a>
              </button>
            </div>
            <div class="col-lg-3 col-4"  title="Tambah">
              <button type="button" class="btn btn-block btn-primary btn-sm" id="btnAdd">
                <a href="{{url('/ibuHamilObservasi/'.$layanan[0]->id)}}" style="color: white">
                  <i class="fa fa-plus-circle nav-icon"></i> Tambah Lembar Observasi
                </a>
              </button>
            </div>
            <div class="col-lg-3 col-4"  title="Tambah">
              <button type="button" class="btn btn-block btn-primary btn-sm" id="btnAdd">
                <a href="{{url('/layanan-ibu-hamil-penapisan/'.$layanan[0]->id)}}" style="color: white">
                  <i class="fa fa-plus-circle nav-icon"></i> Tambah History Penapisan
                </a>
              </button>
            </div>
            <div class="col-lg-3 col-4" title="Hapus" style="margin-top: 1%;">
              <button type="button" class="btn btn-block btn-primary btn-sm" data-toggle="modal" 
              data-target="#modalImportObservasi"><i class="fa fa-upload nav-icon"></i> Import Data Lampiran</button>
            </div>
            @if($c_persalinan==0)
            <div class="col-lg-3 col-4"  title="Tambah" style="margin-top: 1%;">
              <button type="button" class="btn btn-block btn-primary btn-sm" id="btnAdd">
                <a href="{{url('/ibu_hamil_create_history_persalinan?l_ibu_hamil='.$layanan[0]->id)}}" style="color: white">
                  <i class="fa fa-plus-circle nav-icon"></i> Buat History Persalinan 
                </a>
              </button>
            </div>
            @else
            <div class="col-lg-3 col-4"  title="Tambah" style="margin-top: 1%;">
              <button type="button" class="btn btn-block btn-primary btn-sm" id="btnAdd">
                <a href="{{url('/ibuHamilDetailPersalinan?id_layanan='.$layanan[0]->id)}}" style="color: white">
                  <i class="fa fa-plus-circle nav-icon"></i> Tambah History Persalinan
                </a>
              </button>
            </div>

            <div class="col-lg-3 col-4"  title="Tambah"  style="margin-top: 1%;">
              <button type="button" class="btn btn-block btn-primary btn-sm" id="btnAdd">
                <a href="{{url('/cetak_surat_lahir/'.$layanan[0]->id)}}" style="color: white">
                  <i class="fa fa-plus-circle nav-icon"></i> Cetak Surat Ket Lahir
                </a>
              </button>
            </div>
            @endif
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
              <div class="col-sm-12">
                <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                  <thead>
                    <tr role="row" style="text-align: center;">
                      <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 5%;">
                        No
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%;">
                        Tanggal
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%;">
                        Keluhan
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 25%;">
                        Aksi
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($hlayanan as $key => $value) 
                    <tr>
                      <td style="text-align: center;">{{($key+1)}}</td>
                      <td>{{date('d-m-Y', strtotime($value->tanggal))}}</td>
                      <td style="text-align: center">{{$value->keluhan}}</td>
                      <td>
                        <div class="form-group">
                          <div data-toggle="tooltips" title="Detail"  style="width:30%;margin: 0 auto">
                            <a href="{{url('/DetailKunjunganIbuHamil/'.$value->id)}}" class="btn btn-info"><i class="fa fa-history"></i></a>
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
<link rel="stylesheet" href="{{asset('fancybox/jquery.fancybox.css')}}">
<script src="{{asset('fancybox/jquery.fancybox.js')}}"></script>
<script type="text/javascript">
    $("[data-fancybox='group']").fancybox({
      afterClose: function( instance, slide ) {
        $(document).ready(function() {
          $('#bodyHidden').show();
        });
      }
    });
</script>
<script src="{{asset('price_jquery/jquery.priceformat.min.js')}}"></script>
<script src="{{asset('dropify/dist/js/dropify.min.js')}}"></script>
<script>

  $(document).ready(function(){

    $('.datepicker').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy',
      startDate: new Date()
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