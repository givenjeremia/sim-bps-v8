<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('logo-sima.png') }}">
  <title>SIM BPS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/ionsicons/ion.rangeSlider.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{Asset('adminlte/plugins/datatables/dataTables.bootstrap4.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/iCheck/flat/_all.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/morris/morris.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/select2/select2.min.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/datepicker/datepicker3.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/daterangepicker/daterangepicker-bs3.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <!-- Please-wait -->
  <link rel="stylesheet" href="{{asset('please-wait/build/please-wait.css')}}">

  <script src="{{asset('chartjs/Chart.min.js')}}"></script>
  
  @yield('plugin_css')
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="{{asset('css/googlefont.css')}}">
  <style type="text/css">
    @yield('add_css')

    .dropdown-menu a{
      color: black !important;
    }

    .spinner {
      margin: 100px auto;
      width: 50px;
      height: 40px;
      text-align: center;
      font-size: 10px;
    }

    .spinner > div {
      background-color: #333;
      height: 100%;
      width: 6px;
      display: inline-block;

      -webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;
      animation: sk-stretchdelay 1.2s infinite ease-in-out;
    }

    .spinner .rect1 {
      background-color:red;
    }

    .spinner .rect2 {
      background-color:red; 
      -webkit-animation-delay: -1.1s;
      animation-delay: -1.1s;
    }

    .spinner .rect3 {
      background-color:red; 
      -webkit-animation-delay: -1.0s;
      animation-delay: -1.0s;
    }

    .spinner .rect4 {
      background-color:red; 
      -webkit-animation-delay: -0.9s;
      animation-delay: -0.9s;
    }

    .spinner .rect5 {
      background-color:red; 
      -webkit-animation-delay: -0.8s;
      animation-delay: -0.8s;
    }

    @-webkit-keyframes sk-stretchdelay {
      0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  
      20% { -webkit-transform: scaleY(1.0) }
    }

    @keyframes sk-stretchdelay {
      0%, 40%, 100% { 
        transform: scaleY(0.4);
        -webkit-transform: scaleY(0.4);
      }  20% { 
        transform: scaleY(1.0);
        -webkit-transform: scaleY(1.0);
      }
    }

    #bodyHidden
    {
     display:none;   
   }

 </style>
</head>
<body id="bodyHidden" class="hold-transition sidebar-mini hidden">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand border-bottom navbar-dark bg-danger">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Notif -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-bell-o"></i>
            <p><span class="badge badge-warning navbar-badge" id="notif_atas_total">0</span></p>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <p><span class="dropdown-item dropdown-header" id="notif_atas_total_dalam">0 Notifications</span></p>
            <div class="dropdown-divider"></div>
            <a href="{{url('/p_imunisasi_terlewati')}}" class="dropdown-item">
              <p><i class="fa fa-eyedropper mr-2"></i><span id="notif_atas_terlewati" style="color:red;">0</span> imunisasi terlewati</p>
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{url('/p_imunisasi_hari_ini')}}" class="dropdown-item">
              <p><i class="fa fa-eyedropper mr-2"></i><span id="notif_atas_hari_ini" style="color:red;">0</span> imunisasi hari ini</p>
            <div class="dropdown-divider"></div>
            <a href="{{url('/p_imunisasi_akan_datang')}}" class="dropdown-item">
              <p><i class="fa fa-eyedropper mr-2"></i><span id="notif_atas_akan_datang" style="color:red;">0</span> imunisasi akan datang</p>
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{url('/p_obat_expired')}}" class="dropdown-item">
              <p><i class="fa fa-plus-square mr-2"></i><span id="notif_atas_expired" style="color:red;">0</span> obat akan expired</p>
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{url('/p_obat_stok')}}" class="dropdown-item">
              <p><i class="fa fa-plus-square mr-2"></i><span id="notif_atas_stok" style="color:red;">0</span> stok obat menipis</p>
            </a>
          </div>
        </li>
        <!-- Messages Dropdown Menu Logout -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-user"></i> {{ Auth::user()->name }}
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a class="dropdown-item" href="{{ url('/profile') }}" >
              <p style="color:black;"><i class="fa fa-user"></i> Profile</p>
            </a>
            
            <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              <p style="color:black;"><i class="fa fa-power-off"></i>  {{ __('Logout') }}</p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
      <img src="{{ asset('logo-sima.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
      <span class="brand-text font-weight-light">SIM BPS</span>
    </a>

    @include('layouts.sidebar')
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="page-wrapper">

      @yield('content')
    </div>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2018 SIM BPS by TeamLabs
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0
      </div>
    </footer>

  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{asset('jquery/jquery-ui.min.js')}}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- Morris.js charts -->
  <script src="{{asset('raphael/raphael-min.js')}}"></script>
  <script src="{{asset('adminlte/plugins/morris/morris.min.js')}}"></script>
  <!-- Sparkline -->
  <script src="{{asset('adminlte/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
  <!-- jvectormap -->
  <script src="{{asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
  <script src="{{asset('adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{asset('adminlte/plugins/knob/jquery.knob.js')}}"></script>
  <!-- daterangepicker -->
  <script src="{{asset('moment/moment.min.js')}}"></script>
  <script src="{{asset('adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
  <!-- datepicker -->
  <script src="{{asset('adminlte/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
  <!-- iCheck -->
  <script src="{{asset('adminlte/plugins/iCheck/icheck.min.js')}}"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="{{asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
  <!-- Slimscroll -->
  <script src="{{asset('adminlte/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{asset('adminlte/plugins/fastclick/fastclick.js')}}"></script>
  <!-- Select2 -->
  <script src="{{asset('adminlte/plugins/select2/select2.full.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('adminlte/dist/js/adminlte.js')}}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <!-- <script src="{{asset('adminlte/dist/js/pages/dashboard.js')}}"></script> -->
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('adminlte/dist/js/demo.js')}}"></script>
  <!-- DataTables -->
  <script type="text/javascript" src="{{Asset('adminlte/plugins/datatables/jquery.dataTables.js')}}"></script>
  <script type="text/javascript" src="{{Asset('adminlte/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
  <!-- Please Wait -->
  <script src="{{asset('please-wait/build/please-wait.min.js')}}"></script>
  <!-- page script -->
  <script>
    $(function () {
      $("#example1").DataTable();
    });
  </script>
  <script type="text/javascript">
    window.loading_screen = window.pleaseWait({
      logo: '{{ asset("logo-sima-small.png") }}',
      backgroundColor: 'white',
      loadingHtml: '<div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div'
    });
  </script>

  <script>
    $(document).ready(function(){
      window.loading_screen.finish();

      var url = <?php echo "'".URL::to('/imunisasi_hitung_pengingat')."'"; ?>;
      $.ajax({
        type:"GET",
        url:url,
        data:{},
        success:function(data){
            var resp = $.parseJSON(data);
            document.getElementById("notif_terlewati").innerHTML = resp.terlewati.length;
            document.getElementById("notif_hari_ini").innerHTML = resp.hari_ini.length;
            document.getElementById("notif_akan_datang").innerHTML = resp.akan_datang.length;

            document.getElementById("notif_atas_terlewati").innerHTML = resp.terlewati.length;
            document.getElementById("notif_atas_hari_ini").innerHTML = resp.hari_ini.length;
            document.getElementById("notif_atas_akan_datang").innerHTML = resp.akan_datang.length;
          }
      });

      var url = <?php echo "'".URL::to('/obat_hitung_pengingat')."'"; ?>;
      $.ajax({
        type:"GET",
        url:url,
        data:{},
        success:function(data){
            var resp = $.parseJSON(data);
            document.getElementById("notif_expired").innerHTML = resp.expired.length;
            document.getElementById("notif_stok").innerHTML = resp.stok.length;

            document.getElementById("notif_atas_expired").innerHTML = resp.expired.length;
            document.getElementById("notif_atas_stok").innerHTML = resp.stok.length;
          }
      });

      var url = <?php echo "'".URL::to('/hitung_total_notif')."'"; ?>;
      $.ajax({
        type:"GET",
        url:url,
        data:{},
        success:function(data){
            var resp = $.parseJSON(data);
            document.getElementById("notif_atas_total_dalam").innerHTML = (resp)+" Notifikasi";
            if(parseInt(resp) > 0){
              document.getElementById("notif_atas_total").innerHTML =(resp);
              document.getElementById("notif_atas_total").style.display = "block";
            }
            else{
              document.getElementById("notif_atas_total").style.display = "none";
            }
          }
      });

      $('[data-toggle="tooltips"]').tooltip(); 
      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
      });
      $('.select2').select2();
      //Date picker
      $('.datepicker').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy'
      });
      $(document).ready(function() {
        $('#bodyHidden').show();
      });
      $(".alert").fadeTo(2000, 2000).slideUp(2000, function(){
        $(".alert").slideUp(2000);
      });
      
    });
  </script>
  @yield('add_js')

</body>
</html>
