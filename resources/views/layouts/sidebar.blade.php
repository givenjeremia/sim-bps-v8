<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{url('/')}}" class="{{Request::is('/') ? 'active': null}} nav-link">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview {{Request::segment(1) === 'p_imunisasi_terlewati' || Request::segment(1) === 'p_imunisasi_hari_ini' || Request::segment(1) === 'p_imunisasi_akan_datang' ? 'menu-open active': null}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-exclamation-circle"></i>
              <p>
                Pengingat Imunisasi
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color:#282828;">
              <li class="nav-item">
                <a href="{{url('/p_imunisasi_terlewati')}}" class="{{Request::segment(1) === 'p_imunisasi_terlewati' ? 'active': null}} nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Sudah Terlewati <span class="badge badge-danger right" id="notif_terlewati">0</span></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/p_imunisasi_hari_ini')}}" class="{{Request::segment(1) === 'p_imunisasi_hari_ini' ? 'active': null}} nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Hari Ini <span class="badge badge-warning right" id="notif_hari_ini">0</span></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/p_imunisasi_akan_datang')}}" class="{{Request::segment(1) === 'p_imunisasi_akan_datang' ? 'active': null}} nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Yang Akan Datang <span class="badge badge-info right" id="notif_akan_datang">0</span></p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{Request::segment(1) === 'p_obat_expired' || Request::segment(1) === 'p_obat_stok' ? 'menu-open active': null}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-exclamation-circle"></i>
              <p>
                Pengingat Obat
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color:#282828;">
              <li class="nav-item">
                <a href="{{url('/p_obat_expired')}}" class="{{Request::segment(1) === 'p_obat_expired' ? 'active': null}} nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Expired <span class="badge badge-danger right" id="notif_expired">0</span></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/p_obat_stok')}}" class="{{Request::segment(1) === 'p_obat_stok' ? 'active': null}} nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Stok<span class="badge badge-warning right" id="notif_stok">0</span></p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{Request::segment(1) === 'layanan-klinik' || Request::segment(1) === 'layanan-ibu-hamil' || Request::segment(1) === 'layanan-kb' || Request::segment(1) === 'layanan-imunisasi' ? 'menu-open active': null}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-medkit"></i>
              <p>
                Pelayanan
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color:#282828;">
              <li class="nav-item">
                <a href="{{url('/layanan-klinik')}}" class="{{Request::segment(1) === 'layanan-klinik' ? 'active': null}} nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Klinik</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/layanan-ibu-hamil')}}" class="{{Request::segment(1) === 'layanan-ibu-hamil' ? 'active': null}} nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Ibu Hamil</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/layanan-kb')}}" class="{{Request::segment(1) === 'layanan-kb' ? 'active': null}} nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>KB</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/layanan-imunisasi')}}" class="{{Request::segment(1) === 'layanan-imunisasi' ? 'active': null}} nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Bayi Imunisasi</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview {{Request::segment(1) === 'pasien-dewasa' || Request::segment(1) === 'pasien-bayi' || Request::segment(1) === 'jenis-layanan' || Request::segment(1) === 'obat' || Request::segment(1) === 'kepala-puskesmas' || Request::segment(1) === 'karyawan' ? 'menu-open active': null}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-folder-o"></i>
              <p>
                Master Data
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color:#282828;">
              <li class="nav-item">
                <a href="{{url('/pasien-dewasa')}}" class="{{Request::segment(1) === 'pasien-dewasa' ? 'active': null}} nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Pasien Dewasa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/pasien-bayi')}}" class="{{Request::segment(1) === 'pasien-bayi' ? 'active': null}} nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Pasien Bayi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/jenis-layanan')}}" class="{{Request::segment(1) === 'jenis-pelayanan' ? 'active': null}} nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Jenis Pelayanan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/obat')}}" class="{{Request::segment(1) === 'obat' ? 'active': null}} nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Obat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/kepala-puskesmas')}}" class="{{Request::segment(1) === 'kepala-puskesmas' ? 'active': null}} nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Kepala Puskesmas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/karyawan')}}" class="{{Request::segment(1) === 'karyawan' ? 'active': null}} nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Karyawan</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview {{Request::segment(1) === 'laporan_keuangan' || Request::segment(1) === 'laporan_kunjungan_ibu_Hamil' || Request::segment(1) === 'laporan_kunjungan_Persalinan' || Request::segment(1) === 'laporan_kunjungan_kb' || Request::segment(1) === 'laporan_imunisasi' ? 'menu-open active': null}}">

            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-book"></i>
              <p>
                Laporan
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="background-color:#282828;">
              <li class="nav-item">
                <a href="{{url('/laporan_keuangan')}}" class="{{Request::segment(1) === 'laporan_keuangan' ? 'active': null}} nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Laporan Keuangan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/laporan_kunjungan_ibu_Hamil')}}" class="{{Request::segment(1) === 'laporan_kunjungan_ibu_Hamil' ? 'active': null}} nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Laporan Kunjungan Ibu Hamil</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/laporan_kunjungan_persalinan')}}" class="{{Request::segment(1) === 'laporan_kunjungan_Persalinan' ? 'active': null}} nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Laporan Kunjungan Persalinan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/laporan_kunjungan_kb')}}" class="{{Request::segment(1) === 'laporan_kunjungan_kb' ? 'active': null}} nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Laporan Kunjungan KB</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/laporan_imunisasi')}}" class="{{Request::segment(1) === 'laporan_imunisasi' ? 'active': null}} nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Laporan Hasil Imunisasi</p>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
<!-- /.sidebar -->