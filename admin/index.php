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
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin || Website Kemenag Kantor Wilayah Jakarta Selatan</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="../assets/adminlte/plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bootstrap 4 -->
	<link rel="stylesheet" href="../assets/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="../assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- JQVMap -->
	<link rel="stylesheet" href="../assets/adminlte/plugins/jqvmap/jqvmap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="../assets/adminlte/dist/css/adminlte.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="../assets/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="../assets/adminlte/plugins/daterangepicker/daterangepicker.css">
	<!-- summernote -->
	<link rel="stylesheet" href="../assets/adminlte/plugins/summernote/summernote-bs4.min.css">

	<!-- jquery js -->
	<script src="../assets/js/external/jquery/jquery.min.js"></script>
	<!-- jquery-ui js -->
	<script src="../assets/js/jquery-ui/jquery-ui.min.js"></script>
	<!-- bootstrap js -->
	<script src="../assets/js/bootstrap.min.js"></script>

	<!-- DataTables -->
	<link rel="stylesheet" href="../assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="../assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="../assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php include 'header.php'; ?>

		<?php

		// PRODUCT
		if (@$_GET['page'] == "m_product") {
			include 'm_product/x_product/product.php';
		} else if (@$_GET['page'] == "m_category") {
			include 'm_product/x_category/category.php';
		} else if (@$_GET['page'] == "add_category") {
			include 'm_product/x_category/add_category.php';
		} else if (@$_GET['page'] == "m_price") {
			include 'm_product/x_price/price.php';
		}
		// MASTER DATA
		else if (@$_GET['page'] == "m_direktori") {
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
		<!-- Content Wrapper. Contains page content -->



		<!-- /.content-wrapper -->
		<footer class="main-footer">
			<strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
			All rights reserved.
			<div class="float-right d-none d-sm-inline-block">
				<b>Version</b> 3.2.0
			</div>
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

	<!-- jQuery -->
	<script src="../assets/adminlte/plugins/jquery/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="../assets/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button)
	</script>
	<!-- Bootstrap 4 -->
	<script src="../assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- ChartJS -->
	<script src="../assets/adminlte/plugins/chart.js/Chart.min.js"></script>
	<!-- Sparkline -->
	<script src="../assets/adminlte/plugins/sparklines/sparkline.js"></script>
	<!-- JQVMap -->
	<script src="../assets/adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
	<script src="../assets/adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="../assets/adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>
	<!-- daterangepicker -->
	<script src="../assets/adminlte/plugins/moment/moment.min.js"></script>
	<script src="../assets/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="../assets/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
	<!-- Summernote -->
	<script src="../assets/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
	<!-- overlayScrollbars -->
	<script src="../assets/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<!-- AdminLTE App -->
	<script src="../assets/adminlte/dist/js/adminlte.js"></script>
	<!-- AdminLTE for demo purposes -->
	<!-- <script src="../assets/adminlte/dist/js/demo.js"></script> -->
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<!-- <script src="../assets/adminlte/dist/js/pages/dashboard.js"></script> -->

	<!-- DataTables  & Plugins -->
	<script src="../assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="../assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="../assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<script src="../assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
	<script src="../assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
	<script src="../assets/adminlte/plugins/jszip/jszip.min.js"></script>
	<script src="../assets/adminlte/plugins/pdfmake/pdfmake.min.js"></script>
	<script src="../assets/adminlte/plugins/pdfmake/vfs_fonts.js"></script>
	<script src="../assets/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
	<script src="../assets/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
	<script src="../assets/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
	<!-- <script src="../assets/js/form_validation/form_validation_category.js"></script> -->

	<!-- Page specific script -->
	<script>
		$(function() {
			$("#example1").DataTable({
				"responsive": true,
				"lengthChange": false,
				"autoWidth": false,
				"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
			}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
				"responsive": true,
			});
		});
	</script>


</body>

</html>