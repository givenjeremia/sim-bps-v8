@extends('layouts.adminlte')
<!-- plugin css -->
@section('plugin_css')
<link rel="stylesheet" href="{{asset('dropify/dist/css/dropify.min.css')}}">
@endsection
<!-- css -->
@section('add_css')
  /* Mark input boxes that gets an error on validation: */
  input.invalid {
    background-color: #ffdddd;
  }
@endsection
<!-- content -->
@section('content')
<!-- modal simpan -->
<div class="modal fade" id="modalSimpan" role="dialog" aria-labelledby="favoritesModalLabel"> 
  <div class="modal-dialog" role="document"> 
    <div class="modal-content" style="border-radius: 17px;"> 
      <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;"> 
        <h4 style="color:white;">Simpan Data</h4> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
          <span aria-hidden="true">&times;</span>
        </button> 
      </div> 
      <div class="modal-body"> 
        <div class="form-group"> 
          <span id="pesan_error" style="display: none;"></span>
          <span id="pesan_konfirmasi" style="display: none;">Apakah anda yakin ?</span>
        </div> 
        <div class="form-group"> 
          <button class="btn btn-default" data-dismiss="modal" aria-label="Close">Tutup</button> 
          <button class="btn btn-primary" style="display: none;" id="btn_simpan_history" onclick="submit()">Simpan</button> 
        </div>
      </div> 
    </div> 
  </div> 
</div>
<!-- tutup modal simpan -->

<br>
<div class="container-fluid">

  <!-- NOTIFIKASI -->
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
  <!-- END NOTIFIKASI -->

  <div class="row mb-2">
    <div class="col-sm-6">
      <h3>Profile Karyawan</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Profile Karyawan</li>
      </ol>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle"
                 src="{{ asset('ic_img/avatar.png') }}"
                 alt="User profile picture">
          </div>

          <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

          <div id="form_profile">
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>NIK</b> <a class="float-right">{{Auth::user()->nik}}</a>
              </li>
              <li class="list-group-item">
                <b>Username</b> <a class="float-right">{{Auth::user()->username}}</a>
              </li>
              <li class="list-group-item">
                <b>Alamat</b> <a class="float-right">{{Auth::user()->alamat}}</a>
              </li>
              <li class="list-group-item">
                <b>No. Telepon</b> <a class="float-right">{{Auth::user()->telp}}</a>
              </li>
              <li class="list-group-item">
                <b>Tanggal Lahir</b> <a class="float-right">{{Auth::user()->tanggal_lahir}}</a>
              </li>
              <li class="list-group-item">
                <b>Tanggal Gabung</b> <a class="float-right">{{Auth::user()->tanggal_gabung}}</a>
              </li>
            </ul>            
          </div>

          <div id="form_change_pass" style="display: none;">
            <form id="change_pass" class="form-horizontal" method="post" action="<?php echo URL::to('/gantiPass')?>">
            
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label" id="lblPassLama">Password Lama</label>

                <div class="col-sm-10">
                  <input type="password" class="form-control" id="inputPass" name="inputPass" placeholder="Password" oninput="this.className = 'form-control'; document.getElementById('error-old-password').innerHTML = '';" required>
                  <span id="error-old-password" style="color: red;"></span>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label" id="lblPassBaru">Password Baru</label>

                <div class="col-sm-10">
                  <input type="password" class="form-control" id="inputNewPass" name="inputNewPass" placeholder="Password Baru" oninput="this.className = 'form-control'; document.getElementById('error-new-password').innerHTML = '';" required>
                  <span id="error-new-password" style="color: red;"></span>
                </div>
              </div>
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label" id="lblKonfirm">Konfirmasi Password Baru</label>

                <div class="col-sm-10">
                  <input type="password" class="form-control" id="inputConfirmPass" name="inputConfirmPass" placeholder="Konfirmasi Password Baru" oninput="this.className = 'form-control'; document.getElementById('error-confirm-new-password').innerHTML = '';" required>
                  <span id="error-confirm-new-password" style="color: red;"></span>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="checkbox">
                    <label id="lblTampil">
                      <input type="checkbox" id="tampilPass" onclick="checkBoxChange()" > Tampilkan Password
                    </label>
                  </div>
                </div>
              </div>
              
              <input type="hidden" name="_token" value="{!!csrf_token()!!}">
            </form>
          </div>

          <button class="btn btn-primary btn-block" id="btnchange" onclick="changeUI()"><b>Ubah Password</b></button>
          <button class="btn btn-primary btn-block" id="btnSubmit" style="display: none;" onclick="submitForm()"> Submit</button>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
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
    function checkBoxChange()
    {
      if(document.getElementById('tampilPass').checked) {
        var obj = document.getElementById('inputPass');
        var obj2 = document.getElementById('inputConfirmPass');
        var obj3 = document.getElementById('inputNewPass');
        obj.type = "text";
        obj2.type = "text";
        obj3.type = "text";
      } else {
        var obj = document.getElementById('inputPass');
        var obj2 = document.getElementById('inputConfirmPass');
        var obj3 = document.getElementById('inputNewPass');
        obj.type = "password";
        obj2.type = "password";
        obj3.type = "password";
      }
    }

    function changeUI()
    {
      document.getElementById('form_profile').style.display = "none";
      document.getElementById('form_change_pass').style.display = "block";
      document.getElementById('btnchange').style.display = "none";
      document.getElementById('btnSubmit').style.display = "block";
    }

    function submitForm()
    {
      var oldpass = document.getElementById("inputPass").value;
      var newpass = document.getElementById("inputNewPass").value;
      var confirmnewpass = document.getElementById("inputConfirmPass").value;

      var url = <?php echo "'".URL::to('/cekPassword')."'"; ?>;
      $.ajax({
        type:"GET",
        url:url,
        data:{oldpass:oldpass},
        success:function(data){
            var resp = $.parseJSON(data);
            console.log(resp);
            if(resp == true){
              if(newpass.length < 6){
                document.getElementById("inputNewPass").className += " invalid";
                document.getElementById("error-old-password").innerHTML = "";
                document.getElementById("error-new-password").innerHTML = "Password harus mengandung minimal 6 karakter!";
                document.getElementById("error-confirm-new-password").innerHTML = "";
              }
              else{
                if(newpass != confirmnewpass){
                  document.getElementById("inputConfirmPass").className += " invalid";
                  document.getElementById("error-old-password").innerHTML = "";
                  document.getElementById("error-new-password").innerHTML = "";
                  document.getElementById("error-confirm-new-password").innerHTML = "Confirm password tidak sama dengan password!";
                }
                else{
                  document.getElementById("pesan_konfirmasi").style.display = "block";
                  document.getElementById("pesan_error").style.display = "none";
                  document.getElementById("btn_simpan_history").style.display = "inline";
                  $("#modalSimpan").modal();    
                }
              }

              
            }
            else{
              document.getElementById("inputPass").className += " invalid";
              document.getElementById("error-old-password").innerHTML = "Password lama salah!";
              document.getElementById("error-new-password").innerHTML = "";
              document.getElementById("error-confirm-new-password").innerHTML = "";
              // $("#modalSimpan").modal();
              // document.getElementById("pesan_konfirmasi").style.display = "none";
              // document.getElementById("btn_simpan_history").style.display = "none";
              // document.getElementById("pesan_error").style.display = "block";
              // document.getElementById("pesan_error").innerHTML = 'Stok obat untuk layanan ini tidak mencukupi. Harap melakukan restock terlebih dahulu';
            }
          }
      });
    }

    function submit(){
      document.getElementById("change_pass").submit();
    }
  </script>
  @endsection