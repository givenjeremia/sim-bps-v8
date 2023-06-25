@extends('layouts.adminlte')
<!-- plugin css -->
@section('plugin_css')

@endsection
<!-- css -->
@section('add_css')

@endsection
<!-- content -->
@section('content')
<!-- modal hapus -->
<div class="modal fade" id="modalHapus" role="dialog"> 
  <div class="modal-dialog" role="document"> 
    <div class="modal-content" style="border-radius: 17px;"> 
      <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;"> 
      <h4 style="color:white;">Hapus Data Jenis Layanan</h4> 
        <button type="button" class="close"  
        data-dismiss="modal"  
        aria-label="Close"> 
        <span aria-hidden="true">&times;</span></button> 
      </div> 
      <div class="modal-body"> 
        Apakah anda yakin ingin menghapus jenis layanan <span style="font-weight:bold;" id="lblNamaHapus"></span> ?
        <FORM method="post" id="FormDelete">
          @method('delete')
          <div class="button-group">
            <BR>
              <button class="btn btn-default pull-left" data-dismiss="modal">Batal</button>&nbsp
              <button class="btn btn-danger">Hapus</button>
              <br>
              <input type="hidden" name="_token" value="{!!csrf_token()!!}">
              <input type="hidden" id="txtIdHapus" name="txtIdHapus">
            </div>
          </FORM>
        </div> 
      </div> 
    </div> 
</div>
<!-- tutup modal hapus -->
<!-- modal hapus selected -->
  <div class="modal fade" id="modalHapusTerpilih" role="dialog"> 
    <div class="modal-dialog" role="document"> 
      <div class="modal-content" style="border-radius: 17px;"> 
        <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;"> 
          <h4 style="color:white;">Hapus Data Jenis Layanan</h4> 
          <button type="button" class="close"  
          data-dismiss="modal"  
          aria-label="Close"> 
          <span aria-hidden="true">&times;</span></button> 
        </div> 
        <div class="modal-body"> 
          Apakah anda yakin ingin menghapus jenis layanan yang terpilih?
          <FORM method="post" action="<?php echo URL::to('/jenis_pelayanan_hapus_terpilih')?>">
            <div class="button-group">
              <BR>
                <button class="btn btn-default pull-left" data-dismiss="modal">Batal</button>&nbsp
                <button class="btn btn-danger">Hapus Semua</button>
                <br>
                <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                <input type="hidden" id="txtIdHapusTerpilih" name="txtIdHapusTerpilih">
              </div>
            </FORM>
          </div> 
        </div> 
      </div> 
  </div>
  <!-- tutup modal hapus selected -->
  <!-- modal peringatan -->
  <div class="modal fade" id="modalPeringatan" role="dialog"> 
    <div class="modal-dialog" role="document"> 
      <div class="modal-content" style="border-radius: 17px;"> 
        <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;"> 
          <h4 style="color:white;">Peringatan</h4> 
          <button type="button" class="close"  
          data-dismiss="modal"  
          aria-label="Close"> 
          <span aria-hidden="true">&times;</span></button> 
        </div> 
        <div class="modal-body"> 
          <p id="lblPeringatan"></p>
          <div class="button-group">
            <BR>
              <button class="btn btn-default pull-left" data-dismiss="modal">Ok</button>
            </div>
          </div> 
        </div> 
      </div> 
  </div>
  <!-- tutup modal peringatan -->
