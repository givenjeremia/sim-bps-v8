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

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}
@endsection
<!-- content -->
@section('content')

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
        <FORM method="post" action="<?php echo URL::to('/kb/importLampiran')?>" enctype="multipart/form-data"> 
          <div class="form-group">
            <input type="file" id="input-file-now" name="lampiranobservasi[]" multiple class="dropify" data-show-remove="true" data-allowed-file-extensions="jpg jpeg png" data-height="300"/>
          </div> 
          <div class="form-group" id="field_input"> 
            <input type="hidden" name="_token" value="{!!csrf_token()!!}"> 
            <input type="hidden" name="no_regis" id="no_regis" value="{{$layanankbArr[0]['no_registrasi']}}"></input>
            <input type="hidden" name="id_layanan" id="id_layanan" value="{{$layanankbArr[0]['jenis_layanan_kb']}}"></input>
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
      <h3>History Pelayanan KB</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"><a href="">Pelayanan KB</a></li>
        <li class="breadcrumb-item active">History Pelayanan KB</li>
      </ol>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="col-md-12">
              <div class="row">
                  <div class="col-md-6"> 
                    <div class="form-group row">
                      <label class="control-label col-sm-4" for="nama">Nomor Registrasi</label>
                      <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                        : &nbsp; <span> {{$layanankbArr[0]['no_regis_pasien_dewasa']}}</span>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-4" for="nama">Nama Pasien</label>
                      <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                        : &nbsp; <span> {{$layanankbArr[0]->pasienDewasa->nama}}</span>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-4" for="nama">Tanggal Lahir</label>
                      <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                        <div class="input-group">
                          : &nbsp; <span> {{date('d-m-Y', strtotime($layanankbArr[0]->pasienDewasa->tanggal_lahir))}}</span>
                        </div> 
                      </label>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="control-label col-sm-4" for="nama">Agama</label>
                      <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                        : &nbsp; <span> {{ucfirst($layanankbArr[0]->pasienDewasa->agama)}}</span>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-4" for="nama">Alamat</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span> {{$layanankbArr[0]->pasienDewasa->alamat}}</span>
                      </label>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-4" for="nama">No. Telp</label>
                      <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                        : &nbsp; <span> {{$layanankbArr[0]->pasienDewasa->telp}}</span>
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
        <div class="card-header"><h4>Lampiran</h4></div>
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
          <div class="row mb-2">
            <div class="col-sm-6">
              <h6><b>STATUS PESERTA KB</label>
            </div>
          </div>

          <div class="form-group"> 
            <label class="control-label">1. Baru</label> 
          </div> 
          <div class="form-group"> 
            <label class="control-label">2. {{ucfirst($layanankbArr[0]['status_peserta'])}}</label> 
            <label class="control-label col-lg-4" style="font-weight: normal;">
              : &nbsp; <span> {{date("d-m-Y", strtotime($layanankbArr[0]['tgl_status_peserta']))}}</span>
            </label>
          </div>
          <label class="control-label">3. Jumlah anak hidup :</label> 
          <div class="form-group"> 
            <label class="control-label col-sm-2" style="font-weight: normal;">- Laki</label> 
            <label class="control-label col-lg-3" style="font-weight: normal;">
              : &nbsp; <span> {{$layanankbArr[0]['jumlah_anak_laki']}}</span>
            </label>
          </div> 
          <div class="form-group"> 
            <label class="control-label col-sm-2" style="font-weight: normal;">- Perempuan</label> 
            <label class="control-label col-lg-3" style="font-weight: normal;">
              : &nbsp; <span> {{$layanankbArr[0]['jumlah_anak_perempuan']}}</span>
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
          <div class="row mb-2">
            <div class="col-sm-6">
              <label>PEMERIKSAAN</label>
            </div>
          </div>

          <div class="col-md-12">
            <div class="row">
                <div class="col-md-6"> 
                  <div class="form-group"> 
                    <label class="control-label col-sm-3"style>1. K.U.</label> 
                    <label class="control-label col-lg-8" style="font-weight: normal;">
                      : &nbsp; <span> {{ucfirst($layanankbArr[0]['ku'])}}</span>
                    </label>
                  </div> 
                  <div class="form-group"> 
                    <label class="control-label col-sm-3"style>2. Haid Terakhir</label> 
                    <label class="control-label col-lg-8" style="font-weight: normal;">
                      : &nbsp; <span> {{date("d-m-Y", strtotime($layanankbArr[0]['haid_terakhir']))}}</span>             
                    </label>
                  </div>  
                  <label class="control-label col-sm-6">5. Keadaan calon peserta saat ini :</label> 
                  <div class="form-group"> 
                    <label class="control-label col-sm-3" style="font-weight: normal;">- Sakit Kuning</label> 
                    <label class="control-label col-lg-6" style="font-weight: normal;">
                      : &nbsp; <span> {{ucfirst($layanankbArr[0]['sakit_kuning'])}}</span>
                    </label>
                  </div> 
                  <div class="form-group"> 
                    <label class="control-label col-sm-3"style="font-weight: normal;">- Perd. Per Vag.</label> 
                    <label class="control-label col-lg-6" style="font-weight: normal;">
                      : &nbsp; <span> {{ucfirst($layanankbArr[0]['perd_per_vag'])}}</span>
                    </label>
                  </div>                
                  <div class="form-group"> 
                    <label class="control-label col-sm-3"style="font-weight: normal;">- Tumor Payudara</label> 
                    <label class="control-label col-lg-6" style="font-weight: normal;">
                      : &nbsp; <span> {{ucfirst($layanankbArr[0]['tumor_payudara'])}}</span>
                    </label>
                  </div>
                  <label class="control-label col-sm-4">6. Keluhan :</label> 
                  <div class="form-group"> 
                    <label class="control-label col-sm-3" style="font-weight: normal;">- Fluoralbus</label> 
                    <label class="control-label col-lg-6" style="font-weight: normal;">
                      : &nbsp; <span> {{ucfirst($layanankbArr[0]['fluoralbus'])}}</span>
                    </label>
                  </div>
                  <div class="form-group"> 
                    <label class="control-label col-sm-3">8. Alat Kontrasepsi</label> 
                    <label class="control-label col-lg-6" style="font-weight: normal;">
                      : &nbsp; <span> {{$nama_layanan}}</span>
                    </label>
                  </div>
                  <div class="form-group"> 
                    <label class="control-label col-sm-3" style="font-weight: normal;">- Tanggal dilayani</label> 
                    <label class="control-label col-lg-6" style="font-weight: normal;">
                      : &nbsp; <span> {{date("d-m-Y", strtotime($layanankbArr[0]['tgl_dilayani']))}}</span>
                    </label>
                  </div>
                  <div class="form-group"> 
                    <label class="control-label col-sm-3" style="font-weight: normal;">- Tanggal dipesan kembali</label> 
                    <label class="control-label col-lg-6" style="font-weight: normal;">
                      : &nbsp; <span> {{date("d-m-Y", strtotime($layanankbArr[0]['tgl_datang_kembali']))}}</span>
                    </label>
                  </div>
                  <div class="form-group"> 
                    <label class="control-label col-sm-3" style="font-weight: normal;">- Tanggal dilepas</label> 
                    <label class="control-label col-lg-6" style="font-weight: normal;">
                      : &nbsp; <span> {{date("d-m-Y", strtotime($layanankbArr[0]['tgl_lepas']))}}</span>
                    </label>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group"> 
                    <label class="control-label col-sm-3"style>3. Tensi</label> 
                    <label class="control-label col-lg-8" style="font-weight: normal;">
                      : &nbsp; <span> {{$layanankbArr[0]['tensi']." mm hg"}}</span>
                    </label>
                  </div> 
                  <div class="form-group"> 
                    <label class="control-label col-sm-3"style>4. Berat Badan</label> 
                    <label class="control-label col-lg-8" style="font-weight: normal;">
                      : &nbsp; <span> {{$layanankbArr[0]['bb_kb']." Kg"}}</span>
                    </label>
                  </div>
                  <label class="control-label col-sm-8">7. Calon Aks. IUD dilakukan pemeriksaan :</label> 
                  <div class="form-group"> 
                    <label class="control-label col-sm-3" style="font-weight: normal;">- Tanda Radang</label> 
                    <label class="control-label col-lg-6" style="font-weight: normal;">
                      : &nbsp; <span> {{ucfirst($layanankbArr[0]['tanda_radang'])}}</span>
                    </label>
                  </div> 
                  <div class="form-group"> 
                    <label class="control-label col-sm-3"style="font-weight: normal;">- Tumor</label> 
                    <label class="control-label col-lg-6" style="font-weight: normal;">
                      : &nbsp; <span> {{ucfirst($layanankbArr[0]['tumor'])}}</span>
                    </label>
                  </div>                
                  <div class="form-group"> 
                    <label class="control-label col-sm-3"style="font-weight: normal;">- Posisi Rahim</label> 
                    <label class="control-label col-lg-6" style="font-weight: normal;">
                      : &nbsp; <span> {{ucfirst($layanankbArr[0]['posisi_rahim'])}}</span>
                    </label>
                  </div>
                  <div class="form-group"> 
                    <label class="control-label col-sm-3"style="font-weight: normal;">- Genetalia Luar/Dalam</label> 
                    <label class="control-label col-lg-6" style="font-weight: normal;">
                      : &nbsp; <span> {{ucfirst($layanankbArr[0]['genetalia_luar_dalam'])}}</span>
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
        <div class="card-body">
          <div class="row">
            <div class="col-lg-2 col-4" title="Tambah">
              <a href="{{ url('layanan-kb/tambah-history-kb/'.$layanankbArr[0]->id)  }}" class="btn btn-block btn-primary btn-sm" id="btnAdd"><i class="fa fa-plus-circle nav-icon"></i> Tambah History</a>
            </div>

            <div class="col-lg-3 col-4">
              <button type="button" class="btn btn-block btn-primary btn-sm" data-toggle="modal" 
              data-target="#modalImportObservasi"><i class="fa fa-upload nav-icon"></i> Import Data Lampiran</button>
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
              <div class="col-sm-12">
                <div class="table-responsive">  
                  <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                    <thead>
                      <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="2" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 3%; text-align:center;">
                          No
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="2" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%; text-align:center;">
                          Tanggal
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="2" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%; text-align:center;">
                          Tanggal Haid
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="2" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%; text-align:center;">
                          B.B.
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="2" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%; text-align:center;">
                          Tek. Darah
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="2" aria-label="Browser: activate to sort column ascending" style="width: 50%; text-align:center;">
                          Keluhan
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="2" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 30%; text-align:center;">
                         Tindakan
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="2" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 30%; text-align:center;">
                         Efek Samping
                        </th>
                      </tr>
                      <tr role="row">
                       <td>Efek Samping</td>
                       <td>Komplikasi</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(count($history_kb) > 0){  ?>
                        @foreach($history_kb as $key => $value) 
                          <tr>
                            <td style="text-align: center; font-weight: normal;">{{($key+1)}}</td>
                            <td style="font-weight: normal;">{{date("d-m-Y", strtotime($value->tgl))}}</td>
                            <td style="font-weight: normal;">{{date("d-m-Y", strtotime($value->tgl_haid))}}</td>
                            <td style="font-weight: normal;">{{$value->bb . ' Kg'}}</td>
                            <td style="font-weight: normal;">{{$value->tensi_atas.'/'.$value->tensi_bawah}}</td>
                            <td style="font-weight: normal;">{{$value->keluhan_efek_samping}}</td>
                            <td style="font-weight: normal;">{{$value->komplikasi}}</td>
                            <td style="font-weight: normal;">{{$value->tindakan}}</td>
                            <td style="font-weight: normal;">{{$value->tindakan_efek_samping}}</td>
                          </tr> 
                        @endforeach
                      <?php } ?>
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