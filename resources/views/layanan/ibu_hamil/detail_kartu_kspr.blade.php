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
        <div class="form-group"> 
          <span id="pesan_konfirmasi">Apakah anda yakin ingin menyimpan data history ?</span>
        </div> 
        <div class="form-group"> 
          <button class="btn btn-default" data-dismiss="modal" aria-label="Close">Tutup</button> 
          <button class="btn btn-primary" id="btn_simpan_history" onclick="submitForm()">Simpan</button> 
        </div>
      </div> 
    </div> 
  </div> 
</div>
<!-- tutup modal simpan -->

<br>
<div class="container-fluid">
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
  <div class="row mb-2">
    <div class="col-sm-6">
      <h3>Histori KSPR</h3>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/ibu_hamil')}}">Pelayanan Ibu Hamil</a></li>
        <li class="breadcrumb-item active">Histori KSPR</li>
      </ol>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">KSPR</h3>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
            <div class="row">
              <div class="col-sm-12 col-md-6">
              </div>
            </div>
            <div class="form-group"></div>
            <div class="col-md-12">
              <div class="row">
                <FORM method="post" id="form_submit" action="<?php echo URL::to('/ibu_hamil/kspr')?>">
                  <?php if (count($header_kspr) < 4 && !$isLast): ?>
                    <div class="form-group">
                      <label style="font-weight: normal;">
                        <input type="checkbox" class="flat-red" id="chkLast" name="chkLast"> Triwulan Terakhir
                        <input type="hidden" id="lastrecord" name="lastrecord" value="0">
                      </label>
                    </div>
                  <?php endif ?>
                  
                  <table class="table table-bordered">
                    <tr>
                      <th>No.</th>
                      <th>Masalah/Faktor Risiko</th>
                      <th>SKOR</th>
                      <?php foreach ($header_kspr as $keyheader => $valueheader): ?>
                        <th>{{$valueheader['judul']}}</th>
                      <?php endforeach ?>

                      <?php if (count($header_kspr) < 4 && !$isLast): ?>
                        <th>Triwulan {{count($header_kspr)+1}}</th>
                      <?php endif ?>
                    </tr>
                    
                    <?php foreach ($arrData[0] as $key => $value): ?>
                      <tr>
                        <?php
                          if(strpos($value['text'], ':')){
                            $ex_text = explode(":", $value['text']);
                            $text = $ex_text[0].' : <BR>'.str_replace("~", "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp", $ex_text[1]);
                          }
                          else{
                            $text = str_replace("~", "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp", $value['text']);
                          }

                          $skor = explode(";", $value['opsi']);
                          if($value['urutan'] != 0){
                            $max_skor = $skor[1]; 
                          }
                          else{
                            $max_skor = 2;
                          }

                        ?>

                          <td><?php echo $value['urutan']; ?></td>
                          <td><?php echo $text; ?></td>
                          <td style="text-align: right;"><?php echo $max_skor; ?></td>
                          <td style="text-align: right;"><?php echo $value['skor_1']; ?></td>

                          <?php if (isset($value['skor_2'])): ?>
                              <td style="text-align: right;"><?php echo $value['skor_2']; ?></td>                            
                          <?php endif ?>

                          <?php if (isset($value['skor_3'])): ?>
                              <td style="text-align: right;"><?php echo $value['skor_3']; ?></td>                            
                          <?php endif ?>

                          <?php if (isset($value['skor_4'])): ?>
                              <td style="text-align: right;"><?php echo $value['skor_4']; ?></td>                            
                          <?php endif ?>

                          <?php if (count($header_kspr) < 4 && !$isLast): ?>
                            <td style="text-align: center;">
                              <?php if ($value['urutan'] == 0): ?>
                                <?php echo $max_skor; ?>
                              <?php else: ?>
                                <select class="form-control" id="cboOpsi<?php echo $key; ?>" name="cboOpsi[]" oninput="this.className = 'form-control'" onchange="sumTotal()">
                                  <?php foreach ($skor as $key_skor => $value_skor): ?>
                                      <?php if ($key_skor == 0): ?>
                                        <option value="<?php echo $value_skor; ?>" selected><?php echo $value_skor; ?></option>
                                      <?php else: ?>
                                        <option value="<?php echo $value_skor; ?>"><?php echo $value_skor; ?></option>
                                      <?php endif ?>
                                  <?php endforeach ?>
                                </select>
                              <?php endif ?>
                            </td>
                          <?php endif ?>

                      </tr>                   
                    <?php endforeach ?>
                      <tfoot>
                        <tr>
                          <td colspan="2"></td>
                          <td style="text-align: right;"><label>Total KSPR :</label></td>
                          <td style="text-align: right;"><label><?php echo $arrData[0][0]['total_skor_1']; ?></label></td>

                          <?php if (isset($arrData[0][0]['total_skor_2'])): ?>
                              <td style="text-align: right;"><label><?php echo $arrData[0][0]['total_skor_2']; ?></label></td>
                          <?php endif ?>

                          <?php if (isset($arrData[0][0]['total_skor_3'])): ?>
                              <td style="text-align: right;"><label><?php echo $arrData[0][0]['total_skor_3']; ?></label></td>
                          <?php endif ?>

                          <?php if (isset($arrData[0][0]['total_skor_4'])): ?>
                              <td style="text-align: right;"><label><?php echo $arrData[0][0]['total_skor_4']; ?></label></td>
                          <?php endif ?>

                          <?php if (count($header_kspr) < 4 && !$isLast): ?>
                            <td style="text-align: right;"><label id="total_kspr">2</label></td>
                          <?php endif ?>

                        </tr>
                      </tfoot>
                    
                  </table>

                  <table class="table table-bordered" id="tablerujukan" style="display: none;">
                    <tr>
                      <th colspan="4" style="text-align: center;">KEHAMILAN</th>
                      <th colspan="5" style="text-align: center;">PERSALINAN DENGAN RESIKO</th>
                    </tr>
                    <tr>
                      <th rowspan="2" style="text-align: center;">JML. SKOR</th>
                      <th rowspan="2" style="text-align: center;">KEL. SKOR</th>
                      <th rowspan="2" style="text-align: center;">PERAWATAN</th>
                      <th rowspan="2" style="text-align: center;">RUJUKAN</th>
                      <th rowspan="2" style="text-align: center;">TEMPAT</th>
                      <th rowspan="2" style="text-align: center;">PENOLONG</th>
                      <th colspan="3" style="text-align: center;">RUJUKAN</th>
                    </tr>
                    <tr>
                      <th>RDB</th>
                      <th>RDR</th>
                      <th>RTW</th>
                    </tr>

                    <?php if (count($header_kspr) < 4 && !$isLast): ?>
                      <tr id="traman" style="display: none;">
                        <td style="background-color: #47d147;">2</td>
                        <td style="background-color: #47d147;">KRR</td>
                        <td style="background-color: #47d147;">BIDAN</td>
                        <td style="background-color: #47d147;">TIDAK DIRUJUK</td>
                        <td style="background-color: #47d147;">RUMAH POLINDES</td>
                        <td style="background-color: #47d147;">BIDAN</td>
                        <td style="background-color: #47d147; text-align: center;"><input type="radio" name="rdoRujukan" id="rdoRujukanHijau1" value="rdb-hijau"></input></td>
                        <td style="background-color: #47d147; text-align: center;"><input type="radio" name="rdoRujukan" id="rdoRujukanHijau2" value="rdr-hijau"></input></td>
                        <td style="background-color: #47d147; text-align: center;"><input type="radio" name="rdoRujukan" id="rdoRujukanHijau3" value="rtw-hijau"></input></td>
                      </tr>

                      <tr id="trtengah" style="display: none;">
                        <td style="background-color: yellow;">6-10</td>
                        <td style="background-color: yellow;">KRT</td>
                        <td style="background-color: yellow;">BIDAN DOKTER</td>
                        <td style="background-color: yellow;">BIDAN PKM</td>
                        <td style="background-color: yellow;">POLINDES PKM/RS</td>
                        <td style="background-color: yellow;">BIDAN DOKTER</td>
                        <td style="background-color: yellow; text-align: center;"><input type="radio" name="rdoRujukan" id="rdoRujukanKuning1" value="rdb-kuning"></input></td>
                        <td style="background-color: yellow; text-align: center;"><input type="radio" name="rdoRujukan" id="rdoRujukanKuning2" value="rdr-kuning"></input></td>
                        <td style="background-color: yellow; text-align: center;"><input type="radio" name="rdoRujukan" id="rdoRujukanKuning3" value="rtw-kuning"></input></td>
                      </tr>

                      <tr id="trkritis" style="display: none;">
                        <td style="background-color: red;">≥ 12</td>
                        <td style="background-color: red;">KRST</td>
                        <td style="background-color: red;">DOKTER</td>
                        <td style="background-color: red;">RUMAH SAKIT</td>
                        <td style="background-color: red;">RUMAH SAKIT</td>
                        <td style="background-color: red;">DOKTER</td>
                        <td style="background-color: red; text-align: center;"><input type="radio" name="rdoRujukan" id="rdoRujukanMerah1" value="rdb-merah"></input></td>
                        <td style="background-color: red; text-align: center;"><input type="radio" name="rdoRujukan" id="rdoRujukanMerah2" value="rdr-merah"></input></td>
                        <td style="background-color: red; text-align: center;"><input type="radio" name="rdoRujukan" id="rdoRujukanMerah3" value="rtw-merah"></input></td>
                      </tr>
                    <?php else: ?>
                      <tr id="traman" style="display: none;">
                        <td style="background-color: #47d147;">2</td>
                        <td style="background-color: #47d147;">KRR</td>
                        <td style="background-color: #47d147;">BIDAN</td>
                        <td style="background-color: #47d147;">TIDAK DIRUJUK</td>
                        <td style="background-color: #47d147;">RUMAH POLINDES</td>
                        <td style="background-color: #47d147;">BIDAN</td>
                        <td style="background-color: #47d147; text-align: center;"><li class="fa fa-check-circle" id="rdb-hijau" style="display: none;"></li></td>
                        <td style="background-color: #47d147; text-align: center;"><li class="fa fa-check-circle" id="rdr-hijau" style="display: none;"></li></td>
                        <td style="background-color: #47d147; text-align: center;"><li class="fa fa-check-circle" id="rtw-hijau" style="display: none;"></li></td>
                      </tr>

                      <tr id="trtengah" style="display: none;">
                        <td style="background-color: yellow;">6-10</td>
                        <td style="background-color: yellow;">KRT</td>
                        <td style="background-color: yellow;">BIDAN DOKTER</td>
                        <td style="background-color: yellow;">BIDAN PKM</td>
                        <td style="background-color: yellow;">POLINDES PKM/RS</td>
                        <td style="background-color: yellow;">BIDAN DOKTER</td>
                        <td style="background-color: yellow; text-align: center;"><li class="fa fa-check-circle" id="rdb-kuning" style="display: none;"></li></td>
                        <td style="background-color: yellow; text-align: center;"><li class="fa fa-check-circle" id="rdr-kuning" style="display: none;"></li></td>
                        <td style="background-color: yellow; text-align: center;"><li class="fa fa-check-circle" id="rtw-kuning" style="display: none;"></li></td>
                      </tr>

                      <tr id="trkritis" style="display: none;">
                        <td style="background-color: red;">≥ 12</td>
                        <td style="background-color: red;">KRST</td>
                        <td style="background-color: red;">DOKTER</td>
                        <td style="background-color: red;">RUMAH SAKIT</td>
                        <td style="background-color: red;">RUMAH SAKIT</td>
                        <td style="background-color: red;">DOKTER</td>
                        <td style="background-color: red; text-align: center;"><li class="fa fa-check-circle" id="rdb-merah" style="display: none;"></li></td>
                        <td style="background-color: red; text-align: center;"><li class="fa fa-check-circle" id="rdr-merah" style="display: none;"></li></td>
                        <td style="background-color: red; text-align: center;"><li class="fa fa-check-circle" id="rtw-merah" style="display: none;"></li></td>
                      </tr>
                    <?php endif ?>
                  </table>

                  <br>
                  <?php if (count($header_kspr) < 4 && !$isLast): ?>
                    <div>
                      <div style="float:right;">
                        <input type="hidden" id="id_layanan_ibu_hamil" name="id_layanan_ibu_hamil" value="{{$header_kspr[0]['id_layanan_ibu_hamil']}}"></input>
                        <input type="hidden" id="grandtotalkspr" name="grandtotalkspr" value="2"></input>
                        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                        <button type="button" class="btn btn-primary" id="btnSubmit" data-toggle="modal" data-target="#modalSimpan">Simpan</button>
                      </div>
                    </div>
                  <?php endif ?>

                </FORM>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@section('add_js')
