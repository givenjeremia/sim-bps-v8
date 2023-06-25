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
          <span id="pesan_konfirmasi">Apakah anda yakin ingin menyimpan data observasi ?</span>
        </div> 
        <div class="form-group"> 
          <button class="btn btn-default" data-dismiss="modal" aria-label="Close">Tutup</button> 
          <button class="btn btn-primary" id="btn_simpan_history" onclick="submitForm()">Simpan</button> 
        </div>
      </div> 
    </div> 
  </div> 
</div>
<!-- tutup modal simpan -->

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
      <h3>Lembar Observasi</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/ibu_hamil')}}">Pelayanan Ibu Hamil</a></li>
        <li class="breadcrumb-item active">Lembar Observasi</li>
      </ol>
    </div>
  </div>

  <?php if (count($observasi) <= 0): ?>
    <form class="form-horizontal" id="form_submit" method="POST" action="{{url('/ibu_hamil/observasi')}}">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">MASUK KAMAR BERSALIN ANAMNESE</div>
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
                            <input type="text" class="form-control datepicker" id="txtTanggal" name="txtTanggal" required>
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
                        <label class="control-label col-sm-3" for="nama">His mulai tgl</label>
                        <label class="control-label col-sm-6" for="nama">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="text" class="form-control datepicker" id="txtTanggalHis" name="txtTanggalHis">
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
                            <input type="text" class="form-control" id="txtHisJam" name="txtHisJam">
                          </div>
                        </label>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-sm-3" for="nama">Darah</label>
                        <label class="control-label col-sm-6" for="nama">
                          <input type="text" class="form-control" id="txtDarah" name="txtDarah" placeholder="..." required>
                        </label>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-sm-3" for="nama">Lendir</label>
                        <label class="control-label col-sm-6" for="nama">
                          <input type="text" class="form-control" id="txtLendir" name="txtLendir" placeholder="..." required>
                        </label>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="control-label col-sm-3" for="nama">Ketuban</label>
                        <label class="control-label col-sm-6" for="nama">
                          <select class="form-control" id="txtKetuban" name="txtKetuban">
                            <option value="pecah" selected>Pecah</option>
                            <option value="belum">Belum</option>
                          </select>
                        </label>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-sm-3" for="nama">Jam</label>
                        <label class="control-label col-sm-6" for="nama">
                          <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                            </div>
                            <input type="text" class="form-control" id="txtJamKetuban" name="txtJamKetuban">
                          </div>
                        </label>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-sm-3" for="nama">Keluhan Lain</label>
                        <label class="control-label col-sm-6" for="nama">
                          <textarea rows="5"  class="form-control" id="txtKeluhan" name="txtKeluhan" placeholder="..."></textarea>
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
          <div class="card">
            <div class="card-header">KEADAAN UMUM</div>
            <div class="card-body">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6"> 
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
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="control-label col-sm-3" for="nama">Oedema</label>
                        <label class="control-label col-sm-6" for="nama">
                          <input type="text" class="form-control" id="txtOedema" name="txtOedema" placeholder="..." required>
                        </label>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-sm-3" for="nama">Lain - Lain</label>
                        <label class="control-label col-sm-6" for="nama">
                          <textarea rows="5"  class="form-control" id="txtLain_lain" name="txtLain_lain" placeholder="..."></textarea>
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
          <div class="card">
            <div class="card-header">PEMERIKSAAN OBSTETRI</div>
            <div class="card-body">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="control-label col-sm-3" for="nama">Palpasi</label>
                        <label class="control-label col-sm-6" for="nama">
                          <input type="text" class="form-control" id="txtPalpasi" name="txtPalpasi" placeholder="..." required>
                        </label>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-sm-3" for="nama">Djj</label>
                        <label class="control-label col-sm-6" for="nama">
                          <input type="text" class="form-control" id="txtDjj" name="txtDjj" placeholder="..." required>
                        </label>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-sm-3" for="nama">His 10"</label>
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
                      <div class="form-group row">
                        <label class="control-label col-sm-3" for="nama">VT. Tgl.</label>
                        <label class="control-label col-sm-6" for="nama">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="text" class="form-control datepicker" id="txtTglVt" name="txtTglVt">
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
                            <input type="text" class="form-control" id="txtJamVT" name="txtJamVT">
                          </div>
                        </label>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="control-label col-sm-3" for="nama">Hasil</label>
                        <label class="control-label col-sm-6" for="nama">
                          <textarea rows="5"  class="form-control" id="txtHasil" name="txtHasil" placeholder="..." required></textarea>
                        </label>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-sm-3" for="nama">Pemeriksa</label>
                        <label class="control-label col-sm-6" for="nama">
                          <input type="text"  class="form-control" id="txtPemeriksaan" name="txtPemeriksaan" placeholder="..." required>
                        </label>
                      </div>
                    </div>
                  </div>

                  <BR>
                  <div class="form-group">
                    <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                    <input type="hidden" name="idibu" value="{{$idibu}}">
                    <button class="btn btn-primary"><i class="fa fa-save nav-icon"></i> Simpan</button>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </form>  
  <?php else: ?>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">MASUK KAMAR BERSALIN ANAMNESE</div>
          <div class="card-body">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6"> 
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Tanggal</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;" style="font-weight: normal;">
                        : &nbsp; <span>{{$observasi[0]->tgl}}</span>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Jam</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span>{{$observasi[0]->jam}}</span>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">His mulai tgl</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span>{{$observasi[0]->his_mulai_tgl}}</span>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Jam</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span>{{$observasi[0]->his_jam}}</span>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Darah</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span>{{$observasi[0]->darah}}</span>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Lendir</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span>{{$observasi[0]->lendir}}</span>
                      </label>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Ketuban</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span>{{$observasi[0]->ketuban}}</span>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Jam</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span>{{$observasi[0]->jam_ketuban}}</span>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Keluhan Lain</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span>{{$observasi[0]->keluhan_lain}}</span>
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
        <div class="card">
          <div class="card-header">KEADAAN UMUM</div>
          <div class="card-body">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6"> 
                    <label class="control-label col-sm-4" for="nama">Tensi :</label>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama" style="font-weight: normal;">- Sistole</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span>{{$observasi[0]->tensi_atas}}</span>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama" style="font-weight: normal;">- Diastole</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span>{{$observasi[0]->tensi_bawah}}</span>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Suhu</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span>{{$observasi[0]->suhu}}</span>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Nadi</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span>{{$observasi[0]->nadi}}</span>
                      </label>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Oedema</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span>{{$observasi[0]->oedema}}</span>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Lain - Lain</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span>{{$observasi[0]->lain_lain}}</span>
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
        <div class="card">
          <div class="card-header">PEMERIKSAAN OBSTETRI</div>
          <div class="card-body">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Palpasi</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span>{{$observasi[0]->palpasi}}</span>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Djj</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span>{{$observasi[0]->djj}}</span>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">His 10"</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span>{{$observasi[0]->his_10}}</span>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Lama</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span>{{$observasi[0]->lama_his_10}}</span>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">VT. Tgl.</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span>{{$observasi[0]->vt_tgl}} </span>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Jam</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span>{{$observasi[0]->vt_jam}}</span>
                      </label>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Hasil</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span>{{$observasi[0]->hasil}}</span>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Pemeriksa</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span>{{$observasi[0]->pemeriksa}}</span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>

    <?php 
      $url = (count($observasi) > 0) ? "observasiKala/".$observasi[0]->id : "observasiKala" ;
      $display = (count($observasi) > 0) ? 'block' : 'none';
    ?>

    <div class="row" style="display: <?php echo $display; ?>">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-3 col-4" title="KSPR">
                <a href="<?php echo URL::to('/'.$url)?>" class="btn btn-block btn-primary btn-sm" id="btnAdd"><i class="fa fa-plus-circle nav-icon"></i> Tambah Observasi Kala</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">OBSERVASI KALA I</div>
          <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
              <div class="row">
                <div class="col-sm-12">
                  <div class="table-responsive">  
                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                      <thead>
                        <tr role="row">
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="2" colspan="1" aria-label="Browser: activate to sort column ascending" style="text-align:center; width: 20%;;">
                            Tanggal
                          </th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="2" colspan="1" aria-label="Browser: activate to sort column ascending" style="text-align:center; width: 20%;;">
                            Jam
                          </th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="2" aria-label="Browser: activate to sort column ascending" style="text-align:center; width: 20%;;">
                            His dlm 10"
                          </th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="2" colspan="1" aria-label="Browser: activate to sort column ascending" style="text-align:center; width: 20%;;">
                            Djj
                          </th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="2" colspan="1" aria-label="Browser: activate to sort column ascending" style="text-align:center; width: 20%;;">
                            Tensi
                          </th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="2" colspan="1" aria-label="Browser: activate to sort column ascending" style="text-align:center; width: 20%;;">
                           Suhu
                          </th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="2" colspan="1" aria-label="Browser: activate to sort column ascending" style="text-align:center; width: 20%;;">
                           Nadi
                          </th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="2" colspan="1" aria-label="Browser: activate to sort column ascending" style="text-align:center; width: 30%;;">
                           VT
                          </th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="2" colspan="1" aria-label="Browser: activate to sort column ascending" style="text-align:center; width: 50%;">
                           Keterangan
                          </th>
                        </tr>
                        <tr role="row">
                         <td>Berapa Kali</td>
                         <td>Lamanya</td>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($hist_observasi as $key => $value) 
                            <tr>
                              <td style="font-weight: normal;">{{date("d-m-Y", strtotime($value->tgl))}}</td>
                              <td style="font-weight: normal;">{{$value->jam}}</td>
                              <td style="font-weight: normal;">{{$value->his_10}}</td>
                              <td style="font-weight: normal;">{{$value->lama_his_10}}</td>
                              <td style="font-weight: normal;">{{$value->djj}}</td>
                              <td style="font-weight: normal;">{{$value->tensi_atas.'/'.$value->tensi_bawah}}</td>
                              <td style="font-weight: normal;">{{$value->suhu}}</td>
                              <td style="font-weight: normal;">{{$value->nadi}}</td>
                              <td style="font-weight: normal;">{{$value->ket_vt}}</td>
                              <td style="font-weight: normal;">{{$value->keterangan}}</td>
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
  <?php endif ?>
</div>

@section('add_js')
<script type="text/javascript" src="{{asset('clockpicker/dist/bootstrap-clockpicker.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.datepicker').datepicker({
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
@endsection