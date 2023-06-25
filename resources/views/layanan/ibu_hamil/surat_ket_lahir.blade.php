<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('logo-sima.png') }}">

    <title>SIM BPS</title>

    <style>
        #content{
            font-size: 16px;
        }
        .header {
            height:100px;
            width:100%;
            font-size: 12px;
        }
        .kolom1 {
            height:100px;
            width:20%;
            float:left;
        }
        .kolom2 {
            height:100px;
            width:60%;
            float:left;
            margin-left: -5%;   
        }
        .kolom3 {
            height:100px;
            width:20%;
            float:right;     
        }

    </style>
</head>
<body id="app-layout">
    <div class="header">
        <div class="kolom1"> 
            <ul>
                <img src="{{Asset('ic_img/ibi.png')}}" height="70" width="70">
            </ul>
        </div>
        <div class="kolom2" style="text-align: center;"> 
            <ul>
                <h1>BIDAN PRAKTEK MANDIRI Lita Anggraeni, A.Md.Keb</h1>
                <font size="5">NO SIPB: 503.446/110/SIPB/436.7.2/2017</font>
                <BR>
                <font size="5">Jl. Gunung Anyar Jaya I no 4, Surabaya</font>
            </ul>
        </div>

        <div class="kolom3">
            <img src="{{Asset('ic_img/bidan_delima.jpg')}}" height="70" width="70">
        </div>
    </div>
    
    <hr>
    <div id="content">
        <h3 style="text-align: center;"><span style="text-decoration: underline;"> SURAT KETERANGAN </span> <br> ( KELAHIRAN )</h3>
        <br>

        <div style="text-align: center">
            Yang bertanda tangan dibawah ini kami :
            <BR>
            <span style="text-decoration: underline;">Dsk. P. Lita Anggraeni, A.Md.Keb</span>
        </div>
        <br>
        <div style="margin-left: 10%;">
            <div style="text-align: left">
                Nama &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:  Ny. {{$data['surat_keterangan_lahir'][0]->nama_ibu}} &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp; Tn. {{$data['surat_keterangan_lahir'][0]->nama_ayah}} 
            </div>
            <BR>
            <div style="text-align: left">
                Alamat &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;:  {{$data['surat_keterangan_lahir'][0]->alamat}} 
            </div>
            <BR>
            <div style="text-align: left">
                Pada Hari &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;: {{$data['surat_keterangan_lahir'][0]->pada_hari}} 
            </div>
            <BR>
            <div style="text-align: left">
                Tanggal &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp; : {{date('d-m-Y ', strtotime($data['surat_keterangan_lahir'][0]->tanggal)) }} &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp; Jam : {{date('H:i:s', strtotime($data['surat_keterangan_lahir'][0]->tanggal)) }} 
            </div>
            <BR>
            <div style="text-align: left">
                Telah melahirkan seorang anak Laki-laki / Perempuan yang ke :  {{$data['surat_keterangan_lahir'][0]->anak_ke}} 
            </div>
            <BR>
            <div style="text-align: left">
                Berat Badan&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;:  {{$data['surat_keterangan_lahir'][0]->berat_badan ." gram"}}, &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp; panjang badan :  {{$data['surat_keterangan_lahir'][0]->panjang_badan ." cm"}} 
            </div>
            <BR>
            <div style="text-align: left">
                Diberi Nama &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;: {{$data['surat_keterangan_lahir'][0]->diberi_nama}} 
            </div>
            <BR>
        </div>
        <br>
        <div style="margin-left: 10%;">
            
        </div>
        <BR><BR>
        <BR><BR>
        <div style="text-align:right; margin-right: 9%">
            Surabaya, <?php echo date('d M Y'); ?>
        </div>
        <BR>
        <div style="text-align: right;">
            <div style="margin-right: 16%">
                Bidan
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div style="margin-right: 5%">
                Dsk. P. Lita Anggraeni, A.Md.Keb
            </div>
        </div>
    </div>
</body>
</html>