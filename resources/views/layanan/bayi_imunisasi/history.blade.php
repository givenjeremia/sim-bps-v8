@extends('layouts.adminlte')
<!-- plugin css -->
@section('plugin_css')
<link rel="stylesheet" href="{{asset('dropify/dist/css/dropify.min.css')}}">
@endsection
<!-- css -->
@section('add_css')
.gallery img {
    width: 20%;
    height: auto;
    border-radius: 5px;
    cursor: pointer;
    transition: .3s;
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
        <FORM method="post" action="<?php echo URL::to('/imunisasi/importLampiran')?>" enctype="multipart/form-data"> 
          <div class="form-group">
            <input type="file" id="input-file-now" name="lampiranobservasi[]" multiple class="dropify" data-show-remove="true" data-allowed-file-extensions="jpg jpeg png" data-height="300"/>
          </div> 
          <div class="form-group" id="field_input"> 
            <input type="hidden" name="_token" value="{!!csrf_token()!!}"> 
            <input type="hidden" name="id_bayi" id="id_bayi" value="{{$bayiArr[0]['id']}}"></input>
            <input type="hidden" name="no_regis" id="no_regis" value="{{$bayiArr[0]['no_registrasi']}}"></input>
            <input type="hidden" name="id_layanan" id="id_layanan" value="{{$layanan_hist[0]['id']}}"></input>
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
  <div class="row mb-2">
    <div class="col-sm-6">
      <h3>History Pelayanan Imunusiasi</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/bayi_imunisasi')}}">Pelayanan Imunisasi</a></li>
        <li class="breadcrumb-item active">History Pelayanan Imunusiasi</li>
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
                <div class="form-group">
                  <label class="control-label col-sm-4" for="nama">Nama Pasien</label>
                  <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{$bayiArr[0]['nama']}}</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-4" for="nama">Tanggal Lahir</label>
                  <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                    <div class="input-group">
                      : &nbsp <span> {{date('d-m-Y', strtotime($bayiArr[0]['tanggal_lahir']))}}</span>
                    </div> 
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-4" for="nama">B.B.L.</label>
                  <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                    <div class="input-group">
                      : &nbsp <span> {{$bayiArr[0]['bbl']}} KG</span>
                    </div> 
                  </label>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-4" for="nama">Cara Persalinan</label>
                  <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                    : &nbsp <span><?php if($bayiArr[0]['cara_persalinan']=='1'){ echo 'Caesar'; }else echo 'Normal'; ?></span>
                  </label>
                </div>  
              </div>

              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">Nama Ayah</label>
                  <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{$bayiArr[0]['nama_ayah']}}</span>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">Nama Ibu</label>
                  <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{$bayiArr[0]['nama_ibu']}}</span>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">Telepon</label>
                  <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{$bayiArr[0]['telp']}}</span>
                  </label>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-4" for="nama">Alamat</label>
                  <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                    : &nbsp <span> {{$bayiArr[0]['alamat']}}</span>
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
              <a href="<?php echo URL::to('/layanan-imunisasi/'.$bayiArr[0]['id'].'/edit')?>" class="btn btn-block btn-primary btn-sm" id="btnAdd"><i class="fa fa-plus-circle nav-icon"></i> Tambah History</a>
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
                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 3%; text-align:center;">
                          No
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%; text-align:center;">
                          Tanggal
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%; text-align:center;">
                          Umur
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%; text-align:center;">
                          B. B.
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 30%; text-align:center;">
                          Keluhan
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 20%; text-align:center;">
                         Pengobatan/Nasehat
                       </th>
                     </tr>
                    </thead>
                    <tbody>
                      @php
                          dd($history);
                      @endphp
                    @foreach($history as $key => $value) 
                    <tr>
                      <td style="text-align: center;">{{($key+1)}}</td>
                      <td style="text-align:center;">{{date("d-m-Y", strtotime($value['tanggal']))}}</td>
                      <td style="text-align:center;">{{$value['umur']}}</td>
                      <td style="text-align:center;">{{$value['bb'] . ' Kg'}}</td>
                      <?php if($value['keluhan'] != null) { ?>
                        <td>{{$value['keluhan']}}</td>
                      <?php } else{ ?>
                        <td>-</td>
                      <?php } ?>
                      <?php if($value['nasehat'] != null) { ?>
                        <td>{{$value['pengobatan'].' - '.$value['nasehat']}}</td>
                      <?php } else{ ?>
                        <td>{{$value['pengobatan']}}</td>
                      <?php } ?>
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

                $query = DB::select("SELECT * FROM lampiran WHERE no_registrasi_pasien="."'".$bayiArr[0]['no_registrasi']."'");

                if(count($query)>0)
                {
                  foreach ($query as $key => $value) {
                    $imageThumbURL =  URL::to($value->url_gambar);
                    $imageURL = URL::to($value->url_gambar);
                    ?>
                    <a href="<?php echo $imageURL; ?>" data-fancybox="group" data-caption="<?php echo ""; ?>" >
                      <img width="20%" height="200px" style="margin-left:2%;" src="<?php echo $imageThumbURL; ?>"/>
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

</div>
@endsection
<!-- plugin js -->
@section('plugin_js')

@endsection

<!-- add js -->
@section('add_js')
<script src="{{asset('dropify/dist/js/dropify.min.js')}}"></script>
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