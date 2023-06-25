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
        <br>
        <br>    
        <br>
        <br>
        <h3 style="text-align: center; margin-top: -45; text-decoration: underline;">SURAT KETERANGAN SAKIT</h3>
        <br>

        <div style="margin-left: 10%;">
            Yang bertanda tangan dibawah ini adalah <b>BIDAN PRAKTEK SWASTA</b> menerangkan bahwa:
        </div>
        <br>
        <div style="margin-left: 10%;">
            <div style="text-align: left">
                Nama &emsp;&emsp;&emsp;&ensp;: {{$data['nama']}}
            </div>
            <div style="text-align: left">
                Umur&emsp;&emsp;&emsp;&emsp;: {{$data['umur']}} Tahun
            </div>
            <div style="text-align: left">
                Pekerjaan &emsp;&ensp;: {{$data['pekerjaan']}}
            </div>
            <div style="text-align: left">
                Alamat &emsp;&emsp;&emsp;: {{$data['alamat']}}
            </div>
        </div>
        <br>
        <div style="margin-left: 10%;">
            Perlu istirahat selama <b>{{$data['lama_istirahat']}}</b> dikarenakan sakit, mulai tanggal <b>{{$data['tanggal_awal']}} s/d {{$data['tanggal_akhir']}}</b>.<br> Mohon yang berkepentingan maklum adanya
        </div>
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