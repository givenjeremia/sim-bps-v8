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
      <h4 style="color:white;">Tambah Data Bayi Imunisasi</h4>
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
<br>
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h3>Pelayanan Imunisasi</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item active">Pelayanan Imunisasi</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-2 col-4" data-toggle="tooltips" title="Tambah">
              <a href="{{ route('layanan-imunisasi.create') }}"><button type="button" class="btn btn-block btn-primary btn-sm" id="btnAdd"><i class="fa fa-plus-circle nav-icon"></i> Tambah pasien baru</button></a>
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
                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 3%; text-align:center;">
                          No
                        </th>
                   
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 20%; text-align:center;">
                          Nama
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 15%; text-align:center;">
                          Tanggal Lahir
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 20%; text-align:center;">
                          Alamat
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 5%; text-align:center;">
                         Aksi
                       </th>
                     </tr>
                   </thead>
                   <tbody>
                    @foreach($bayiArr as $key => $value) 
                    <tr>
                      <td style="text-align: center;">{{($key+1)}}</td>
      
                      <td>{{$value['nama']}}</td>
                      <td style="text-align:center;">{{date('d-m-Y', strtotime($value['tanggal_lahir']))}}</td>
                      <td>{{$value['alamat']}}</td>
                      
                      <td>
                        <div class="form-group">
                          {{-- $value->imunisasi --}}
                          @if (count($value->imunisasi) > 0)
                          <div>
                            <a href="{{url('/layanan-imunisasi/'.$value['id'])}}"><button type="button" class="btn btn-info" title="history pasien"><i class="fa fa-history"></i></button></a>
                          </div>
                          @else
                          <div>
                            <a href="{{url('/layanan-imunisasi/tambah-kartu/'.$value['id'])}}"><button type="button" class="btn btn-primary" title="tambah kartu"><i class="fa fa-plus"></i></button></a>
                          </div> 
                          @endif
                         

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
        <script>
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


            // if(status == 1)
            // {
            //   $("#imgIc").show();
            //   $("#dpIC").hide();
            //   $("#btnSimpanIc").hide();
            //   document.getElementById('imgIc').src = ic;
            // }
            // if(status == 2)
            // {
            //   $("#imgIc").hide();
            //   $("#dpIC").show();
            //   $("#btnSimpanIc").show();
            // }
            
            document.getElementById('lblNamaIc').innerHTML = nama;
          }
        </script>

        <script src="{{asset('dropify/dist/js/dropify.min.js')}}"></script>
        <script type="text/javascript">
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
            @endsection