<!-- modal tambah -->
<div class="modal fade" id="modalTambah" role="dialog" aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 17px;">
      <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;">
        <h4 style="color:white;">Tambah Layanan</h4>
        <button type="button" class="close" 
        data-dismiss="modal" 
        aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <FORM method="post" name="formTambah" action="{{ route('jenis-layanan.store') }}">
          <div class="form-group">
            <label>Pelayanan:</label>
            <select class="form-control" id="txtPelayanan" name="txtPelayanan" >
              <option value="0">KB</option>
              <option value="1">Imunisasi Paketan</option>
              <option value="2">Imunisasi Satuan</option>
              <option value="3">Ibu Hamil</option>
              <option value="4">Kunjungan Ulang Ibu Hamil</option>
              <option value="5">Persalinan</option>
              <option value="6">Nifas</option>
            </select>
            <label>Nama Layanan:</label>
            <input type="text" class="form-control" id="txtNamaLayanan" name="txtNamaLayanan" placeholder="Nama Layanan" autocomplete="off" required>
            <label>Tarif Jasa Layanan:</label>
            <input type="text" class="form-control" id="txtTarifLayanan" name="txtTarifLayanan" placeholder="Tarif Layanan" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="nama">Obat</label>
            <label class="control-label col-sm-4" for="nama">
              <select class="form-control" id="txtObat" name="txtObat" >
                <?php $obat = DB::table('obat')->where('status_hapus','=','0')->get(); ?>
                @foreach($obat as $key => $value) 
                <option value="{{ $value->id }}" value2="{{ $value->id_satuan }}">{{ $value->nama }}</option>
                @endforeach
              </select>
            </label>
            <label class="control-label col-sm-2" for="nama"><span class="btn btn-primary" onclick="tambah_tabel()"><i class="fa fa-plus-circle"></i></span></label>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-bordered table-striped dataTable" id="tabelDataObat">
                    <tr id="tambahDataObat">
                      <th>Nama</th>
                      <th>Kuantitas</th>
                      <th>Satuan</th>
                      <th></th>
                    </tr>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div><!-- /.row -->
          <div class="form-group">
            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
            <input type="hidden" id="txtIdObat" name="txtIdObat">
            <input type="hidden" id="txtQtyObat" name="txtQtyObat">
            <button class="btn btn-default pull-left" data-dismiss="modal">Batal</button>&nbsp
            <label class="control-label" for="nama"><span class="btn btn-danger" onclick="simpanQty()">Tambah</span></label>
          </div>
        </FORM>
      </div>
    </div>
  </div>
</div>
<!-- tutup modal tambah-->

<!-- modal edit -->
<div class="modal fade" id="modalEdit" role="dialog" aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 17px;">
      <div class="modal-header" style="background-color: #e61919; border-radius:17px 17px 0px 0px;">
        <h4 style="color:white;">Edit Layanan</h4>
        <button type="button" class="close" 
        data-dismiss="modal" 
        aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <FORM method="post" name="formEdit" id="FormEdit">
          @method('put')
          <div class="form-group">
            <label>Pelayanan:</label>
            <select class="form-control" id="txtPelayananEdit" name="txtPelayananEdit" disabled>
              <option value="0">KB</option>
              <option value="1">Imunisasi Paketan</option>
              <option value="2">Imunisasi Satuan</option>
              <option value="3">Ibu Hamil</option>
              <option value="4">Kunjungan Ulang Ibu Hamil</option>
              <option value="5">Persalinan</option>
              <option value="6">Nifas</option>
            </select>
            <label>Nama Layanan:</label>
            <input type="text" class="form-control" id="txtNamaLayananEdit" name="txtNamaLayananEdit" placeholder="Nama Layanan" autocomplete="off" required>
            <label>Tarif Jasa Layanan:</label>
            <input type="text" class="form-control" id="txtTarifLayananEdit" name="txtTarifLayananEdit" placeholder="Tarif Layanan" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="nama">Obat</label>
            <label class="control-label col-sm-4" for="nama">
              <select class="form-control" id="txtObatEdit" name="txtObatEdit" >
                <?php $obat = DB::table('obat')->where('status_hapus','=','0')->get(); ?>
                @foreach($obat as $key => $value) 
                <option value="{{ $value->id }}" value2="{{ $value->id_satuan }}">{{ $value->nama }}</option>
                @endforeach
              </select>
            </label>
            <label class="control-label col-sm-2" for="nama"><span class="btn btn-primary" onclick="tambah_tabel_edit()"><i class="fa fa-plus-circle"></i></span></label>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-bordered table-striped dataTable" id="tabelDataObatEdit">
                    <tr id="tambahDataObatEdit">
                      <th>Nama</th>
                      <th>Kuantitas</th>
                      <th>Satuan</th>
                      <th></th>
                    </tr>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div><!-- /.row -->
          <div class="form-group">
            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
            <input type="hidden" id="txtIdObatEdit" name="txtIdObatEdit">
            <input type="hidden" id="txtQtyObatEdit" name="txtQtyObatEdit">
            <input type="hidden" id="txtIdEdit" name="txtIdEdit">
            
            <button class="btn btn-default pull-left" data-dismiss="modal">Batal</button>&nbsp
            <label class="control-label" for="nama"><span class="btn btn-danger" onclick="simpanQtyEdit()">Edit</span></label>
          </div>
        </FORM>
      </div>
    </div>
  </div>
