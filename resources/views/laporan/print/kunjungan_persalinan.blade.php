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
            <th style="width: 5%; text-align: center;">
              No
            </th>
            <th style="width: 40%; text-align: center;">
              Nama Ibu
            </th>
            <th style="width: 25%; text-align: center;">
              Umur (Tahun)
            </th>
            <th style="width: 25%; text-align: center;">
              Alamat
            </th>
            <th style="width: 25%; text-align: center;">
              Usia Kehamilan
            </th>
            <th style="width: 25%; text-align: center;">
              GR
            </th>
            <th style="width: 25%; text-align: center;">
              RT/RR
            </th>
            <th style="width: 25%; text-align: center;">
              Keterangan
            </th>
          </tr>
        </thead>
        <tbody>
          <tbody>
            <?php foreach($laporan as $key => $value) { ?>
              <tr>
                <td style="text-align: center;"><?php echo ($key+1); ?></td>
                <?php

                $id_layanan = $value->id_layanan_ibu_hamil;
                $data_layanan = DB::table('layanan_ibu_hamil')->where('id', $id_layanan)->get();
                $no_reg = $data_layanan[0]->no_registrasi;
                $data_ibu = DB::table('pasien_dewasa')->where('no_registrasi', $no_reg)->get();
                $id_ibu = $data_ibu[0]->id;
                // $data_ayah = DB::table('suami_pasien_dewasa')->where('id_pasien_dewasa', $id_ibu)->get();
                $riwayat_hamil = DB::table('riwayat_kehamilan')->where('id_layanan_ibu_hamil',  $data_layanan[0]->id)->get();
                $kepala_puskesmas = DB::table('kepala_puskesmas')->where('status_aktif',1)->get();

                if(!is_null($data_layanan[0]->rujukan_terencana) || $data_layanan[0]->rujukan_terencana != ""){
                    $warna = explode(";", $data_layanan[0]->rujukan_terencana);
                    $stringrr = "RR";

                    if($warna[0] != "#47d147"){
                        $stringrr = "RT";
                    }
                }
                ?>
                <td>{{$data_ibu[0]->nama}}</td>
                <td>{{floor((time() - strtotime($data_ibu[0]->tanggal_lahir)) / 31556926)}}</td>
                <td>{{$data_ibu[0]->alamat}}</td>
                <td>{{datediff('ww', date('d-m-Y', strtotime($tgl_awal)), date('d-m-Y', strtotime($data_layanan[0]->hpht)), false).' minggu'}}</td>
                <td>{{$riwayat_hamil[0]->kehamilan_ke}}</td>
                <td>{{$stringrr}}</td>
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

<?php

function datediff($interval, $datefrom, $dateto, $using_timestamps = false)
{
    /*
    $interval can be:
    yyyy - Number of full years
    q    - Number of full quarters
    m    - Number of full months
    y    - Difference between day numbers
           (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
    d    - Number of full days
    w    - Number of full weekdays
    ww   - Number of full weeks
    h    - Number of full hours
    n    - Number of full minutes
    s    - Number of full seconds (default)
    */

    if (!$using_timestamps) {
        $datefrom = strtotime($datefrom, 0);
        $dateto   = strtotime($dateto, 0);
    }

    $difference        = $dateto - $datefrom; // Difference in seconds
    $months_difference = 0;

    switch ($interval) {
        case 'yyyy': // Number of full years
            $years_difference = floor($difference / 31536000);
            if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
                $years_difference--;
            }

            if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
                $years_difference++;
            }

            $datediff = $years_difference;
        break;

        case "q": // Number of full quarters
            $quarters_difference = floor($difference / 8035200);

            while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                $months_difference++;
            }

            $quarters_difference--;
            $datediff = $quarters_difference;
        break;

        case "m": // Number of full months
            $months_difference = floor($difference / 2678400);

            while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                $months_difference++;
            }

            $months_difference--;

            $datediff = $months_difference;
        break;

        case 'y': // Difference between day numbers
            $datediff = date("z", $dateto) - date("z", $datefrom);
        break;

        case "d": // Number of full days
            $datediff = floor($difference / 86400);
        break;

        case "w": // Number of full weekdays
            $days_difference  = floor($difference / 86400);
            $weeks_difference = floor($days_difference / 7); // Complete weeks
            $first_day        = date("w", $datefrom);
            $days_remainder   = floor($days_difference % 7);
            $odd_days         = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?

            if ($odd_days > 7) { // Sunday
                $days_remainder--;
            }

            if ($odd_days > 6) { // Saturday
                $days_remainder--;
            }

            $datediff = ($weeks_difference * 5) + $days_remainder;
        break;

        case "ww": // Number of full weeks
            $datediff = floor($difference / 604800);
        break;

        case "h": // Number of full hours
            $datediff = floor($difference / 3600);
        break;

        case "n": // Number of full minutes
            $datediff = floor($difference / 60);
        break;

        default: // Number of full seconds (default)
            $datediff = $difference;
        break;
    }

    return $datediff;
}

?>