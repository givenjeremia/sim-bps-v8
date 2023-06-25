  @extends('layouts.adminlte')
  <!-- plugin css -->
  @section('plugin_css')
  <link rel="stylesheet" href="{{asset('dropify/dist/css/dropify.min.css')}}">
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
        <FORM method="post" action="{{ route('klinik.simpan.history') }}"> 
          <div class="form-group"> 
            <span id="pesan_error" style="display: none;"></span>
            <span id="pesan_konfirmasi" style="display: none;">Apakah anda yakin ingin menyimpan data history yang bernilai <strong><span id="totalnya"></span></strong> ?</span>
          </div> 
          <div class="form-group"> 
            <input type="hidden" name="_token" value="{!!csrf_token()!!}"> 
            <input type="hidden" name="idSimpan" id="idSimpan" value="">
            <input type="hidden" name="keluhannya" id="keluhannya" value="">
            <input type="hidden" name="tindakannya" id="tindakannya" value="">
            <input type="hidden" name="obatnya" id="obatnya" value="">
            <input type="hidden" name="harga_layanannya" id="harga_layanannya" value="">
            <button class="btn btn-default" data-dismiss="modal" aria-label="Close">Tutup</button> 
            <button class="btn btn-primary" style="display: none;" id="btn_simpan_history" onclick="load()">Simpan</button> 
          </div> 
        </FORM> 
      </div> 
    </div> 
  </div> 
</div>
<!-- tutup modal simpan -->