</div>
<!-- tutup modal edit-->

<br>
<div class="container-fluid">

@if (Session::get('notif_berhasil'))
<div class="alert alert-success"></span><a href="#" class="close" data-dismiss="alert">&times;</a><strong>BERHASIL!</strong><BR> 
{!! session::get('notif_berhasil') !!}
</div>
@endif
@if (Session::get('notif_gagal'))
<div class="alert alert-danger"></span><a href="#" class="close" data-dismiss="alert">&times;</a><strong>GAGAL!</strong><BR> 
  {!! session::get('notif_gagal') !!}
</div>
@endif
  <div class="row mb-2">
    <div class="col-sm-6">
      <h3>Master Layanan</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Master Jenis Layanan</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-1 col-4" title="Add">
              <button type="button" class="btn btn-block btn-primary btn-sm" id="btnAdd" data-toggle="modal" 
              data-target="#modalTambah"><i class="fa fa-plus-circle nav-icon"></i> Tambah</button>
            </div>
            <div class="col-lg-1 col-4" title="Hapus">
              <!-- <button type="button" class="btn btn-block btn-danger btn-sm" onclick="openhapusterpilihmodal();"><i class="fa fa-times-circle nav-icon"></i> Hapus</button> -->
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
              <div class="table-responsive"> 
                <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                  <thead>
                    <tr role="row">
                      <!-- <th style="width: 2%; text-align:right;"></th> -->
                      <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 5%;">
                        No
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 30%;">
                        Pelayanan
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 30%;">
                        Nama Layanan
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 20%;">
                        Total Tarif
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 30%;">
                        Obat
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 20%;">
                        Aksi
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($layanan as $key => $value) 
                   <tr>
                    <!-- <td style="text-align: center;"><input type="checkbox" class="flat-red icheckbox" name="cbxHapusTerpilih" id="{{$value['id']}}"></td> -->
                    <td style="text-align: center;">{{($key+1)}}</td>
                    <td>
                    <?php 
                    if($value['pelayanan'] == 0)
                      echo 'KB';
                    if($value['pelayanan'] == 1)
                      echo 'Imunisasi Paketan';
                    if($value['pelayanan'] == 2)
                      echo 'Imunisasi Satuan';
                    if($value['pelayanan'] == 3)
                      echo 'Ibu Hamil';
                    if($value['pelayanan'] == 4)
                      echo 'Kunjungan Ulang Ibu Hamil';
                    if($value['pelayanan'] == 5)
                      echo 'Persalinan';
                    if($value['pelayanan'] == 6)
                      echo 'Nifas';
                    ?>
                    </td>
                    <td>{{$value['nama']}}</td>
                    <td style="text-align: right;">{{ number_format($value['tarif_total']) }}</td>
                    <td>
                    <?php $obat = DB::table('obat')->leftJoin('obat_layanan', 'obat.id', '=', 'obat_layanan.id_obat')->where('id_layanan','=',$value['id'])->get(); 
                    if(count($obat)==0)
                      echo 'tidak menggunakan obat'?>
                    @foreach($obat as $key => $value2)
                      <li>
                      {{ $value2->nama.' ('.$value2->qty.' PCS/BUTIR)' }}
                      </li>
                    @endforeach
                    </td>
                    <td>
                      <div class="form-group">
                        <div>

                          <button data-toggle="modal" data-target="#modalEdit" id="<?php echo 'edit'.$key; ?>" onclick="openeditmodal(<?php echo "'".$value['id']."'" ?>,'edit');" class="btn btn-primary" data-toggle="tooltips" title="Edit" style="width:40px"><i class="fa fa-edit"></i></button>
                          <?php if($value['pelayanan'] != 3 && $value['pelayanan'] != 4 && $value['pelayanan'] != 5 && $value['pelayanan'] != 6){ ?>
                          <button data-toggle="modal" data-target="#modalHapus" id="<?php echo 'edit'.$key; ?>" onclick="openhapusmodal(<?php echo "'".$value['id']."'" ?>,<?php echo "'".$value['nama']."'" ?>);" class="btn btn-danger" data-toggle="tooltips" title="Hapus" style="width:40px"><i class="fa fa-times"></i></button>
                          <?php } ?>

                        </div>
                      </div>


                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table></div></div></div></div>
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
    <script src="{{asset('price_jquery/jquery.priceformat.min.js')}}"></script>
    <script>
      var counter = 1;
      var idTerpilih = new Array();
      function tambah_tabel(){
        $cek = $.inArray(document.getElementById('txtObat').value, idTerpilih);
        if ($cek != -1)
        {
          alert('Anda menambahkan obat yang sama'); 
        }
        else
        {
          var newTextBoxDiv = $(document.createElement('tr')).attr("id", 'trdata'+ counter);

          var namaobat =  $('#txtObat option:selected').text();
          // var satuan =  $('#txtObat option:selected')[0].getAttribute('value2');

          newTextBoxDiv.after().html(
            '<td>'+namaobat+'</td>'+
            '<td contenteditable style="text-align: right;" onkeypress="return isNumberKey(event)">1</td>'+
            '<td>PCS/BUTIR</td>'+
            '<td><span class="btn btn-danger" onclick="kurang_tabel('+counter+','+document.getElementById('txtObat').value+')"><i class="fa fa-times-circle"></i></span></td>');

          newTextBoxDiv.appendTo("#tabelDataObat");
          idTerpilih.push(document.getElementById('txtObat').value);
          document.getElementById('txtIdObat').value = idTerpilih;
          counter++;
        }
        
      }

      function kurang_tabel(counterr, id){
        if(counter==1){
          alert("No more textbox to remove");
          return false;
        }
        else
        {
          counter--;
        }

        //counter--;
        $("#trdata" + counterr).remove();
        removeA(idTerpilih, ''+id+'');
        document.getElementById('txtIdObat').value = idTerpilih;
      }

      function simpanQty(){
        <?php 
          $ibu_hamil = DB::select("select * from layanan where pelayanan=3");
          $kunjungan_ulang_ibu_hamil = DB::select("select * from layanan where pelayanan=4");
          $persalinan = DB::select("select * from layanan where pelayanan=5"); 
          $nifas = DB::select("select * from layanan where pelayanan=6"); 
        ?>
        var idQty = new Array();
        for (var i = 1 ; i < counter; i++) {
          idQty.push(document.getElementById("tabelDataObat").rows[i].cells[1].innerHTML);
        }
        document.getElementById('txtQtyObat').value = idQty;
        if(idQty.includes('0'))
        {
          alert('Kuantitas obat tidak boleh Nol');
        }
        else if(idQty.includes(''))
        {
          alert('Kuantitas obat tidak boleh kosong');
        }
        else if(<?php echo count($ibu_hamil) ?>>0 && document.getElementById("txtPelayanan").value == 3)
        {
          alert('Jenis layanan untuk ibu hamil tidak boleh lebih dari 1');
        }
        else if(<?php echo count($kunjungan_ulang_ibu_hamil) ?>>0 && document.getElementById("txtPelayanan").value == 4)
        {
          alert('Jenis layanan untuk kunjungan ulang ibu hamil tidak boleh lebih dari 1');
        }
        else if(<?php echo count($persalinan) ?>>0 && document.getElementById("txtPelayanan").value == 5)
        {
          alert('Jenis layanan untuk persalinan ibu tidak boleh lebih dari 1');
        }
        else if(<?php echo count($nifas) ?>>0 && document.getElementById("txtPelayanan").value == 6)
        {
          alert('Jenis layanan untuk nifas tidak boleh lebih dari 1');
        }
        else
        {
          
          if(document.getElementById('txtNamaLayanan').value == '')
            document.getElementById('txtNamaLayanan').style.backgroundColor = "#ffcccc";
          else if(document.getElementById('txtTarifLayanan').value == '')
            document.getElementById('txtTarifLayanan').style.backgroundColor = "#ffcccc";
          else
          {
            document.formTambah.submit();
          }
        }
        
      }

      function removeA(arr) {
        var what, a = arguments, L = a.length, ax;
        while (L > 1 && arr.length) {
          what = a[--L];
          while ((ax= arr.indexOf(what)) !== -1) {
            arr.splice(ax, 1);
          }
        }
        return arr;
      }

      var counterEdit = 1;
      var idTerpilihEdit = new Array();
      function load_tabel_edit(arr){
        
        counterEdit = 1;
        idTerpilihEdit = new Array();
        var table = document.getElementById("tabelDataObatEdit");
        for(var i = table.rows.length - 1; i > 0; i--)
        {
          table.deleteRow(i);
        }
        if(arr[0].nama != null)
        {
          for (var i = 0; i < arr.length; i++) {
          var newTextBoxDiv = $(document.createElement('tr')).attr("id", 'trdataedit'+ counterEdit);
            newTextBoxDiv.after().html(
              '<td>'+arr[i].nama+'</td>'+
              '<td contenteditable style="text-align: right;" onkeypress="return isNumberKey(event)">'+arr[i].qty+'</td>'+
              '<td>PCS/BUTIR</td>'+
              '<td><span class="btn btn-danger" onclick="kurang_tabel_edit('+counterEdit+','+''+arr[i].id+''+')"><i class="fa fa-times-circle"></i></span></td>');

            newTextBoxDiv.appendTo("#tabelDataObatEdit");
            idTerpilihEdit.push(''+arr[i].id+'');
            document.getElementById('txtIdObatEdit').value = idTerpilihEdit;
            counterEdit++;
          }
        }
      }

      function tambah_tabel_edit(){
        $cek = $.inArray(document.getElementById('txtObatEdit').value, idTerpilihEdit);
        if ($cek != -1)
        {
          alert('Anda menambahkan obat yang sama'); 
        }
        else
        {
          var newTextBoxDiv = $(document.createElement('tr')).attr("id", 'trdataedit'+ counterEdit);

          var namaobat =  $('#txtObatEdit option:selected').text();
          // var satuan =  $('#txtObat option:selected')[0].getAttribute('value2');

          newTextBoxDiv.after().html(
            '<td>'+namaobat+'</td>'+
            '<td contenteditable style="text-align: right;">1</td>'+
            '<td>PCS/BUTIR</td>'+
            '<td><span class="btn btn-danger" onclick="kurang_tabel_edit('+counterEdit+','+document.getElementById('txtObatEdit').value+')"><i class="fa fa-times-circle"></i></span></td>');

          newTextBoxDiv.appendTo("#tabelDataObatEdit");
          idTerpilihEdit.push(document.getElementById('txtObatEdit').value);
          document.getElementById('txtIdObatEdit').value = idTerpilihEdit;
          counterEdit++;
        }
      }

      function kurang_tabel_edit(counterr, id){
        
        if(counterEdit==1){
          alert("No more textbox to remove");
          return false;
        }
        else
        {
          counterEdit--;
        }
        
        //counter--;
        $("#trdataedit" + counterr).remove();
        removeA(idTerpilihEdit, ''+id+'');
        document.getElementById('txtIdObatEdit').value = idTerpilihEdit;
      }

      function simpanQtyEdit(){
        var idQty = new Array();
        for (var i = 1 ; i < counterEdit; i++) {
          idQty.push(document.getElementById("tabelDataObatEdit").rows[i].cells[1].innerHTML);
        }

        if(idQty.includes('0'))
        {
          alert('Kuantitas obat tidak boleh Nol');
        }
        else if(idQty.includes(''))
        {
          alert('Kuantitas obat tidak boleh kosong');
        }
        else
        {
          if(document.getElementById('txtNamaLayananEdit').value == '')
            document.getElementById('txtNamaLayananEdit').style.backgroundColor = "#ffcccc";
          else if(document.getElementById('txtTarifLayananEdit').value == '')
            document.getElementById('txtTarifLayananEdit').style.backgroundColor = "#ffcccc";
          else
          {
            document.getElementById('txtQtyObatEdit').value = idQty;
            document.formEdit.submit();
          }
          
        }


      }

      function openhapusmodal(id, nama)
      {
        let action = "{{ route('jenis-layanan.destroy', ':id') }}".replace(':id', id)
        $('#FormDelete').attr('action',action)

        document.getElementById('txtIdHapus').value = id;
        document.getElementById('lblNamaHapus').innerHTML  = nama;
      }

      function openhapusterpilihmodal()
      {
        var arrTerpilih = new Array();
        $("input:checkbox[name='cbxHapusTerpilih']:checked").each(function(){
          arrTerpilih.push($(this).attr('id'));
        });
        if(arrTerpilih.length>0)
        {
          $('#modalHapusTerpilih').modal('show');
          document.getElementById('txtIdHapusTerpilih').value = arrTerpilih;
        }
        else
        {
          document.getElementById('lblPeringatan').innerHTML = 'Anda belum memilih data yang akan dihapus';
          $('#modalPeringatan').modal('show');
        }
      }

      function openeditmodal(id, desire)
      {
        let action = "{{ route('jenis-layanan.update', ':id') }}".replace(':id', id)
        $('#FormEdit').attr('action',action)
        let url = "{{ route('jenis-layanan.show',':id') }}".replace(':id', id)
        $.ajax({
          type:"GET",
          url:url,
        
          success:function(data){
            var resp = $.parseJSON(data);
            if(desire == 'edit')
            {
              console.log(resp);
              document.getElementById('txtIdEdit').value = resp.id;
              document.getElementById('txtNamaLayananEdit').value = resp.nama;
              document.getElementById('txtTarifLayananEdit').value = resp.tarif_layanan;
              document.getElementById('txtPelayananEdit').value = parseInt(resp.pelayanan);
              load_tabel_edit(resp.obat);
            }
          }    
        });
      }

     function isNumberKey(evt)
     {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if ((charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) || charCode ==13 )
           return false;

        return true;
     }

      $(document).ready(function() {
       $('#txtTarifLayanan').priceFormat({ 
        clearPrefix: true, 
        clearSuffix: true, 
        prefix: '', 
        centsLimit: 0, 
        thousandsSeparator: ',' 
      });

      $('#txtTarifLayananEdit').priceFormat({ 
        clearPrefix: true, 
        clearSuffix: true, 
        prefix: '', 
        centsLimit: 0, 
        thousandsSeparator: ',' 
      }); 


       $("#txtTarifLayanan").keydown(function (e) {
          // Allow: backspace, delete, tab, escape, enter and .
          if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
               // Allow: Ctrl+A, Command+A
               (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
               // Allow: home, end, left, right, down, up
               (e.keyCode >= 35 && e.keyCode <= 40)) {
                   // let it happen, don't do anything
                 return;
               }
          // Ensure that it is a number and stop the keypress
          if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
          }
        });

       

     });
    </script>
    @endsection