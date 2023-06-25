<!DOCTYPE html>
<html>
<style type="text/css">
  table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
  }
</style>
<body>

  <div class="box box-info">
    <br>
    <br>
    <h3 style="text-align: center; margin-top: -45;"><?php echo $judul; ?></h3>
    <hr>

    <div class="box-body">
      <table class="table table-bordered table-striped" id="example1" align="center">
        <thead>
          <tr role="row">
            <th style="width: 5%; text-align: center;" rowspan="2">
              No
            </th>
            <th style="width: 40%; text-align: center;" rowspan="2">
              Tgl Kunjung
            </th>
            <th style="width: 40%; text-align: center;" colspan="2">
              Nama
            </th>
            <th style="width: 25%; text-align: center;" rowspan="2">
              Umur (Tahun)
            </th>
            <th style="width: 25%; text-align: center;" rowspan="2">
              Alamat
            </th>
            <th style="width: 40%; text-align: center;" colspan="2">
              Jenis KB
            </th>
            <th style="width: 25%; text-align: center;" rowspan="2">
              JML Anak
            </th>
            <th style="width: 25%; text-align: center;" rowspan="2">
              GAKIN NON GAKIN
            </th>
            <th style="width: 25%; text-align: center;" rowspan="2">
              Jenis KB ALKON
            </th>
            <th style="width: 25%; text-align: center;" rowspan="2">
              Penyakit Kronis
            </th>
            <th style="width: 25%; text-align: center;" rowspan="2">
              PUS 4T
            </th>
            <th style="width: 40%; text-align: center;" colspan="2">
              Pasca/Setelah
            </th>
            <th style="width: 25%; text-align: center;" rowspan="2">
              LILA < 23cm 
            </th>
            <th style="width: 25%; text-align: center;" rowspan="2">
              Pus ANEMIA
            </th>
            <th style="width: 25%; text-align: center;" rowspan="2">
              IMS/Peny Kelamin
            </th>
            <th style="width: 25%; text-align: center;" rowspan="2">
              Efek Samping
            </th>
            <th style="width: 25%; text-align: center;" rowspan="2">
              Kegagalan
            </th>
            <th style="width: 25%; text-align: center;" rowspan="2">
              DO
            </th>
          </tr>
          <tr role="row">
            <th style="width: 40%; text-align: center;">
               Ibu
            </th>
            <th style="width: 40%; text-align: center;">
               Ayah
            </th>
            <th style="width: 25%; text-align: center;">
              B
            </th>
            <th style="width: 25%; text-align: center;">
              L
            </th>
            <th style="width: 25%; text-align: center;">
              Lahir 
            </th>
            <th style="width: 25%; text-align: center;">
              Abortus 
            </th>
            
          </tr>
        </thead>
        <tbody>
          <tbody>
            <?php $kepala_puskesmas = DB::table('kepala_puskesmas')->where('status_aktif',1)->get(); ?>
            <?php foreach($laporan as $key => $value) { ?>
              <tr>
                <td style="text-align: center;"><?php echo ($key+1); ?></td>
                <?php

                $no_reg = $value->no_registrasi_pasien;
                $data_ibu = DB::table('pasien_dewasa')->where('no_registrasi', $no_reg)->get();
                $id_ibu = $data_ibu[0]->id;
                $data_ayah = DB::table('suami_pasien_dewasa')->where('id_pasien_dewasa', $id_ibu)->get();
                if(count($data_ayah) > 0){
                    $nama_ayah = $data_ayah[0]->nama;
                }
                else{
                    $nama_ayah = "";
                }
                
                $layanan = DB::table('layanan')->where('id',$value->id_jenis_layanan)->get();

                ?>
                <td>{{date('d-m-Y', strtotime($value->tgl_status_peserta))}}</td>
                <td>{{$data_ibu[0]->nama}}</td>
                <td>{{$nama_ayah}}</td>
                <td>{{floor((time() - strtotime($data_ibu[0]->tanggal_lahir)) / 31556926)}}</td>
                <td>{{$data_ibu[0]->alamat}}</td>
                <td></td>
                <td></td>
                <td>{{$value->jumlah_anak_laki+$value->jumlah_anak_perempuan}}</td>
                <td></td>
                <td>{{$layanan[0]->nama}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            <?php } ?>
          </tbody>
        </tbody>
      </table>
    </div>
    <BR>

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