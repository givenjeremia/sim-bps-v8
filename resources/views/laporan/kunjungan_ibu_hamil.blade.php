@extends('layouts.adminlte')
<!-- plugin css -->
@section('plugin_css')

@endsection
<!-- css -->
@section('add_css')

@endsection
<!-- content -->
@section('content')
<br>
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h3>Laporan Kunjungan Ibu Hamil</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Laporan Kunjungan Ibu Hamil</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6"> 
              <FORM method="post" action="<?php echo URL::to('/laporan_kunjungan_ibu_Hamil/print')?>">
              <div class="form-group">
                <label class="col-sm-2" style="font-weight: normal;" >Tanggal </label>
                <label class="col-sm-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right" id="tanggal" name="tanggal" autocomplete="off" required>
                  </div>
                </label>
              </div>  
              <div class="form-group">
                <label class="col-sm-2" style="font-weight: normal;" ></label>
                <label class="col-sm-6">
                <button class="btn btn-primary">Cetak Laporan</button>
                <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                </label>
              </div>
              </FORM>             
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
<script type="text/javascript">
   $(function () {
    //Date range picker
    $('#tanggal').daterangepicker()
  })
</script>
@endsection