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
        <label>Jenis Kelamin:</label>
        <p id="lblKelamin"></p>
        <label>Tanggal Lahir:</label>
        <p id="lblTtlDetail"></p>
        <label>B.B.L:</label>
        <p id="lblBblDetail"></p>
        <label>Cara Persalinan:</label>
        <p id="lblCaraPersalinanDetail"></p>
        <label>Kelurahan:</label>
        <p id="lblKelurahanDetail"></p>
        <label>Asal Wilayah:</label>
        <p id="lblAsalWilayahDetail"></p>
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
      <FORM method="post" action="<?php echo URL::to('/pasien_bayi_edit')?>">
        <div class="form-group">
          <label>Nama:</label>
          <input type="text" class="form-control" id="txtNamaEdit" name="txtNamaEdit" placeholder="Nama Layanan" autocomplete="off" required>
          <label>Jenis Kelamin:</label>
          <select class="form-control" id="cbxKelaminEdit" name="cbxKelaminEdit" style="width: 100%;">
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
          </select>
          <label>Tanggal Lahir:</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right datepicker" id="txtTTLEdit" name="txtTTLEdit" autocomplete="off" required>
            </div>
            <label>B.B.L (KG):</label>
            <input type="number" class="form-control" id="txtBBLEdit" name="txtBBLEdit" placeholder="Berat Badan Lahir" autocomplete="off" required>
            <label>Cara Persalinan:</label>
            <select class="form-control" id="cbxCaraPersalinanEdit" name="cbxCaraPersalinanEdit" style="width: 100%;">
              <option value="1">Caesar</option>
              <option value="0">Normal</option>
            </select>
            <label>Kelurahan:</label>
            <input type="text" class="form-control" id="txtKelurahanEdit" name="txtKelurahanEdit" placeholder="Kelurahan" autocomplete="off" required>
            <label>Asal Wilayah:</label>
            <input type="text" class="form-control" id="txtAsalWilayahEdit" name="txtAsalWilayahEdit" placeholder="Asal Wilayah" autocomplete="off" required>
            <label>Alamat:</label>
            <textarea class="form-control" rows="3" id="txtAlamatEdit" name="txtAlamatEdit" placeholder="Alamat" autocomplete="off" required></textarea>
            <label>Nama Ayah:</label>
            <input type="text" class="form-control" id="txtNamaAyahEdit" name="txtNamaAyahEdit" placeholder="Nama Ayah" autocomplete="off" required>
            <label>Nama Ibu:</label>
            <input type="text" class="form-control" id="txtNamaIbuEdit" name="txtNamaIbuEdit" placeholder="Nama Ibu" autocomplete="off" required>
            <label>Telepon:</label>
            <input type="number" class="form-control" id="txtTelpEdit" name="txtTelpEdit" placeholder="Telepon" autocomplete="off" required>
          </div>
          <div class="form-group">
            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
            <input type="hidden" id="txtIdEdit" name="txtIdEdit">
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
        <FORM method="post" action="<?php echo URL::to('/pasien_bayi_hapus')?>">
          <div class="button-group">
            <BR>
              <button class="btn btn-default pull-left" data-dismiss="modal">Batal</button>&nbsp
              <button class="btn btn-danger">Hapus</button>
              <br>
              <input type="hidden" name="_token" value="{!!csrf_token()!!}">
              <input type="hidden" id="txtIdHapus" name="txtIdHapus">
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
          <FORM method="post" action="<?php echo URL::to('/pasien_bayi_hapus_terpilih')?>">
            <div class="button-group">
              <BR>
                <button class="btn btn-default pull-left" data-dismiss="modal">Batal</button>&nbsp
                <button class="btn btn-danger">Hapus Semua</button>
                <br>
                <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                <input type="hidden" id="txtIdHapusTerpilih" name="txtIdHapusTerpilih">
              </div>
            </FORM>
          </div> 
        </div> 
      </div> 
    </div>
    <!-- tutup modal hapus selected -->
    <!-- modal peringatan -->
    <div class="modal fade" id="modalPeringatan" role="dialog"> 
      <div class="modal-dialog" role="document"> 
        <div class="modal-content" style="border-radius: 17px;"> 
          <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;"> 
            <h4 style="color:white;">Peringatan</h4> 
            <button type="button" class="close"  
            data-dismiss="modal"  
            aria-label="Close"> 
            <span aria-hidden="true">&times;</span></button> 
          </div> 
          <div class="modal-body"> 
            <p id="lblPeringatan"></p>
              <div class="button-group">
                <BR>
                <button class="btn btn-default pull-left" data-dismiss="modal">Ok</button>
              </div>
          </div> 
        </div> 
      </div> 
    </div>
    <!-- tutup modal peringatan -->
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
          <FORM method="post" action="<?php echo URL::to('/pasien_bayi')?>">
            <div class="form-group">
              <label>Nama:</label>
              <input type="text" class="form-control" id="txtNama" name="txtNama" placeholder="Nama Pasien" autocomplete="off" required>
              <label>Jenis Kelamin:</label>
              <select class="form-control" id="cbxKelamin" name="cbxKelamin" style="width: 100%;">
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
              </select>
              <label>Tanggal Lahir:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker" id="datepicker" name="dtpTanggalLahir" autocomplete="off" required>
                </div>
                <label>B.B.L (KG):</label>
                <input type="number" class="form-control" id="txtBBL" name="txtBBL" placeholder="Berat Badan Lahir" autocomplete="off" required>
                <label>Cara Persalinan:</label>
                <select class="form-control" id="cbxCaraPersalinan" name="cbxCaraPersalinan" style="width: 100%;">
                  <option value="1">Caesar</option>
                  <option value="0">Normal</option>
                </select>
                <label>Kelurahan:</label>
                <input type="text" class="form-control" id="txtKelurahan" name="txtKelurahan" placeholder="Kelurahan" autocomplete="off" required>
                <label>Asal Wilayah:</label>
                <input type="text" class="form-control" id="txtAsalWilayah" name="txtAsalWilayah" placeholder="Asal Wilayah" autocomplete="off" required>
                <label>Alamat:</label>
                <textarea class="form-control" rows="3" id="txtAlamat" name="txtAlamat" placeholder="Alamat" autocomplete="off" required></textarea>
                <label>Nama Ayah:</label>
                <input type="text" class="form-control" id="txtNamaAyah" name="txtNamaAyah" placeholder="Nama Ayah" autocomplete="off" required>
                <label>Nama Ibu:</label>
                <input type="text" class="form-control" id="txtNamaIbu" name="txtNamaIbu" placeholder="Nama Ibu" autocomplete="off" required>
                <label>Telepon:</label>
                <input type="number" class="form-control" id="txtTelp" name="txtTelp" placeholder="Telepon" autocomplete="off" required>
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

    <!-- modal Import-->
    <div class="modal fade" id="modalImport" role="dialog" aria-labelledby="favoritesModalLabel"> 
      <div class="modal-dialog" role="document"> 
        <div class="modal-content" style="border-radius: 17px;"> 
          <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;"> 
            <h4 style="color:white;">Import Data Pasien Bayi</h4> 
            <button type="button" class="close" 
            data-dismiss="modal" 
            aria-label="Close"> 
            <span aria-hidden="true">&times;</span></button> 
          </div> 
          <div class="modal-body"> 
            <FORM method="post" action="<?php echo URL::to('/bayi_import')?>" enctype="multipart/form-data"> 
              <div class="form-group">
                <input type="file" id="input-file-now" name="input-file-now" class="dropify" data-show-remove="true" data-allowed-file-extensions="xlsx" data-height="300"/>
              </div> 
              <div class="form-group" id="field_input"> 
                <input type="hidden" name="_token" value="{!!csrf_token()!!}"> 
                <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">Batal</button> 
                <button class="btn btn-danger" id="btnImport">Import</button> 
              </div>
              <div class="form-group"> 
                Gunakan file dengan format .xlsx. Download template <a href="<?php echo URL::to('/bayi_export')?>">disini</a>
              </div> 
            </FORM> 
          </div> 
        </div> 
      </div> 
    </div>
    <!-- tutup modal Import-->

    <br>
    <div class="container-fluid">
    @if (Session::get('notif_berhasil'))
    <div class="alert alert-success"></span><a href="#" class="close" data-dismiss="alert">&times;</a><strong>BERHASIL!</strong><BR> 
    {!! session::get('notif_berhasil') !!}
    </div>
    @endif
    @if (Session::get('notif_gagal'))
    <div class="alert alert-danger"></span><a href="#" class="close" data-dismiss="alert">&times;</a><strong>GAGAL!</strong><BR> 
      {!! session::get('notif_gagal') !!}
    </div>
    @endif
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3>Master Data Pasien Bayi</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Master Data Pasien Bayi</li>
          </ol>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-1 col-4" title="Tambah">
                  <button type="button" class="btn btn-block btn-primary btn-sm" id="btnAdd" data-toggle="modal" 
                  data-target="#modalTambah"><i class="fa fa-plus-circle nav-icon"></i> Tambah</button>
                </div>
                <div class="col-lg-1 col-4" title="Hapus">
                  <button type="button" class="btn btn-block btn-danger btn-sm" onclick="openhapusterpilihmodal();"><i class="fa fa-times-circle nav-icon"></i> Hapus</button>
                </div>
                <div class="col-lg-2 col-4" title="Hapus">
                  <button type="button" class="btn btn-block btn-info btn-sm" data-toggle="modal" 
                  data-target="#modalImport"><i class="fa fa-upload nav-icon"></i> Import Excel</button>
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
                  <div class="col-sm-12">
                    <div class="table-responsive">  
                      <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <thead>
                          <tr role="row">
                            <th style="width: 2%; text-align:right;"></th>
                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 3%; text-align:center;">
                              No
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 15%; text-align:center;">
                              No.Registerasi
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 20%; text-align:center;">
                              Nama
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 20%; text-align:center;">
                              Jenis Kelamin
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 15%; text-align:center;">
                              Tanggal Lahir
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 20%; text-align:center;">
                              Nama Ayah
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 20%; text-align:center;">
                              Nama Ibu
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 15%; text-align:center;">
                             Aksi
                           </th>
                         </tr>
                       </thead>
                       <tbody>
                        @foreach($bayiArr as $key => $value) 
                        <tr>
                          <td style="text-align: center;"><input type="checkbox" class="flat-red icheckbox" name="cbxHapusTerpilih" id="{{$value['id']}}"></td>
                          <td style="text-align: center;">{{($key+1)}}</td>
                          <td>{{$value['no_registrasi']}}</td>
                          <td>{{$value['nama']}}</td>
                          <?php $kelamin = "Laki-Laki"; if($value['kelamin']=='P') $kelamin = "Perempuan"; ?>
                          <td>{{$kelamin}}</td>
                          <td style="text-align:center;">{{date("d-m-Y", strtotime($value['tanggal_lahir']))}}</td>
                          <td>{{$value['nama_ayah']}}</td>
                          <td>{{$value['nama_ibu']}}</td>
                          <td>
                            <div class="form-group">
                              <div>
                                <button data-toggle="modal" data-target="#modalDetail" id="<?php echo 'edit'.$key; ?>" onclick="opendetailmodal(<?php echo "'".$value['id']."'" ?>,'detail');" class="btn btn-info" data-toggle="tooltips" title="Edit" style="width:40px"><i class="fa fa-info"></i></button>

                                <button data-toggle="modal" data-target="#modalEdit" id="<?php echo 'edit'.$key; ?>" onclick="opendetailmodal(<?php echo "'".$value['id']."'" ?>,'edit');" class="btn btn-primary" data-toggle="tooltips" title="Edit" style="width:40px"><i class="fa fa-edit"></i></button>

                                <a href="{{url('/cetak_kartu_bayi/'.$value['id'])}}"><button type="button" class="btn btn-warning" title="tambah kartu"><i class="fa fa-print"></i></button></a>

                                <button data-toggle="modal" data-target="#modalHapus" id="<?php echo 'edit'.$key; ?>" onclick="openhapusmodal(<?php echo "'".$value['id']."'" ?>,<?php echo "'".$value['nama']."'" ?>);" class="btn btn-danger" data-toggle="tooltips" title="Hapus" style="width:40px"><i class="fa fa-times"></i></button>

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

      </div>
      @endsection
      <!-- plugin js -->
      @section('plugin_js')

      @endsection

      <!-- add js -->
      @section('add_js')
      <script src="{{asset('dropify/dist/js/dropify.min.js')}}"></script>
      <script>
        function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }

        $(document).ready(function(){
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

        function opendetailmodal(id, desire)
        {
          var url = <?php echo "'".URL::to('/detail_pasien_bayi')."'"; ?>;
          $.ajax({
            type:"GET",
            url:url,
            data:{bayi_id:id},
            success:function(data){
              var resp = $.parseJSON(data);
              console.log(resp);
              if(desire == 'detail')
              {
                document.getElementById('lblNamaDetail').innerHTML = resp.nama;
                var kelamin = 'Laki-Laki';
                if(resp.kelamin == 'P')
                  kelamin = 'Perempuan';

                var caraPersalinan = 'Normal';
                if(resp.cara_persalinan == '1')
                  caraPersalinan = 'Caesar';
                document.getElementById('lblKelamin').innerHTML = kelamin;
                document.getElementById('lblTtlDetail').innerHTML = resp.tanggal_lahir;
                document.getElementById('lblBblDetail').innerHTML = resp.bbl+" KG";
                document.getElementById('lblCaraPersalinanDetail').innerHTML = caraPersalinan;
                document.getElementById('lblKelurahanDetail').innerHTML = resp.kelurahan;
                document.getElementById('lblAsalWilayahDetail').innerHTML = resp.asal_wilayah;
                document.getElementById('lblAlamatDetail').innerHTML = resp.alamat;
                document.getElementById('lblNamaAyahDetail').innerHTML = resp.nama_ayah;
                document.getElementById('lblNamaIbuDetail').innerHTML = resp.nama_ibu;
                document.getElementById('lblTelpDetail').innerHTML = resp.telp;
              }
              else if(desire == 'edit')
              {
                document.getElementById('txtIdEdit').value = resp.id;
                document.getElementById('cbxKelaminEdit').value = resp.kelamin;
                document.getElementById('txtNamaEdit').value = resp.nama;
                document.getElementById('txtTTLEdit').value = resp.tanggal_lahir;
                document.getElementById('txtBBLEdit').value = resp.bbl;
                document.getElementById('cbxCaraPersalinanEdit').value = resp.cara_persalinan;
                document.getElementById('txtKelurahanEdit').value = resp.kelurahan;
                document.getElementById('txtAsalWilayahEdit').value = resp.asal_wilayah;
                document.getElementById('txtAlamatEdit').value = resp.alamat;
                document.getElementById('txtNamaAyahEdit').value = resp.nama_ayah;
                document.getElementById('txtNamaIbuEdit').value = resp.nama_ibu;
                document.getElementById('txtTelpEdit').value = resp.telp;
              }
            }    
          });
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
          if(arrTerpilih.length>0)
          {
            $('#modalHapusTerpilih').modal('show');
            document.getElementById('txtIdHapusTerpilih').value = arrTerpilih;
          }
          else
          {
            document.getElementById('lblPeringatan').innerHTML = 'Anda belum memilih data yang akan dihapus';
            $('#modalPeringatan').modal('show');
          }
        }
      </script>

      @endsection