<nav class="navbar navbar-default">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand text-center" href="?page=home"><img src="images/logo-kemenag.png"></a>
		</div> <!-- /.navbar-header -->

		<div class="collapse navbar-collapse" id="#bs-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Master Data <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="?page=m_direktori">Data Direktori</a></li>
						<li><a href="?page=m_jabatan">Data Jabatan</a></li>
						<li><a href="?page=m_pegawai">Data Pegawai</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="?page=link_direktori">Link Direktori</a></li>
						<li><a href="?page=link_zona">Link Zona</a></li>
						<li><a href="?page=link_maklumat">Link Maklumat</a></li>
						<li><a href="?page=link_masyarakat">Link Masyarakat</a></li>
						<li><a href="?page=link_pengaduan">Link Pengaduan</a></li>
						<li><a href="?page=link_survey">Link Survey</a></li>
						<li><a href="?page=link_dampak">Link Dampak</a></li>
						<li><a href="?page=link_inovasi">Link Inovasi</a></li>
						<li><a href="?page=m_masa_kpl">Masa Kepala Kantor</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="?page=m_struktur_org">Struktur Organisasi</a></li>
					</ul>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Posting <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="?page=m_berita">Berita</a></li>
						<li><a href="?page=m_layananpublik">Layanan Publik</a></li>
						<li><a href="?page=carousel">Carousel</a></li>
						<li><a href="?page=tugasfungsi">Tugas & Fungsi</a></li>
						<li><a href="?page=link_surat">Peraturan & Informasi</a></li>
					</ul>
				</li>

				<!-- <li><a href="?page=carousel">Carousel</a></li>
				<li><a href="?page=tugasfungsi">Tugas & Fungsi</a></li> -->
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Media Gallery <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="?page=m_medgall_foto">Foto</a></li>
						<li><a href="?page=m_medgall_video">Video</a></li>
					</ul>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Zona Integritas<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="?page=m_zona_data">Integritas Data</a></li>
						<li><a href="?page=m_zona_gambar">Integritas Gambar</a></li>
						<li><a href="?page=m_zona_video">Integritas Video</a></li>
					</ul>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Layanan Online<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="?page=link_bimas">Bimas Islam</a></li>
						<li><a href="?page=link_haji">Penyelenggara Haji & Umroh</a></li>
						<li><a href="?page=link_pontren">PD Pontren</a></li>
						<li><a href="?page=link_penmad">Pendidikan Madrasah</a></li>
					</ul>
				</li>

				<li><a href="?page=unitkerja">Unit Kerja</a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $_SESSION['nama_admin']." As ".$_SESSION['level']; ?> <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="?page=ubah_userpass"><i class="fa fa-cog"></i> Ubah Username dan Password</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="cek_login.php?op=out"><i class="fa fa-sign-out"></i> Sign Out</a></li>
					</ul>
				</li>
			</ul>
		</div> <!-- /.navbar-collapse -->
	</div> <!-- /.container -->
</nav>