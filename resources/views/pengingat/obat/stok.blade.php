@extends('layouts.adminlte')
<!-- plugin css -->
@section('plugin_css')
<link rel="stylesheet" href="{{asset('dropify/dist/css/dropify.min.css')}}">
@endsection
<!-- css -->
@section('add_css')

@endsection
<!-- content -->
@section('content')
<!-- modal detail -->
<div class="modal fade" id="modalDetail" role="dialog" 
aria-labelledby="favoritesModalLabel">
<div class="modal-dialog" role="document">
  <div class="modal-content" style="border-radius: 17px;">
    <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;">
      <h4 style="color:white;">Detail Data Obat</h4>
      <button type="button" class="close" 
      data-dismiss="modal" 
      aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
      <div class="form-group">
    <label>Nama:</label>
    <p id="lblNamaDetail"></p>
    <label>Kode:</label>
    <p id="lblKodeDetail"></p>
    <label>Merk:</label>
    <p id="lblMerkDetail"></p>
    <label>Harga:</label>
    <p id="lblHargaDetail"></p>
    <label>Catatan:</label>
    <p id="lblCatatanDetail"></p>
    <label>Stok:</label>
    <p id="lblStokDetail"></p>
    <label>Tanggal Kadaluarsa:</label>
    <p id="lblTglDetail"></p> 
  </div>
  <div class="form-group">
    <input type="hidden" name="_token" value="{!!csrf_token()!!}">
    <input type="hidden" id="txtIdEdit" name="txtIdEdit" value="{!!csrf_token()!!}">
    <button class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
  </div>
</div>
</div>
</div>
</div>
<!-- tutup modal detail-->
<!-- modal add -->
<div class="modal fade" id="modalAdd" role="dialog" aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 17px;">
      <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;">
        <h4 style="color:white;">Tambah Obat</h4>
        <button type="button" class="close" 
        data-dismiss="modal" 
        aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <FORM method="post" action="<?php echo URL::to('/obat_tambah')?>">
          <div class="form-group">
            <label>Nama:</label>
            <input type="text" class="form-control" id="txtNama" name="txtNama" placeholder="Nama" autocomplete="off" required>
            <label>Kode:</label>
            <input type="text" class="form-control" id="txtKode" name="txtKode" placeholder="Kode" autocomplete="off" required>
            <label>Merk:</label>
            <input type="text" class="form-control" id="txtMerk" name="txtMerk" placeholder="Merk" autocomplete="off" required>
            <label>Harga:</label>
            <input type="text" class="form-control" id="txtHarga" name="txtHarga" value="" style="text-align: right;" autocomplete="off" required> 
            <label style="display: none; font-weight: normal" id="peringatanHarga">Harga Tidak Boleh 0</label>
            <label>Catatan:</label>
            <textarea class="form-control" rows="3" id="txtCttn" name="txtCttn" placeholder="Enter ..." autocomplete="off"></textarea>
            <label>Jumlah:</label>
            <input type="number" class="form-control" min="0" id="txtStok" name="txtStok" style="text-align: right;" placeholder="" autocomplete="off" required>
            <label>Satuan:</label>
            <select class="form-control" id="txtSatuan" name="txtSatuan">
              <option value="0">PCS/BUTIR</option>
              <option value="1">PACK/STRIP</option>
            </select>
            <div id="jumlahPCS" style="display: none">
              <label>Jumlah PCS/BUTIR:</label>
              <input type="number" min="0" class="form-control" id="txtPcs" name="txtPcs" style="text-align: right;" placeholder="" autocomplete="off" >
            </div>
            <label>Tanggal Kadaluarsa:</label>
            <div class="input-group date">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <input type="text" name="tglkadaluarsa" class="form-control datepicker2" required>
              </div>
            </div>
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

