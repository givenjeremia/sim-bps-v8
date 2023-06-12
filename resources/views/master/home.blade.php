@extends('layouts.adminlte')

@section('content')

<BR>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="callout callout-danger callout-dismissible" style="background-color:#d72a3e; color:white;">
              <button type="button" id="click_callout" class="close" data-dismiss="callout" aria-hidden="true">&times;</button>
              <h5>Peringatan</h5>
              <p id="im_lewat"></p>
              <p id="im_hari_ini"></p>
              <p id="im_akan_datang"></p>
              <p id="ob_ex"></p>
              <p id="ob_stok"></p>
            </div>
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Hai {{Auth::user()->username}}, <BR>
                    Selamat datang di sistem informasi ini.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <!-- DONUT CHART -->
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">Perbandingan Pendapatan per Layanan (7 Hari Terakhir)</h3>
        </div>
        <div class="card-body">
          <div class="box-body chart-responsive">
              <canvas id="myChart" height="200"></canvas>
          </div>                    
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col (LEFT) -->
    <div class="col-md-6">
      <!-- DONUT CHART -->
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">Total Pendapatan BPS 7 hari terakhir</h3>
        </div>
        <div class="card-body">
          <div class="box-body chart-responsive">
            <canvas id="myChart2" height="200"></canvas>
          </div>  
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col (RIGHT) -->
  </div>
  <!-- /.row -->
</div><!-- /.container-fluid -->
  @section('add_js')
  <script>
    $(document).ready(function(){
      $(".callout").fadeTo(4000, 4000).slideUp(4000, function(){
        $(".callout").slideUp(4000);
      });
      $( "#click_callout" ).click(function() {
        $(".callout").fadeTo(600, 600).slideUp(600, function(){
          $(".callout").slideUp(600);
        });
      });

      var url = <?php echo "'".URL::to('/hitung_notif')."'"; ?>;
      $.ajax({
        type:"GET",
        url:url,
        data:{},
        success:function(data){
            var resp = $.parseJSON(data);
            document.getElementById("im_lewat").innerHTML = resp.terlewati.length+' Imunisasi terlewati';
            document.getElementById("im_hari_ini").innerHTML = resp.hari_ini.length+' Imunisasi hari ini';
            document.getElementById("im_akan_datang").innerHTML = resp.akan_datang.length+' Imunisasi akan datang';
            document.getElementById("ob_ex").innerHTML = resp.expired.length+' Obat akan expired';
            document.getElementById("ob_stok").innerHTML = resp.stok.length+' Stok menipis';
          }
      });

      var url = <?php echo "'".URL::to('/chart')."'"; ?>;
      $.ajax({
        type:"GET",
        url:url,
        data:{},
        success:function(data){
            var resp = $.parseJSON(data);
            console.log(resp);
              var ctx2 = document.getElementById("myChart2");
              var myChart2 = new Chart(ctx2, {
                type: 'line',
                data: {
                  labels:[resp.hari1[0].tanggal,resp.hari2[0].tanggal,resp.hari3[0].tanggal,resp.hari4[0].tanggal,resp.hari5[0].tanggal,resp.hari6[0].tanggal,resp.hari7[0].tanggal],
                  datasets: [{
                    label: 'Total Pendapatan (dalam ribuan)',
                    data: [resp.hari1[0].total,resp.hari2[0].total,resp.hari3[0].total,resp.hari4[0].total,resp.hari5[0].total,resp.hari6[0].total,resp.hari7[0].total],
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                  }]
                },
                options: {
                  // title: {
                  //     display: true,
                  //     fontSize: 15,
                  //     text: 'Total Pendapatan BPS 7 hari terakhir'
                  // }
                }
              });
          }
      });

      var url = <?php echo "'".URL::to('/donut')."'"; ?>;
      $.ajax({
        type:"GET",
        url:url,
        data:{},
        success:function(data){
            var resp = $.parseJSON(data);
            
            var i_paketan;
            parseFloat(resp.imunisasi_paketan[0].total)>0?i_paketan=parseFloat(resp.imunisasi_paketan[0].total):i_paketan = 0;
            var i_satuan;
            parseFloat(resp.imunisasi_satuan[0].total)>0?i_satuan=parseFloat(resp.imunisasi_satuan[0].total):i_satuan = 0;
            var par_ibu_hamil;
            parseFloat(resp.ibu_hamil[0].total)>0?par_ibu_hamil=parseFloat(resp.ibu_hamil[0].total):par_ibu_hamil=0;
            var par_klinik;
            parseFloat(resp.klinik[0].total)>0?par_klinik=parseFloat(resp.klinik[0].total):par_klinik=0;
            var par_kb;
            parseFloat(resp.kb[0].total)>0?par_kb=parseFloat(resp.kb[0].total):par_kb=0;
            var par_imunisasi_total = i_paketan+i_satuan;

            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx,
            {
                "type":"doughnut",
                "data":
                {
                    labels:["Ibu Hamil","Klinik Umum","KB", "Imunisasi"],
                    datasets:[{
                        "label":"My First Dataset",
                        "data":[par_ibu_hamil,par_klinik,par_kb, par_imunisasi_total],
                        "backgroundColor":["rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86)"]
                    }]
                },
                "options":{
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                          var dataLabel = data.labels[tooltipItem.index];
                          var value = ':Rp.' + data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index].toLocaleString();

                          if (Chart.helpers.isArray(dataLabel)) {
                            dataLabel = dataLabel.slice();
                            dataLabel[0] += value;
                          } else {
                            dataLabel += value;
                          }
                          return dataLabel;
                        }
                      }
                    }
                },


            });

          }
      });

    });
  </script>
  <script>
    

   

    // new Chart(document.getElementById("chartjs-0"),{"type":"line","data":{"labels":["January","February","March","April","May","June","July"],"datasets":[{"label":"My First Dataset","data":[65,59,80,81,56,55,40],"fill":false,"borderColor":"rgb(75, 192, 192)","lineTension":0.1}]},"options":{}});
</script>
  @endsection

@endsection
