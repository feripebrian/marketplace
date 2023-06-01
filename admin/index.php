<?php

session_start();

if (!isset($_SESSION['login']) === true) {
	header("location:login.php");
	exit;
}

require 'config/koneksi.php';
require 'helpers/funct_query.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin || Website Kemenag Kantor Wilayah Jakarta Selatan</title>
	<!-- bootstrap css -->
	<link rel="stylesheet" href="../assets/bootstrap/bootstrap.css">
	<!-- font-awesome -->
	<link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
	<!-- datatables css -->
	<link rel="stylesheet" href="../assets/datatables/css/dataTables.bootstrap.min.css">
	<!-- jquery-ui css -->
	<link rel="stylesheet" href="../assets/js/jquery-ui/jquery-ui.min.css">
	<!-- custom css admin -->
	<link rel="stylesheet" href="../assets/css/style_admin.css">
	<!-- jquery js -->
	<script src="../assets/js/external/jquery/jquery.min.js"></script>
	<!-- bootstrap js -->
	<script src="../assets/js/bootstrap.min.js"></script>
	<!-- datatables js -->
	<script src="../assets/datatables/js/jquery.dataTables.min.js"></script>
	<script src="../assets/datatables/js/dataTables.bootstrap.min.js"></script>
	<!-- jquery-ui js -->
	<script src="../assets/js/jquery-ui/jquery-ui.min.js"></script>
</head>