<br>
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h3>Tambah Histori Pelayanan Klinik</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/klinik')}}">Pelayanan Klinik</a></li>
        <li class="breadcrumb-item active">Tambah Histori Pelayanan Klinik</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <label class="control-label col-lg-6">
              <div class="form-group">
                <label class="control-label col-sm-4" for="nama">Nomor Registrasi</label>
                <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                  <span> : &nbsp; {{$pasien[0]['no_regis']}}</span>
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-4" for="nama">Nama</label>
                <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                  <span> : &nbsp; {{$pasien[0]['nama']}}</span>
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-4" for="nama">Tanggal Lahir</label>
                <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                  <div class="input-group">
                    <span> : &nbsp; {{date("d-m-Y", strtotime($pasien[0]['tanggal_lahir']))}}</span>
                  </div> 
                </label>
              </div>
            </label>
            <label class="control-label col-lg-6">
              <div class="form-group">
                <label class="control-label col-sm-2" for="nama">Agama</label>
                <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                  : &nbsp; {{$pasien[0]['agama']}}
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="nama">Alamat</label>
                <label class="control-label col-sm-6" for="nama" style="font-weight: normal;">
                  <span> : &nbsp; {{$pasien[0]['alamat']}}</span>
                </label>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="nama">No. Telp</label>
                <label class="control-label col-sm-4" for="nama" style="font-weight: normal;">
                  <span> : &nbsp; {{$pasien[0]['telp']}}</span>
                </label>
              </div>
            </label>
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
            <div class="form-group row">
              <label class="control-label col-sm-2" for="nama">Keluhan</label>
              <label class="control-label col-sm-4" for="nama">
                <textarea class="form-control" id="txtKeluhan" name="txtKeluhan" placeholder="keluhan yang diderita" oninput='txtKeluhan.style.backgroundColor = "#FFF"' rows="5" required></textarea>
              </label>
            </div>
            <div class="form-group row">
              <label class="control-label col-sm-2" for="nama">Tindakan</label>
              <label class="control-label col-sm-4" for="nama">
                <textarea class="form-control" id="txtTindakan" name="txtTindakan" placeholder="tindakan yang diberikan" oninput='txtTindakan.style.backgroundColor = "#FFF"' rows="5" required></textarea>
              </label>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="nama">Obat</label>
              <label class="control-label col-sm-4" for="nama">
                <select class="form-control" id="txtObat" name="txtObat" >
                  <option selected disabled value="">Obat...</option>
                  @foreach($obat as $value)
                  <option value="{{$value->id}}" data-value="{{$value->harga}}" stok-value="{{$value->total_pcs}}">{{$value->nama}}</option>
                  @endforeach
                </select>
              </label>
              <label class="control-label col-sm-2" for="nama"><span class="btn btn-primary" onclick="tambah_tabel()">Tambah</span></label>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Obat yang dipakai</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-striped dataTable" id="tabelDataObat">
                      <tr id="tambahDataObat">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kuantitas</th>
                        <th>Satuan</th>
                        <th>Harga Satuan</th>
                        <th>Total</th>
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
              <label class="control-label col-sm-2" for="nama">Harga Layanan (Rp)</label>
              <label class="control-label col-sm-4" for="nama">
                <input type="text" class="form-control" id="txtHargaLayanan" name="txtHargaLayanan" onkeyup="hitung_total_harga()" placeholder="" style="text-align: right;" value="0" required>
              </label>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="nama">Total Harga :</label>
              <label class="control-label col-sm-4" style="font-weight: normal;" id="lbl_total_harga">
                Rp. 0
              </label>
            </div>
            <div class="form-group">
              <button type="submit" name="simpan" class="btn btn-primary" onclick="opensimpanmodal('{{ $pasien[0]['no_regis'] }}')"><i class="fa fa-save nav-icon"></i> Simpan</button>
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
  var idxObat = [];
  var counterObat = [];
  var counter = 1;
  function tambah_tabel(){
    var newTextBoxDiv = $(document.createElement('tr')).attr("id", 'trdata'+ counter);
    var namaobat =  $('#txtObat option:selected').text();
    var idobat =  $('#txtObat option:selected').val();
    var harga_satuanObat = $('#txtObat option:selected').attr('data-value');
    var stoknya_obat = $('#txtObat option:selected').attr('stok-value');
    var total_hargaObat = harga_satuanObat * 1;

    if(idobat!=''){
      if(idxObat.indexOf(idobat) != -1)
      {  
        var idxCounter = counterObat[idxObat.indexOf(idobat)];
        var ttl_qty_obt = parseInt($('#qty_Obat'+idxCounter).text());
        $('#qty_Obat'+idxCounter).html(ttl_qty_obt+1);
        $('#total_harga'+idxCounter).html(((ttl_qty_obt+1)*harga_satuanObat).toLocaleString());
      }
      else{
        idxObat.push(idobat);
        counterObat.push(counter);
        newTextBoxDiv.after().html('<td>1</td>'+
          '<td data-value=\''+idobat+'\' id="obat'+counter+'">'+namaobat+'</td>'+
          '<td contenteditable style="text-align: right;" id="qty_Obat'+counter+'" onkeyup="ubah_total_harga_obat('+counter+')" onkeypress="return boleh_input_angka(event,'+counter+')">1</td>'+
          '<td>Tablet</td>'+
          '<td style="text-align: right;" id="harga_satuanObat'+counter+'">'+parseInt( harga_satuanObat ).toLocaleString()+'</td>'+
          '<td style="text-align: right;" id="total_harga'+counter+'">'+parseInt( total_hargaObat ).toLocaleString()+'</td>'+
          '<td><span class="btn btn-danger" onclick="kurang_tabel('+counter+')">X</span></td>');

        newTextBoxDiv.appendTo("#tabelDataObat");

        counter++;
      }
      
    }    
    hitung_total_harga();
  }

  function validasi_form(){

    var keluhannya = $('#txtKeluhan').val();
    var tindakannya = $('#txtTindakan').val();

    if(keluhannya.length > 0 && tindakannya.length > 0 ){
      $stringhasil = "";
    }
    else{
      if(tindakannya.length == 0){
          txtTindakan.style.backgroundColor = "#ffdddd";
          txtTindakan.focus();
      }
      if(keluhannya.length == 0){
          txtKeluhan.style.backgroundColor = "#ffdddd";
          txtKeluhan.focus();
      }
      
      $stringhasil = "data harus diisi dengan baik";
    }

    /*
    $stringhasil = keluhannya.length > 0 ? "" : "Teks keluhan harus diisi <br>";
    $stringhasil += tindakannya.length > 0 ? "" : "Teks tindakan harus diisi <br>";
    */

    return $stringhasil;
  }

  function hitung_total_harga(){
    var hargaObatnya = 0;
    
    $('#tabelDataObat tr').each(function(index) {  
      if(index!=0){
        hargaObatnya += parseInt($(":nth-child(6)", $(this)).text().replace(',', ''));
      }
    });
    
    var harga_layanan = $('#txtHargaLayanan').unmask() =="" ? 0 : $('#txtHargaLayanan').unmask();
    var total_harga = hargaObatnya + parseInt(harga_layanan);
    $('#lbl_total_harga').html("Rp. "+parseInt( total_harga ).toLocaleString())

  }

  function ubah_total_harga_obat(id){
    var yang_gak_boleh = new Array("", "0");
    
    var qtynya = yang_gak_boleh.indexOf($('#qty_Obat'+id).text()) != -1 ? 1 : $('#qty_Obat'+id).text();
    if(yang_gak_boleh.indexOf($('#qty_Obat'+id).text()) != -1){
      $('#qty_Obat'+id).text(qtynya);
    } 
    var harga_satuannya = $('#harga_satuanObat'+id).text();
    var total_harganya = parseInt(harga_satuannya.replace(',', ''))*qtynya;
    $('#total_harga'+id).html(parseInt( total_harganya ).toLocaleString());
    hitung_total_harga();
  }

  function boleh_input_angka(evt, idcounter) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if ((charCode > 31 && (charCode < 48 || charCode > 57))|| charCode==13){
      return false;
    }
    return true;
  }

  function kurang_tabel(id){
    if(counter==1){
      alert("No more textbox to remove");
      return false;
    }   

    var idObat = $("#obat"+ id).attr('data-value');
    idxObat.pop(idObat);
    counterObat.pop(id);

    $("#trdata" + id).remove();
    hitung_total_harga();
  }


  function opensimpanmodal(id){
    
    var dataObatTerpakai = eachCell();

    document.getElementById('idSimpan').value = id;
    document.getElementById('keluhannya').value = $('#txtKeluhan').val(); 
    document.getElementById('tindakannya').value = $('#txtTindakan').val();
    document.getElementById('harga_layanannya').value = $('#txtHargaLayanan').val();
    document.getElementById('obatnya').value = dataObatTerpakai;
    
    if(dataObatTerpakai.length>1){
      $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type:"POST",
        url:"{{ route('klinik.cek.stok.obat') }}",
        data:{ obatnya:dataObatTerpakai },
        success:function(data){

          if(data=="" && validasi_form()==""){
            $("#modalSimpan").modal();
            pesan_error.style.display = "none";
            btn_simpan_history.style.display="inline";
            pesan_konfirmasi.style.display = "block";

          }
          else{
            $("#modalSimpan").modal();
            btn_simpan_history.style.display="none";
            pesan_konfirmasi.style.display = "none";
            pesan_error.style.display = "block";
            document.getElementById('pesan_error').innerHTML = data;
          }
        }
      });
    }
    else{
      if(validasi_form()==""){
        $("#modalSimpan").modal();
        pesan_error.style.display = "none";
        btn_simpan_history.style.display="inline";
        pesan_konfirmasi.style.display = "block";
      }
      else{

        btn_simpan_history.style.display="none";
        pesan_konfirmasi.style.display = "none";
        pesan_error.style.display = "block";
        document.getElementById('pesan_error').innerHTML = validasi_form();
      }
    }
    document.getElementById('totalnya').innerHTML = $('#lbl_total_harga').text();
  }

  function eachCell(){
    var idObatnya = [];
    var qtyObatnya = [];
    $('#tabelDataObat tr').each(function(index) {   
      if(index!=0){
        console.log($(":nth-child(2)", $(this))[0]);

        idObatnya.push($(":nth-child(2)", $(this)).attr('data-value'));
        qtyObatnya.push($(":nth-child(3)", $(this)).text());
      }
    });
    var hasil =  idObatnya.join(",") + ';' + qtyObatnya.join(",");
    return hasil;
  }

  function opendetailmodal(id, nama, ttl, alamat, telp)
  {
    document.getElementById('lblNamaDetail').innerHTML = nama;
    document.getElementById('lblTtlDetail').innerHTML = ttl;

    document.getElementById('lblAlamatDetail').innerHTML = alamat;
    document.getElementById('lblTelpDetail').innerHTML = telp;
  }

  function openicmodal(id, ic, nama, status)
  {
    var dpf1 = $('#input-file-now').dropify(
    {
     defaultFile: ic
   });
    dpf = dpf1.data('dropify');
    dpf.resetPreview();
    dpf.clearElement();
    dpf.settings.defaultFile = ic;
    dpf.destroy();
    dpf.init();  

    document.getElementById('lblNamaIc').innerHTML = nama;
  }
  function load(){
        window.loading_screen = window.pleaseWait({
        logo: '{{ asset("logo-sima-small.png") }}',
        backgroundColor: 'white',
        loadingHtml: '<div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div'
      });
  }

