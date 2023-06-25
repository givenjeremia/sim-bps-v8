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


<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h3>Detail History Nifas</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/ibu_hamil')}}">Pelayanan Ibu Hamil</a></li>
        <li class="breadcrumb-item active">Detail History Nifas</li>
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
          <h3 class="card-title p-3">Nifas</h3>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <label class="control-label col-lg-6">
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Tanggal</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{date('d-m-Y', strtotime($nifas[0]->tanggal))}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Keluhan</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$nifas[0]->keluhan}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">TD</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$nifas[0]->td}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Nadi</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$nifas[0]->nadi}}
                </label> 
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">RR</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$nifas[0]->rr}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Suhu</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$nifas[0]->suhu}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Payudara</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$nifas[0]->payudara}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">TFU</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$nifas[0]->tfu}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Kontraksi Rahim</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$nifas[0]->kontraksi_rahim}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Pendarahan</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$nifas[0]->pendarahan}}
                </label>
              </div>
            </label>
            <label class="control-label col-lg-6">
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Lochia</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$nifas[0]->lochia}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Oed</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$nifas[0]->oed}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Bab</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$nifas[0]->bab}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Bak</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$nifas[0]->bak}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Asi Saja</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$nifas[0]->asi_saja}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Analisa Masalah</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$nifas[0]->analisa_masalah}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Terapi Tindakan</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$nifas[0]->terapi_tindakan}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Penyuluhan</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$nifas[0]->penyuluhan}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Rujuk Ke</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$nifas[0]->rujuk_ke}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4" for="nama">Pemeriksa</label>
                <label class="control-label col-lg-6" for="nama" style="font-weight: normal;">
                :  {{$nifas[0]->pemeriksa_paraf}}
                </label>
              </div>
            </label>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">Obat</h3>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
              <thead>
                <tr role="row" style="text-align: center;">
                  <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 5%;">
                    No
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%;">
                    Nama
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%;">
                    Qty (PCS/BUTIR)
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%;">
                    harga (PCS/BUTIR)
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%;">
                    Total
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach($obatnya as $key => $value) 
                <tr>
                  <td style="text-align: center;">{{($key+1)}}</td>
                  <td>{{($value->nama)}}</td>
                  <td style="text-align: center;">{{$value->qty}}</td>
                  <td style="text-align: right;">{{number_format($value->harga_obat)}} </td>
                  <td style="text-align: right;">{{number_format($value->total_harga_obat)}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
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