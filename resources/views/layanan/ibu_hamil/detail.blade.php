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

<!-- modal tambah -->
<div class="modal fade" id="modalTambah" role="dialog" 
aria-labelledby="favoritesModalLabel">
<div class="modal-dialog" role="document">
  <div class="modal-content" style="border-radius: 17px;">
    <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;">
      <h4 style="color:white;">Cetak Surat Keterangan Sakit</h4>
      <button type="button" class="close" 
      data-dismiss="modal" 
      aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
      <FORM method="post" action="<?php echo URL::to('/klinikSuratKetSakit')?>">
        <input type="hidden" name="no_registrasi" value="{{$pasien[0]['no_regis']}}">
        <div class="form-group">
          <label>Perlu Istirahat selama :</label>
          <input type="text" class="form-control" id="txtlamaIstirahat" name="txtlamaIstirahat" placeholder="3 Hari" required>
          <label>Tanggal Awal:</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-calendar"></i></span>
            </div>
            <input type="text" class="form-control pull-right datepicker" id="txtTanggalAwal" name="txtTanggalAwal">
          </div>
          <label>Tanggal Akhir:</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-calendar"></i></span>
            </div>
            <input type="text" class="form-control pull-right datepicker" id="txtTanggalAkhir" name="txtTanggalAkhir">
          </div>
        </div>
        <div class="form-group">
          <input type="hidden" name="_token" value="{!!csrf_token()!!}">
          <button class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>&nbsp
          <button class="btn btn-danger">Cetak</button>
        </div>
      </FORM>
    </div>
  </div>
</div>
</div>
<!-- tutup modal tambah-->

<!-- modal tambah rujukan -->
<div class="modal fade" id="modalTambahRujukan" role="dialog" 
aria-labelledby="favoritesModalLabel">
<div class="modal-dialog" role="document">
  <div class="modal-content" style="border-radius: 17px;">
    <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;">
      <h4 style="color:white;">Cetak Surat Rujukan</h4>
      <button type="button" class="close" 
      data-dismiss="modal" 
      aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
      <FORM method="post" action="<?php echo URL::to('/klinikSuratRujukan')?>">
        <input type="hidden" name="no_registrasi" value="{{$pasien[0]['no_registrasi']}}">
        <div class="form-group">
          <label>Kepada :</label>
          <input type="text" class="form-control" id="txtKepada" name="txtKepada" placeholder="Kepada Yth." required>
          <label>Nama Rumah Sakit :</label>
          <input type="text" class="form-control" id="txtKepadaRs" name="txtKepadaRs" placeholder="Nama Rumah Sakit" required>
          <label>Anamnese :</label>
          <textarea class="form-control" id="txtAnamnese" name="txtAnamnese" placeholder="Anamnese" required></textarea>
          <label>Tindakan / Pemeriksaan :</label>
          <textarea class="form-control" id="txtTindakan" name="txtTindakan" placeholder="Tindakan" required></textarea>
          <label>Perkiraan Diagnosa :</label>
          <textarea class="form-control" id="txtDiagnosa" name="txtDiagnosa" placeholder="Diagnosa" required></textarea>
          
        </div>
        <div class="form-group">
          <input type="hidden" name="_token" value="{!!csrf_token()!!}">
          <button class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>&nbsp
          <button class="btn btn-danger">Cetak</button>
        </div>
      </FORM>
    </div>
  </div>
</div>
</div>
<!-- tutup modal tambah rujukan -->

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
      <h3>Histori Pelayanan Ibu Hamil</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/ibu_hamil')}}">Pelayanan Ibu Hamil</a></li>
        <li class="breadcrumb-item active">Histori Pelayanan Ibu Hamil</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <label class="control-label col-lg-6">
              <div class="form-group row">
                <label class="control-label col-sm-4" for="nama">Nomor Registrasi</label>
                <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                  <span> : &nbsp; {{$pasien[0]['no_regis']}}</span>
                </label>
              </div>
              <div class="form-group row">
                <label class="control-label col-sm-4" for="nama">Nama</label>
                <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                  <span> : &nbsp; {{$pasien[0]['nama']}}</span>
                </label>
              </div>
              <div class="form-group row">
                <label class="control-label col-sm-4" for="nama">Tanggal Lahir</label>
                <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                  <div class="input-group">
                    <span> : &nbsp; {{date('d-m-Y', strtotime($pasien[0]['tanggal_lahir']))}}</span>
                  </div> 
                </label>
              </div>
            </label>
            <label class="control-label col-lg-6">
              <div class="form-group row">
                <label class="control-label col-sm-2" for="nama">Agama</label>
                <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                  : &nbsp; {{$pasien[0]['agama']}}
                </label>
              </div>
              <div class="form-group row">
                <label class="control-label col-sm-2" for="nama">Alamat</label>
                <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                  <span> : &nbsp; {{$pasien[0]['alamat']}}</span>
                </label>
              </div>
              <div class="form-group row">
                <label class="control-label col-sm-2" for="nama">No. Telp</label>
                <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                  <span> : &nbsp; {{$pasien[0]['telp']}}</span>
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
              <a href="{{ url('/layanan-ibu-hamil-tambah-history-hamil?no_registrasi='.$pasien[0]['no_regis']) }}" class="btn btn-block btn-primary btn-sm" id="btnAdd"><i class="fa fa-plus-circle nav-icon"></i> Tambah Histori Kehamilan</a>
            </div>
            <div class="col-lg-3 col-4" title="Tambah">
              <a href="#" class="btn btn-block btn-primary btn-sm" id="btnAdd" data-toggle="modal" 
              data-target="#modalTambah"><i class="fa fa-plus-circle nav-icon"></i> Cetak Surat Keterangan Sakit</a>
            </div>
            <div class="col-lg-3 col-4" title="Tambah">
              <a href="#" class="btn btn-block btn-primary btn-sm" id="btnAddRujukan" data-toggle="modal" 
              data-target="#modalTambahRujukan"><i class="fa fa-plus-circle nav-icon"></i> Cetak Surat Rujukan</a>
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
                          No. Kartu Layanan
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" aria-label="Browser: activate to sort column ascending" style="width: 15%; text-align:center;">
                          Kehamilan Ke
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1"  aria-label="Browser: activate to sort column ascending" style="width: 15%; text-align:center;">
                          Aksi
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($hklinik as $key => $value) 
                      <tr>
                        <td style="text-align: center;">{{($key+1)}}</td>
                        <td style="text-align: center;">{{(date('d-m-Y', strtotime($value->tanggal)))}}</td>
                        <td style="text-align: center;">{{($value->g)}}</td>
                        <td style="text-align: center;">{{$value->kehamilan_ke}}</td>
                        <td>
                          <div class="form-group">
                            <div data-toggle="tooltips" title="Detail"  style="width:30%">
                              <a href="{{url('/layananIbuHamilDetail/detailKartu/'.$value->id)}}" class="btn btn-info"><i class="fa fa-history"></i></a>
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