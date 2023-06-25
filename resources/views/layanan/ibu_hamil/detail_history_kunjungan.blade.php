@extends('layouts.adminlte')
<!-- plugin css -->
@section('plugin_css')
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
      <h3>Detail History Kunjungan</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/ibu_hamil')}}">Pelayanan Ibu Hamil</a></li>
        <li class="breadcrumb-item active">Detail History Kunjungan</li>
      </ol>
    </div>
  </div>
  <div class="row">

  </div>


  <div class="row">
    <div class="col-12">
      <!-- Custom Tabs -->
      <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">Kunjungan</h3>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <label class="control-label col-lg-6">
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Tanggal</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{date('d-m-Y',strtotime($kunjungan[0]->tanggal))}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Keluhan</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$kunjungan[0]->keluhan}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Buku Kia</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$kunjungan[0]->bawa_buku_kia}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">BB</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$kunjungan[0]->bb}}
                </label> 
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">TD</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$kunjungan[0]->td}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Nadi</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$kunjungan[0]->nadi}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">RR</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$kunjungan[0]->rr}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Abdomen</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$kunjungan[0]->abdomen}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Oedem Tungkai</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$kunjungan[0]->oedem_tungkai}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">TFU</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$kunjungan[0]->tfu}}
                </label>
              </div>
            </label>
            <label class="control-label col-lg-6">

              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">LT Janin</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$kunjungan[0]->lt_janin}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">DJJ</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$kunjungan[0]->djj}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Gerak Janin</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$kunjungan[0]->gerak_janin}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">UK</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$kunjungan[0]->uk}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Lab</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$kunjungan[0]->lab}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Skor</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$kunjungan[0]->skor}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Analisa Masalah</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$kunjungan[0]->analisa_masalah}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Penyuluhan</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$kunjungan[0]->penyuluhan}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Terapi TT</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$kunjungan[0]->terapi_tt}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Rujuk Ke</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$kunjungan[0]->rujuk_ke}}
                </label>
              </div>
            </label>
          </div>
        </div>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <!-- END CUSTOM TABS -->
</div>
@endsection
<!-- plugin js -->
@section('plugin_js')

@endsection

<!-- add js -->
@section('add_js')
@endsection