@extends('layouts.adminlte')
<!-- plugin css -->
@section('plugin_css')

@endsection
<!-- css -->
@section('add_css')

@endsection
<!-- content -->
@section('content')

<?php $filter_date = (isset($_GET['filter_date']) && $_GET['filter_date'] != '') ? $_GET['filter_date'] : ""; ?>
<br>
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h3>Laporan Keuangan</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Laporan Keuangan</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6"> 
              <FORM method="post" action="<?php echo URL::to('/laporan_keuangan/print')?>">
              <div class="form-group">
                <label class="col-sm-2" style="font-weight: normal;" >Tanggal </label>
                <label class="col-sm-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right" id="tanggal" name="tanggal" autocomplete="off" value="{{$filter_date}}" required onchange="filterDate()">
                  </div>
                </label>
              </div>  
              <div class="form-group">
                <label class="col-sm-2" style="font-weight: normal;" ></label>
                <label class="col-sm-6">
                  <!-- <a href="<?php echo URL::to('/laporan_keuangan/print')?>" class="btn btn-primary"><i class="nav-icon fa fa-print"></i> Cetak Laporan</a> -->
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
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
            <div class="row">
              <div class="col-sm-12">
                <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                  <thead>
                    <tr role="row">
                      <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="text-align: center;">
                        No
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%; text-align: center;">
                        Jenis Layanan
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%; text-align: center;">
                        Total Harga
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 20%; text-align: center;">
                        Harga Obat
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 30%; text-align: center;">
                        Harga Layanan
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($laporan as $key => $value)
                      <tr>
                        <td style="text-align: center;">{{($key+1)}}</td>
                        <?php
                          $jenis = '';
                          if($value->jenis_layanan == 'KLINIK')
                            $jenis = 'KLINIK';
                          if($value->jenis_layanan == '0')
                            $jenis = 'KB';
                          if($value->jenis_layanan == '1')
                            $jenis = 'IMUNISASI PAKETAN';
                          if($value->jenis_layanan == '2')
                            $jenis = 'IMUNISASI SATUAN';
                          if($value->jenis_layanan == '3')
                            $jenis = 'IBU HAMIL';
                          if($value->jenis_layanan == '4')
                            $jenis = 'KUNJUNGAN ULANG IBU HAMIL';
                          if($value->jenis_layanan == '5')
                            $jenis = 'PERSALINAN';
                          if($value->jenis_layanan == '6')
                            $jenis = 'KUNJUNGAN ULANG NIFAS';
                        ?>
                        <td>
                        {{$jenis}}
                        </td>
                        <td style="text-align: right;">{{number_format($value->total_harga,0,",",".")}}</td>
                        <td style="text-align: right;">{{number_format($value->harga_obat,0,",",".")}}</td>
                        <td style="text-align: right;">{{number_format($value->harga_layanan,0,",",".")}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                      <tr>
                        <td style="text-align: right;" colspan="2"><label>Total :</label></td>
                        <td style="text-align: right;">{{"Rp. ".number_format($total_totharga,0,",",".").",-"}}</td>
                        <td style="text-align: right;">{{"Rp. ".number_format($total_obat,0,",",".").",-"}}</td>
                        <td style="text-align: right;">{{"Rp. ".number_format($total_keuntungan,0,",",".").",-"}}</td>
                      </tr>
                  </tfoot>
                </table>
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
<script type="text/javascript">
   $(function () {
    //Date range picker
    $('#tanggal').daterangepicker({
      locale: {
            format: 'YYYY-MM-DD'
        }
    });
  })

  function filterDate(){
    var tgl = document.getElementById("tanggal").value;
    var baseurl = window.location.href;

    if(baseurl.includes("filterDate") == false)
    {
      var url = window.location.href+"/filterDate?filter_date="+tgl;
    }
    else
    {
      var urldev = window.location.href.split("/filterDate?filter_date=");
      var url =  urldev[0]+"/filterDate?filter_date="+tgl;
    }

    window.location.href = url;
  }
</script>
@endsection