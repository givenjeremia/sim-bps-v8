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
          <span id="pesan_konfirmasi">Apakah anda yakin ingin menyimpan data history ?</span>
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
      <h3>Histori KSPR</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/ibu_hamil')}}">Pelayanan Ibu Hamil</a></li>
        <li class="breadcrumb-item active">Histori Penapisan</li>
      </ol>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">PENAPISAN</h3>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
            <div class="row">
              <div class="col-sm-12 col-md-6">
              </div>
            </div>
            <div class="form-group"></div>
            <div class="col-md-12">
              <div class="row">
                <FORM method="post" id="form_submit" action="<?php echo URL::to('/ibu_hamil/penapisan')?>">
                  <div class="form-group row"> 
                    <label class="control-label col-sm-3">Nama</label> 
                    <label class="control-label col-lg-8">
                      <input type="text" class="form-control" id="txtNama" name="txtNama" value="{{$nama_pasien}}" readonly required>
                    </label>
                  </div> 

                  <div class="form-group row"> 
                    <label class="control-label col-sm-3">Tanggal</label> 
                    <label class="control-label col-lg-8">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                        <?php if (!$isExist): ?>
                          <input type="text" class="form-control datepicker" id="txtTanggal" name="txtTanggal" required>
                        <?php else: ?>
                          <input type="text" class="form-control datepicker" id="txtTanggal" name="txtTanggal" value="{{$data[0]['tanggal']}}" disabled>
                        <?php endif ?>
                      </div>                
                    </label>
                  </div>

                  <div class="form-group row">
                    <label class="control-label col-sm-3" for="nama">Jam</label>
                    <label class="control-label col-sm-8" for="nama">
                      <div class="input-group clockpicker" data-placement="right" data-align="top" data-autoclose="true">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <?php if (!$isExist): ?>
                            <input type="text" class="form-control" id="txtJam" name="txtJam">
                        <?php else: ?>  
                          <input type="text" class="form-control" id="txtJam" name="txtJam" value="{{$data[0]['jam']}}" disabled>
                        <?php endif ?>
                      </div>
                    </label>
                  </div>

                  <table class="table table-bordered">
                    <tr>
                      <th>No.</th>
                      <th>Kriteria</th>
                      <th>Jawaban</th>
                    </tr>
                    
                    <?php foreach ($data as $key => $value): ?>
                      <tr>
                        <?php

                        ?>

                          <td><?php echo $key+1; ?></td>
                          <td><?php echo $value['kriteria']; ?></td>
                          <?php if (!$isExist): ?>
                            <td style="text-align: center;">
                              <select class="form-control" id="cboOpsi<?php echo $key; ?>" name="cboOpsi[]" oninput="this.className = 'form-control'">
                                <option value="1" selected>Ya</option>
                                <option value="0">Tidak</option>
                              </select>
                            </td>
                          <?php else: ?>
                              <td><?php echo $value['jawab']; ?></td>
                          <?php endif ?>
                      </tr>                   
                    <?php endforeach ?>                    
                  </table>

                  <?php if (!$isExist): ?>
                    <div>
                      <div style="float:right;">
                        <input type="hidden" id="id_layanan_ibu_hamil" name="id_layanan_ibu_hamil" value="{{$idibuhamil}}"></input>
                        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                        <button type="button" class="btn btn-primary" id="btnSubmit" data-toggle="modal" data-target="#modalSimpan">Simpan</button>
                      </div>
                    </div>
                  <?php endif ?>

                </FORM>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@section('add_js')
<script type="text/javascript" src="{{asset('clockpicker/dist/bootstrap-clockpicker.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.clockpicker').clockpicker({
      autoclose: true
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