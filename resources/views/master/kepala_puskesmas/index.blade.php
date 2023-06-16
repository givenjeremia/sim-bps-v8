@extends('layouts.adminlte')
<!-- plugin css -->
@section('plugin_css')

@endsection
<!-- css -->
@section('add_css')

@endsection
<!-- content -->
@section('content')
<!-- modal add -->
<div class="modal fade" id="modalAdd" role="dialog" aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 17px;">
      <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;">
        <h4 style="color:white;">Tambah Kepala Puskesmas</h4>
        <button type="button" class="close" 
        data-dismiss="modal" 
        aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <FORM method="post" action="{{ route('kepala-puskesmas.store') }}">
          <div class="form-group">
            <label>Nama:</label>
            <input type="text" class="form-control" id="txtNama" name="txtNama" placeholder="Nama" required>
            <label>NIP:</label>
            <input type="text" class="form-control" id="txtNIP" name="txtNIP" placeholder="NIP" required>
            <label>Kelurahan:</label>
            <input type="text" class="form-control" id="txtKelurahan" name="txtKelurahan" placeholder="Kelurahan" required>
          </div>
          <div class="form-group">
            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
            <button class="btn btn-danger">Tambah</button>
          </div>
        </FORM>
      </div>
    </div>
  </div>
</div>
<!-- tutup modal add-->
<!-- modal edit -->
<div class="modal fade" id="modalEdit" role="dialog" aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 17px;">
      <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;">
        <h4 style="color:white;">Ubah Kepala Puskesmas</h4>
        <button type="button" class="close" 
        data-dismiss="modal" 
        aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <FORM method="post" id="FormEdit">
          @method('put')
          <input type="hidden" name="idUpdate" id="idUpdate" value="">
          <div class="form-group">
            <label>Nama:</label>
            <input type="text" class="form-control" id="txtNamaEdit" name="txtNamaEdit" placeholder="Nama"  required>
            <label>NIP:</label>
            <input type="text" class="form-control" id="txtNIPEdit" name="txtNIPEdit" placeholder="NIP"  required>
            <label>Kelurahan:</label>
            <input type="text" class="form-control" id="txtKelurahanEdit" name="txtKelurahanEdit" placeholder="Kelurahan" required>
            <label>Status:</label>
            <select class="form-control" name="statusEdit" id="statusEdit">
              <option value="1" >Aktif</option>
              <option value="0" >Nonaktif</option>
            </select>
            <label style="display: none; color: red; font-weight: normal" id="peringatanStatus">Tidak Boleh Nonaktif</label>
          </div>
          <div class="form-group">
            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
            <button class="btn btn-danger" id="btnUbah">Ubah</button>
          </div>
        </FORM>
      </div>
    </div>
  </div>
</div>
<!-- tutup modal edit -->

<!-- modal delete -->
<div class="modal fade" id="modalHapus" role="dialog" aria-labelledby="favoritesModalLabel"> 
  <div class="modal-dialog" role="document"> 
    <div class="modal-content" style="border-radius: 17px;"> 
      <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;"> 
        <h4 style="color:white;">Hapus Data Kepala Puskesmas</h4> 
        <button type="button" class="close" 
        data-dismiss="modal" 
        aria-label="Close"> 
        <span aria-hidden="true">&times;</span></button> 
      </div> 
      <div class="modal-body"> 
        <FORM method="post" id="FormDeleteSingle"> 
          <div class="form-group"> 
            Apakah anda yakin ingin menghapus data Kepala Puskesmas bernama <strong><span id="nametext"></span></strong> ?
          </div> 
          <div class="form-group"> 
            <input type="hidden" name="_token" value="{!!csrf_token()!!}"> 
            <input type="hidden" name="idHapus" id="idHapus" value="">
            <input type="hidden" name="jenis_delete" value="single">
            <button class="btn btn-default" class="btn btn-default" data-dismiss="modal" aria-label="Close">Tutup</button> 
            <button class="btn btn-danger">Hapus</button> 
          </div> 
        </FORM> 
      </div> 
    </div> 
  </div> 
</div>
<!-- tutup modal delete -->

<!-- modal Delete All-->
<div class="modal fade" id="modalHapusSemua" role="dialog" aria-labelledby="favoritesModalLabel"> 
  <div class="modal-dialog" role="document"> 
    <div class="modal-content" style="border-radius: 17px;"> 
      <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;"> 
        <h4 style="color:white;">Hapus Data Kepala Puskesmas</h4> 
        <button type="button" class="close" 
        data-dismiss="modal" 
        aria-label="Close"> 
        <span aria-hidden="true">&times;</span></button> 
      </div> 
      <div class="modal-body"> 
        <FORM method="post" id="FormDeleteAll"> 
          <div class="form-group"> 
            <span id="textdel"></span>
          </div> 
          <div class="form-group" id="field_input"> 
            <input type="hidden" name="_token" value="{!!csrf_token()!!}"> 
            <input type="hidden" name="jenis_delete" name="all">
            <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">Tutup</button> 
            <button class="btn btn-danger" id="btnConfirmHapus">Hapus</button> 
          </div> 
        </FORM> 
      </div> 
    </div> 
  </div> 
</div>
<!-- tutup modal Delete All-->