<body>
	<!-- .wrapper -->
	<div class="wrapper">
		<!-- header -->
		<header>
			<?php include 'header.php'; ?>
		</header> <!-- /header -->

		<!-- section .content -->
		<section class="content">
			<div class="container">
				<?php
				// MASTER DATA
				// DIREKTORI
				if (@$_GET['page'] == "m_direktori") {
					include 'm_direktori/direktori.php';
				} else if (@$_GET['page'] == "add_direktori") {
					include 'm_direktori/add_direktori.php';
				} else if (@$_GET['page'] == "edt_direktori") {
					include 'm_direktori/edt_direktori.php';
				} else if (@$_GET['page'] == "del_direktori") {
					include 'm_direktori/del_direktori.php';
				}
				// PEGAWAI
				else if (@$_GET['page'] == "m_pegawai") {
					include 'm_pegawai/pegawai.php';
				} else if (@$_GET['page'] == "add_pegawai") {
					include 'm_pegawai/add_pegawai.php';
				} else if (@$_GET['page'] == "edt_pegawai") {
					include 'm_pegawai/edt_pegawai.php';
				} else if (@$_GET['page'] == "del_pegawai") {
					include 'm_pegawai/del_pegawai.php';
				}
				// JABATAN
				else if (@$_GET['page'] == "m_jabatan") {
					include 'm_jabatan/jabatan.php';
				} else if (@$_GET['page'] == "add_jabatan") {
					include 'm_jabatan/add_jabatan.php';
				} else if (@$_GET['page'] == "edt_jabatan") {
					include 'm_jabatan/edt_jabatan.php';
				} else if (@$_GET['page'] == "del_jabatan") {
					include 'm_jabatan/del_jabatan.php';
				}
				// MASA KEPALA KANTOR
				else if (@$_GET['page'] == "m_masa_kpl") {
					include 'm_masa_kepala_kantor/masa_kepala_kantor.php';
				} else if (@$_GET['page'] == "add_masa_kpl") {
					include 'm_masa_kepala_kantor/add_masa_kepala_kantor.php';
				} else if (@$_GET['page'] == "edt_masa_kpl") {
					include 'm_masa_kepala_kantor/edt_masa_kepala_kantor.php';
				} else if (@$_GET['page'] == "del_masa_kpl") {
					include 'm_masa_kepala_kantor/del_masa_kepala_kantor.php';
				}
				// LINK DIREKTORI
				else if (@$_GET['page'] == "link_direktori") {
					include 'link_direktori/link_direktori.php';
				} else if (@$_GET['page'] == "add_link_direktori") {
					include 'link_direktori/add_link_direktori.php';
				} else if (@$_GET['page'] == "edt_link_direktori") {
					include 'link_direktori/edt_link_direktori.php';
				} else if (@$_GET['page'] == "del_link_direktori") {
					include 'link_direktori/del_link_direktori.php';
				}

				// ZONA
				else if (@$_GET['page'] == "m_zona") {
					include 'm_zona/add_zona.php';
				}

				// LINK ZONA
				else if (@$_GET['page'] == "link_zona") {
					include 'link_zona/link_zona.php';
				} else if (@$_GET['page'] == "add_link_zona") {
					include 'link_zona/add_link_zona.php';
				} else if (@$_GET['page'] == "edt_link_zona") {
					include 'link_zona/edt_link_zona.php';
				} else if (@$_GET['page'] == "del_link_zona") {
					include 'link_zona/del_link_zona.php';
				}

				// PENGADUAN
				else if (@$_GET['page'] == "m_pengaduan") {
					include 'm_pengaduan/add_pengaduan.php';
				}

				// LINK PENGADUAN
				else if (@$_GET['page'] == "link_pengaduan") {
					include 'link_pengaduan/link_pengaduan.php';
				} else if (@$_GET['page'] == "add_link_pengaduan") {
					include 'link_pengaduan/add_link_pengaduan.php';
				} else if (@$_GET['page'] == "edt_link_pengaduan") {
					include 'link_pengaduan/edt_link_pengaduan.php';
				} else if (@$_GET['page'] == "del_link_pengaduan") {
					include 'link_pengaduan/del_link_pengaduan.php';
				}

				// SURVEY
				else if (@$_GET['page'] == "m_survey") {
					include 'm_survey/add_survey.php';
				}

				// LINK SURVEY
				else if (@$_GET['page'] == "link_survey") {
					include 'link_survey/link_survey.php';
				} else if (@$_GET['page'] == "add_link_survey") {
					include 'link_survey/add_link_survey.php';
				} else if (@$_GET['page'] == "edt_link_survey") {
					include 'link_survey/edt_link_survey.php';
				} else if (@$_GET['page'] == "del_link_survey") {
					include 'link_survey/del_link_survey.php';
				}

				// MAKLUMAT
				else if (@$_GET['page'] == "m_maklumat") {
					include 'm_maklumat/add_maklumat.php';
				}

				// LINK MAKLUMAT
				else if (@$_GET['page'] == "link_maklumat") {
					include 'link_maklumat/link_maklumat.php';
				} else if (@$_GET['page'] == "add_link_maklumat") {
					include 'link_maklumat/add_link_maklumat.php';
				} else if (@$_GET['page'] == "edt_link_maklumat") {
					include 'link_maklumat/edt_link_maklumat.php';
				} else if (@$_GET['page'] == "del_link_maklumat") {
					include 'link_maklumat/del_link_maklumat.php';
				}

				// MASYARAKAT
				else if (@$_GET['page'] == "m_masyarakat") {
					include 'm_masyarakat/add_masyarakat.php';
				}

				// LINK MASYARAKAT
				else if (@$_GET['page'] == "link_masyarakat") {
					include 'link_masyarakat/link_masyarakat.php';
				} else if (@$_GET['page'] == "add_link_masyarakat") {
					include 'link_masyarakat/add_link_masyarakat.php';
				} else if (@$_GET['page'] == "edt_link_masyarakat") {
					include 'link_masyarakat/edt_link_masyarakat.php';
				} else if (@$_GET['page'] == "del_link_masyarakat") {
					include 'link_masyarakat/del_link_masyarakat.php';
				}

				// INOVASI
				else if (@$_GET['page'] == "m_inovasi") {
					include 'm_inovasi/add_inovasi.php';
				}

				// LINK INOVASI
				else if (@$_GET['page'] == "link_inovasi") {
					include 'link_inovasi/link_inovasi.php';
				} else if (@$_GET['page'] == "add_link_inovasi") {
					include 'link_inovasi/add_link_inovasi.php';
				} else if (@$_GET['page'] == "edt_link_inovasi") {
					include 'link_inovasi/edt_link_inovasi.php';
				} else if (@$_GET['page'] == "del_link_inovasi") {
					include 'link_inovasi/del_link_inovasi.php';
				}

				// DAMPAK
				else if (@$_GET['page'] == "m_dampak") {
					include 'm_dampak/add_dampak.php';
				}

				// LINK DAMPAK
				else if (@$_GET['page'] == "link_dampak") {
					include 'link_dampak/link_dampak.php';
				} else if (@$_GET['page'] == "add_link_dampak") {
					include 'link_dampak/add_link_dampak.php';
				} else if (@$_GET['page'] == "edt_link_dampak") {
					include 'link_dampak/edt_link_dampak.php';
				} else if (@$_GET['page'] == "del_link_dampak") {
					include 'link_dampak/del_link_dampak.php';
				}

				// STRUKTUR ORGANISASI
				else if (@$_GET['page'] == "m_struktur_org") {
					include 'm_struktur_organisasi/struktur_organisasi.php';
				}
				// POSTING
				// BERITA
				else if (@$_GET['page'] == "m_berita") {
					include 'm_berita/berita.php';
				} else if (@$_GET['page'] == "add_berita") {
					include 'm_berita/add_berita.php';
				} else if (@$_GET['page'] == "edt_berita") {
					include 'm_berita/edt_berita.php';
				} else if (@$_GET['page'] == "dtl_berita") {
					include 'm_berita/detail_berita.php';
				} else if (@$_GET['page'] == "del_berita") {
					include 'm_berita/del_berita.php';
				}
				// LAYANAN PUBLIK
				else if (@$_GET['page'] == "m_layananpublik") {
					include 'm_layanan_publik/layanan_publik.php';
				} else if (@$_GET['page'] == "add_layananpublik") {
					include 'm_layanan_publik/add_layanan_publik.php';
				} else if (@$_GET['page'] == "edt_layananpublik") {
					include 'm_layanan_publik/edt_layanan_publik.php';
				} else if (@$_GET['page'] == "del_layananpublik") {
					include 'm_layanan_publik/del_layanan_publik.php';
				}
				// CAROUSEL
				else if (@$_GET['page'] == "carousel") {
					include 'carousel/carousel.php';
				} else if (@$_GET['page'] == "add_carousel") {
					include 'carousel/add_carousel.php';
				} else if (@$_GET['page'] == "edt_carousel") {
					include 'carousel/edt_carousel.php';
				} else if (@$_GET['page'] == "del_carousel") {
					include 'carousel/del_carousel.php';
				}
				// TUGAS FUNGSI
				else if (@$_GET['page'] == "tugasfungsi") {
					include 'tugas_fungsi/tugas_fungsi.php';
				}
				// MEDIA GALLERY
				// FOTO
				else if (@$_GET['page'] == "m_medgall_foto") {
					include 'm_media_gallery/media_gallery_foto.php';
				} else if (@$_GET['page'] == "add_medgall_foto") {
					include 'm_media_gallery/add_media_gallery_foto.php';
				} else if (@$_GET['page'] == "edt_medgall_foto") {
					include 'm_media_gallery/edt_media_gallery_foto.php';
				} else if (@$_GET['page'] == "del_medgall_foto") {
					include 'm_media_gallery/del_media_gallery_foto.php';
				}
				// VIDEO
				else if (@$_GET['page'] == "m_medgall_video") {
					include 'm_media_gallery/media_gallery_video.php';
				} else if (@$_GET['page'] == "add_medgall_video") {
					include 'm_media_gallery/add_media_gallery_video.php';
				} else if (@$_GET['page'] == "edt_medgall_video") {
					include 'm_media_gallery/edt_media_gallery_video.php';
				} else if (@$_GET['page'] == "del_medgall_video") {
					include 'm_media_gallery/del_media_gallery_video.php';
				}

				// ZONA INTEGRITAS
				// GAMBAR
				else if (@$_GET['page'] == "m_zona_gambar") {
					include 'm_zona_gambar/zona_gambar.php';
				} else if (@$_GET['page'] == "add_zona_gambar") {
					include 'm_zona_gambar/add_zona_gambar.php';
				} else if (@$_GET['page'] == "edt_zona_gambar") {
					include 'm_zona_gambar/edt_zona_gambar.php';
				} else if (@$_GET['page'] == "del_zona_gambar") {
					include 'm_zona_gambar/del_zona_gambar.php';
				}

				// LINK zona data
				else if (@$_GET['page'] == "m_zona_data") {
					include 'm_zona_data/zona_data.php';
				} else if (@$_GET['page'] == "add_zona_data") {
					include 'm_zona_data/add_zona_data.php';
				} else if (@$_GET['page'] == "edt_zona_data") {
					include 'm_zona_data/edt_zona_data.php';
				} else if (@$_GET['page'] == "del_zona_data") {
					include 'm_zona_data/del_zona_data.php';
				}

				// VIDEO
				else if (@$_GET['page'] == "m_zona_video") {
					include 'm_zona_video/zona_video.php';
				} else if (@$_GET['page'] == "add_zona_video") {
					include 'm_zona_video/add_zona_video.php';
				} else if (@$_GET['page'] == "edt_zona_video") {
					include 'm_zona_video/edt_zona_video.php';
				} else if (@$_GET['page'] == "del_zona_video") {
					include 'm_zona_video/del_zona_video.php';
				}

				// UNIT KERJA
				else if (@$_GET['page'] == "unitkerja") {
					include 'unit_kerja/unit_kerja.php';
				} else if (@$_GET['page'] == "add_unitkerja") {
					include 'unit_kerja/add_unit_kerja.php';
				} else if (@$_GET['page'] == "edt_unitkerja") {
					include 'unit_kerja/edt_unit_kerja.php';
				} else if (@$_GET['page'] == "del_unitkerja") {
					include 'unit_kerja/del_unit_kerja.php';
				} else if (@$_GET['page'] == "dtl_unitkerja") {
					include 'unit_kerja/detail_unit_kerja.php';
				} else if (@$_GET['page'] == "add_dtl_unitkerja") {
					include 'unit_kerja/add_detail_unit_kerja.php';
				} else if (@$_GET['page'] == "edt_dtl_unitkerja") {
					include 'unit_kerja/edt_detail_unit_kerja.php';
				} else if (@$_GET['page'] == "del_dtl_unitkerja") {
					include 'unit_kerja/del_detail_unit_kerja.php';
				}

				// BIMAS
				else if (@$_GET['page'] == "m_bimas") {
					include 'm_bimas/add_bimas.php';
				}

				// LINK BIMAS
				else if (@$_GET['page'] == "link_bimas") {
					include 'link_bimas/link_bimas.php';
				} else if (@$_GET['page'] == "add_link_bimas") {
					include 'link_bimas/add_link_bimas.php';
				} else if (@$_GET['page'] == "edt_link_bimas") {
					include 'link_bimas/edt_link_bimas.php';
				} else if (@$_GET['page'] == "del_link_bimas") {
					include 'link_bimas/del_link_bimas.php';
				}

				// HAJI
				else if (@$_GET['page'] == "m_haji") {
					include 'm_haji/add_haji.php';
				}

				// LINK HAJI
				else if (@$_GET['page'] == "link_haji") {
					include 'link_haji/link_haji.php';
				} else if (@$_GET['page'] == "add_link_haji") {
					include 'link_haji/add_link_haji.php';
				} else if (@$_GET['page'] == "edt_link_haji") {
					include 'link_haji/edt_link_haji.php';
				} else if (@$_GET['page'] == "del_link_haji") {
					include 'link_haji/del_link_haji.php';
				}

				// PONTREN
				else if (@$_GET['page'] == "m_pontren") {
					include 'm_pontren/add_pontren.php';
				}

				// LINK PONTREN
				else if (@$_GET['page'] == "link_pontren") {
					include 'link_pontren/link_pontren.php';
				} else if (@$_GET['page'] == "add_link_pontren") {
					include 'link_pontren/add_link_pontren.php';
				} else if (@$_GET['page'] == "edt_link_pontren") {
					include 'link_pontren/edt_link_pontren.php';
				} else if (@$_GET['page'] == "del_link_pontren") {
					include 'link_pontren/del_link_pontren.php';
				}

				// PENMAD
				else if (@$_GET['page'] == "m_penmad") {
					include 'm_penmad/add_penmad.php';
				}

				// LINK PENMAD
				else if (@$_GET['page'] == "link_penmad") {
					include 'link_penmad/link_penmad.php';
				} else if (@$_GET['page'] == "add_link_penmad") {
					include 'link_penmad/add_link_penmad.php';
				} else if (@$_GET['page'] == "edt_link_penmad") {
					include 'link_penmad/edt_link_penmad.php';
				} else if (@$_GET['page'] == "del_link_penmad") {
					include 'link_penmad/del_link_penmad.php';
				}


				// LINK SURAT
				else if (@$_GET['page'] == "link_surat") {
					include 'link_surat/link_surat.php';
				} else if (@$_GET['page'] == "add_link_surat") {
					include 'link_surat/add_link_surat.php';
				} else if (@$_GET['page'] == "edt_link_surat") {
					include 'link_surat/edt_link_surat.php';
				} else if (@$_GET['page'] == "del_link_surat") {
					include 'link_surat/del_link_surat.php';
				}


				// HOME
				else if (@$_GET['page'] == "home") {
					include 'home.php';
				} else {
					include 'home.php';
				}
				?>
			</div>
		</section><!-- /.content -->

		<!-- footer -->
		<footer>
			<h5 class="text-center">&copy; Copyright 2018 - Kementerian Agama Jakarta Selatan</h5>
		</footer> <!-- /footer -->
	</div> <!-- /.wrapper -->

	<script>
		$(document).ready(function() {

			$('#tabel-data-direktori, #tabel-data-jabatan').dataTable({
				"paging": false,
				"ordering": false,
				"filtering": false,
				"dom": '<"row"<"col-sm-6"i><"col-sm-6"f>>',
				"language": {
					"decimal": "",
					"emptyTable": "Tidak ada data di dalam tabel ini",
					"info": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
					"infoEmpty": "Menampilkan 0 - 0 dari 0 data",
					"infoFiltered": "(filtered dari _MAX_ total data)",
					"infoPostFix": "",
					"thousands": ",",
					"lengthMenu": "Tampilkan _MENU_ data",
					"loadingRecords": "Loading...",
					"processing": "Processing...",
					"search": "Cari:",
					"zeroRecords": "Data tidak ditemukan",
					"searchPlaceholder": "Cari data...",
					"paginate": {
						"first": "First",
						"last": "Last",
						"next": '<i class="fa fa-chevron-right"></i>',
						"previous": '<i class="fa fa-chevron-left"></i>'
					},
					"aria": {
						"sortAscending": ": activate to sort column ascending",
						"sortDescending": ": activate to sort column descending"
					}
				}
			});

			$('#tabel-data-direktori_filter input, #tabel-data-jabatan_filter input').attr('size', '40%');

			$('#tabel-data').dataTable({
				"ordering": false,
				"language": {
					"decimal": "",
					"emptyTable": "Tidak ada data di dalam tabel ini",
					"info": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
					"infoEmpty": "Menampilkan 0 - 0 dari 0 data",
					"infoFiltered": "(filtered dari _MAX_ total data)",
					"infoPostFix": "",
					"thousands": ",",
					"lengthMenu": "Tampilkan _MENU_ data",
					"loadingRecords": "Loading...",
					"processing": "Processing...",
					"search": "Cari:",
					"zeroRecords": "Data tidak ditemukan",
					"searchPlaceholder": "Cari data...",
					"paginate": {
						"first": "First",
						"last": "Last",
						"next": '<i class="fa fa-chevron-right"></i>',
						"previous": '<i class="fa fa-chevron-left"></i>'
					},
					"aria": {
						"sortAscending": ": activate to sort column ascending",
						"sortDescending": ": activate to sort column descending"
					}
				}
			});

			$('#tabel-data_filter input').attr('size', '40%');

		});
	</script>
</body>

</html>