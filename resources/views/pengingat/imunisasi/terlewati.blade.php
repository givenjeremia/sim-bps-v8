@extends('layouts.adminlte')
<!-- plugin css -->
@section('plugin_css')

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
      <h4 style="color:white;">Detail Data Pasien Bayi</h4>
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
        <label>B.B.L:</label>
        <p id="lblBblDetail"></p>
        <label>Cara Persalinan:</label>
        <p id="lblCaraPersalinanDetail"></p>
        <label>Alamat:</label>
        <p id="lblAlamatDetail"></p>
        <label>Nama Ayah:</label>
        <p id="lblNamaAyahDetail"></p>
        <label>Nama Ibu:</label>
        <p id="lblNamaIbuDetail"></p>
        <label>Telp:</label>
        <p id="lblTelpDetail"></p>
      </div>
      <div class="form-group">
        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
        <input type="hidden" id="txtIdEdit" name="txtIdEdit" value="{!!csrf_token()!!}">
        <button class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
      </div>
    </div>
  </div>
</div>
</div>
<!-- tutup modal detail-->
<!-- modal edit -->
<div class="modal fade" id="modalEdit" role="dialog" 
aria-labelledby="favoritesModalLabel">
<div class="modal-dialog" role="document">
  <div class="modal-content" style="border-radius: 17px;">
    <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;">
      <h4 style="color:white;">Edit Data Pasien Bayi</h4>
      <button type="button" class="close" 
      data-dismiss="modal" 
      aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
      <FORM method="post" action="<?php echo URL::to('#')?>">
        <div class="form-group">
          <label>Nama:</label>
          <input type="text" class="form-control" id="txtNamaEdit" name="txtNamaEdit" placeholder="Nama Layanan" required>
          <label>Tanggal Lahir:</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right datepicker" id="txtTTLEdit">
            </div>
            <label>B.B.L:</label>
            <input type="text" class="form-control" id="txtBBLEdit" name="txtBBLEdit" placeholder="Berat Badan Lahir" required>
            <label>Cara Persalinan:</label>
            <select class="form-control" id="cbxCaraPersalinanEdit" style="width: 100%;">
              <option>Caesar</option>
              <option>Normal</option>
            </select>
            <label>Alamat:</label>
            <textarea class="form-control" rows="3" id="txtAlamatEdit" placeholder="Alamat" required></textarea>
            <label>Nama Ayah:</label>
            <input type="text" class="form-control" id="txtNamaAyahEdit" name="txtNamaAyahEdit" placeholder="Nama Ayah" required>
            <label>Nama Ibu:</label>
            <input type="text" class="form-control" id="txtNamaIbuEdit" name="txtNamaIbuEdit" placeholder="Nama Ibu" required>
            <label>Telepon:</label>
            <input type="text" class="form-control" id="txtTelpEdit" name="txtTelpEdit" placeholder="Telepon" required>
          </div>
          <div class="form-group">
            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
            <input type="hidden" id="txtIdEdit" name="txtIdEdit" value="{!!csrf_token()!!}">
            <button class="btn btn-default pull-left" data-dismiss="modal">Batal</button>&nbsp
            <button class="btn btn-danger">Edit</button>
          </div>
        </FORM>
      </div>
    </div>
  </div>