</script>
<script src="{{asset('price_jquery/jquery.priceformat.min.js')}}"></script>
<script src="{{asset('dropify/dist/js/dropify.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){

    $('#txtHargaLayanan').priceFormat({ 
      clearPrefix: true, 
      clearSuffix: true, 
      prefix: '', 
      centsLimit: 0, 
      thousandsSeparator: ',' 
    }); 

    // Basic
    $('.dropify').dropify();

    // Translated
    $('.dropify-fr').dropify({
      messages: {
        default: 'Glissez-déposez un fichier ici ou cliquez',
        replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
        remove:  'Supprimer',
        error:   'Désolé, le fichier trop volumineux'
      }
    });

    // Used events
    var drEvent = $('#input-file-events').dropify();

    drEvent.on('dropify.beforeClear', function(event, element){
      return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
    });

    drEvent.on('dropify.afterClear', function(event, element){
      alert('File deleted');
    });

    drEvent.on('dropify.errors', function(event, element){
      console.log('Has Errors');
    });

    var drDestroy = $('#input-file-to-destroy').dropify();
    drDestroy = drDestroy.data('dropify');
    $('#toggleDropify').on('click', function(e){
      e.preventDefault();
      if (drDestroy.isDropified()) {
        drDestroy.destroy();
      } else {
        drDestroy.init();
      }
    });

  });
</script>
@endsection