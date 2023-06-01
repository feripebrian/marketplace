-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2018 at 02:13 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kemenagjaksel`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `level` varchar(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_admin`, `username`, `password`, `level`, `status`) VALUES
(1, 'Superadmin', 'superadmin', '889a3a791b3875cfae413574b53da4bb8a90d53e', 'Superadmin', 1),
(2, 'Tri Bowo', 'tribowo', 'cbca0793dea0eb32ec5392afa2bd4e0e4beb7925', 'Superadmin', 1),
(3, 'Admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_berita`
--

CREATE TABLE `tb_berita` (
  `id_berita` int(11) NOT NULL,
  `judul_berita` varchar(100) NOT NULL,
  `isi_berita` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `created_date` date NOT NULL,
  `created_time` varchar(5) NOT NULL,
  `views` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `show_item` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_berita`
--

INSERT INTO `tb_berita` (`id_berita`, `judul_berita`, `isi_berita`, `gambar`, `created_date`, `created_time`, `views`, `id_admin`, `show_item`) VALUES
(1, 'Upacara Hari Santri 2018', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga doloribus nam laudantium fugiat sequi, possimus, beatae similique eligendi nulla pariatur modi aliquam natus! A adipisci esse unde aliquam optio nam ducimus blanditiis porro, nobis nostrum laudantium amet sapiente, voluptas recusandae quibusdam reprehenderit ut nisi corporis corrupti. Inventore voluptatibus eum ea quisquam, ut dolore obcaecati, voluptates quaerat quis? Incidunt eos quasi, et excepturi animi omnis velit, deserunt ratione eum, dolorem ducimus ab quidem saepe natus earum nobis. Nisi at, ad aliquid, aliquam a natus beatae! Ullam nihil sed beatae a laboriosam, repellat deleniti voluptate maiores consectetur debitis quasi. Nesciunt, repellat, sint?', 'upaca-hari-santri-1.jpg', '2018-11-16', '14:43', 3, 1, 'Y'),
(2, 'Sertijab MTs Negeri 4 Jakarta Selatan', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga doloribus nam laudantium fugiat sequi, possimus, beatae similique eligendi nulla pariatur modi aliquam natus! A adipisci esse unde aliquam optio nam ducimus blanditiis porro, nobis nostrum laudantium amet sapiente, voluptas recusandae quibusdam reprehenderit ut nisi corporis corrupti. Inventore voluptatibus eum ea quisquam, ut dolore obcaecati, voluptates quaerat quis? Incidunt eos quasi, et excepturi animi omnis velit, deserunt ratione eum, dolorem ducimus ab quidem saepe natus earum nobis. Nisi at, ad aliquid, aliquam a natus beatae! Ullam nihil sed beatae a laboriosam, repellat deleniti voluptate maiores consectetur debitis quasi. Nesciunt, repellat, sint? Lorem.', 'Sertijab-3.jpg', '2018-11-16', '14:52', 3, 1, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tb_carousel`
--

CREATE TABLE `tb_carousel` (
  `id_carousel` varchar(5) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `ket_carousel` varchar(100) NOT NULL,
  `show_item` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_carousel`
--

INSERT INTO `tb_carousel` (`id_carousel`, `gambar`, `ket_carousel`, `show_item`) VALUES
('CRL01', 'kemenag-jaksel.jpg', 'Kantor Kementrian Agama Wilayah Jakarta Selatan', 'Y'),
('CRL02', 'hari-santri.jpg', 'Hari Santri', 'Y'),
('CRL03', 'seminar-1.jpg', 'Seminar', 'Y'),
('CRL04', 'sertijab-pdkpinang-1.jpg', 'Sertijab Pondok Pinang', 'Y'),
('CRL05', 'upaca-hari-santri-1.jpg', 'Upacara Hari Santri', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_struktur_organisasi`
--

CREATE TABLE `tb_detail_struktur_organisasi` (
  `no_detail_org` int(11) NOT NULL,
  `id_struktur_org` varchar(5) NOT NULL,
  `nip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_struktur_organisasi`
--

INSERT INTO `tb_detail_struktur_organisasi` (`no_detail_org`, `id_struktur_org`, `nip`) VALUES
(1, 'ORG01', '196604101996031002'),
(2, 'ORG01', '197610242000031003'),
(3, 'ORG01', '196509181995031003'),
(4, 'ORG01', '196510262000031002'),
(5, 'ORG01', '196207091990011001'),
(6, 'ORG01', '197303052003121001'),
(7, 'ORG01', '197706202006041011'),
(8, 'ORG01', '197012022006041014');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_unit_kerja`
--

CREATE TABLE `tb_detail_unit_kerja` (
  `no_detail_uk` int(11) NOT NULL,
  `kd_unit_kerja` varchar(5) NOT NULL,
  `nama_detail_uk` varchar(100) NOT NULL,
  `link_detail_uk` varchar(50) NOT NULL,
  `file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_unit_kerja`
--

INSERT INTO `tb_detail_unit_kerja` (`no_detail_uk`, `kd_unit_kerja`, `nama_detail_uk`, `link_detail_uk`, `file`) VALUES
(1, 'UK001', 'UNIT KEPEGAWAIAN', 'detailuk&no=1', 'DATA_PEGAWAI.pdf'),
(2, 'UK001', 'UNIT KEUANGAN', 'detailuk&no=2', 'DATA_PEGAWAI-1.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tb_direktori`
--

CREATE TABLE `tb_direktori` (
  `id_direktori` varchar(3) NOT NULL,
  `nama_direktori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_direktori`
--

INSERT INTO `tb_direktori` (`id_direktori`, `nama_direktori`) VALUES
('KUA', 'Kantor Urusan Agama'),
('MAN', 'Madrasah Aliyah Negeri'),
('MIN', 'Madrasah Ibtidaiyah Negeri'),
('MTN', 'Madrasah Tsanawiyah Negeri');

-- --------------------------------------------------------

--
-- Table structure for table `tb_direktori_link`
--

CREATE TABLE `tb_direktori_link` (
  `id_dir_link` varchar(5) NOT NULL,
  `id_direktori` varchar(3) NOT NULL,
  `nama_dir_link` varchar(50) NOT NULL,
  `link_dir_link` varchar(100) NOT NULL,
  `show_item` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_direktori_link`
--

INSERT INTO `tb_direktori_link` (`id_dir_link`, `id_direktori`, `nama_dir_link`, `link_dir_link`, `show_item`) VALUES
('L0001', 'KUA', 'KUA KEC.CILANDAK', 'http://kua-cilandak.blogspot.com/', 'Y'),
('L0002', 'KUA', 'KUA KEC.JAGAKARSA', 'https://kuajagakarsa.blogspot.com/', 'Y'),
('L0003', 'KUA', 'KUA KEC.KEBAYORAN BARU', 'http://kuakebayoranbaru.blogspot.com/', 'Y'),
('L0004', 'KUA', 'KUA KEC.KEBAYORAN LAMA', 'http://kuakebayoranlama.blogspot.com/', 'Y'),
('L0005', 'KUA', 'KUA KEC.MAMPANG PRAPATAN', 'http://kuaprapatan.blogspot.com/', 'Y'),
('L0006', 'KUA', 'KUA KEC.PANCORAN', 'http://kuapancoranjaksel.blogspot.com/', 'Y'),
('L0007', 'KUA', 'KUA KEC.PASAR MINGGU', 'http://kuapasarminggu.blogspot.com', 'Y'),
('L0008', 'KUA', 'KUA KEC.PESANGGRAHAN', 'http://kuapesanggrahan.blogspot.com/', 'Y'),
('L0009', 'KUA', 'KUA KEC.SETIA BUDI', 'http://kuasetiabudi.blogspot.com/p/lokasi-kantor.html', 'Y'),
('L0010', 'KUA', 'KUA KEC.TEBET', 'http://kuatebet.blogspot.com/', 'Y'),
('L0011', 'MIN', 'MIN 4 PONDOK PINANG', 'http://min4pondokpinang.sch.id/', 'Y'),
('L0012', 'MIN', 'MIN 6 JAGAKARSA', 'http://www.min6gandaria.sch.id/', 'Y'),
('L0013', 'MIN', 'MIN 8 SRENGSENG SAWAH', 'http://20102838.siap-sekolah.com/sekolah-profil/', 'Y'),
('L0014', 'MIN', 'MIN 9 PETUKANGAN SELATAN', 'https://www.min9jakartaselatan.sch.id/', 'Y'),
('L0015', 'MIN', 'MIN 15 BINTARO', 'https://www.facebook.com/pages/Min-15-Bintaro/132479020126674', 'Y'),
('L0016', 'MIN', 'MIN 14 AL-AZHAR ASY-SYARIF', 'http://www.min-azhar.sch.id/', 'Y'),
('L0017', 'MTN', 'MTSN 1 MAMPANG PRAPATAN', 'http://www.mtsn1-jakarta.sch.id/', 'Y'),
('L0018', 'MTN', 'MTSN 2 CIGANJUR', 'http://mtsnegeri2jakarta.sch.id/', 'Y'),
('L0019', 'MTN', 'MTSN 3 PONDOK PINANG', '', 'Y'),
('L0020', 'MTN', 'MTSN 4 JAGAKARSA', '', 'Y'),
('L0021', 'MTN', 'MTSN 13 PETUKANGAN UTARA', 'http://20109370.siap-sekolah.com/sekolah-profil/#.W4gQ_egza00', 'Y'),
('L0022', 'MTN', 'MTSN 19 CILANDAK', 'http://mtsnegeri19jakarta.sch.id/', 'Y'),
('L0023', 'MTN', 'MTSN 23 PASAR MINGGU', '', 'Y'),
('L0024', 'MTN', 'MTSN 32 PETUKANGAN UTARA', '', 'Y'),
('L0025', 'MTN', 'MTSN 41 AL-AZHAR ASY-SYARIF', '', 'Y'),
('L0026', 'MAN', 'MAN 4 PONDOK PINANG', 'https://man4jkt.kemenag.go.id/', 'Y'),
('L0027', 'MAN', 'MAN 7 JAGAKARSA', 'http://www.man7jakarta.sch.id/', 'Y'),
('L0028', 'MAN', 'MAN 11 LEBAK BULUS', 'https://id-id.facebook.com/pages/Madrasah-Aliyah-Negeri-MAN-11-Lebak-Bulus/444666958977277', 'Y'),
('L0029', 'MAN', 'MAN 13 LENTENG AGUNG', 'http://www.man13-jkt.sch.id/', 'Y'),
('L0030', 'MAN', 'MAN 19 PETUKANGAN UTARA', 'http://man19jkt.sch.id/home/', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jabatan`
--

CREATE TABLE `tb_jabatan` (
  `kd_jabatan` varchar(5) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jabatan`
--

INSERT INTO `tb_jabatan` (`kd_jabatan`, `nama_jabatan`) VALUES
('00001', 'KEPALA KANTOR'),
('00008', 'PENYELENGGARA HAJI DAN UMROH'),
('00007', 'PENYELENGGARA SYARIAH'),
('00006', 'SEKSI BIMBINGAN MASYARAKAT ISLAM'),
('00004', 'SEKSI PENDIDIKAN AGAMA ISLAM'),
('00005', 'SEKSI PENDIDIKAN DINIYAH DAN PONDOK PESANTREN'),
('00003', 'SEKSI PENDIDIKAN MADRASAH'),
('00002', 'SUB BAGIAN TATA USAHA');

-- --------------------------------------------------------

--
-- Table structure for table `tb_layanan_publik`
--

CREATE TABLE `tb_layanan_publik` (
  `id_layanan_pblk` int(11) NOT NULL,
  `url_layanan_pblk` varchar(100) NOT NULL,
  `ket_layanan_pblk` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `show_item` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_layanan_publik`
--

INSERT INTO `tb_layanan_publik` (`id_layanan_pblk`, `url_layanan_pblk`, `ket_layanan_pblk`, `gambar`, `show_item`) VALUES
(1, 'http://www.facebook.com', 'Website Resmi Sosial Media Facebook', 'facebook.jpg', 'Y'),
(2, 'http://www.twitter.com', 'Website Resmi Sosial Media Twitter', 'twitter.jpg', 'Y'),
(3, 'http://www.instagram.com', 'Website Resmi Sosial Media Instagram', 'instagram.jpg', 'Y'),
(4, 'http://www.detik.com', 'Website Portal Berita Indonesia Detik', 'detik.jpg', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tb_masa_kepala_kantor`
--

CREATE TABLE `tb_masa_kepala_kantor` (
  `nip_kpl_kantor` varchar(20) NOT NULL,
  `periode_dari` date NOT NULL,
  `periode_sampai` date NOT NULL,
  `show_item` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_masa_kepala_kantor`
--

INSERT INTO `tb_masa_kepala_kantor` (`nip_kpl_kantor`, `periode_dari`, `periode_sampai`, `show_item`) VALUES
('196604101996031002', '1998-08-01', '2018-07-28', 'Y'),
('2014141148', '1996-11-16', '2018-11-15', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tb_media_gallery`
--

CREATE TABLE `tb_media_gallery` (
  `id_medgall` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `nama_file_medgall` varchar(100) NOT NULL,
  `kategori_medgall` varchar(5) NOT NULL,
  `created_date` date NOT NULL,
  `created_time` varchar(5) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `show_item` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_media_gallery`
--

INSERT INTO `tb_media_gallery` (`id_medgall`, `judul`, `nama_file_medgall`, `kategori_medgall`, `created_date`, `created_time`, `id_admin`, `show_item`) VALUES
(1, '', 'foto-1.jpg', 'FOTO', '2018-11-10', '11:52', 1, 'Y'),
(2, '', 'foto-2.jpg', 'FOTO', '2018-11-10', '11:52', 1, 'Y'),
(3, '', 'foto-3.jpg', 'FOTO', '2018-11-10', '11:52', 1, 'Y'),
(4, '', 'upaca-hari-santri-1.jpg', 'FOTO', '2018-11-10', '12:01', 1, 'Y'),
(5, 'Hari Pancasila', 'hari-pancasila.mp4', 'VIDEO', '2018-11-19', '17:29', 3, 'N'),
(6, 'Asian Games 2018', 'asian-games.mp4', 'VIDEO', '2018-11-19', '17:54', 3, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `nip` varchar(20) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `jk` varchar(1) NOT NULL,
  `kd_jabatan` varchar(5) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`nip`, `nama_pegawai`, `jk`, `kd_jabatan`, `foto`, `status`) VALUES
('196207091990011001', 'Drs. H. HAMIDULLAH AR., M.SI.', 'L', '00005', 'hamidullah.jpg', 1),
('196509181995031003', 'Drs. H. HASYIM', 'L', '00003', 'hasyim.jpg', 1),
('196510262000031002', 'Drs. SUKIRMAN, M.Pd.I.', 'L', '00004', 'sukirman.png', 1),
('196604101996031002', 'Drs. H. MOH. KOMARUDIN, M.Pd.I.', 'L', '00001', 'komarudin.jpg', 1),
('197012022006041014', 'H. FATULLAH, S.Ag.', 'L', '00008', 'fatullah.jpg', 1),
('197303052003121001', 'H. NASRUDDIN, LC, MM', 'L', '00006', 'nasruddin.jpg', 1),
('197610242000031003', 'ZULKARNAIN S.Ag, M.Hum', 'L', '00002', 'zulkarnain.png', 1),
('197706202006041011', 'H. M. YUNUS HASYIM, S.Ag.', 'L', '00007', 'yunus.png', 1),
('2014141148', 'Maulana Yusuf, S. Kom.', 'L', '00001', 'maulana-1.JPG', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sess_viewers_berita`
--

CREATE TABLE `tb_sess_viewers_berita` (
  `id_session` varchar(50) NOT NULL,
  `id_berita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sess_viewers_berita`
--

INSERT INTO `tb_sess_viewers_berita` (`id_session`, `id_berita`) VALUES
('2037vqfgq383tgt2e1g4kvn61c', 1),
('2037vqfgq383tgt2e1g4kvn61c', 2),
('72qf4e15sivr774m7jn3lha6rb', 1),
('8nah7h6nnssdgfgrq9a2io2flg', 1),
('8nah7h6nnssdgfgrq9a2io2flg', 2),
('mss7h3kf9ok3vc2s750oqn7but', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_struktur_organisasi`
--

CREATE TABLE `tb_struktur_organisasi` (
  `id_struktur_org` varchar(5) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `show_item` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_struktur_organisasi`
--

INSERT INTO `tb_struktur_organisasi` (`id_struktur_org`, `gambar`, `show_item`) VALUES
('ORG01', 'struktur-organisasi.png', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tugas_fungsi`
--

CREATE TABLE `tb_tugas_fungsi` (
  `kd_tugas_fungsi` varchar(5) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tugas_fungsi`
--

INSERT INTO `tb_tugas_fungsi` (`kd_tugas_fungsi`, `nip`, `deskripsi`) VALUES
('T0001', '196604101996031002', 'Kantor Kementerian Agama mempunyai tugas melaksanakan tugas dan fungsi Kementerian Agama dalam wilayah kabupaten/kota berdasarkan kebijakan Kepala Kantor Wilayah Kementerian Agama provinsi dan ketentuan peraturan perundang-undangan.');

-- --------------------------------------------------------

--
-- Table structure for table `tb_unit_kerja`
--

CREATE TABLE `tb_unit_kerja` (
  `kd_unit_kerja` varchar(5) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `deskripsi` text NOT NULL,
  `show_item` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_unit_kerja`
--

INSERT INTO `tb_unit_kerja` (`kd_unit_kerja`, `nip`, `deskripsi`, `show_item`) VALUES
('UK001', '197610242000031003', 'Subbagian Tata Usaha sebagaimana dimaksud dalam Pasal 357 PMA 13 tahun 2012 mempunyai tugas melakukan koordinasi perumusan kebijakan teknis dan perencanaan, pelaksanaan pelayanan dan pembinaan administrasi, keuangan dan barang milik negara di lingkungan Kantor Kementerian Agama.', 'Y'),
('UK002', '196509181995031003', 'Seksi Pendidikan Madrasah sebagaimana dimaksud dalam Pasal 357 PMA 13 tahun 2012 mempunyai tugas melakukan pelayanan, bimbingan teknis, pembinaan, serta pengelolaan data informasi di bidang RA, MI, MTs, MA, dan MAK.\r\n', 'Y'),
('UK003', '196510262000031002', 'Seksi Pendidikan Agama Islam sebagaimana dimaksud dalam Pasal 357 mempunyai tugas melakukan pelayanan dan bimbingan teknis, pembinaan serta pengelolaan data dan informasi di bidang pendidikan agama Islam pada PAUD, SD/SDLB, SMP/SMPLB, SMA/ SMALB/SMK.', 'Y'),
('UK004', '196207091990011001', 'Seksi Pendidikan Diniyah dan Pondok sebagaimana dimaksud dalam Pasal 357 tugas melakukan pelayanan, bimbingan teknis, pembinaan, serta pengelolaan data dan informasi di bidang pendidikan diniyah dan pondok pesantren.', 'Y'),
('UK005', '197303052003121001', 'Seksi Bimbingan Masyarakat Islam sebagaimana dimaksud dalam Pasal\r\n357 mempunyai tugas melakukan pelayanan, bimbingan teknis,\r\npembinaan, serta pengelolaan data dan informasi di bidang bimbingan\r\nmasyarakat Islam.', 'Y'),
('UK006', '197706202006041011', 'Penyelenggara Syariah sebagaimana dimaksud dalam Pasal 357\r\nmempunyai tugas melakukan pelayanan, bimbingan teknis,\r\npembinaan, serta pengelolaan data dan informasi di bidang pembinaan\r\nsyariah.', 'Y'),
('UK007', '197012022006041014', 'Seksi Penyelenggaraan Haji dan Umrah sebagaimana dimaksud dalam Pasal 357 mempunyai tugas melakukan pelayanan, bimbingan teknis, pembinaan serta pengelolaan data dan informasi di bidang penyelenggaraan haji dan umrah.', 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `nama_admin` (`nama_admin`),
  ADD KEY `level` (`level`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `tb_berita`
--
ALTER TABLE `tb_berita`
  ADD PRIMARY KEY (`id_berita`),
  ADD KEY `judul_berita` (`judul_berita`),
  ADD KEY `created_date` (`created_date`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `show_item` (`show_item`);

--
-- Indexes for table `tb_carousel`
--
ALTER TABLE `tb_carousel`
  ADD PRIMARY KEY (`id_carousel`);

--
-- Indexes for table `tb_detail_struktur_organisasi`
--
ALTER TABLE `tb_detail_struktur_organisasi`
  ADD PRIMARY KEY (`no_detail_org`),
  ADD KEY `id_struktur_org` (`id_struktur_org`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `tb_detail_unit_kerja`
--
ALTER TABLE `tb_detail_unit_kerja`
  ADD PRIMARY KEY (`no_detail_uk`),
  ADD KEY `kd_unit_kerja` (`kd_unit_kerja`);

--
-- Indexes for table `tb_direktori`
--
ALTER TABLE `tb_direktori`
  ADD PRIMARY KEY (`id_direktori`),
  ADD KEY `nama_direktori` (`nama_direktori`);

--
-- Indexes for table `tb_direktori_link`
--
ALTER TABLE `tb_direktori_link`
  ADD PRIMARY KEY (`id_dir_link`),
  ADD KEY `id_direktori` (`id_direktori`),
  ADD KEY `nama_dir_link` (`nama_dir_link`),
  ADD KEY `show_item` (`show_item`);

--
-- Indexes for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  ADD PRIMARY KEY (`kd_jabatan`),
  ADD KEY `nama_jabatan` (`nama_jabatan`);

--
-- Indexes for table `tb_layanan_publik`
--
ALTER TABLE `tb_layanan_publik`
  ADD PRIMARY KEY (`id_layanan_pblk`),
  ADD KEY `show_item` (`show_item`);

--
-- Indexes for table `tb_masa_kepala_kantor`
--
ALTER TABLE `tb_masa_kepala_kantor`
  ADD PRIMARY KEY (`nip_kpl_kantor`),
  ADD KEY `periode_dari` (`periode_dari`),
  ADD KEY `periode_sampai` (`periode_sampai`),
  ADD KEY `show_item` (`show_item`);

--
-- Indexes for table `tb_media_gallery`
--
ALTER TABLE `tb_media_gallery`
  ADD PRIMARY KEY (`id_medgall`),
  ADD KEY `judul` (`judul`),
  ADD KEY `kategori_medgall` (`kategori_medgall`),
  ADD KEY `created_date` (`created_date`),
  ADD KEY `created_time` (`created_time`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `show_item` (`show_item`);

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `nama_pegawai` (`nama_pegawai`),
  ADD KEY `kd_jabatan` (`kd_jabatan`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `tb_sess_viewers_berita`
--
ALTER TABLE `tb_sess_viewers_berita`
  ADD UNIQUE KEY `uidx_id` (`id_session`,`id_berita`),
  ADD KEY `id_session` (`id_session`),
  ADD KEY `id_berita` (`id_berita`);

--
-- Indexes for table `tb_struktur_organisasi`
--
ALTER TABLE `tb_struktur_organisasi`
  ADD PRIMARY KEY (`id_struktur_org`),
  ADD KEY `show_item` (`show_item`);

--
-- Indexes for table `tb_tugas_fungsi`
--
ALTER TABLE `tb_tugas_fungsi`
  ADD PRIMARY KEY (`kd_tugas_fungsi`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `tb_unit_kerja`
--
ALTER TABLE `tb_unit_kerja`
  ADD PRIMARY KEY (`kd_unit_kerja`),
  ADD KEY `nip` (`nip`),
  ADD KEY `show_item` (`show_item`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
