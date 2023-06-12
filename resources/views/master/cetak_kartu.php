<!DOCTYPE html>
<html>
<head>
 <title>Kartu Nama</title>
 <style type="text/css">
  body {
   font-family: Arial;
  }
  td {
   padding: 10px;
  }
  table {
   margin: auto;
   margin-top: 90px;
   border: 2px solid white;
   padding: 10px;
  }

 </style>
</head>
<body bgcolor="#181a1c">
 <table border="0" width="600" cellpadding="0" cellspacing="0">
  <tr bgcolor="#DCDCDC">
   <td colspan="3" align="center"><img style="margin-top:-10px;" width="84.7%" height="130" src="<?php echo asset('ic_img/header_kartu_fix.png') ?>"></td>
  </tr>
  <tr bgcolor="#DCDCDC">
   <td width="150">Nama Lengkap</td>
   <td width="250">: <?php echo $bayi[0]->nama ?></td>
  </tr>
  <tr bgcolor="#DCDCDC">
   <td>Tgl. Bergabung</td>
   <td>: <?php echo date("d-m-Y",strtotime($bayi[0]->created_at))?></td>
  </tr>
  <tr bgcolor="#DCDCDC">
   <td>No. Registrasi</td>
   <td>: <?php echo $bayi[0]->no_registrasi ?></td>
  </tr>
  <tr bgcolor="#DCDCDC">
   <td></td>
   <td></td>
  </tr>
  <tr>
   <td colspan="3" align="center"><img style="margin-top:-10px;" width="84.7%" height="40" src="<?php echo asset('ic_img/footer_kartu.png') ?>"></td>
  </tr>
 </table> 

</body>
</html>