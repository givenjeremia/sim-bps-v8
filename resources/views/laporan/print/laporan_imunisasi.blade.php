<!DOCTYPE html>
<html>
<style type="text/css">
table, tr, th {border-collapse:collapse; width:310px; border: solid 1px black;}
table td {border:solid 1px black; width:100px; word-wrap:break-word; font-size: 20px;}
table th {font-size: 15px;}

</style>
<body>

  <div class="box box-info">
    <br>
    <br>
    <h5 style="text-align: center; margin-top: -45;"><?php echo $judul; ?></h5>
    <hr>

    <div class="box-body">
      <table class="table table-bordered table-striped" id="example1" align="center">
        <thead>
          <tr role="row">
            <th rowspan="2" style="width: 5%; text-align: center;">
              NO
            </th>
            <th rowspan="2" style="width: 40%; text-align: center;">
              NAMA
            </th>
            <th rowspan="2" style="width: 25%; text-align: center;">
              TGL.LAHIR
            </th>
            <th rowspan="2" style="width: 25%; text-align: center;">
              L/P
            </th>
            <th rowspan="2" style="width: 25%; text-align: center;">
              ALAMAT
            </th>
            <th rowspan="2" style="width: 25%; text-align: center;">
              KELURAHAN
            </th>
            <th rowspan="2" style="width: 25%; text-align: center;">
              PUSKESMAS
            </th>
            <th rowspan="2" style="width: 25%; text-align: center;">
              ASAL WILAYAH
            </th>
            <?php $jumlah_header= 0; foreach($header_layanan_imunisasi as $key => $value) { 
              $jumlah_header+= 1;} ?>
            <th colspan="{{$jumlah_header}}" style="width: auto; text-align: center;">
              BAYI
            </th>
          </tr>
          <tr role="row">
            <?php foreach($header_layanan_imunisasi as $key => $value) { ?>
            <th style="width: 25%; text-align: center;">
              {{$value->nama}}
            </th>
            <?php } ?>
          </tr>
        </thead>
        <thead>
          <tr role="row">
            <th rowspan="2" style="width: 5%; text-align: center;">
              1
            </th>
            <th rowspan="2" style="width: 40%; text-align: center;">
              2
            </th>
            <th rowspan="2" style="width: 25%; text-align: center;">
              3
            </th>
            <th rowspan="2" style="width: 25%; text-align: center;">
              4
            </th>
            <th rowspan="2" style="width: 25%; text-align: center;">
              5
            </th>
            <th rowspan="2" style="width: 25%; text-align: center;">
              6
            </th>
            <th rowspan="2" style="width: 25%; text-align: center;">
              7
            </th>
            <th rowspan="2" style="width: 25%; text-align: center;">
              8
            </th>
            <?php $jumlah_header= 0; foreach($header_layanan_imunisasi as $key => $value) { 
              $jumlah_header+= 1;} ?>
          </tr>
          <tr role="row">
            <?php $bantu = 9; foreach($header_layanan_imunisasi as $key => $value) { ?>
            <th style="width: 25%; text-align: center;">
              {{$bantu+$key}}
            </th>
            <?php } ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach($pasien_bayi as $key => $value) { ?>
            <tr>
              <td style="text-align: center;"><?php echo ($key+1); ?></td>
              <td style="text-align: left;">{{$value->nama}}</td>
              <td style="text-align: center;">{{date('d-m-Y', strtotime($value->tanggal_lahir))}}</td>
              <td style="text-align: center; width:5%;">{{$value->kelamin}}</td>
              <td style="text-align: left;">{{$value->alamat}}</td>
              <td style="text-align: left;">{{$value->kelurahan}}</td>
              <td style="text-align: left;">{{$puskesmas[0]->kelurahan}}</td>
              <td style="text-align: left;">{{$value->asal_wilayah}}</td>
              <?php foreach($header_layanan_imunisasi as $key => $value2) { 
                $tanggal = DB::select("SELECT * FROM layanan_imunisasi li, imunisasi_jenis_layanan ijl WHERE li.id = ijl.id_layanan_imuniasasi AND ijl.status_imunisasi = 1 AND li.no_registrasi='".$value->no_registrasi."' AND ijl.id_jenis_layanan=".$value2->id." AND ijl.tanggal>='".$tanggal_bawah." 00:00:00' AND ijl.tanggal<='".$tanggal_atas." 23:59:59'");
                if($tanggal)
                { ?>
                  <td style="text-align: center;">{{date('d-m-Y', strtotime($tanggal[0]->tanggal))}}</td>
                <?php } else{
                  ?>
                    <td style="text-align: center;"></td>
                  <?php
                }
              } ?>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <BR>
    <?php $kepala_puskesmas = DB::table('kepala_puskesmas')->where('status_aktif',1)->get(); ?>
    <div style="float: right;  width: 30%;">
        <br>
        <div style="text-align: center">
            Yang membuat Laporan
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div style="text-align: center">
            Dsk. P. Lita Anggraeni, A.Md.Keb
        </div>
    </div>
    <div style="float: right; width: 30%; ">
        <div style="text-align: center">
            Mengetahui,
            <br>
            Kepala Puskesmas {{$kepala_puskesmas[0]->kelurahan}}
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div style="text-align: center">
            <span style="text-decoration: underline;">{{$kepala_puskesmas[0]->nama}}</span>
            <br>
            {{$kepala_puskesmas[0]->nip}}
        </div>
    </div>

  </div>

  <script>
    document.window = function() {
      $("#example1").DataTable();
    }
  </script>
</body>
</html>