</div>
<!-- tutup modal edit-->
<!-- modal hapus -->
<div class="modal fade" id="modalHapus" role="dialog"> 
  <div class="modal-dialog" role="document"> 
    <div class="modal-content" style="border-radius: 17px;"> 
      <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;"> 
        <h4 style="color:white;">Hapus Data Pasien Bayi</h4> 
        <button type="button" class="close"  
        data-dismiss="modal"  
        aria-label="Close"> 
        <span aria-hidden="true">&times;</span></button> 
      </div> 
      <div class="modal-body"> 
        Apakah anda yakin ingin menghapus pasien <span style="font-weight:bold;" id="lblNamaHapus"></span> ?
        <FORM method="post" action="<?php echo URL::to('/#')?>">
          <div class="button-group">
            <BR>
              <button class="btn btn-default pull-left" data-dismiss="modal">Batal</button>&nbsp
              <button class="btn btn-danger">Hapus</button>
              <br>
              <input type="hidden" id="txtIdHapus">
            </div>
          </FORM>
        </div> 
      </div> 
    </div> 
  </div>
  <!-- tutup modal hapus -->
  <!-- modal hapus selected -->
  <div class="modal fade" id="modalHapusTerpilih" role="dialog"> 
    <div class="modal-dialog" role="document"> 
      <div class="modal-content" style="border-radius: 17px;"> 
        <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;"> 
          <h4 style="color:white;">Hapus Data Pasien Bayi</h4> 
          <button type="button" class="close"  
          data-dismiss="modal"  
          aria-label="Close"> 
          <span aria-hidden="true">&times;</span></button> 
        </div> 
        <div class="modal-body"> 
          Apakah anda yakin ingin menghapus pasien yang terpilih?
          <FORM method="post" action="<?php echo URL::to('/#')?>">
            <div class="button-group">
              <BR>
                <button class="btn btn-default pull-left" data-dismiss="modal">Batal</button>&nbsp
                <button class="btn btn-danger">Hapus Semua</button>
                <br>
                <input type="hidden" id="txtIdHapusTerpilih">
              </div>
            </FORM>
          </div> 
        </div> 
      </div> 
    </div>
    <!-- tutup modal hapus selected -->
    <!-- modal tambah -->
    <div class="modal fade" id="modalTambah" role="dialog" 
    aria-labelledby="favoritesModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="border-radius: 17px;">
        <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;">
          <h4 style="color:white;">Tambah Data Pasien Bayi</h4>
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
    <br>
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3>Pengingat Imunisasi yang Terlewati</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Pengingat Imunisasi yang Terlewati</li>
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
                    <div class="table-responsive">  
                      <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <thead>
                          <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 3%; text-align:center;">
                              No
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 20%; text-align:center;">
                              Nama
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 15%; text-align:center;">
                              Jenis Imunisasi
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 15%; text-align:center;">
                              Tanggal Imunisasi
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 20%; text-align:center;">
                              Nama Ibu
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 20%; text-align:center;">
                              Nama Ayah
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 20%; text-align:center;">
                              Telepon
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 15%; text-align:center;">
                             Aksi
                           </th>
                         </tr>
                       </thead>
                       <tbody>
                        @foreach($bayi as $key => $value) 
                        <tr>
                          <td style="text-align: center;">{{($key+1)}}</td>
                          <td>{{$value->nama}}</td>
                          <td>{{$value->jenisImunisasi}}</td>
                          <td>{{$value->tanggal}}</td>
                          <td>{{$value->nama_ibu}}</td>
                          <td>{{$value->nama_ayah}}</td>
                          <td>{{$value->telp}}</td>
                          <td>
                            <div class="form-group">
                              <div>

                                <a href="{{url('/layanan-imunisasi/'.$value->idbayi.'/edit')}}"><button id="<?php echo 'edit'.$key; ?>" class="btn btn-primary" data-toggle="tooltips" title="Jadwalkan Ulang" style="width:40px"><i class="fa fa-clock-o"></i></button></a>

                              </div>
                            </div>


                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table></div></div></div></div>
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
            function openeditmodal(id, nama, ttl, bbl, caraPersalinan, alamat, namaAyah, namaIbu, telp)
            {
              document.getElementById('txtIdEdit').value = id;
              document.getElementById('txtNamaEdit').value = nama;
              document.getElementById('txtTTLEdit').value = ttl;
              document.getElementById('txtBBLEdit').value = bbl+" KG";
              document.getElementById('cbxCaraPersalinanEdit').selectedIndex = caraPersalinan;
              document.getElementById('txtAlamatEdit').value = alamat;
              document.getElementById('txtNamaAyahEdit').value = namaAyah;
              document.getElementById('txtNamaIbuEdit').value = namaIbu;
              document.getElementById('txtTelpEdit').value = telp;
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

            function openhapusmodal(id, nama)
            {
              document.getElementById('txtIdHapus').value = id;
              document.getElementById('lblNamaHapus').innerHTML  = nama;
            }

            function openhapusterpilihmodal()
            {
              var arrTerpilih = new Array();
              $("input:checkbox[name='cbxHapusTerpilih']:checked").each(function(){
                arrTerpilih.push($(this).attr('id'));
              });
              document.getElementById('txtIdHapusTerpilih').value = arrTerpilih;
            }
          </script>
          @endsection