<script type="text/javascript">
  $(document).ready(function(){
    $('input').on('ifChecked', function(event){
      document.getElementById('lastrecord').value = "1";
    });

    $('input').on('ifUnchecked', function(event){
      document.getElementById('lastrecord').value = "0";
    });

    var rujukan_terencana = <?php echo "'".$header_kspr[0]['rujukan_terencana']."'"; ?>;
    if(rujukan_terencana != ""){
      document.getElementById("tablerujukan").style.display = "contents";
      var splitrujukan = rujukan_terencana.split(";");
      <?php if (count($header_kspr) < 4 && !$isLast): ?>
          $('input[name="rdoRujukan"]').each(function () {
            if($(this).attr('value') == splitrujukan[1]){
              var id = $(this).attr('id');
              document.getElementById(id).checked = true;
            }
          });
      <?php else: ?>
          document.getElementById(splitrujukan[1]).style.display = "block";
      <?php endif ?>

      if(splitrujukan[0] == "yellow"){
        document.getElementById("trtengah").style.display = "contents";
      }
      else if(splitrujukan[0] == "red"){
        document.getElementById("trkritis").style.display = "contents";
      }
      else{
        document.getElementById("traman").style.display = "contents";
      }
      
    }
  });

  function sumTotal(){
      var select = document.getElementsByName("cboOpsi[]");
      var totalkspr = 2;
      for(var i = 0; i < select.length; i++){
        totalkspr += parseInt(select[i].value);
      }

      var idx = "total_kspr";
      var idx_total = "grandtotalkspr";
      document.getElementById(idx).innerHTML = totalkspr;
      document.getElementById(idx_total).value = totalkspr;

      if(totalkspr > 0){
        document.getElementById("tablerujukan").style.display = "contents";

        if(totalkspr >= 2 && totalkspr <= 5){
          document.getElementById("traman").style.display = "contents";
          document.getElementById("trtengah").style.display = "none";
          document.getElementById("trkritis").style.display = "none";
          document.getElementById("rdoRujukanHijau1").checked = true;
        }
        else if(totalkspr >= 6 && totalkspr <= 10){
          document.getElementById("trtengah").style.display = "contents";
          document.getElementById("traman").style.display = "none";
          document.getElementById("trkritis").style.display = "none";
          document.getElementById("rdoRujukanKuning1").checked = true;
        }
        else{
          document.getElementById("trkritis").style.display = "contents";
          document.getElementById("traman").style.display = "none";
          document.getElementById("trtengah").style.display = "none";
          document.getElementById("rdoRujukanMerah1").checked = true;
        }
      }
  }

  function submitForm(){
    document.getElementById("form_submit").submit();
    window.loading_screen = window.pleaseWait({
        logo: '{{ asset("logo-sima-small.png") }}',
        backgroundColor: 'white',
        loadingHtml: '<div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div'
      });
  }
</script>
@endsection
@endsection