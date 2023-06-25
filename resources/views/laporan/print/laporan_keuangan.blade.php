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
              Jenis Layanan
            </th>
            <th style="width: 25%; text-align: center;">
              Total Harga
            </th>
            <th style="width: 25%; text-align: center;">
              Harga Obat
            </th>
            <th style="width: 25%; text-align: center;">
              Harga Layanan
            </th>
          </tr>
        </thead>
        <tbody>
          <tbody>
            <?php foreach($laporan as $key => $value) { ?>
              <tr>
                <td style="text-align: center;"><?php echo ($key+1); ?></td>
                <?php
                  $jenis = '';
                  if($value->jenis_layanan == 'KLINIK')
                    $jenis = 'KLINIK';
                  if($value->jenis_layanan == '0')
                    $jenis = 'KB';
                  if($value->jenis_layanan == '1')
                    $jenis = 'IMUNISASI PAKETAN';
                  if($value->jenis_layanan == '2')
                    $jenis = 'IMUNISASI SATUAN';
                  if($value->jenis_layanan == '3')
                    $jenis = 'IBU HAMIL';
                  if($value->jenis_layanan == '4')
                    $jenis = 'KUNJUNGAN ULANG IBU HAMIL';
                  if($value->jenis_layanan == '5')
                    $jenis = 'PERSALINAN';
                  if($value->jenis_layanan == '6')
                    $jenis = 'NIFAS';
                ?>
                <td>
                {{$jenis}}
                </td>
                <td style="text-align: right;"><?php echo number_format($value->total_harga,0,",","."); ?></td>
                <td style="text-align: right;"><?php echo number_format($value->harga_obat,0,",","."); ?></td>
                <td style="text-align: right;"><?php echo number_format($value->harga_layanan,0,",","."); ?></td>
              </tr>
            <?php } ?>
          </tbody>
          <tfoot>
              <tr>
                <td style="text-align: right;" colspan="2"><label>Total :</label></td>
                <td style="text-align: right;">{{"Rp. ".number_format($total_totharga,0,",",".").",-"}}</td>
                <td style="text-align: right;">{{"Rp. ".number_format($total_obat,0,",",".").",-"}}</td>
                <td style="text-align: right;">{{"Rp. ".number_format($total_keuntungan,0,",",".").",-"}}</td>
              </tr>
          </tfoot>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    document.window = function() {
      $("#example1").DataTable();
    }
  </script>
</body>
</html>