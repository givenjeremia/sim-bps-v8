@extends('layouts.adminlte')
<!-- plugin css -->
@section('plugin_css')
<link rel="stylesheet" href="{{asset('dropify/dist/css/dropify.min.css')}}">
@endsection
<!-- css -->
@section('add_css')
.overlay {
background-color:#EFEFEF;
position: fixed;
width: 100%;
height: 100%;
z-index: 1000;
top: 0px;
left: 0px;
opacity: .5; /* in FireFox */ 
filter: alpha(opacity=50); /* in IE */
}


.buttonChecked:hover {transform: translateY(3px); cursor: pointer;}

.buttonChecked:active {
transform: translateY(5px);
}

.buttonPlus:hover {transform: translateY(3px); cursor: pointer;}

.buttonPlus:active {
transform: translateY(5px);

}
/* Mark input boxes that gets an error on validation: */
input.invalid {
background-color: #ffdddd;
}

select.invalid {
background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
display: none;
}


/* Make circles that indicate the steps of the form: */
.step {
height: 15px;
width: 15px;
margin: 0 2px;
background-color: #bbbbbb;
border: none; 
border-radius: 50%;
display: inline-block;
opacity: 0.5;
}

/* Mark the active step: */
.step.active {
opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
background-color: #4CAF50;
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
      <h3>Tambah History Kehamilan</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/ibu_hamil')}}">Pelayanan Ibu Hamil</a></li>
        <li class="breadcrumb-item active">Tambah History Kehamilan</li>
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
        </div><!-- /.card-header -->
        <div class="card-body">
          <form id="regForm" action="{{ route('tambah.history.hamil') }}" method="post" enctype="multipart/form-data">
            @csrf
  
            <input type="hidden" name="no_reg" value="{{ $pasien[0]->id_ibu }}">

            <div class="tab"><b>IDENTITAS IBU :</b>
              <p><input type="text" class="form-control" id="txtNamaibu" name="txtNamaibu" placeholder="Nama..." oninput="this.className = 'form-control'" required></p>
              <p>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" class="form-control datepicker" id="txtTanggalLahiribu" name="txtTanggalLahiribu" placeholder="Tanggal Lahir..." onchange="this.className = 'form-control datepicker'">
                  </div>
                </div>
              </p>
              <p>
                <div class="form-group">
                  <select class="form-control" id="txtAgamaibu" name="txtAgamaibu" oninput="this.className = 'form-control'">
                    <option selected disabled value="">Agama...</option>
                    <option value="atheis">Atheis</option>
                    <option value="budha">Budha</option>
                    <option value="hindu">Hindu</option>
                    <option value="islam">Islam</option>
                    <option value="kristen">Kristen</option>
                  </select>
                </div>
              </p>
              <p><input type="text" class="form-control" id="txtAlamatibu" name="txtAlamatibu" placeholder="Alamat..." oninput="this.className = 'form-control'" required></p>
              <p><input type="number" class="form-control" id="txtPhoneibu" name="txtPhoneibu" placeholder="No. Telp..." oninput="this.className = 'form-control'" required></p>
              <p><input type="text" class="form-control" id="txtKelurahanibu" name="txtKelurahanibu" placeholder="Kelurahan..." oninput="this.className = 'form-control'" required></p>
              <p><input type="text" class="form-control" id="txtPekerjaanibu" name="txtPekerjaanibu" placeholder="Pekerjaan..." oninput="this.className = 'form-control'" required></p>
              <p><input type="text" class="form-control" id="txtPendidikanibu" name="txtPendidikanibu" placeholder="Pendidikan..." oninput="this.className = 'form-control'" required></p>
              <p>
                <div class="form-group">
                  <select class="form-control" onchange="changeKIA(this, 'add')" id="cboBukuKIA" name="cboBukuKIA">
                    <option selected disabled value="">Buku KIA</option>
                    <option value="punya">Punya</option>
                    <option value="belum">Belum Punya</option>
                  </select>
                </div>
              </p>
              <p>
                <div class="form-group" id="divKIA" style="display: none;">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" class="form-control datepicker" onchange="this.className = 'form-control datepicker'" id="tglKIA" name="tglKIA" placeholder="Diberi tanggal...">
                  </div>
                </div>
              </p>
            </div>

            <div class="tab"><b>IDENTITAS AYAH :</b>
              <p><input type="text" class="form-control" id="txtNamaayah" name="txtNamaayah" placeholder="Nama..." oninput="this.className = 'form-control'" required></p>
              <p>
                <div class="form-group" id="txtTanggalLahirayahGroup">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" class="form-control datepicker" id="txtTanggalLahirayah" name="txtTanggalLahirayah" placeholder="Tanggal Lahir..." onchange="this.className = 'form-control datepicker'">
                  </div>
                </div>
              </p>
              <p>
                <div class="form-group">
                  <div class="input-group">
                    <input type="checkbox" name="cbxLupaTglLahir" id="cbxLupaTglLahir"> <p style="margin-top:-7px;"> Lupa Tanggal Lahir</p>
                  </div>
                </div>
              </p>
              <p>
                <div class="form-group">
                  <select class="form-control" id="txtAgamaayah" name="txtAgamaayah" oninput="this.className = 'form-control'">
                    <option selected disabled value="">Agama...</option>
                    <option value="atheis">Atheis</option>
                    <option value="budha">Budha</option>
                    <option value="hindu">Hindu</option>
                    <option value="islam">Islam</option>
                    <option value="kristen">Kristen</option>
                  </select>
                </div>
              </p>
              <p><input type="text" class="form-control" id="txtAlamatayah" name="txtAlamatayah" placeholder="Alamat..." oninput="this.className = 'form-control'" required></p>
              <p><input type="number" class="form-control" id="txtPhoneayah" name="txtPhoneayah" placeholder="No. Telp..." oninput="this.className = 'form-control'" required></p>
              <p><input type="text" class="form-control" id="txtKelurahanayah" name="txtKelurahanayah" placeholder="Kelurahan..." oninput="this.className = 'form-control'" required></p>
              <p><input type="text" class="form-control" id="txtPekerjaanayah" name="txtPekerjaanayah" placeholder="Pekerjaan..." oninput="this.className = 'form-control'" required></p>
              <p><input type="text" class="form-control" id="txtPendidikanayah" name="txtPendidikanayah" placeholder="Pendidikan..." oninput="this.className = 'form-control'" required></p>
            </div>

            <div class="tab"><b>RIWAYAT PERKAWINAN:</b>
              <p><input type="number" class="form-control" min="0" id="txtKawinke" name="txtKawinke" placeholder="Perkawinan ke..." oninput="this.className = 'form-control'" style="text-align: right;" autocomplete="off" required></p>
              <div class="row">
                <div class="col-sm"><input type="number" class="form-control" min="0" id="txtLamaKawin" name="txtLamaKawin" placeholder="Lama Kawin (Tahun)..." oninput="this.className = 'form-control'" style="text-align: right;" autocomplete="off" required></div>
                <div class="col-sm"><input type="number" class="form-control" min="0" id="txtLamaKawinBulan" name="txtLamaKawinBulan" placeholder="Lama Kawin (Bulan)..." oninput="this.className = 'form-control'" style="text-align: right;" autocomplete="off" required></div>              
              </div>
              <p>
                <div class="form-group">
                  <select class="form-control" id="cboSebabPisah" name="cboSebabPisah" oninput="changeSebabPisah(this, 'add');">
                    <option selected disabled value="">Sebab Pisah...</option>
                    <option value="masih">Masih Berjalan</option>
                    <option value="cerai">Cerai</option>
                    <option value="meninggal">Meninggal</option>
                  </select>
                </div>
              </p>
              <p><input type="text" class="form-control" id="txtSebabmeninggal" name="txtSebabmeninggal" placeholder="Sebab Meninggal..." oninput="this.className = 'form-control'" autocomplete="off" required style="display: none;"></p>
              <p><input type="button" id="btnTambah" class="btn btn-primary" onclick="tambah_tabel(1)" value="Tambah ke Tabel"></input></p>
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Tabel Riwayat Perkawinan</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                      <table class="table table-bordered table-striped" id="tabelDataRiwayatKawin">
                        <tr id="tambahDataObat">
                          <th>Kawin Ke</th>
                          <th>Lama Kawin</th>
                          <th>Sebab Pisah</th>
                          <th>Sebab Meninggal</th>
                          <th></th>
                        </tr>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
              </div><!-- /.row -->

              <div id="field_input_riwayat_kawin">

              </div>
            </div>
            <div class="tab"><b>RIWAYAT KEHAMILAN PERSALINAN DAN KB:</b>
              <div class="form-group"></div>

              <div class="form-group">
                <label class="col-sm-3" >Apakah kehamilan pertama? </label>
                <label class="col-sm-1">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="rdoHamilPertama" id="rdoHamilPertamaYa" value="ya" onclick="showFormRiwayatHamil(this.value)" checked>
                    <label class="form-check-label" style="font-weight: normal;">Ya</label>
                  </div>
                </label>
                <label class="col-sm-1">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="rdoHamilPertama" id="rdoHamilPertamaTidak" value="tidak" onclick="showFormRiwayatHamil(this.value)">
                    <label class="form-check-label" style="font-weight: normal;">Tidak</label>
                  </div>
                </label>
              </div>

              <div class="form-group" id="kehamilan_ke" style="display: none;">
                <label class="col-sm-3" >Kehamilan ke berapa?</label>
                <label class="col-sm-1">
                  <input type="number" class="form-control" id="txthamilke" name="txthamilke" oninput="hamil_ke_change(this);this.className = 'form-control'" value="2" min="2" style="text-align: right;" required>
                </label>
              </div>

              <div class="col-md-12" id="field_hamil" style="display: none;">
                <div class="card">
                  <div class="form-group"></div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-sm-3" >Kehamilan ke</label>
                        <label class="col-sm-6">
                          <input type="number" class="form-control" id="txtKehamilanKe" name="txtKehamilanKe" oninput="this.className = 'form-control'" value="1" min="1" style="text-align: right;" required>
                        </label>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-3" >Komplikasi </label>
                        <label class="col-sm-6">
                          <select class="form-control" id="txtKomplikasi" name="txtKomplikasi" oninput="this.className = 'form-control'">
                            <option selected disabled value="">Komplikasi...</option>
                            <option value="tidak">Tidak</option>
                            <option value="asp">ASP</option>
                            <option value="ht">HT</option>
                          </select>
                        </label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" >Persalinan </label>
                        <label class="col-sm-6">
                          <select class="form-control" id="txtPersalinan" name="txtPersalinan" oninput="this.className = 'form-control'">
                            <option selected disabled value="">Persalinan...</option>
                            <option value="abortus">Abortus</option>
                            <option value="aips">AIPS</option>
                            <option value="iufd">IUFD</option>
                            <option value="normal">Normal</option>
                            <option value="su">SU</option>
                            <option value="alat">Alat</option>
                            <option value="sc">SC</option>
                          </select>
                        </label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-sm-4" >Tempat Persalinan </label>
                        <label class="col-sm-6">
                          <select class="form-control" id="txtTempatPersalinan" name="txtTempatPersalinan" oninput="this.className = 'form-control'">
                            <option selected disabled value="">Tempat Persalinan...</option>
                            <option value="rs">RS</option>
                            <option value="pusk">PUSK</option>
                            <option value="bps">BPS</option>
                            <option value="rumah">Rumah</option>
                            <option value="lain-lain">Lain-Lain</option>
                          </select>
                        </label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4" >Komplikasi Persalinan </label>
                        <label class="col-sm-6">
                          <select class="form-control" id="txtKomplikasiPersalinan" name="txtKomplikasiPersalinan" oninput="this.className = 'form-control'">
                            <option selected disabled value="">Komplikasi Persalinan...</option>
                            <option value="plama">P-Lama</option>
                            <option value="infeksi">Infeksi</option>
                            <option value="hpp">HPP</option>
                            <option value="infus">Infus</option>
                            <option value="normal">Normal</option>
                          </select>
                        </label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4" >Penolong </label>
                        <label class="col-sm-6">
                          <select class="form-control" id="txtPenolong" name="txtPenolong" oninput="this.className = 'form-control'">
                            <option selected disabled value="">Penolong...</option>
                            <option value="dokter">Dokter</option>
                            <option value="bidan">Bidan</option>
                            <option value="lain-lain">Lain-Lain</option>
                          </select>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="form-group"></div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group" >
                        <label class="col-sm-3" >Keadaan BBL : </label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">- P / L </label>
                        <label class="col-sm-6">
                          <select class="form-control" id="txtJenisKelamin" name="txtJenisKelamin[]" oninput="this.className = 'form-control'">
                            <option selected disabled value="">P/L...</option>
                            <option value="P">P</option>
                            <option value="L">L</option>
                          </select>
                        </label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">- Berat </label>
                        <label class="col-sm-6">
                          <input type="text" style="text-align: right;" class="form-control" id="txtBerat" name="txtBerat[]" placeholder="...KG" oninput="this.className = 'form-control'" required>
                        </label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" style="font-weight: normal;">- Keadaan </label>
                        <label class="col-sm-6">
                          <select class="form-control" id="txtKeadaan" name="txtKeadaan[]" oninput="this.className = 'form-control'">
                            <option selected disabled value="">Keadaan...</option>
                            <option value="sehat">Sehat</option>
                            <option value="sakit">Sakit</option>
                            <option value="mati">Mati</option>
                          </select>
                        </label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" >Keadaan Anak Sekarang </label>
                        <label class="col-sm-6">
                          <select class="form-control" id="txtKeadaanAnak" name="txtKeadaanAnak[]" oninput="this.className = 'form-control'">
                            <option selected disabled value="">Keadaan...</option>
                            <option value="sehat">Hidup</option>
                            <option value="mati">Mati</option>
                          </select>
                        </label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-sm-3" >Keterangan Anak Sekarang </label>
                        <label class="col-sm-6">
                          <input type="text" class="form-control" id="txtKeadaanAnak" name="txtKetKeadaanAnak[]" placeholder="..." oninput="this.className = 'form-control'" required>
                        </label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" >KB </label>
                        <label class="col-sm-6">
                          <input type="text" class="form-control" id="txtKB" name="txtKB[]" placeholder="..." oninput="this.className = 'form-control'" required>
                        </label>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" >ASI </label>
                        <label class="col-sm-6">
                          <input type="text" class="form-control" id="txtAsi" name="txtAsi[]" placeholder="..." oninput="this.className = 'form-control'" required>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="field_card_anak">

                </div>

                <div class="form-group">
                  <button type="button" id="btnTambahBayi" class="btn btn-success" onclick="tambah_anak()"><i class="fa fa-plus-circle"></i></button>
                </div>

                <p><input type="button" id="btnTambahHamil" class="btn btn-primary" onclick="tambah_tabel_hamil()" value="Tambah ke Tabel"></input></p>
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Tabel Riwayat Kehamilan</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0">
                        <table class="table table-bordered table-striped" id="tabelDataRiwayatHamil">
                          <tr id="tambahDataHamil">
                            <th style="text-align: center;" colspan="2">Hamil</th>
                            <th style="text-align: center;">Persalinan</th>
                            <th style="text-align: center;">Tempat Persalinan</th>
                            <th style="text-align: center;">Komplikasi Persalinan</th>
                            <th style="text-align: center;">Penolong</th>
                            <th style="text-align: center;" colspan="3">Keadaan BBL</th>
                            <th style="text-align: center;">Keadaan Anak Sekarang</th>
                            <th style="text-align: center;">KB</th>
                            <th style="text-align: center;">ASI</th>
                            <th></th>
                          </tr>
                          <tr>
                            <th>Ke</th>
                            <th>Komplikasi</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>P/L</th>
                            <th>Berat</th>
                            <th>Keadaan</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                          </tr>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                </div><!-- /.row -->

                <div id="field_input_riwayat_kawin">

                </div>
              </div>
            </div>

            <div class="tab"><b>RIWAYAT KEHAMILAN SEKARANG :</b>
              <div class="form-group"></div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6"> 
                    <div class="form-group">
                      <label class="col-sm-3" style="font-weight: normal;">G </label>
                      <label class="col-sm-6">
                        <input type="text" class="form-control" id="txtg" name="txtg" placeholder="..." oninput="this.className = 'form-control'" required>
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3" style="font-weight: normal;">Haid </label>
                      <label class="col-sm-6">
                        <select class="form-control" id="txtHaid" name="txtHaid" oninput="this.className = 'form-control'">
                          <option selected disabled value="">Haid...</option>
                          <option value="teratur">Teratur</option>
                          <option value="tidak">Tidak</option>
                        </select>
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3" style="font-weight: normal;">HPHT </label>
                      <label class="col-sm-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i>
                            </span>
                          </div>
                          <input type="text" id="txtHPHT" name="txtHPHT" onchange="this.className = 'form-control pull-right datepicker'" class="form-control pull-right datepicker">
                        </div>
                      </label>
                    </div>
                    <!-- <label class="control-label col-sm-4" for="nama">Tekanan Darah :</label> -->
                    <div class="form-group">
                      <label class="col-sm-3" style="font-weight: normal;">HPL </label>
                      <label class="col-sm-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i>
                            </span>
                          </div>
                          <input type="text" id="txtHPL" name="txtHPL" onchange="this.className = 'form-control pull-right datepicker'" class="form-control pull-right datepicker">
                        </div>
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3" style="font-weight: normal;">BB sebelum hamil </label>
                      <label class="col-sm-6">
                        <input type="number" min="0" style="text-align: right;" class="form-control" id="txtBBsblmhml" name="txtBBsblmhml" placeholder="..." oninput="this.className = 'form-control'" required>
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3" style="font-weight: normal;">Mual/Muntah </label>
                      <label class="col-sm-6">
                        <select class="form-control" id="txtMualMuntah" name="txtMualMuntah" oninput="this.className = 'form-control'" onchange="changeMual(this)">
                          <option selected disabled value="">Mual...</option>
                          <option value="ya">Ya</option>
                          <option value="tidak">Tidak</option>
                        </select>
                      </label>
                    </div>
                    <div class="form-group" style="display: none;" id="mual">
                      <label class="col-sm-3" style="font-weight: normal;">Keterangan Mual/Muntah</label>
                      <label class="col-sm-6">
                        <input type="text" class="form-control" id="txtmual" name="txtmual" placeholder="..." oninput="this.className = 'form-control'" required>
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3" style="font-weight: normal;">Pusing </label>
                      <label class="col-sm-6">
                        <select class="form-control" id="txtPusing" name="txtPusing" oninput="this.className = 'form-control'" onchange="changePusing(this)">
                          <option selected disabled value="">Pusing...</option>
                          <option value="ya">Ya</option>
                          <option value="tidak">Tidak</option>
                        </select>
                      </label>
                    </div>
                    <div class="form-group" style="display: none;" id="pusing">
                      <label class="col-sm-3" style="font-weight: normal;">Keterangan Pusing</label>
                      <label class="col-sm-6">
                        <input type="text" class="form-control" id="txtKeteranganPusing" name="txtKeteranganPusing" placeholder="..." oninput="this.className = 'form-control'" required>
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3" style="font-weight: normal;">Nyeri Perut </label>
                      <label class="col-sm-6">
                        <select class="form-control" id="txtNyeriPerut" name="txtNyeriPerut" oninput="this.className = 'form-control'" onchange="changeNyeriPerut(this)">
                          <option selected disabled value="">Nyeri Perut...</option>
                          <option value="ya">Ya</option>
                          <option value="tidak">Tidak</option>
                        </select>
                      </label>
                    </div>
                    <div class="form-group" style="display: none;" id="nyeri_perut">
                      <label class="col-sm-3" style="font-weight: normal;">Keterangan Nyeri Perut</label>
                      <label class="col-sm-6">
                        <input type="text" class="form-control" id="txtKeteranganNyeriPerut" name="txtKeteranganNyeriPerut" placeholder="..." oninput="this.className = 'form-control'" required>
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3" style="font-weight: normal;">Gerak Janin </label>
                      <label class="col-sm-6">
                        <select class="form-control" id="txtGerakJanin" name="txtGerakJanin" oninput="this.className = 'form-control'" onchange="changeGerakJanin(this)">
                          <option selected disabled value="">Gerak Janin...</option>
                          <option value="ya">Ya</option>
                          <option value="tidak">Tidak</option>
                        </select>
                      </label>
                    </div>
                    <div class="form-group" style="display: none;" id="gerak_janin">
                      <label class="col-sm-3" style="font-weight: normal;">Keterangan Gerak Janin</label>
                      <label class="col-sm-6">
                        <input type="text" class="form-control" id="txtketerangangerakJanin" name="txtketerangangerakJanin" placeholder="..." oninput="this.className = 'form-control'" required>
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3" style="font-weight: normal;">Oedema </label>
                      <label class="col-sm-6">
                        <select class="form-control" id="txtOedema" name="txtOedema" oninput="this.className = 'form-control'" onchange="changeOedema(this)">
                          <option selected disabled value="">Oedema...</option>
                          <option value="ya">Ya</option>
                          <option value="tidak">Tidak</option>
                        </select>
                      </label>
                    </div>
                    <div class="form-group" style="display: none;" id="oedema">
                      <label class="col-sm-3" style="font-weight: normal;">Keterangan Oedema</label>
                      <label class="col-sm-6">
                        <input type="text" class="form-control" id="txtKeteranganOedema" name="txtKeteranganOedema" placeholder="..." oninput="this.className = 'form-control'" required>
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3" style="font-weight: normal;">Nafsu Makan </label>
                      <label class="col-sm-6">
                        <select class="form-control" id="txtNafsuMakan" name="txtNafsuMakan" oninput="this.className = 'form-control'" onchange="changeNafsuMakan(this)">
                          <option selected disabled value="">Nafsu Makan...</option>
                          <option value="baik">Baik</option>
                          <option value="menurun">Menurun</option>
                        </select>
                      </label>
                    </div>
                    <div class="form-group" style="display: none;" id="nafsu_makan">
                      <label class="col-sm-3" style="font-weight: normal;">Keterangan Nafsu Makan</label>
                      <label class="col-sm-6">
                        <input type="text" class="form-control" id="txtKeteranganNafsuMakan" name="txtKeteranganNafsuMakan" placeholder="..." oninput="this.className = 'form-control'" required>
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3" style="font-weight: normal;">Pendarahan </label>
                      <label class="col-sm-6">
                        <select class="form-control" id="txtPendarahan" name="txtPendarahan" oninput="this.className = 'form-control'" onchange="changePendarahan(this)">
                          <option selected disabled value="">Pendarahan...</option>
                          <option value="ya">Ya</option>
                          <option value="tidak">Tidak</option>
                        </select>
                      </label>
                    </div>
                    <div class="form-group" style="display: none;" id="pendarahan">
                      <label class="col-sm-3" style="font-weight: normal;">Pendarahan Sejak</label>
                      <label class="col-sm-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i>
                            </span>
                          </div>
                          <input type="text" id="txtPendarahansejak" name="txtPendarahansejak" onchange="this.className = 'form-control pull-right datepicker'" class="form-control pull-right datepicker" id="datepicker">
                        </div> 
                      </label>
                    </div>
                    <div class="form-group"  id="keluhan_utama">
                      <label class="col-sm-3" style="font-weight: normal;">Keluhan Utama</label>
                      <label class="col-sm-6">
                        <input type="text" name="txt_keluhan_utama" oninput="this.className = 'form-control'" placeholder="..." class="form-control">
                      </label>
                    </div>
                    <div class="form-group"  id="hasil_skor_kspr">
                      <label class="col-sm-3" style="font-weight: normal;">Hasil Skor KSPR</label>
                      <label class="col-sm-6">
                        <select class="form-control" id="txtHasilKSPR" name="txtHasilKSPR" oninput="this.className = 'form-control'">
                          <option selected disabled value="">KSPR...</option>
                          <option value="rst">RST</option>
                          <option value="rt">RT</option>
                          <option value="rr">RR</option>
                        </select>
                      </label>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group"  id="hasil_skor_kspr">
                      <label class="col-sm-3" style="font-weight: normal;">Deteksi Oleh Tenaga Kesehatan</label>
                      <label class="col-sm-6">
                        <select class="form-control" id="txtDOTK" name="txtDOTK" oninput="this.className = 'form-control'">
                          <option selected disabled value="">Deteksi...</option>
                          <option value="+">+</option>
                          <option value="-">-</option>
                        </select>
                      </label>
                    </div>
                    <div class="form-group"  id="hasil_skor_kspr">
                      <label class="col-sm-3" style="font-weight: normal;">Deteksi Oleh Masyarakat</label>
                      <label class="col-sm-6">
                        <select class="form-control" id="txtDOM" name="txtDOM" oninput="this.className = 'form-control'">
                          <option selected disabled value="">Deteksi...</option>
                          <option value="+">+</option>
                          <option value="-">-</option>
                        </select>
                      </label>
                    </div>
                    <div class="form-group"  id="hasil_skor_kspr">
                      <label class="col-sm-3" style="font-weight: normal;">Rujuk Ke</label>
                      <label class="col-sm-6">
                        <input type="text" name="txt_rujuk_ke" oninput="this.className = 'form-control'" placeholder="..." class="form-control">
                      </label>
                    </div>
                    <div class="form-group"  id="hasil_skor_kspr">
                      <label class="col-sm-3" style="font-weight: normal;">Penyakit yang Diderita Bumil</label>
                      <label class="col-sm-6">
                        <input type="text" name="txt_penyakit_yang_diderita" oninput="this.className = 'form-control'" placeholder="..." class="form-control">
                      </label>
                    </div>
                    <div class="form-group"  id="hasil_skor_kspr">
                      <label class="col-sm-3" style="font-weight: normal;">Riwayat Penyakit Keluarga</label>
                      <label class="col-sm-6">
                        <input type="text" name="txt_riwayat_penyakit_keluarga" oninput="this.className = 'form-control'" placeholder="..." class="form-control">
                      </label>
                    </div>
                    <div class="form-group"  id="hasil_skor_kspr">
                      <label class="col-sm-3" style="font-weight: normal;">Kebiasaan Ibu</label>
                      <label class="col-sm-6">
                        <input type="text" name="txt_kebiasaan_ibu" oninput="this.className = 'form-control'" placeholder="..." class="form-control">
                      </label>
                    </div>
                    <div class="form-group"  id="hasil_skor_kspr">
                      <label class="col-sm-3" style="font-weight: normal;">Status TT</label>
                      <label class="col-sm-6">
                        <select class="form-control" id="txtStatusTT" name="txtStatusTT" oninput="this.className = 'form-control'">
                          <option selected disabled value="">TT...</option>
                          <option value="+">T1</option>
                          <option value="-">T2</option>
                          <option value="-">T3</option>
                          <option value="-">T4</option>
                          <option value="-">T5</option>
                        </select>
                      </label>
                    </div>
                    <div class="form-group"  id="tgl_imunisasi">
                      <label class="col-sm-3" style="font-weight: normal;">Tanggal Imuinisasi</label>
                      <label class="col-sm-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i>
                            </span>
                          </div>
                          <input type="text" name="tanggal_imunisasi" onchange="this.className = 'form-control pull-right datepicker'" class="form-control pull-right datepicker" id="datepicker">
                        </div> 
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3" style="font-weight: normal;">Resiko HIV/AIDS </label>
                      <label class="col-sm-6">
                        <select class="form-control" id="txtResikoHIV" name="txtResikoHIV" oninput="this.className = 'form-control'" onchange="changeResikHiv(this)">
                          <option selected disabled value="">Resiko...</option>
                          <option value="ya">Ya</option>
                          <option value="tidak">Tidak</option>
                        </select>
                      </label>
                    </div>
                    <div class="form-group" style="display: none;" id="penyebab_hiv">
                      <label class="col-sm-3" style="font-weight: normal;">Penyebab HIV</label>
                      <label class="col-sm-6">
                       <input type="text" id="txt_penyebab_hiv" name="txt_penyebab_hiv" oninput="this.className = 'form-control'" placeholder="..." class="form-control">
                     </label>
                   </div>
                 </div>
               </div>
             </div>
           </div>

          <div class="tab"><b>PEMERIKSAAN:</b>
            <div class="form-group"></div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6"> 
                  <div class="form-group">
                    <label class="col-sm-3" style="font-weight: normal;" >TB </label>
                    <label class="col-sm-6">
                      <input type="number" min="1" style="text-align: right;" class="form-control" id="txtTB" name="txtTB" placeholder="..." oninput="this.className = 'form-control'" required>
                    </label>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3" style="font-weight: normal;" >LILA </label>
                    <label class="col-sm-6">
                      <input type="number" min="1" style="text-align: right;" class="form-control" id="txtLILA" name="txtLILA" placeholder="..." oninput="this.className = 'form-control'" required>
                    </label>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3" style="font-weight: normal;" >IMT </label>
                    <label class="col-sm-6">
                      <input type="number" min="1" style="text-align: right;" class="form-control" id="txtIMT" name="txtIMT" placeholder="..." oninput="this.className = 'form-control'" required>
                    </label>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3" style="font-weight: normal;" >Bentuk Tubuh</label>
                    <label class="col-sm-6">
                      <select class="form-control" id="txtBentukTubuh" name="txtBentukTubuh" oninput="this.className = 'form-control'" onchange="changeBentukTubuh(this)">
                        <option selected disabled value="">Bentuk Tubuh...</option>
                        <option value="normal">Normal</option>
                        <option value="tidak">Tidak</option>
                      </select>
                    </label>
                  </div>
                  <div class="form-group" style="display: none;" id="ketBentukTubuh">
                    <label class="col-sm-3" style="font-weight: normal;">Keterangan Bentuk Tubuh</label>
                    <label class="col-sm-6">
                      <input type="text" class="form-control" id="txtKetBentukTubuh" name="txtKetBentukTubuh" placeholder="..." oninput="this.className = 'form-control'" required>
                    </label>
                  </div>
                  <div class="form-group" >
                    <label class="col-sm-3" style="font-weight: normal;" >Kesadaran </label>
                    <label class="col-sm-6">
                      <select class="form-control" id="txtKesadaran" name="txtKesadaran" oninput="this.className = 'form-control'" onchange="changeKesadaran(this)">
                        <option selected disabled value="">Kesadaran...</option>
                        <option value="baik">Baik</option>
                        <option value="tidak">Tidak</option>
                      </select>
                    </label>
                  </div>
                  <div class="form-group" style="display: none;" id="ketKesadaran">
                    <label class="col-sm-3" style="font-weight: normal;">Keterangan Kesadaran</label>
                    <label class="col-sm-6">
                      <input type="text" class="form-control" id="txtketKesadaran" name="txtketKesadaran" placeholder="..." oninput="this.className = 'form-control'" required>
                    </label>
                  </div>
                  <div class="form-group" >
                    <label class="col-sm-3" style="font-weight: normal;" >Muka </label>
                    <label class="col-sm-6">
                      <select class="form-control" id="txtMuka" name="txtMuka" oninput="this.className = 'form-control'" onchange="changeKetMuka(this)">
                        <option selected disabled value="">Muka...</option>
                        <option value="pucat">Pucat</option>
                        <option value="tidak">Tidak</option>
                      </select>
                    </label>
                  </div>
                  <div class="form-group" style="display: none;" id="ketMuka">
                    <label class="col-sm-3" style="font-weight: normal;">Keterangan Muka</label>
                    <label class="col-sm-6">
                      <input type="text" class="form-control" id="txtketMuka" name="txtketMuka" placeholder="..." oninput="this.className = 'form-control'" required>
                    </label>
                  </div>
                  <div class="form-group" >
                    <label class="col-sm-3" style="font-weight: normal;" >Kulit </label>
                    <label class="col-sm-6">
                      <select class="form-control" id="txtKulit" name="txtKulit" oninput="this.className = 'form-control'" onchange="changeKulit(this)">
                        <option selected disabled value="">Kulit...</option>
                        <option value="normal">Normal</option>
                        <option value="tidak">Tidak</option>
                      </select>
                    </label>
                  </div>
                  <div class="form-group" style="display: none;" id="ketKulit">
                    <label class="col-sm-3" style="font-weight: normal;">Keterangan Kulit</label>
                    <label class="col-sm-6">
                      <input type="text" class="form-control" id="txtketKulit" name="txtketKulit" placeholder="..." oninput="this.className = 'form-control'" required>
                    </label>
                  </div>
                  <div class="form-group" >
                    <label class="col-sm-3" style="font-weight: normal;" >Mata </label>
                    <label class="col-sm-6">
                      <select class="form-control" id="txtMata" name="txtMata" oninput="this.className = 'form-control'" onchange="changeMata(this)">
                        <option selected disabled value="">Mata...</option>
                        <option value="normal">Normal</option>
                        <option value="tidak">Tidak</option>
                      </select>
                    </label>
                  </div>
                  <div class="form-group" style="display: none;" id="ketMata">
                    <label class="col-sm-3" style="font-weight: normal;">Keterangan Mata</label>
                    <label class="col-sm-6">
                      <input type="text" class="form-control" id="txtketMata" name="txtketMata" placeholder="..." oninput="this.className = 'form-control'" required>
                    </label>
                  </div>

                </div>
                <div class="col-md-6"> 
                  <div class="form-group" >
                    <label class="col-sm-3" style="font-weight: normal;" >Mulut </label>
                    <label class="col-sm-6">
                      <select class="form-control" id="txtMulut" name="txtMulut" oninput="this.className = 'form-control'" onchange="changeMulut(this)">
                        <option selected disabled value="">Mulut...</option>
                        <option value="normal">Normal</option>
                        <option value="tidak">Tidak</option>
                      </select>
                    </label>
                  </div>
                  <div class="form-group" style="display: none;" id="ketMulut">
                    <label class="col-sm-3" style="font-weight: normal;">Keterangan Mulut</label>
                    <label class="col-sm-6">
                      <input type="text" class="form-control" id="txtketMulut" name="txtketMulut" placeholder="..." oninput="this.className = 'form-control'" required>
                    </label>
                  </div>
                  <div class="form-group" >
                    <label class="col-sm-3" style="font-weight: normal;" >Gigi </label>
                    <label class="col-sm-6">
                      <select class="form-control" id="txtGigi" name="txtGigi" oninput="this.className = 'form-control'" onchange="changeGigi(this)">
                        <option selected disabled value="">Gigi...</option>
                        <option value="normal">Normal</option>
                        <option value="tidak">Tidak</option>
                      </select>
                    </label>
                  </div>
                  <div class="form-group" style="display: none;" id="ketGigi">
                    <label class="col-sm-3" style="font-weight: normal;">Keterangan Gigi</label>
                    <label class="col-sm-6">
                      <input type="text" class="form-control" id="txtketGigi" name="txtketGigi" placeholder="..." oninput="this.className = 'form-control'" required>
                    </label>
                  </div>
                  <div class="form-group" >
                    <label class="col-sm-3" style="font-weight: normal;" >Pembesaran Kel </label>
                    <label class="col-sm-6">
                      <select class="form-control" id="txtPemKel" name="txtPemKel" oninput="this.className = 'form-control'" onchange="changePembKel(this)">
                        <option selected disabled value="">PemKel...</option>
                        <option value="ya">Ya</option>
                        <option value="tidak">Tidak</option>
                      </select>
                    </label>
                  </div>
                  <div class="form-group" style="display: none;" id="ketPemKel">
                    <label class="col-sm-3" style="font-weight: normal;">Keterangan Pembesaran Kel</label>
                    <label class="col-sm-6">
                      <input type="text" class="form-control" id="txtketPemKel" name="txtketPemKel" placeholder="..." oninput="this.className = 'form-control'" required>
                    </label>
                  </div>
                  <div class="form-group" >
                    <label class="col-sm-3" style="font-weight: normal;" >Dada </label>
                    <label class="col-sm-6">
                      <select class="form-control" id="txtDada" name="txtDada" oninput="this.className = 'form-control'" onchange="changeKetDada(this)">
                        <option selected disabled value="">Dada...</option>
                        <option value="normal">Normal</option>
                        <option value="tidak">Tidak</option>
                      </select>
                    </label>
                  </div>
                  <div class="form-group" style="display: none;" id="ketDada">
                    <label class="col-sm-3" style="font-weight: normal;">Keterangan Dada</label>
                    <label class="col-sm-6">
                      <input type="text" class="form-control" id="txtketDada" name="txtketDada" placeholder="..." oninput="this.className = 'form-control'" required>
                    </label>
                  </div>
                  <div class="form-group" >
                    <label class="col-sm-3" style="font-weight: normal;" >Paru/Jantung </label>
                    <label class="col-sm-6">
                      <select class="form-control" id="txtParu" name="txtParu" oninput="this.className = 'form-control'" onchange="changeParu(this)">
                        <option selected disabled value="">Paru...</option>
                        <option value="normal">Normal</option>
                        <option value="tidak">Tidak</option>
                      </select>
                    </label>
                  </div>
                  <div class="form-group" style="display: none;" id="ketParu">
                    <label class="col-sm-3" style="font-weight: normal;">Keterangan Paru</label>
                    <label class="col-sm-6">
                      <input type="text" class="form-control" id="txtketParu" name="txtketParu" placeholder="..." oninput="this.className = 'form-control'" required>
                    </label>
                  </div>
                  <div class="form-group" >
                    <label class="col-sm-3" style="font-weight: normal;" >Jantung </label>
                    <label class="col-sm-6">
                      <select class="form-control" id="txtJantung" name="txtJantung" oninput="this.className = 'form-control'" onchange="changeJantung(this)">
                        <option selected disabled value="">Jantung...</option>
                        <option value="normal">Normal</option>
                        <option value="tidak">Tidak</option>
                      </select>
                    </label>
                  </div>
                  <div class="form-group" style="display: none;" id="ketJantung">
                    <label class="col-sm-3" style="font-weight: normal;">Keterangan Jantung</label>
                    <label class="col-sm-6">
                      <input type="text" class="form-control" id="txtketJantung" name="txtketJantung" placeholder="..." oninput="this.className = 'form-control'" required>
                    </label>
                  </div>
                  <div class="form-group" >
                    <label class="col-sm-3" style="font-weight: normal;" >Payudara </label>
                    <label class="col-sm-6">
                      <select class="form-control" id="txtPayudara" name="txtPayudara" oninput="this.className = 'form-control'" onchange="changePayudara(this)">
                        <option selected disabled value="">Payudara...</option>
                        <option value="normal">Normal</option>
                        <option value="tidak">Tidak</option>
                      </select>
                    </label>
                  </div>
                  <div class="form-group" style="display: none;" id="ketPayudara">
                    <label class="col-sm-3" style="font-weight: normal;">Keterangan Payudara</label>
                    <label class="col-sm-6">
                      <input type="text" class="form-control" id="txtketPayudara" name="txtketPayudara" placeholder="..." oninput="this.className = 'form-control'" required>
                    </label>
                  </div>
                  <div class="form-group" >
                    <label class="col-sm-3" style="font-weight: normal;" >Tangan Tungkai </label>
                    <label class="col-sm-6">
                      <select class="form-control" id="txtTangan" name="txtTangan" oninput="this.className = 'form-control'">
                        <option selected disabled value="">Tangan...</option>
                        <option value="normal">Normal</option>
                        <option value="oedema">Oedema</option>
                      </select>
                    </label>
                  </div>
                  <div class="form-group" >
                    <label class="col-sm-3" style="font-weight: normal;" >Refleks</label>
                    <label class="col-sm-6">
                      <select class="form-control" id="txtRefleks" name="txtRefleks" oninput="this.className = 'form-control'">
                        <option selected disabled value="">Refleks...</option>
                        <option value="ada">Ada</option>
                        <option value="tidak">Tidak</option>
                      </select>
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="tab"><b>RENCANA PERSALINAN:</b>
            <div class="form-group"></div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6"> 
                  <div class="form-group row">
                    <label class="col-sm-3" style="font-weight: normal;" >Gol. Darah Ibu </label>
                    <label class="col-sm-6">
                      <input type="text" class="form-control" id="txtGolIbu" name="txtGolIbu" placeholder="..." oninput="this.className = 'form-control'" required>
                    </label>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3" style="font-weight: normal;" >Gol. Darah Suami </label>
                    <label class="col-sm-6">
                      <input type="text" class="form-control" id="txtGolAyah" name="txtGolAyah" placeholder="..." oninput="this.className = 'form-control'" required>
                    </label>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3" style="font-weight: normal;" >Penolong </label>
                    <label class="col-sm-6">
                      <input type="text" class="form-control" id="txtPenolongPersalinan" name="txtPenolongPersalinan" placeholder="..." oninput="this.className = 'form-control'" required>
                    </label>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3" style="font-weight: normal;" >Tempat</label>
                    <label class="col-sm-6">
                      <input type="text" class="form-control" id="txtTempat" name="txtTempat" placeholder="..." oninput="this.className = 'form-control'" required>
                    </label>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3" style="font-weight: normal;">Pendamping</label>
                    <label class="col-sm-6">
                      <input type="text" class="form-control" id="txtPendamping" name="txtPendamping" placeholder="..." oninput="this.className = 'form-control'" required>
                    </label>
                  </div>                   
                  <div class="form-group row" >
                    <label class="col-sm-3" style="font-weight: normal;" >Calon donor </label>
                    <label class="col-sm-6">
                      <input type="text" class="form-control" id="txtCalonDonor" name="txtCalonDonor" placeholder="..." oninput="this.className = 'form-control'" required>
                    </label>
                  </div>
                </div>
                <div class="col-md-6"> 
                  <div class="form-group row">
                    <label class="col-sm-3" style="font-weight: normal;">Sticker P4K</label>
                    <label class="col-sm-6">
                      <select class="form-control" id="txtSticker" name="txtSticker" oninput="this.className = 'form-control'">
                        <option value="ya">Ya</option>
                        <option value="tidak">Tidak</option>
                      </select>
                    </label>
                  </div>
                  <div class="form-group row" >
                    <label class="col-sm-3" style="font-weight: normal;" >Dipasang tanggal </label>
                    <label class="col-sm-6">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-calendar"></i>
                          </span>
                        </div>
                        <input type="text" class="form-control datepicker" id="txtTglPasang" name="txtTglPasang" onchange="this.className = 'form-control datepicker'">
                      </div>
                    </label>
                  </div> 
                  <div class="form-group row">
                    <label class="col-sm-3" style="font-weight: normal;" >Kesimpulan Diagnosa </label>
                    <label class="col-sm-6">
                      <textarea class="form-control" id="txtKesimpulanDiagnosa" name="txtKesimpulanDiagnosa" placeholder="..." oninput="this.className = 'form-control'" rows="7" required></textarea>
                    </label>
                  </div> 
                </div>
              </div>
            </div>
          </div> 

          <div class="tab"><b>INFORMED CONSENT:</b>
            <div class="col-lg-12">
              <div class="row">
                <div class="col-lg-10">
                  <div class="form-group">
                    <!-- <p>INFORMED CONSENT PASIEN</p> -->
                    <!-- <img id="imgIc" style="width:100%; height:100%;" src=""> -->
                    <div id="dpIC">
                      <input type="file" id="input-file-now" name="lampiran[]" multiple class="dropify" data-show-remove="true" data-height="500" data-allowed-file-extensions="jpg jpeg png"/>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <br>
            <b>PERHITUNGAN HARGA:</b>
            <div class="col-md-16">
              <div class="row">
                <div class="col-md-8"> 
                  <div class="form-group"> 
                    <label class="control-label col-sm-3"style>1. Harga Layanan :</label> 
                    <label class="control-label col-lg-8" style="font-weight: normal;">
                      Rp. <span id="harga_layanan">{{$layanan[0]->str_tarif_layanan}}</span> ,-
                    </label>
                  </div> 
                  <span id="titleObat"><label class="control-label col-sm-4"style>2. Obat yang diberikan :</label></span>
                  <div id="show_list_obat">
                    <?php 
                    $list_obat = '';
                    $list_qty = '';
                    $harga_obat = 0;
                    ?>
                    <?php foreach ($layanan as $key => $value): ?>
                      <?php
                      $list_obat .= $value->id_obat.';';
                      $list_qty .= $value->qty.";";
                      $harga_obat += $value->subtotal;
                      ?>
                      <div class="form-group">
                        <label class="control-label col-sm-3" style="font-weight: normal;">- <?php echo $value->nama; ?></label> 
                        <label class="control-label col-lg-6" style="font-weight: normal;">
                          Rp. <span id="hargaObat3"><?php echo $value->str_subtotal; ?></span> ,-
                        </label>
                      </div>
                    <?php endforeach ?>
                  </div>
                  <div class="form-group"> 
                    <label class="control-label col-sm-3">Total Harga :</label> 
                    <label class="control-label col-lg-8">
                      Rp. <span id="totalHarga">{{$layanan[0]->str_tarif_total}}</span> ,-
                    </label>
                  </div>
                </div>
              </div>
            </div> 
          </div>

          <div class="tab"><b>KSPR:</b>
            <div class="form-group"></div>
            <div class="col-md-12">
              <div class="row">
                <table class="table table-bordered">
                  <tr>
                    <th>No.</th>
                    <th>Masalah/Faktor Risiko</th>
                    <th>SKOR</th>
                    <th>Tribulan</th>
                  </tr>
                  <?php $banturow = 0; ?>
                  <?php foreach ($kspr_table as $key => $value): ?>
                    <tr>
                      <?php
                        if(strpos($value['text'], ':')){
                          $ex_text = explode(":", $value['text']);
                          $text = $ex_text[0].' : <BR>'.str_replace("~", "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp", $ex_text[1]);
                        }
                        else{
                          $text = str_replace("~", "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp", $value['text']);
                        }

                        $skor = explode(";", $value['opsi']);
                        if($value['urutan'] != 0){
                          $max_skor = $skor[1]; 
                        }
                        else{
                          $max_skor = 2;
                        }

                      ?>

                        <td><?php echo $value['urutan']; ?></td>
                        <td><?php echo $text; ?></td>
                        <td style="text-align: right;"><?php echo $max_skor; ?></td>
                        <td style="text-align: center;">
                          <?php if ($value['urutan'] == 0): ?>
                            <?php echo $max_skor; ?>
                          <?php else: ?>
                            <select class="form-control" id="cboOpsi<?php echo $key; ?>" name="cboOpsi[]" oninput="this.className = 'form-control'" onchange="sumTotal()">
                              <?php foreach ($skor as $key_skor => $value_skor): ?>
                                  <?php if ($key_skor == 0): ?>
                                    <option value="<?php echo $value_skor; ?>" selected><?php echo $value_skor; ?></option>
                                  <?php else: ?>
                                    <option value="<?php echo $value_skor; ?>"><?php echo $value_skor; ?></option>
                                  <?php endif ?>
                              <?php endforeach ?>
                          </select>
                          <?php endif ?>
                        </td>
                    </tr>                      
                  <?php endforeach ?>
                    <tfoot>
                      <tr>
                        <td colspan="2"></td>
                        <td style="text-align: right;"><label>Total KSPR :</label></td>
                        <td style="text-align: right;"><label id="total_kspr">2</label></td>
                      </tr>
                    </tfoot>
                </table>

                <table class="table table-bordered" id="tablerujukan" style="display: contents;">
                  <tr>
                    <th colspan="4" style="text-align: center;">KEHAMILAN</th>
                    <th colspan="5" style="text-align: center;">PERSALINAN DENGAN RESIKO</th>
                  </tr>
                  <tr>
                    <th rowspan="2" style="text-align: center;">JML. SKOR</th>
                    <th rowspan="2" style="text-align: center;">KEL. SKOR</th>
                    <th rowspan="2" style="text-align: center;">PERAWATAN</th>
                    <th rowspan="2" style="text-align: center;">RUJUKAN</th>
                    <th rowspan="2" style="text-align: center;">TEMPAT</th>
                    <th rowspan="2" style="text-align: center;">PENOLONG</th>
                    <th colspan="3" style="text-align: center;">RUJUKAN</th>
                  </tr>
                  <tr>
                    <th>RDB</th>
                    <th>RDR</th>
                    <th>RTW</th>
                  </tr>

                  
                    <tr id="traman" style="display: contents;">
                      <td style="background-color: #47d147;">2</td>
                      <td style="background-color: #47d147;">KRR</td>
                      <td style="background-color: #47d147;">BIDAN</td>
                      <td style="background-color: #47d147;">TIDAK DIRUJUK</td>
                      <td style="background-color: #47d147;">RUMAH POLINDES</td>
                      <td style="background-color: #47d147;">BIDAN</td>
                      <td style="background-color: #47d147; text-align: center;"><input type="radio" name="rdoRujukan" id="rdoRujukanHijau1" value="rdb-hijau" checked></input></td>
                      <td style="background-color: #47d147; text-align: center;"><input type="radio" name="rdoRujukan" id="rdoRujukanHijau2" value="rdr-hijau"></input></td>
                      <td style="background-color: #47d147; text-align: center;"><input type="radio" name="rdoRujukan" id="rdoRujukanHijau3" value="rtw-hijau"></input></td>
                    </tr>

                    <tr id="trtengah" style="display: none;">
                      <td style="background-color: yellow;">6-10</td>
                      <td style="background-color: yellow;">KRT</td>
                      <td style="background-color: yellow;">BIDAN DOKTER</td>
                      <td style="background-color: yellow;">BIDAN PKM</td>
                      <td style="background-color: yellow;">POLINDES PKM/RS</td>
                      <td style="background-color: yellow;">BIDAN DOKTER</td>
                      <td style="background-color: yellow; text-align: center;"><input type="radio" name="rdoRujukan" id="rdoRujukanKuning1" value="rdb-kuning"></input></td>
                      <td style="background-color: yellow; text-align: center;"><input type="radio" name="rdoRujukan" id="rdoRujukanKuning2" value="rdr-kuning"></input></td>
                      <td style="background-color: yellow; text-align: center;"><input type="radio" name="rdoRujukan" id="rdoRujukanKuning3" value="rtw-kuning"></input></td>
                    </tr>

                    <tr id="trkritis" style="display: none;">
                      <td style="background-color: red;">≥ 12</td>
                      <td style="background-color: red;">KRST</td>
                      <td style="background-color: red;">DOKTER</td>
                      <td style="background-color: red;">RUMAH SAKIT</td>
                      <td style="background-color: red;">RUMAH SAKIT</td>
                      <td style="background-color: red;">DOKTER</td>
                      <td style="background-color: red; text-align: center;"><input type="radio" name="rdoRujukan" id="rdoRujukanMerah1" value="rdb-merah"></input></td>
                      <td style="background-color: red; text-align: center;"><input type="radio" name="rdoRujukan" id="rdoRujukanMerah2" value="rdr-merah"></input></td>
                      <td style="background-color: red; text-align: center;"><input type="radio" name="rdoRujukan" id="rdoRujukanMerah3" value="rtw-merah"></input></td>
                    </tr>
                </table>
              </div>
            </div>
          </div>                  

          <div style="overflow:auto;">
            <div style="float:right;">
              <input type="hidden" name="id_layanan" id="id_layanan" value="{{$layanan[0]->id_layanan}}"></input>
              <input type="hidden" name="list_obat" id="list_obat" value="{{$list_obat}}"></input>
              <input type="hidden" name="list_qty" value="{{$list_qty}}"></input>
              <input type="hidden" name="harga_obat" value="{{$harga_obat}}"></input>
              <input type="hidden" name="harga_layanan" value="{{$layanan[0]->tarif_layanan}}"></input>
              <input type="hidden" name="harga_total" value="{{$layanan[0]->tarif_total}}"></input>
              <input type="hidden" id="riwayat_hamil" name="riwayat_hamil"></input>
              <input type="hidden" id="grandtotalkspr" name="grandtotalkspr" value="2"></input>
              <input type="hidden" name="_token" value="{!!csrf_token()!!}">
              <button type="button" class="btn btn-primary" id="prevBtn" onclick="nextPrev(-1)">Sebelumnya</button>
              <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextPrev(1)">Selanjutnya</button>
            </div>
          </div>

          <!-- Circles which indicates the steps of the form: -->
          <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
          </div>

        </form>
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
  <script type="text/javascript">
      var counter = 1;
      var dataRiwayatKawin = [];
      function tambah_tabel(tipe){
        var valid_process = true;
        var kawin_ke =  $('#txtKawinke').val();
        var lama_kawin_tahun =  $('#txtLamaKawin').val();
        var lama_kawin_bulan =  $('#txtLamaKawinBulan').val();
        var lama_kawin = lama_kawin_tahun +" Tahun " + lama_kawin_bulan + " Bulan";
        var sebab_pisah =  $('#cboSebabPisah option:selected').text();
        var sebab_meninggal =  "";

        if(kawin_ke == ""){
          document.getElementById("txtKawinke").className += " invalid";
          valid_process = false;
        }

        if(lama_kawin_tahun == "" && lama_kawin_bulan == ""){
          document.getElementById("txtLamaKawin").className += " invalid";
          document.getElementById("txtLamaKawinBulan").className += " invalid";
          valid_process = false;
        }
        else{

          if(lama_kawin_bulan == ""){
            lama_kawin = lama_kawin_tahun + " Tahun";
          }
          else if(lama_kawin_tahun == ""){
            lama_kawin = lama_kawin_bulan + " Bulan";
          }
          document.getElementById("txtLamaKawin").className = "form-control";
          document.getElementById("txtLamaKawinBulan").className = "form-control";
        }

        if(sebab_pisah == "Sebab Pisah..."){
          document.getElementById("cboSebabPisah").className += " invalid";
          valid_process = false;
        }
        else if(sebab_pisah == 'Masih Berjalan'){
          sebab_pisah = "-";
          sebab_meninggal = "";
        }
        else if(sebab_pisah == 'Meninggal'){
          sebab_meninggal = $('#txtSebabmeninggal').val();
        }
        else{
          sebab_meninggal = "";
        }

        if(valid_process == true){
          if(tipe == 1){
            var newTextBoxDiv = $(document.createElement('tr')).attr("id", 'trdata'+ counter);

            newTextBoxDiv.after().html(
              '<td>'+kawin_ke+'</td>'+
              '<td>'+lama_kawin+'</td>'+
              '<td>'+sebab_pisah+'</td>'+
              '<td>'+sebab_meninggal+'</td>'+
              '<td><span class="btn btn-danger" onclick="kurang_tabel('+counter+','+tipe+')">X</span></td>');

            newTextBoxDiv.appendTo("#tabelDataRiwayatKawin");

            var save_variable = kawin_ke+";"+lama_kawin+";"+sebab_pisah+";"+sebab_meninggal;

              // CREATE HIDDEN ELEMENT FOR SAVE ID'S CHOOSE
              var input = document.createElement("input");
              input.setAttribute('type', 'hidden');
              input.setAttribute('id', 'tbl'+counter);
              input.setAttribute('name', 'riwayat_kawin[]');
              input.setAttribute('value', save_variable);

              var parent = document.getElementById("field_input_riwayat_kawin");
              parent.appendChild(input);
            }
            else{
              var newTextBoxDiv = $(document.createElement('tr')).attr("id", 'trdataedit'+ counter);
              
              newTextBoxDiv.after().html(
                '<td>'+kawin_ke+'</td>'+
                '<td>'+lama_kawin+'</td>'+
                '<td>'+sebab_pisah+'</td>'+
                '<td>'+sebab_meninggal+'</td>'+
                '<td><span class="btn btn-danger" onclick="kurang_tabel('+counter+','+tipe+')">X</span></td>');

              newTextBoxDiv.appendTo("#bodyriwayatkawinedit");

              var save_variable = kawin_ke+";"+lama_kawin+";"+sebab_pisah+";"+sebab_meninggal;

              // CREATE HIDDEN ELEMENT FOR SAVE ID'S CHOOSE
              var input = document.createElement("input");
              input.setAttribute('type', 'hidden');
              input.setAttribute('id', 'tbl_edit'+counter);
              input.setAttribute('name', 'riwayat_kawin_edit[]');
              input.setAttribute('value', save_variable);

              var parent = document.getElementById("field_input_riwayat_kawin");
              parent.appendChild(input);
            }

            counter++;        
          }    
      }

      function kurang_tabel(id, tipe){
        if(counter==1){
          alert("No more textbox to remove");
          return false;
        }   

        counter--;

        if(tipe == 1){
          $("#trdata" + id).remove();
          
          var parent = document.getElementById("field_input_riwayat_kawin");
          var element = document.getElementById('tbl'+id);
          parent.removeChild(element);
        }
        else{
          $("#trdataedit" + id).remove();
          
          var parent = document.getElementById("field_input_riwayat_kawin");
          var element = document.getElementById('tbl_edit'+id);
          parent.removeChild(element);
        }

      }

      var counterhamil = 1;
      var dataRiwayatHamil = [];
      var dataKehamilanke = [];

      function tambah_tabel_hamil(){
        var valid_process = true;
        var hamil_ke = document.getElementById("txthamilke").value;
        var kehamilan_ke = document.getElementById("txtKehamilanKe").value;
        var komplikasi = document.getElementById("txtKomplikasi").value;
        var persalinan = document.getElementById("txtPersalinan").value;
        var tempat_persalinan = document.getElementById("txtTempatPersalinan").value;
        var komplikasi_persalinan = document.getElementById("txtKomplikasiPersalinan").value;
        var penolong = document.getElementById("txtPenolong").value;

        var jenis_kelamin= document.getElementsByName("txtJenisKelamin[]");
        var berat= document.getElementsByName("txtBerat[]");
        var keadaan = document.getElementsByName("txtKeadaan[]");
        var keadaan_anak = document.getElementsByName("txtKeadaanAnak[]");
        var ket_keadaan_anak = document.getElementsByName("txtKetKeadaanAnak[]");
        var kb = document.getElementsByName("txtKB[]");
        var asi = document.getElementsByName("txtAsi[]");

        var x = document.getElementsByClassName("tab");
        var y = x[3].getElementsByTagName("input");
        var z = x[3].getElementsByTagName("select");

        for (i = 0; i < y.length; i++) {
          if(y[i].id == "txthamilke" || y[i].id == "txtKehamilanKe"){
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              valid_process = false;
            }
          }   

          if(y[i].name == "txtBerat[]" || y[i].name == "txtKetKeadaanAnak[]" || y[i].name == "txtKB[]" || y[i].name == "txtAsi[]"){
            var element = document.getElementsByName(y[i].name);
            for(a = 0; a < element.length; a ++){
              // If a field is empty...
              if (element[a].value == "") {
                // add an "invalid" class to the field:
                element[a].className += " invalid";
                valid_process = false;
              }
            }
          }     
        }

        for (m = 0; m < z.length; m++) {
          if(z[m].id == "txtKomplikasi" || z[m].id == "txtPersalinan" || z[m].id == "txtTempatPersalinan" || z[m].id == "txtKomplikasiPersalinan" || z[m].id == "txtPenolong"){
              // If a field is empty...
              if (z[m].value == "") {
                // add an "invalid" class to the field:
                z[m].className += " invalid";
                valid_process = false;
              }
            }

            if(z[m].name == "txtJenisKelamin[]" || z[m].name == "txtKeadaan[]" || z[m].name == "txtKeadaanAnak[]"){
              var element2 = document.getElementsByName(z[m].name);
              for(c = 0; c < element2.length; c ++){
              // If a field is empty...
              if (element2[c].value == "") {
                // add an "invalid" class to the field:
                element2[c].className += " invalid";
                valid_process = false;
              }
            }
          }
        }

        if(parseInt(kehamilan_ke) > (parseInt(hamil_ke) - 1)){
          alert("Kehamilan ke tidak boleh melebihi jumlah kehamilan");
          valid_process = false;
        }

        if(valid_process){
          for(b = 0; b < jenis_kelamin.length; b++){
            var newTextBoxDiv = $(document.createElement('tr')).attr("id", 'trdatahamil'+ counterhamil);

            newTextBoxDiv.after().html(
              '<td>'+kehamilan_ke+'</td>'+
              '<td>'+komplikasi+'</td>'+
              '<td>'+persalinan+'</td>'+
              '<td>'+tempat_persalinan+'</td>'+
              '<td>'+komplikasi_persalinan+'</td>'+
              '<td>'+penolong+'</td>'+
              '<td>'+jenis_kelamin[b].value+'</td>'+
              '<td>'+berat[b].value+'</td>'+
              '<td>'+keadaan[b].value+'</td>'+
              '<td>'+keadaan_anak[b].value+'( '+ket_keadaan_anak[b].value+' )</td>'+
              '<td>'+kb[b].value+'</td>'+
              '<td>'+asi[b].value+'</td>'+
              '<td><span class="btn btn-danger" onclick="kurang_tabel_hamil('+counterhamil+')">X</span></td>');
            newTextBoxDiv.appendTo("#tabelDataRiwayatHamil");

            var stringData = kehamilan_ke+"~"+komplikasi+"~"+persalinan+"~"+tempat_persalinan+"~"+komplikasi_persalinan+"~"+penolong+"~"+jenis_kelamin[b].value+"~"+berat[b].value+"~"+keadaan[b].value+"~"+keadaan_anak[b].value+"~"+ket_keadaan_anak[b].value+"~"+kb[b].value+"~"+asi[b].value+"~";
            dataRiwayatHamil.push(stringData);
            dataKehamilanke.push(parseInt(kehamilan_ke));

            counterhamil++;
          }

          document.getElementById("riwayat_hamil").value = dataRiwayatHamil.join(";"); //JOIN DIGUNAKAN UNTUK MENGGANTI SEPARATOR DARI ARRAYNYA
        }
      }

      function kurang_tabel_hamil(id){
        if(counterhamil==1){
          alert("No more textbox to remove");
          return false;
        }   

        counterhamil--;

        $("#trdatahamil" + id).remove();
        
        dataRiwayatHamil.splice(id, 1);
        dataKehamilanke.splice(id, 1);
        // var parent = document.getElementById("field_input_riwayat_kawin");
        // var element = document.getElementById('tbl'+id);
        // parent.removeChild(element);

      }
  </script>

  <script>
    function sumTotal(){
      var select = document.getElementsByName("cboOpsi[]");
      var totalkspr = 2;
      for(var i = 0; i < select.length; i++){
        totalkspr += parseInt(select[i].value);
      }

      document.getElementById("total_kspr").innerHTML = totalkspr;
      document.getElementById("grandtotalkspr").value = totalkspr;

      if(totalkspr > 0){
        document.getElementById("tablerujukan").style.display = "contents";

        if(totalkspr >= 2 && totalkspr <= 5){
          document.getElementById("traman").style.display = "contents";
          document.getElementById("trtengah").style.display = "none";
          document.getElementById("trkritis").style.display = "none";
          document.getElementById("rdoRujukanHijau1").checked = true;
        }
        else if(totalkspr >= 6 && totalkspr <= 10){
          document.getElementById("trtengah").style.display = "contents";
          document.getElementById("traman").style.display = "none";
          document.getElementById("trkritis").style.display = "none";
          document.getElementById("rdoRujukanKuning1").checked = true;
        }
        else{
          document.getElementById("trkritis").style.display = "contents";
          document.getElementById("traman").style.display = "none";
          document.getElementById("trtengah").style.display = "none";
          document.getElementById("rdoRujukanMerah1").checked = true;
        }
      }
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
    function submitForm(){
      document.getElementById("regForm").submit();
      window.loading_screen = window.pleaseWait({
        logo: '{{ asset("logo-sima-small.png") }}',
        backgroundColor: 'white',
        loadingHtml: '<div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div'
      });
    }

  var currentTab = 0; 
  showTab(currentTab);

  function showTab(n) {
      // This function will display the specified tab of the form ...
      var x = document.getElementsByClassName("tab");
      x[n].style.display = "block";
      // ... and fix the Previous/Next buttons:
      if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
      } else {
        document.getElementById("prevBtn").style.display = "inline";
      }
      if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
      } else {
        document.getElementById("nextBtn").innerHTML = "Selanjutnya";
      }
      // ... and run a function that displays the correct step indicator:
      fixStepIndicator(n)
  }

  function nextPrev(n) {
    var x = document.getElementsByClassName("tab");
    if (n == 1 && !validateForm()) return false;  
    if ((x.length - currentTab) == 1) {
        if(n != -1){
          var id = document.getElementById('list_obat').value;
          var id_layanan = document.getElementById('id_layanan').value;
          
          var url = <?php echo "'".URL::to('/cekStokObat')."'"; ?>;
          $.ajax({
            type:"GET",
            url:url,
            data:{obat_id:id, id_layanan:id_layanan},
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
                  $("#modalSimpan").modal();
                  document.getElementById("pesan_konfirmasi").style.display = "none";
                  document.getElementById("btn_simpan_history").style.display = "none";
                  document.getElementById("pesan_error").style.display = "block";
                  document.getElementById("pesan_error").innerHTML = 'Stok obat untuk layanan ini tidak mencukupi. Harap melakukan restock terlebih dahulu';
                }
              }
          });
        }
        else{
     
          // Hide the current tab:
          let data = x[currentTab];
          data.style.display = "none";
          // Increase or decrease the current tab by 1:
          currentTab = currentTab + n;

        }
      }
      else{
        // Hide the current tab:
        let data = x[currentTab];
        data.style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
      }
      
      // Otherwise, display the correct tab:
      showTab(currentTab);
    
  }

    function validateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      x = document.getElementsByClassName("tab");
      y = x[currentTab].getElementsByTagName("input");
      z = x[currentTab].getElementsByTagName("select");

      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // check active input tag
        if(document.getElementById("mual").style.display != "none"){
          if(y[i].id == "txtmual"){
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false:
              valid = false;
            }
          }
        }

        if(document.getElementById("pusing").style.display != "none"){
          if(y[i].id == "txtKeteranganPusing"){
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false:
              valid = false;
            }
          }
        }

        if(document.getElementById("nyeri_perut").style.display != "none"){
          if(y[i].id == "txtKeteranganNyeriPerut"){
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false:
              valid = false;
            }
          }
        }

        if(document.getElementById("gerak_janin").style.display != "none"){
          if(y[i].id == "txtketerangangerakJanin"){
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false:
              valid = false;
            }
          }
        }

        if(document.getElementById("oedema").style.display != "none"){
          if(y[i].id == "txtKeteranganOedema"){
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false:
              valid = false;
            }
          }
        }

        if(document.getElementById("nafsu_makan").style.display != "none"){
          if(y[i].id == "txtKeteranganNafsuMakan"){
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false:
              valid = false;
            }
          }
        }

        if(document.getElementById("pendarahan").style.display != "none"){
          if(y[i].id == "txtPendarahansejak"){
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false:
              valid = false;
            }
          }
        }

        if(document.getElementById("penyebab_hiv").style.display != "none"){
          if(y[i].id == "txt_penyebab_hiv"){
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false:
              valid = false;
            }
          }
        }

        if(document.getElementById("ketBentukTubuh").style.display != "none"){
          if(y[i].id == "txtKetBentukTubuh"){
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false:
              valid = false;
            }
          }
        }

        if(document.getElementById("ketKesadaran").style.display != "none"){
          if(y[i].id == "txtketKesadaran"){
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false:
              valid = false;
            }
          }
        }

        if(document.getElementById("ketMuka").style.display != "none"){
          if(y[i].id == "txtketMuka"){
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false:
              valid = false;
            }
          }
        }

        if(document.getElementById("ketKulit").style.display != "none"){
          if(y[i].id == "txtketKulit"){
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false:
              valid = false;
            }
          }
        }

        if(document.getElementById("ketMata").style.display != "none"){
          if(y[i].id == "txtketMata"){
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false:
              valid = false;
            }
          }
        }

        if(document.getElementById("ketMulut").style.display != "none"){
          if(y[i].id == "txtketMulut"){
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false:
              valid = false;
            }
          }
        }
        if(document.getElementById("ketDada").style.display != "none"){
          if(y[i].id == "txtketDada"){
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false:
              valid = false;
            }
          }
        }

        if(document.getElementById("ketGigi").style.display != "none"){
          if(y[i].id == "txtketGigi"){
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false:
              valid = false;
            }
          }
        }

        if(document.getElementById("ketPemKel").style.display != "none"){
          if(y[i].id == "txtketPemKel"){
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false:
              valid = false;
            }
          }
        }

        if(document.getElementById("ketParu").style.display != "none"){
          if(y[i].id == "txtketParu"){
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false:
              valid = false;
            }
          }
        }

        if(document.getElementById("ketJantung").style.display != "none"){
          if(y[i].id == "txtketJantung"){
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false:
              valid = false;
            }
          }
        }

        if(document.getElementById("ketPayudara").style.display != "none"){
          if(y[i].id == "txtketPayudara"){
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false:
              valid = false;
            }
          }
        }

        if(document.getElementById("divKIA").style.display != "none"){
          if(y[i].id == "tglKIA"){
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false:
              valid = false;
            }
          }
        }

        if(document.getElementById("txtSebabmeninggal").style.display != "none"){
          if(y[i].id == "txtSebabmeninggal"){
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false:
              valid = false;
            }
          }
        }

        if(currentTab == 3){
          if(document.getElementById("rdoHamilPertamaTidak").checked){
            if(document.getElementById("field_hamil").style.display=="block"){
              if(y[i].id == "txtKomplikasi" || y[i].id == "txtPersalinan" || y[i].id == "txtTempatPersalinan" || y[i].id == "txtKomplikasiPersalinan" || y[i].id == "txtPenolong" || y[i].id == "txtJenisKelamin" || y[i].id == "txtBerat" || y[i].id == "txtKeadaan" || y[i].id == "txtKeadaanAnak" || y[i].id == "txtKB" || y[i].id == "txtAsi"){
                // If a field is empty...
                if (y[i].value == "") {
                  // add an "invalid" class to the field:
                  y[i].className += " invalid";
                  // and set the current valid status to false:
                  valid = false;
                }
              }
            }
          }
        }
        else{
          if(y[i].id != "tglKIA" && y[i].id != "txtSebabmeninggal" && y[i].id != "txtLamaKawin" && y[i].id != "txtLamaKawinBulan" && y[i].id != "txtKawinke" && y[i].id != "txtmual" && y[i].id != "txtKeteranganPusing" && y[i].id != "txtKeteranganNyeriPerut" && y[i].id != "txtketerangangerakJanin" && y[i].id != "txtKeteranganOedema" && y[i].id != "txtKeteranganNafsuMakan" && y[i].id != "txtPendarahansejak" && y[i].id != "txt_penyebab_hiv" && y[i].id != "txtKetBentukTubuh" && y[i].id != "txtketKesadaran" && y[i].id != "txtketMuka" && y[i].id != "txtketKulit" && y[i].id != "txtketMata" && y[i].id != "txtketMulut" && y[i].id != "txtketGigi" && y[i].id != "txtketPemKel" && y[i].id != "txtketParu" && y[i].id != "txtketJantung" && y[i].id != "txtketPayudara" && y[i].id != "txtketDada" /* && y[i].id != "txtGolIbu" && y[i].id != "txtGolIbu" && y[i].id != "txtPenolongPersalinan" && y[i].id != "txtTempat" && y[i].id != "txtCalonDonor" && y[i].id != "txtTglPasang" && y[i].id != "txtKesimpulanDiagnosa" && y[i].id != "txtPendamping" && y[i].id != "txtSticker" && y[i].id != "txtG" && y[i].id != "txtHpht" && y[i].id != "txtHpl" && y[i].id != "txtBBsblmHamil" */){
            // console.log(y[i].id);
            // If a field is empty...
            if (y[i].value == "") {
              //console.log('masuk sini');
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false:
              valid = false;
            }
          }
        }
      }

      // CEK TABLE RIWAYAT PERKAWINAN
      // if(currentTab == 3){
      //   if(counter < 2){
      //     alert("Harap mengisi riwayat perkawinan");
      //     valid = false;
      //   }
      // }

      // CEK TABLE RIWAYAT KEHAMILAN

      if(currentTab == 3){
        if(document.getElementById("rdoHamilPertamaTidak").checked){
          if(document.getElementById("field_hamil").style.display=="block"){
            var rows = document.getElementById("tabelDataRiwayatHamil").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
            if(rows <= parseInt(hamil_sekarang)+1){
              alert("Harap mengisi tabel riwayat kehamilan");
              valid = false;
            }
            else{
              var kehamilan_terakhir = Math.max.apply(Math, dataKehamilanke);
              var hamil_ke_ = parseInt(document.getElementById("txthamilke").value) - 1;

              
              if(kehamilan_terakhir < hamil_ke_){
                alert("Jumlah data pada tabel riwayat hamil kurang dari jumlah kehamilan");
                valid = false;
              }
              else if(kehamilan_terakhir > hamil_ke_){
                alert("Jumlah data pada tabel riwayat hamil melebihi dari jumlah kehamilan");
                valid = false;
              }
            }
          }
          
        }
      }
      //otw ke tab 3
      if(currentTab==2){
        var no_reg= "{{ $pasien[0]->id_ibu }}";
        disableScreen();
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type:"POST",
          url:"{{ url('/layanan-ibu-hamil/get-riwayat-hamil') }}",
          data:{ no_registrasi:no_reg },
          success:function(data){
            //console.log(data);
            //return data;
            //hamil_sekarang=data;
            //document.getElementById("txthamilke").min = parseInt(data)+1;
            enableScreen();
            if(parseInt(data)!=0){
              //$('#rdoHamilPertamaYa').attr('checked', false);
              //$('#rdoHamilPertamaTidak').attr('checked', true);
              document.getElementById("rdoHamilPertamaTidak").click();
              document.getElementById("rdoHamilPertamaYa").disabled = true;
               //document.getElementById("rdoHamilPertamaYa").attr('checked', false);
               //document.getElementById("rdoHamilPertamaTidak").attr('checked', false);
              //document.getElementById("field_hamil").style.display = "block";  
            }
          }
        });
      }

      for (m = 0; m < z.length; m++) {
        if(currentTab == 3){
          if(document.getElementById("rdoHamilPertamaTidak").checked){
            if(document.getElementById("field_hamil").style.display=="block"){
              if(z[m].id == "txtKomplikasi" || z[m].id == "txtPersalinan" || z[m].id == "txtTempatPersalinan" || z[m].id == "txtKomplikasiPersalinan" || z[m].id == "txtPenolong" || z[m].id == "txtJenisKelamin" || z[m].id == "txtBerat" || z[m].id == "txtKeadaan" || z[m].id == "txtKeadaanAnak" || z[m].id == "txtKB" || z[m].id == "txtAsi"){
                // If a field is emptz...
                if (z[m].value == "") {
                  // add an "invalid" class to the field:
                  z[m].className += " invalid";
                  // and set the current valid status to false:
                  valid = false;
                }
              }
            }
          }
        }
        else{
          if(/*z[m].id != "txtAgamaibu" && z[m].id != "changeKIA" && z[m].id != "txtAgamaayah" && */ z[m].id != "cboSebabPisah" /* && z[m].id != "txtKomplikasi" && z[m].id != "txtPersalinan" && z[m].id != "txtTempatPersalinan" && z[m].id != "txtKomplikasiPersalinan" && z[m].id != "txtPenolong" && z[m].id != "txtJenisKelamin" && z[m].id != "txtKeadaan" && z[m].id != "txtKeadaanAnak" && z[m].id != "txtHaid" && z[m].id != "txtSelectMual" && z[m].id != "txtPusing" && z[m].id != "txtNyeriPerut" && z[m].id != "txtGerakJanin" && z[m].id != "txtOedema" && z[m].id != "txtNafsuMakan" && z[m].id != "txtPendarahan" && z[m].id != "txtHasilKSPR" && z[m].id != "txtDOTK" && z[m].id != "txtDOM" && z[m].id != "txtStatusTT" && z[m].id != "txtResikoHIV" && z[m].id != "txtBentukTubuh" && z[m].id != "txtKesadaran" && z[m].id != "txtMuka" && z[m].id != "txtKulit" && z[m].id != "txtMata" && z[m].id != "txtMulut" && z[m].id != "txtGigi" && z[m].id != "txtPemKel" && z[m].id != "txtDada" && z[m].id != "txtParu" && z[m].id != "txtJantung" && z[m].id != "txtPayudara" && z[m].id != "txtTangan" && z[m].id != "txtRefleks"*/ ){
            // console.log(y[i].id);
            // If a field is empty...
            if (z[m].value == "") {
              console.log("error : "+z[m].id);
              // add an "invalid" class to the field:
              z[m].className += " invalid";
              // and set the current valid status to false:
              valid = false;
            }
          }
        }
      }

      // If the valid status is true, mark the step as finished and valid:
      //valid=true;
      if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
      }
      return valid; // return the valid status
    }

    function fixStepIndicator(n) {
      // This function removes the "active" class of all steps...
      var i, x = document.getElementsByClassName("step");
      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
      }
      //... and adds the "active" class to the current step:
      x[n].className += " active";
    }
    function changeKIA(element, tipe){
      element.className = 'form-control';
      if(element.value == "punya"){
        if(tipe == 'add'){
          document.getElementById("divKIA").style.display = "block";
        }
        else{
          document.getElementById("divKIAEdit").style.display = "block";
        }
      }
      else{
        if(tipe == 'add'){
          document.getElementById("divKIA").style.display = "none";
        }
        else{
          document.getElementById("divKIAEdit").style.display = "none";
        }
      }
    }
    function changeSebabPisah(element, tipe){
      element.className = 'form-control';
      if(element.value == "meninggal"){
        if(tipe == 'add'){
          document.getElementById("txtSebabmeninggal").style.display = "block";
        }
        else{
          document.getElementById("txtSebabmeninggalEdit").style.display = "block";
        }
      }
      else{
        if(tipe == 'add'){
          document.getElementById("txtSebabmeninggal").style.display = "none";
        }
        else{
          document.getElementById("txtSebabmeninggalEdit").style.display = "none";
        }
      }
    }
    function changeMual(element){
      element.className = 'form-control';
      if(element.value == "ya"){
        document.getElementById("mual").style.display = "block";
      }
      else{
        document.getElementById("mual").style.display = "none";
      }
    }

    function changePusing(element){
      element.className = 'form-control';
      if(element.value == "ya"){
        document.getElementById("pusing").style.display = "block";
      }
      else{
        document.getElementById("pusing").style.display = "none";
      }
    }

    function changeOedema(element){
      element.className = 'form-control';
      if(element.value == "ya"){
        document.getElementById("oedema").style.display = "block";
      }
      else{
        document.getElementById("oedema").style.display = "none";
      }
    }

    function changeNafsuMakan(element){
      element.className = 'form-control';
      if(element.value == "menurun"){
        document.getElementById("nafsu_makan").style.display = "block";
      }
      else{
        document.getElementById("nafsu_makan").style.display = "none";
      }
    }

    function changeGerakJanin(element){
      element.className = 'form-control';
      if(element.value == "ya"){
        document.getElementById("gerak_janin").style.display = "block";
      }
      else{
        document.getElementById("gerak_janin").style.display = "none";
      }
    }

    function changePendarahan(element){
      element.className = 'form-control';
      if(element.value == "ya"){
        document.getElementById("pendarahan").style.display = "block";
      }
      else{
        document.getElementById("pendarahan").style.display = "none";
      }
    }

    function changeResikHiv(element){
      element.className = 'form-control';
      if(element.value == "ya"){
        document.getElementById("penyebab_hiv").style.display = "block";
      }
      else{
        document.getElementById("penyebab_hiv").style.display = "none";
      }
    }

    function changeNyeriPerut(element){
      element.className = 'form-control';
      if(element.value == "ya"){
        document.getElementById("nyeri_perut").style.display = "block";
      }
      else{
        document.getElementById("nyeri_perut").style.display = "none";
      }
    }

    function changeBentukTubuh(element){
      element.className = 'form-control';
      if(element.value != "normal"){
        document.getElementById("ketBentukTubuh").style.display = "block";
      }
      else{
        document.getElementById("ketBentukTubuh").style.display = "none";
      }
    }

    function changeKesadaran(element){
      element.className = 'form-control';
      if(element.value != "baik"){
        document.getElementById("ketKesadaran").style.display = "block";
      }
      else{
        document.getElementById("ketKesadaran").style.display = "none";
      }
    }

    function changeKetMuka(element){
      element.className = 'form-control';
      if(element.value == "pucat"){
        document.getElementById("ketMuka").style.display = "block";
      }
      else{
        document.getElementById("ketMuka").style.display = "none";
      }
    }
    function changeKetDada(element){
      element.className = 'form-control';
      if(element.value != "normal"){
        document.getElementById("ketDada").style.display = "block";
      }
      else{
        document.getElementById("ketDada").style.display = "none";
      }
    }

    function changeKulit(element){
      element.className = 'form-control';
      if(element.value != "normal"){
        document.getElementById("ketKulit").style.display = "block";
      }
      else{
        document.getElementById("ketKulit").style.display = "none";
      }
    }

    function changeMata(element){
      element.className = 'form-control';
      if(element.value != "normal"){
        document.getElementById("ketMata").style.display = "block";
      }
      else{
        document.getElementById("ketMata").style.display = "none";
      }
    }

    function changeMulut(element){
      element.className = 'form-control';
      if(element.value != "normal"){
        document.getElementById("ketMulut").style.display = "block";
      }
      else{
        document.getElementById("ketMulut").style.display = "none";
      }
    }

    function changeGigi(element){
      element.className = 'form-control';
      if(element.value != "normal"){
        document.getElementById("ketGigi").style.display = "block";
      }
      else{
        document.getElementById("ketGigi").style.display = "none";
      }
    }

    function changePembKel(element){
      element.className = 'form-control';
      if(element.value == "ya"){
        document.getElementById("ketPemKel").style.display = "block";
      }
      else{
        document.getElementById("ketPemKel").style.display = "none";
      }
    }

    function changeParu(element){
      element.className = 'form-control';
      if(element.value != "normal"){
        document.getElementById("ketParu").style.display = "block";
      }
      else{
        document.getElementById("ketParu").style.display = "none";
      }
    }

    function changeJantung(element){
      element.className = 'form-control';
      if(element.value != "normal"){
        document.getElementById("ketJantung").style.display = "block";
      }
      else{
        document.getElementById("ketJantung").style.display = "none";
      }
    }

    function changePayudara(element){
      element.className = 'form-control';
      if(element.value != "normal"){
        document.getElementById("ketPayudara").style.display = "block";
      }
      else{
        document.getElementById("ketPayudara").style.display = "none";
      }
    }

    function showFormRiwayatHamil(value){
      if(value == "ya"){
        document.getElementById("field_hamil").style.display = "none";
        document.getElementById("kehamilan_ke").style.display = "none";
        document.getElementById("txthamilke").style.display = "none";
      }
      else{
        //ditambah pengecekkan data kehamilan dia ada enggak disini
        //console.log(parseInt($('#txthamilke').val()));
        //console.log(get_history_hamil());
        //console.log(parseInt(get_history_hamil())+1);
        /*
        if(parseInt($('#txthamilke').val())>parseInt(get_history_hamil())+1){
          document.getElementById("field_hamil").style.display = "block";  
        }
        else{
          document.getElementById("field_hamil").style.display = "none";   
        }*/

        document.getElementById("kehamilan_ke").style.display = "block";
        document.getElementById("txthamilke").style.display = "block";
        get_history_hamil();
        //var riwayat_hamil = get_history_hamil();
        //alert($('#txthamilke').val());

      }
    }
    var hamil_sekarang = 0;

    function get_history_hamil(){
      var no_reg = "{{ $pasien[0]->id_ibu }}";
      disableScreen();
      $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type:"POST",
        url:"{{ url('/layanan-ibu-hamil/get-riwayat-hamil') }}",
        data:{ no_registrasi:no_reg },
        success:function(data){
          //console.log(data);
          //return data;
          hamil_sekarang=data;
          document.getElementById("txthamilke").min = parseInt(data)+1;
          enableScreen();
          if(parseInt($('#txthamilke').val())>parseInt(data)+1){
            document.getElementById("field_hamil").style.display = "block";  
          }
          else{
            document.getElementById("field_hamil").style.display = "none";   
          }
        }
      });
    }

    function hamil_ke_change(element){
      if(element.value.length==0){

      }
      else{
        //console.log(element.value);
        //disini ditambah muncul enggaknya field itu
        if(element.value>parseInt(hamil_sekarang)+1){
          document.getElementById("field_hamil").style.display = "block";  
          //console.log(element.value+" "+hamil_sekarang);
          //console.log(currentTab)
        }
        else{
          document.getElementById("field_hamil").style.display = "none";  
        }
      }
    }

    var arrJmlhAnak = [];
    var jmlh_anak = 1;

    function tambah_anak(){
      if(arrJmlhAnak.length > 1){
        jmlh_anak = Math.max.apply(Math, arrJmlhAnak) + 1;
      }
      else{
        jmlh_anak = jmlh_anak;
      }

      var id_div = "card_anakclone"+jmlh_anak;

      var newgbr = document.createElement('div')
      newgbr.setAttribute("id",id_div);
      newgbr.setAttribute("style","margin-top:1rem;");
      newgbr.innerHTML='<div class="card">'+
      '<div class="form-group"></div>'+
      '<div class="form-group" style="margin-right: 1%;"><button class="btn btn-danger pull-right" type="button" onclick="removeElement('+id_div+')"><i class="fa fa-close"></i></button></div>'+
      '<div class="row">'+
      '  <div class="col-md-6">'+
      '    <div class="form-group" >'+
      '      <label class="col-sm-3" >Keadaan BBL : </label>'+
      '    </div>'+
      '    <div class="form-group">'+
      '      <label class="col-sm-3" style="font-weight: normal;">- P / L </label>'+
      '      <label class="col-sm-6">'+
      '        <select class="form-control" id="txtJenisKelamin'+id_div+'" name="txtJenisKelamin[]" oninput="this.className = \'form-control\'">'+
      '          <option selected disabled value="">P/L...</option>'+
      '          <option value="P">P</option>'+
      '          <option value="L">L</option>'+
      '        </select>'+
      '      </label>'+
      '    </div>'+
      '    <div class="form-group">'+
      '      <label class="col-sm-3" style="font-weight: normal;">- Berat </label>'+
      '      <label class="col-sm-6">'+
      '        <input type="text" style="text-align: right;" class="form-control" id="txtBerat'+id_div+'" name="txtBerat[]" placeholder="...KG" oninput="this.className = \'form-control\'" required>'+
      '      </label>'+
      '    </div>'+
      '    <div class="form-group">'+
      '      <label class="col-sm-3" style="font-weight: normal;">- Keadaan </label>'+
      '      <label class="col-sm-6">'+
      '        <select class="form-control" id="txtKeadaan'+id_div+'" name="txtKeadaan[]" oninput="this.className = \'form-control\'">'+
      '          <option selected disabled value="">Keadaan...</option>'+
      '          <option value="sehat">Sehat</option>'+
      '          <option value="sakit">Sakit</option>'+
      '          <option value="mati">Mati</option>'+
      '        </select>'+
      '      </label>'+
      '    </div>'+
      '    <div class="form-group">'+
      '      <label class="col-sm-3" >Keadaan Anak Sekarang </label>'+
      '      <label class="col-sm-6">'+
      '        <select class="form-control" id="txtKeadaanAnak'+id_div+'" name="txtKeadaanAnak[]" oninput="this.className = \'form-control\'">'+
      '          <option selected disabled value="">Keadaan...</option>'+
      '          <option value="sehat">Hidup</option>'+
      '          <option value="mati">Mati</option>'+
      '        </select>'+
      '      </label>'+
      '    </div>'+
      '  </div>'+
      '  <div class="col-md-6">'+
      '    <div class="form-group">'+
      '      <label class="col-sm-3" >Keterangan Anak Sekarang </label>'+
      '      <label class="col-sm-6">'+
      '        <input type="text" class="form-control" id="txtKetKeadaanAnak'+id_div+'" name="txtKetKeadaanAnak[]" placeholder="..." oninput="this.className = \'form-control\'" required>'+
      '      </label>'+
      '    </div>'+
      '    <div class="form-group">'+
      '      <label class="col-sm-3" >KB </label>'+
      '      <label class="col-sm-6">'+
      '        <input type="text" class="form-control" id="txtKB'+id_div+'" name="txtKB[]" placeholder="..." oninput="this.className = \'form-control\'" required>'+
      '      </label>'+
      '    </div>'+
      '    <div class="form-group">'+
      '      <label class="col-sm-3" >ASI </label>'+
      '      <label class="col-sm-6">'+
      '        <input type="text" class="form-control" id="txtAsi'+id_div+'" name="txtAsi[]" placeholder="..." oninput="this.className = \'form-control\'" required>'+
      '      </label>'+
      '    </div>'+
      '  </div>'+
      '</div>'+
      '</div>';

      document.getElementById("field_card_anak").appendChild(newgbr);

      arrJmlhAnak.push(jmlh_anak);
      jmlh_anak++;
    }

    function removeElement(obj){
        // console.log(obj.id);
        var id = obj.id;
        var value = id.split("card_anakclone");
        var index = arrJmlhAnak.indexOf(parseInt(value[1]));
        arrJmlhAnak.splice(index, 1);
        $(obj).remove();
        jmlh_anak--;
      }
      function disableScreen() {
        var div= document.createElement("div");
        div.setAttribute("id","freeze");
        div.className += "overlay";
        document.body.appendChild(div);
      }
      function enableScreen() {
        $('#freeze').remove();
      }


    </script>

    <script src="{{asset('dropify/dist/js/dropify.min.js')}}"></script>
    <script type="text/javascript">

      function loadData(){
        console.log(<?php //print_r($pasien)?>);
        $('#txtNamaibu').val('{{$pasien[0]->nama_ibu}}');
      // txtNamaibu
      $('#txtTanggalLahiribu').val("{{date('d-m-Y', strtotime($pasien[0]->tl_ibu))}}");
      // txtTanggalLahiribu
      $('#txtAgamaibu').val("{{$pasien[0]->agama_ibu}}");
      // txtAgamaibu
      $('#txtAlamatibu').val("{{$pasien[0]->alamat_ibu}}");
      // txtAlamatibu
      $('#txtPhoneibu').val("{{$pasien[0]->telp_ibu}}");
      // txtPhoneibu
      $('#txtKelurahanibu').val("{{$pasien[0]->kelurahan_ibu}}");
      // txtKelurahanibu
      $('#txtPekerjaanibu').val("{{$pasien[0]->pekerjaan_ibu}}");
      // txtPekerjaanibu
      $('#txtPendidikanibu').val("{{$pasien[0]->pendidikan_ibu}}");
      // txtPendidikanibu
      $('#cboBukuKIA').val("{{$pasien[0]->buku_kia_ibu}}");
      // cboBukuKIA
      $('#tglKIA').val("{{$pasien[0]->tgl_buku_kia_ibu}}");
      // tglKIA
      $('#txtNamaayah').val("{{$pasien[0]->nama_suami}}");

      // txtTanggalLahirayah
      $('#txtAgamaayah').val("{{$pasien[0]->agama_suami}}");
      // txtAgamaayah
      $('#txtAlamatayah').val("{{$pasien[0]->alamat_suami}}");
      // txtAlamatayah
      $('#txtPhoneayah').val("{{$pasien[0]->telp_suami}}");
      // txtPhoneayah
      $('#txtKelurahanayah').val("{{$pasien[0]->kelurahan_suami}}");
      // txtKelurahanayah
      $('#txtPekerjaanayah').val("{{$pasien[0]->pekerjaan_suami}}");
      // txtPekerjaanayah
      $('#txtPendidikanayah').val("{{$pasien[0]->pendidikan_suami}}");
      // txtPendidikanayah
    }
    $(document).ready(function(){
      var lupaTglLahir = 0;//tidak lupa
      // txtNamaayah
      if("{{date('d-m-Y', strtotime($pasien[0]->tanggal_lahir_suami))}}"=="01-01-1970"){
        lupaTglLahir = 1;
        document.getElementById('txtTanggalLahirayah').value = '00-00-0000';
        document.getElementById("txtTanggalLahirayahGroup").style.display = 'none';
        document.getElementById('cbxLupaTglLahir').checked = true;
      }
      else{
        $('#txtTanggalLahirayah').val("{{date('d-m-Y', strtotime($pasien[0]->tanggal_lahir_suami))}}");
      }
      $(document).on('change', '#cbxLupaTglLahir', function() {
          if(lupaTglLahir==0){
            lupaTglLahir = 1;
            document.getElementById('txtTanggalLahirayah').value = '00-00-0000';
            document.getElementById("txtTanggalLahirayahGroup").style.display = 'none';
          }
          else if(lupaTglLahir==1){
            lupaTglLahir = 0;
            document.getElementById("txtTanggalLahirayahGroup").style.display = 'block';
          }
      });
      loadData();
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
      });
    });
  </script>
  @endsection