<!-- modal edit -->
<div class="modal fade" id="modalEdit" role="dialog" aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 17px;">
      <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;">
        <h4 style="color:white;">Ubah Obat</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="card">
            <div class="card-header d-flex p-0">
              <h3 class="card-title p-3"></h3>
              <ul class="nav nav-pills ml-auto p-2">
                <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Data</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Harga</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Tambah Stok</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">Kurang Stok</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <form class="form-horizontal" method="post" action="<?php echo URL::to('/obat_update_data')?>">
                    {{ csrf_field() }}
                    <input type="hidden" name="idUpdate" id="idUpdate" value="">
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="nama">Nama</label>
                      <label class="control-label col-sm-8" for="nama">
                        <input type="text" class="form-control" id="txtNamaEdit" name="txtNamaEdit" placeholder="Nama" autocomplete="off" required>  
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="nama">Kode</label>
                      <label class="control-label col-sm-8" for="nama">
                        <input type="text" class="form-control" id="txtKodeEdit" name="txtKodeEdit" placeholder="Kode" autocomplete="off" required>
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="nama">Merk</label>
                      <label class="control-label col-sm-8" for="nama">
                        <input type="text" class="form-control" id="txtMerkEdit" name="txtMerkEdit" placeholder="Merk" autocomplete="off" required>
                      </label>
                    </div>
                    <div class="row form-group">
                      <label class="control-label col-sm-3">&nbsp;&nbsp;Catatan</label>
                      <label class="control-label col-sm-8" style="padding-left: 3%">
                        <textarea class="form-control" rows="3" id="txtCttnEdit" name="txtCttnEdit" placeholder="Enter ..." autocomplete="off"></textarea>
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="nama">Tanggal Kadaluarsa</label>
                      <label class="control-label col-sm-8" for="nama">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i>
                            </span>
                          </div>
                          <input type="text" name="tglkadaluarsaEdit" class="form-control pull-right datepicker2" id="tglkadaluarsaEdit">
                        </div> 
                      </label>
                    </div>

                    <div class="form-group">
                      <button type="submit" name="simpan" class="btn btn-danger">Simpan</button>
                    </div>
                  </form>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                  <form class="form-horizontal" method="post" action="<?php echo URL::to('/obat_update_harga')?>">
                    {{ csrf_field() }}
                    <input type="hidden" name="idUpdate" id="idUpdateHarga" value="">
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Harga</label>
                      <label class="control-label col-sm-8" for="nama">
                        <input type="text" class="form-control" id="txtHargaEdit" name="txtHargaEdit" value="0" style="text-align: right;" autocomplete="off" required> 
                        <label style="display: none; font-weight: normal; font-size: 10pt" id="peringatanHargaEdit">Harga Tidak Boleh 0</label>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="nama">Satuan</label>
                      <label class="control-label col-sm-8" for="nama">
                        <select class="form-control" id="txtSatuanEditHarga" name="txtSatuanEdit" disabled=""></select>
                        <label style="display: none; font-weight: normal; font-size: 10pt" id="lblsatuanHarganya"></label>
                      </label>
                    </div>
                    <div class="form-group">
                      <button type="submit" name="simpan" id="btnsubmitEdit" class="btn btn-danger"> Simpan</button>
                    </div>
                  </form>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
                <div class="tab-pane" id="tab_3">
                  <form class="form-horizontal" method="post" action="<?php echo URL::to('/obat_tambah_stok')?>">
                    {{ csrf_field() }}
                    <input type="hidden" name="idUpdate" id="idUpdateTambahStok" value="">
                    <div class="form-group  row">
                      <label class="control-label col-sm-3" for="nama">Jumlah</label>
                      <label class="control-label col-sm-8" for="nama">
                        <input type="number" class="form-control" name="txtJmlTambah" min="0" style="text-align: right;" autocomplete="off" required> 
                      </label>
                    </div>
                    <div class="form-group  row">
                      <label class="control-label col-sm-3" for="nama">Satuan</label>
                      <label class="control-label col-sm-8" for="nama">
                        <select class="form-control" id="txtSatuanJmlTambah" name="txtSatuanJmlTambah"></select>
                        <label style="display: none; font-weight: normal; font-size: 10pt" id="satuanTambah"></label>
                      </label>
                    </div>
                    <div class="form-group">
                      <button type="submit" name="simpan" class="btn btn-danger">Simpan</button>
                    </div>
                  </form>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
                <div class="tab-pane" id="tab_4">
                  <form class="form-horizontal" method="post" action="<?php echo URL::to('/obat_kurang_stok')?>">
                    {{ csrf_field() }}
                    <input type="hidden" name="idUpdate" id="idUpdateKurangStok" value="">
                    <div class="form-group  row">
                      <label class="control-label col-sm-3" for="nama">Jumlah</label>
                      <label class="control-label col-sm-8" for="nama">
                        <input type="number" class="form-control"  id="txtJmlKurang" name="txtJmlKurang" min="0" style="text-align: right;" autocomplete="off" required> 
                        <label style="display: none; font-weight: normal; font-size: 10pt" id="peringatanStok">Tidak Boleh Melebihi Stok</label>
                      </label>
                    </div>
                    <div class="form-group  row">
                      <label class="control-label col-sm-3" for="nama">Satuan</label>
                      <label class="control-label col-sm-8" for="nama">
                        <select class="form-control" id="txtSatuanJmlKurang" name="txtSatuanJmlKurang"></select>
                        <label style="display: none; font-weight: normal; font-size: 10pt" id="satuanKurang"></label>
                      </label>

                    </div>
                    <div class="form-group">
                      <button type="submit" name="simpan" id="btnsubmitkurang" class="btn btn-danger">Simpan</button>
                    </div>
                  </form>
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
  <!-- tutup modal edit -->

  <!-- modal delete -->
  <div class="modal fade" id="modalHapus" role="dialog" aria-labelledby="favoritesModalLabel"> 
    <div class="modal-dialog" role="document"> 
      <div class="modal-content" style="border-radius: 17px;"> 
        <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;"> 
          <h4 style="color:white;">Hapus Obat</h4> 
          <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close"> 
          <span aria-hidden="true">&times;</span></button> 
        </div> 
        <div class="modal-body"> 
          <FORM method="post" action="<?php echo URL::to('/obat_hapus')?>"> 
            <div class="form-group"> 
              Apakah anda yakin ingin menghapus data Obat bernama <strong><span id="nametext"></span></strong> ?
            </div> 
            <div class="form-group"> 
              <input type="hidden" name="_token" value="{!!csrf_token()!!}"> 
              <input type="hidden" name="idHapus" id="idHapus" value="">
              <button class="btn btn-default" data-dismiss="modal" aria-label="Close">Tutup</button> 
              <button class="btn btn-danger">Hapus</button> 
            </div> 
          </FORM> 
        </div> 
      </div> 
    </div> 
  </div>
  <!-- tutup modal delete -->


  <!-- modal Delete All-->
  <div class="modal fade" id="modalHapusSemua" role="dialog" aria-labelledby="favoritesModalLabel"> 
    <div class="modal-dialog" role="document"> 
      <div class="modal-content" style="border-radius: 17px;"> 
        <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;"> 
          <h4 style="color:white;">Hapus Obat</h4> 
          <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close"> 
          <span aria-hidden="true">&times;</span></button> 
        </div> 
        <div class="modal-body"> 
          <FORM method="post" action="<?php echo URL::to('/obat_hapusall')?>"> 
            <div class="form-group"> 
              <span id="textdel"></span>
            </div> 
            <div class="form-group" id="field_input"> 
              <input type="hidden" name="_token" value="{!!csrf_token()!!}"> 
              <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">Tutup</button> 
              <button class="btn btn-danger" id="btnConfirmHapus">Hapus</button> 
            </div> 
          </FORM> 
        </div> 
      </div> 
    </div> 
  </div>
  <!-- tutup modal Delete All-->


  <!-- modal Import-->
  <div class="modal fade" id="modalImport" role="dialog" aria-labelledby="favoritesModalLabel"> 
    <div class="modal-dialog" role="document"> 
      <div class="modal-content" style="border-radius: 17px;"> 
        <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;"> 
          <h4 style="color:white;">Import Data Obat</h4> 
          <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close"> 
          <span aria-hidden="true">&times;</span></button> 
        </div> 
        <div class="modal-body"> 
          <div class="callout callout-warning">
            <h4><i class="fa fa-warning"></i> Note:</h4>
            Gunakan template yang sudah disediakan pada link di bawah ini
          </div>
          <div class="row">
            <div class="col-12">
              <!-- Custom Tabs -->
              <div class="card">
                <div class="card-header d-flex p-0">
                  <h3 class="card-title p-3"></h3>
                  <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Import Data Obat</a></li>
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                      <H5>Import Data Obat</H5>
                      <FORM method="post" action="<?php echo URL::to('/obat_import')?>" enctype="multipart/form-data"> 
                        <div class="form-group">
                          <input type="file" id="input-file-now" name="input-file-now" class="dropify" data-show-remove="true" data-allowed-file-extensions="xlsx" data-height="300"/>
                        </div> 
                        <div class="form-group" id="field_input"> 
                          <input type="hidden" id="txtIdentifier" name="txtIdentifier" value="ibu"></input>
                          <input type="hidden" name="_token" value="{!!csrf_token()!!}"> 
                          <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">Tutup</button> 
                          <button class="btn btn-danger" id="btnImport">Import</button> 
                        </div>
                        <div class="form-group"> 
                          Gunakan file dengan format .xlsx. Download template <a href="<?php echo URL::to('/obat_export')?>">disini</a>
                        </div> 
                      </FORM> 
                    </div>
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- ./card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <!-- END CUSTOM TABS -->
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
        <h3>Pengingat Obat Stok Menipis</h3>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Pengingat obat stok menipis</li>
        </ol>
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
                        Nama
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%;">
                        Harga (PCS/BUTIR)
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%;">
                        Stok (PCS/BUTIR)
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%;">
                        Tanggal Kadaluarsa
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 25%;">
                        Aksi
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($obat as $key => $value) 
                    <tr>
                      <td style="text-align: center;">{{($key+1)}}</td>
                      <td>{{($value['nama'])}}</td>
                      <td style="text-align: right">{{(number_format($value['harga']))}}</td>
                      <td style="text-align: right">{{($value['total_pcs'])}} </td>
                      <td>{{date('d-m-Y', strtotime($value['tanggal_kadaluarsa']))}}</td>
                      <td>
                        <div class="form-group">
                          <div>
                            <button data-toggle="modal" data-target="#modalDetail" id="<?php echo 'edit'.$key; ?>" onclick="opendetailmodal(<?php echo "'".$value["kode_obat"]."'" ?>,<?php echo "'".$value["nama"]."'" ?>,<?php echo "'".$value["merk"]."'" ?>,<?php echo "'".number_format($value["harga"])."'" ?>,<?php echo "'".$value["catatan"]."'" ?>,<?php echo "'".$value["total_pcs"]."'" ?>,<?php echo "'".$value["id_satuan"]."'" ?>,<?php echo "'".$value["tanggal_kadaluarsa"]."'" ?>);" class="btn btn-info"  style="width:40px"><i class="fa fa-info"></i></button>

                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalEdit" title="Edit" id="<?php echo 'edit'.$key; ?>" onclick="openeditmodal(<?php echo "'".$value['id']."'" ?>,<?php echo "'".$value["nama"]."'" ?>,<?php echo "'".$value["kode_obat"]."'" ?>,<?php echo "'".$value["merk"]."'" ?>,<?php echo "'".number_format($value["harga"]*$value["pcs"])."'" ?>,<?php echo "'".$value["total_pcs"]."'" ?>,<?php echo "'".$value["catatan"]."'" ?>,<?php echo "'".$value["id_satuan"]."'" ?>,<?php echo "'".$value["pcs"]."'" ?>,<?php echo "'".date('d-m-Y', strtotime($value['tanggal_kadaluarsa']))."'" ?>);"><i class="fa fa-edit"></i></button>

                            <button class="btn btn-danger" data-toggle="modal" data-target="#modalHapus" onclick="opendeletemodal(<?php echo "'".$value['id']."'" ?>,<?php echo "'".$value['nama']."'" ?>)"><i class="fa fa-times"></i></button>
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
<script src="{{asset('price_jquery/jquery.priceformat.min.js')}}"></script>
<script src="{{asset('dropify/dist/js/dropify.min.js')}}"></script>
<script>


  var total_pcsnya;
  var pcsnya;

  function opendetailmodal(KODE, NAMA, MERK, HARGA, CATATAN, STOK, SATUAN, TGLKADALUARSA)
  {
    document.getElementById('lblNamaDetail').innerHTML = NAMA;
    document.getElementById('lblKodeDetail').innerHTML = KODE;
    document.getElementById('lblMerkDetail').innerHTML = MERK;
    document.getElementById('lblHargaDetail').innerHTML = HARGA;
    document.getElementById('lblCatatanDetail').innerHTML = CATATAN;
    document.getElementById('lblStokDetail').innerHTML = STOK+" (PCS/BUTIR)";
    document.getElementById('lblTglDetail').innerHTML = TGLKADALUARSA;
  }


  function openeditmodal(id, nama, kode, merk,harga,total_pcs, catatan,id_satuan, pcs,tglkadaluarsa){
    modalEdit.style.display = "block";

    total_pcsnya=total_pcs;
    pcsnya=pcs;

    document.getElementById('idUpdate').value = id;
    document.getElementById('idUpdateHarga').value = id;
    document.getElementById('idUpdateTambahStok').value = id;
    document.getElementById('idUpdateKurangStok').value = id;
    document.getElementById('txtNamaEdit').value = nama;
    document.getElementById('txtKodeEdit').value = kode;
    document.getElementById('txtMerkEdit').value = merk;
    document.getElementById('txtHargaEdit').value = harga;
    document.getElementById('txtCttnEdit').value = catatan;
    //document.getElementById('txtStokEdit').value = stok;

    document.getElementById("satuanTambah").style.display = "none";
    document.getElementById("satuanKurang").style.display = "none";
    var satuannya = "";
    if(id_satuan==0){
      satuannya = " PCS/BUTIR";
      document.getElementById('txtSatuanJmlTambah').innerHTML = "<option value='"+id_satuan+"'>"+satuannya+"</option>";
      document.getElementById('txtSatuanJmlKurang').innerHTML = "<option value='"+id_satuan+"'>"+satuannya+"</option>";

      document.getElementById("lblsatuanHarganya").style.display = "none";
    }
    else{
      satuannya = "PACK/STRIP";
      satuanPCSnya = "<option value='0'>PCS/BUTIR</option>";
      document.getElementById('txtSatuanJmlTambah').innerHTML = satuanPCSnya+"<option value='"+id_satuan+"'>"+satuannya+"</option>";
      document.getElementById('txtSatuanJmlKurang').innerHTML = satuanPCSnya+"<option value='"+id_satuan+"'>"+satuannya+"</option>";

      document.getElementById('lblsatuanHarganya').innerHTML = "1 "+satuannya+" = "+pcsnya+" PCS";
      document.getElementById("lblsatuanHarganya").style.display = "block";
      // document.getElementById("satuanTambah").style.display = "block";
      // document.getElementById("satuanKurang").style.display = "block";
    }
    document.getElementById('txtSatuanEditHarga').innerHTML = "<option value='"+id_satuan+"'>"+satuannya+"</option>";
    document.getElementById('tglkadaluarsaEdit').value = tglkadaluarsa;
  }

  function opendeletemodal(id, nama){
    modalHapus.style.display = "block";

    document.getElementById('idHapus').value =id;
    document.getElementById('nametext').innerHTML = nama;
  }

  function opendeleteallmodal(){
    modalHapusSemua.style.display = "block";

    $ischecked = false;
    for(var i = 0; i < document.getElementsByName('chkDel[]').length; i++){
      if(document.getElementById('checkbox'+i).checked){
        $ischecked = true;
      }
    }

    if($ischecked){
      document.getElementById("textdel").innerHTML = "Apakah anda yakin ingin menghapus data obat yang telah dipilih?";
      document.getElementById("btnConfirmHapus").style.visibility = "visible";
    }
    else{
      document.getElementById("textdel").innerHTML = "Tidak ada data obat yang dipilih";
      document.getElementById("btnConfirmHapus").style.visibility = "hidden";
    }
    //alert($ischecked);
  }

  // FOR DELETE CHECKED
  $('input').on('ifChecked', function(event){
      // CREATE HIDDEN ELEMENT FOR SAVE ID'S CHOOSE
      var input = document.createElement("input");
      input.setAttribute('type', 'hidden');
      input.setAttribute('id', 'del'+$(this).val());
      input.setAttribute('name', 'txtDeleteAll[]');
      input.setAttribute('value', $(this).val());

      var parent = document.getElementById("field_input");
      parent.appendChild(input);
    });

  $('input').on('ifUnchecked', function(event){
    var parent = document.getElementById("field_input");
    var element = document.getElementById('del'+$(this).val());
    parent.removeChild(element);
  });
  // ============ DELETE CHECKED END

  $(document).ready(function(){

    $('#txtSatuanJmlTambah').on('change', function (e) {
      var optionSelected = $("option:selected", this);
      var valueSelected = this.value;
      if(valueSelected==1){
        document.getElementById('satuanTambah').innerHTML = "1 PACK/STRIP = "+pcsnya+" PCS";
        document.getElementById("satuanTambah").style.display = "block";
      }
      else{
        document.getElementById('satuanTambah').innerHTML = '';
        document.getElementById("satuanTambah").style.display = "none";
      }
    });

    $('#txtSatuanJmlKurang').on('change', function (e) {
      var optionSelected = $("option:selected", this);
      var valueSelected = this.value;
      if(valueSelected==1){
        document.getElementById('satuanKurang').innerHTML = "1 PACK/STRIP = "+pcsnya+" PCS";
        document.getElementById("satuanKurang").style.display = "block";
      }
      else{
        document.getElementById('satuanKurang').innerHTML = '';
        document.getElementById("satuanKurang").style.display = "none";
      }
    });
    
    $( "#txtHarga" ).keyup(function() {
      //alert( "Handler for .keyup() called." );
      if($("#txtHarga").val()==0){
        document.getElementById("peringatanHarga").style.display = "block";
        $("#btnsubmitTambah").prop('disabled',true);
      }
      else{
        document.getElementById("peringatanHarga").style.display = "none";
        $("#btnsubmitTambah").prop('disabled',false);
      }
    });

    $( "#txtHargaEdit" ).keyup(function() {
      //alert( "Handler for .keyup() called." );
      if($("#txtHargaEdit").val()==0){
        document.getElementById("peringatanHargaEdit").style.display = "block";
        $("#btnsubmitEdit").prop('disabled',true);
      }
      else{
        document.getElementById("peringatanHargaEdit").style.display = "none";
        $("#btnsubmitEdit").prop('disabled',false);
      }
    });


    $( "#txtJmlKurang" ).keyup(function() {
      //alert( ($("#txtJmlKurang").val()*($("#txtSatuanJmlKurang").val() == 1 ? pcsnya : 1)) );
      if(($("#txtJmlKurang").val()*($("#txtSatuanJmlKurang").val() == 1 ? pcsnya : 1)) > total_pcsnya){
        document.getElementById("peringatanStok").style.display = "block";
        $("#btnsubmitkurang").prop('disabled',true);
      }
      else{
        document.getElementById("peringatanStok").style.display = "none";
        $("#btnsubmitkurang").prop('disabled',false);
      }
    });

    $('.datepicker2').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy',
      startDate: new Date()
    });


    $('#txtHarga').priceFormat({ 
      clearPrefix: true, 
      clearSuffix: true, 
      prefix: '', 
      centsLimit: 0, 
      thousandsSeparator: ',' 
    }); 
    $('#txtHargaEdit').priceFormat({ 
      clearPrefix: true, 
      clearSuffix: true, 
      prefix: '', 
      centsLimit: 0, 
      thousandsSeparator: ',' 
    }); 
    $('#txtSatuan').on('change', function (e) {
      var optionSelected = $("option:selected", this);
      var valueSelected = this.value;

      if(valueSelected==1){
        document.getElementById("jumlahPCS").style.display = "block";
        $("#txtPcs").prop('required',true);
      }
      else{
        document.getElementById("jumlahPCS").style.display = "none";
        $("#txtPcs").prop('required',false);
      }

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
    });

  });




</script>
@endsection