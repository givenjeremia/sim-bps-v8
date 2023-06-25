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
      <h3>Histori Persalinan</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/ibu_hamil')}}">Pelayanan Ibu Hamil</a></li>
        <li class="breadcrumb-item active">Histori Persalinan</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
              <label class="control-label col-lg-6">
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">Tempat</label>
                  <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                    : {{str_replace("_", " ",$persalinan[0]->tempat)}} 
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">Tanggal</label>
                  <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                    : {{date('d-m-y H:i:s', strtotime($persalinan[0]->tanggal))}}
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">Penolong</label>
                  <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                    : {{$persalinan[0]->penolong}}
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">Nama</label>
                  <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                    : {{$persalinan[0]->nama_penolong}}
                  </label> 
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">Proses Persalinan</label>
                  <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                    : {{str_replace("_", " ",$persalinan[0]->proses_persalinan)}}
                  </label>
                </div>
              </label>
              <label class="control-label col-lg-6">
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">Komplikasi</label>
                  <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                    : {{str_replace("_", " ",$persalinan[0]->komplikasi_persalinan)}}
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">BB</label>
                  <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                    : {{$persalinan[0]->keadaan_bbl_bb}}
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">PB</label>
                  <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                    : {{$persalinan[0]->keadaan_bbl_pb}}
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">LK</label>
                  <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                    : {{$persalinan[0]->keadaan_bbl_lk}}
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4" for="nama">Keadaan</label>
                  <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                    : {{$persalinan[0]->keadaan_bbl_hidup}}
                  </label>
                </div>
              </label>
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
              <a href="<?php echo URL::to('/ibuHamilDetailTambahNifas?id_persalinan='.$persalinan[0]->id)?>" class="btn btn-block btn-primary btn-sm" id="btnAdd"><i class="fa fa-plus-circle nav-icon"></i> Tambah Histori Nifas</a>
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
                <br>
                <div class="table-responsive">  
                  <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                    <thead>
                      <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 3%; text-align:center;">
                          No
                        </th>
                        <th tabindex="0" aria-controls="example1" aria-label="Rendering engine: activate to sort column descending" style="width: 10%; text-align:center;">
                          Tanggal
                        </th>
                        <th tabindex="0" aria-controls="example1" aria-label="Rendering engine: activate to sort column descending" style="width: 10%; text-align:center;">
                          Keluhan
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" aria-label="Browser: activate to sort column ascending" style="width: 15%; text-align:center;">
                          Tindakan
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1"  aria-label="Browser: activate to sort column ascending" style="width: 15%; text-align:center;">
                          Aksi
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($hnifas as $key => $value) 
                      <tr>
                        <td style="text-align: center;">{{($key+1)}}</td>
                        <td style="text-align: center;">{{date('d-m-Y H:i:s', strtotime($value->tanggal))}}</td>
                        <td>{{($value->keluhan)}}</td>
                        <td>{{$value->terapi_tindakan}}</td>
                        <td>
                          <div class="form-group">
                            <div data-toggle="tooltips" title="Detail"  style="width:30%">
                              <a href="{{url('/layananIbuHamilDetailNifas/'.$value->id)}}" class="btn btn-info"><i class="fa fa-history"></i></a>
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
<script>
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