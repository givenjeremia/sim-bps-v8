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
  <div class="row mb-2">
    <div class="col-sm-6">
      <h3>Detail Pasien Dewasa</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('pasien-dewasa.index') }}">Master Pasien Dewasa</a></li>
        <li class="breadcrumb-item active">Detail Pasien Dewasa</li>
      </ol>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Ibu</h3>
        </div>
        <div class="card-body">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6"> 
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">Nomor Registrasi</label>
                  <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{ $pasienDewasa->no_regis }}</span>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">Nama Pasien</label>
                  <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{ $pasienDewasa->nama }}</span>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">Tanggal Lahir</label>
                  <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                    <div class="input-group">
                      : &nbsp <span> {{ $pasienDewasa->tanggal_lahir }}</span>
                    </div> 
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">Agama</label>
                  <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                    <div class="input-group">
                      : &nbsp <span> {{ $pasienDewasa->agama }}</span>
                    </div> 
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">Alamat</label>
                  <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{ $pasienDewasa->alamat }}</span>
                  </label>
                </div> 
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">No. Telp</label>
                  <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{ $pasienDewasa->telp }}</span>
                  </label>
                </div> 
              </div>

              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">Kelurahan</label>
                  <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{ $pasienDewasa->kelurahan }}</span>
                  </label>
                </div> 
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">Pekerjaan</label>
                  <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{ $pasienDewasa->pekerjaan }}</span>
                  </label>
                </div> 
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">Pendidikan</label>
                  <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{ $pasienDewasa->pendidikan }}</span>
                  </label>
                </div> 
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">Buku KIA</label>
                  <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{ $pasienDewasa->buku_kia }}</span>
                  </label>
                </div> 
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">Tanggal Buku KIA</label>
                  <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{ $pasienDewasa->tgl_buku_kia }}</span>
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
        <div class="card-header">
          <h3 class="card-title">Data Suami</h3>
        </div>
        <div class="card-body">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">Nama Suami</label>
                  <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{ $pasienDewasa->suamiPasienDewasa[0]->nama }}</span>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">Tanggal Lahir</label>
                  <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                    <div class="input-group">
                      : &nbsp <span> {{ $pasienDewasa->suamiPasienDewasa[0]->tanggal_lahir }}</span>
                    </div> 
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">Agama</label>
                  <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                    <div class="input-group">
                      : &nbsp <span> {{ $pasienDewasa->suamiPasienDewasa[0]->agama }}</span>
                    </div> 
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">Alamat</label>
                  <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{ $pasienDewasa->suamiPasienDewasa[0]->alamat }}</span>
                  </label>
                </div> 
              </div>

              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">No. Telp</label>
                  <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{ $pasienDewasa->suamiPasienDewasa[0]->telp }}</span>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">Kelurahan</label>
                  <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{ $pasienDewasa->suamiPasienDewasa[0]->kelurahan }}</span>
                  </label>
                </div> 
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">Pekerjaan</label>
                  <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{ $pasienDewasa->suamiPasienDewasa[0]->pekerjaan }}</span>
                  </label>
                </div> 
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">Pendidikan</label>
                  <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{ $pasienDewasa->suamiPasienDewasa[0]->pendidikan }}</span>
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
        <div class="card-header">
          <h3 class="card-title">Riwayat Kawin</h3>
        </div>
        <div class="card-body">
          <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
            <div class="row">
              <div class="col-sm-12">
                <div class="table-responsive">  
                  <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                    <thead>
                      <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 3%; text-align:center;">
                          Nikah Ke
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%; text-align:center;">
                          Lama Nikah
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%; text-align:center;">
                          Sebab Pisah
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%; text-align:center;">
                          Sebab Meninggal
                        </th>
                     </tr>
                   </thead>
                   <tbody>
                   @foreach($pasienDewasa->suamiPasienDewasa as $key => $value) 
                    <tr>
                      <td style="text-align: right;">{{$value->nikah_ke}}</td>
                      <td style="text-align: right;">{{$value->lama_nikah." Tahun"}}</td>
                      <td>{{$value->sebab_pisah}}</td>
                      <td>{{$value->sebab_meninggal}}</td>
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