<br>
<div class="container-fluid">
  @if (session()->has('message'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fa fa-check"></i> Alert!</h5>
    {{ session('message') }}
  </div>
  @endif
  <div class="row mb-2">
    <div class="col-sm-6">
      <h3>Kepala Puskesmas</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Kepala Puskesmas</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-1 col-4"  title="Tambah">
              <button type="button" class="btn btn-block btn-primary btn-sm" id="btnAdd" data-toggle="modal" 
              data-target="#modalAdd"><i class="fa fa-plus-circle nav-icon"></i> Tambah </button>
            </div>
            <div class="col-lg-1 col-4"  title="Hapus">
              <button type="button" class="btn btn-block btn-danger btn-sm" data-toggle="modal" 
              data-target="#modalHapusSemua" onclick="opendeleteallmodal();"><i class="fa fa-times-circle nav-icon"></i> Hapus</button>
            </div>
            <!-- <div class="col-lg-1 col-4" data-toggle="tooltips" title="Filter">
              <button type="button" class="btn btn-block btn-secondary btn-sm"><i class="fa fa-filter nav-icon"></i> Filter</button>
            </div> -->
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
                <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                  <thead>
                    <tr role="row" style="text-align: center;">
                      <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                        #
                      </th>
                      <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 5%;">
                        No
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 30%;">
                        Nama
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 30%;">
                        NIP
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 30%;">
                        Kelurahan
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 20%;">
                        Status
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 25%;">
                        Aksi
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($kepala_puskesmas as $key => $value) 
                    <tr>
                      <td>
                        <label>
                          <input type="checkbox" class="flat-red" id="checkbox<?php echo $key ?>" name="chkDel[]" value="<?php echo $value['id']; ?>">
                        </label>
                      </td>
                      <td style="text-align: center;">{{($key+1)}}</td>
                      <td>{{($value['nama'])}}</td>
                      <td>{{($value['nip'])}}</td>
                      <td>{{($value['kelurahan'])}}</td>
                      <td>{{($value['status_aktif']?'Aktif':'Nonaktif')}}</td>
                      <td>
                        <div class="form-group">
                          <div>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalEdit" title="Edit" id="<?php echo 'edit'.$key; ?>" onclick="openeditmodal(<?php echo "'".$value['id']."'" ?>,<?php echo "'".$value["nama"]."'" ?>,<?php echo "'".$value["nip"]."'" ?>,<?php echo "'".$value["kelurahan"]."'" ?>,<?php echo "'".$value["status_aktif"]."'" ?>);"><i class="fa fa-edit"></i></button>

                            <button class="btn btn-danger" data-toggle="modal" data-target="#modalHapus" onclick="opendeletemodal(<?php echo "'".$value['id']."'" ?>,<?php echo "'".$value['nama']."'" ?>)"><i class="fa fa-times"></i></button>
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
@endsection
<!-- plugin js -->
@section('plugin_js')

@endsection

<!-- add js -->
@section('add_js')
<script>
  // var btnAdd = document.getElementById('btnAdd');

  // btnAdd.onclick = function() {
  //   modalAdd.style.display = "block";
  //   $('.select2').select2();
  // }
  var statusnya = '';
  function openeditmodal(id, nama, nip, kelurahan, status){
    let action = "{{ route('kepala-puskesmas.update', ':id') }}".replace(':id', id)
    $('#FormEdit').attr('action', action);

    modalEdit.style.display = "block";
    document.getElementById('idUpdate').value = id;
    document.getElementById('txtNamaEdit').value = nama;
    document.getElementById('txtKelurahanEdit').value = kelurahan;
    document.getElementById('txtNIPEdit').value = nip;
    document.getElementById('statusEdit').value = status;
    statusnya = status;

  }

  function opendeletemodal(id, nama){
    let action = "{{ route('karyawan.destroy', ':id') }}".replace(':id', id)
    $('#FormDeleteSingle').attr('action', action);
    modalHapus.style.display = "block";

    document.getElementById('idHapus').value =id;
    document.getElementById('nametext').innerHTML = nama;
  }

  function opendeleteallmodal(){
    let action = "{{ route('karyawan.destroy', ':id') }}".replace(':id', id)
    $('#FormDeleteAll').attr('action', action);
    modalHapusSemua.style.display = "block";

    $ischecked = false;
    for(var i = 0; i < document.getElementsByName('chkDel[]').length; i++){
      if(document.getElementById('checkbox'+i).checked){
        $ischecked = true;
      }
    }

    if($ischecked){
      document.getElementById("textdel").innerHTML = "Apakah anda yakin ingin menghapus data kepala puskesmas yang telah dipilih?";
      document.getElementById("btnConfirmHapus").style.visibility = "visible";
    }
    else{
      document.getElementById("textdel").innerHTML = "Tidak ada data kepala puskesmas yang dipilih";
      document.getElementById("btnConfirmHapus").style.visibility = "hidden";
    }
    //alert($ischecked);
  }

  // FOR DELETE CHECKED
  $('input').on('ifChecked', function(event){
    // CREATE HIDDEN ELEMENT FOR SAVE ID'S CHOOSE
    var input = document.createElement("input");
    input.setAttribute('type', 'hidden');
    input.setAttribute('id', 'del'+$(this).val());
    input.setAttribute('name', 'txtDeleteAll[]');
    input.setAttribute('value', $(this).val());

    var parent = document.getElementById("field_input");
    parent.appendChild(input);
  });

  $('input').on('ifUnchecked', function(event){
    var parent = document.getElementById("field_input");
    var element = document.getElementById('del'+$(this).val());
    parent.removeChild(element);
  });
  // ============ DELETE CHECKED END
  $('#statusEdit').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;

    if(statusnya!='0'){
      if(valueSelected==0){
        document.getElementById("peringatanStatus").style.display = "block";
        $("#btnUbah").attr("disabled", true);
        // alert("gak boleh, harus balik ke aktif");  
        // $("#statusEdit").val("1");
      }
      else{
        document.getElementById("peringatanStatus").style.display = "none";
        $("#btnUbah").removeAttr("disabled");
      }
    }



  });
</script>
@endsection