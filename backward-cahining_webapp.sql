-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2021 at 11:13 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `backward-cahining.webapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `anak`
--

CREATE TABLE `anak` (
  `id` int(11) NOT NULL,
  `id_wali` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anak`
--

INSERT INTO `anak` (`id`, `id_wali`, `nama`, `jenis_kelamin`) VALUES
(6, 7, 'Agung Widjaya', 'l'),
(7, 7, 'Roney', 'l');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosa`
--

CREATE TABLE `diagnosa` (
  `id` int(11) NOT NULL,
  `code_diagnosa` varchar(25) NOT NULL,
  `diagnosa` text NOT NULL,
  `code_kebutuhan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diagnosa`
--

INSERT INTO `diagnosa` (`id`, `code_diagnosa`, `diagnosa`, `code_kebutuhan`) VALUES
(1, 'G001', 'Mata tampak merah', 'P001'),
(2, 'G002', 'Bola mata tampak keruh (putih-putih ditengah), dan kadang-kadang seperti mata kucing (bersinar)', 'P001'),
(3, 'G003', 'Bola mata bergerak sangat cepat', 'P001'),
(5, 'G004', 'Penglihatan hanya mampu merespon terhadap cahaya, benda ukuran besar dengan warna mencolok', 'P001'),
(6, 'G005', 'Melihat objek, menonton televisi, membaca buku atau melihat gambar di buku sangat dekat', 'P001'),
(7, 'G006', 'Tidak menunjukan reaksi terkejut terhadap bunyi-bunyian atau tepuk tangan yang keras pada jarak satu meter', 'P002'),
(8, 'G007', 'Tidak bisa dibuat tenang dengan suara ibunya atau pengasuh', 'P002'),
(9, 'G008', 'Tidak bereaksi bila dipanggil namanya atau acuh tak acuh terhadap suara di sekitarnya', 'P002'),
(10, 'G009', 'Tidak mampu mengetahui arah bunyi', 'P002'),
(11, 'G010', 'Sering mengalami infeksi di telinga', 'P002'),
(12, 'G011', 'Kepala kecil/besar/datar', 'P003'),
(13, 'G012', 'Tidak dapat mengurus diri sendiri sesuai usianya atau semua harus dibantu orang lain', 'P003'),
(14, 'G013', 'Perkembangan bicara/ bahasa terlambat atau tidak dapat bicara', 'P003'),
(15, 'G014', 'Kurang atau tidak dapat menyesuaikan diri dengan lingkungan', 'P003'),
(16, 'G015', 'Sering keluar ludah (cairan) dari mulut', 'P003'),
(17, 'G016', 'Anggota gerak tubuh kaku/ lemah/ lumpuh', 'P004'),
(18, 'G017', 'Kesulitan dalam gerakan', 'P004'),
(19, 'G018', 'Terdapat bagian anggota gerak yang tidak lengkap/ tidak sempurna/ lebih kecil dari biasa', 'P004'),
(20, 'G019', 'Terdapat cacat pada alat gerak', 'P005'),
(21, 'G020', 'Kesulitan pada saat berdiri/ berjalan/ duduk, dan menunjukan sikap tidak tidak normal', 'P005'),
(22, 'G021', 'Bersikap membangkang dan suka berbohong', 'P005'),
(23, 'G022', 'Mudah terangsang emosinya/ emosional/ mudah marah', 'P005'),
(24, 'G023', 'Sering melakukan tindakan agresif, merusak, dan mengganggu', 'P005'),
(25, 'G024', 'Kurang/tidak mampu menjalin hubungan dengan orang lain', 'P006'),
(26, 'G025', 'Mempunyai perasaan yang tertekan dan selalu merasa tidak bahagia', 'P006'),
(27, 'G026', 'Inatensi atau kesulitan memusatkan perhatian', 'P006'),
(28, 'G027', 'Impulsif atau kesulitan menahan keinginan', 'P006'),
(29, 'G028', 'Hiperaktif atau kesulitan mengendalikan gerakan', 'P006'),
(30, 'G029', 'Merasa tidak nyaman dalam keramaian, misalnya pesta ulang tahun, pernikahan', 'P007'),
(31, 'G030', 'Merasa lebih nyaman bila bermain sendiri', 'P007'),
(32, 'G031', 'Mengamuk hebat kalau tidak mendapat keinginannya', 'P007'),
(33, 'G032', 'Tertawa/ menangis/ marah tanpa sebab yang jelas', 'P007'),
(34, 'G033', 'Ada kebutuhan untuk mencium-cium sesuatu dan memasukan segala benda yang dipegangnya kedalam mulut atau digigit-gigit', 'P007'),
(35, 'G034', 'Memiliki perpaduan dua hambatan atau lebih', 'P008'),
(36, 'G035', 'Memiliki kemampuan yang sangat terbatas dalam mengekspresikan atau mengerti orang lain', 'P008'),
(37, 'G036', 'Pada umumnya mengalami keterlambatan perkembangan fisik dan motorik', 'P008'),
(38, 'G037', 'Sering berperilaku aneh dan tidak bertujuan', 'P008'),
(39, 'G038', 'Seringkali tidak mampu mengurus kebutuhan dasar mereka sendiri seperti makan, berpakaian, buang air kecil, dsb', 'P008'),
(40, 'G039', 'Rata-rata prestasi belajar selalu rendah', 'P009'),
(41, 'G040', 'Dalam menyelesaikan tugas-tugas akademik sering terlambat', 'P009'),
(42, 'G041', 'Daya tangkap terhadap pelajaran lambat', 'P009'),
(43, 'G042', 'Butuh waktu lama dan berulang-ulang untuk dapat menyelesaikan tugas-tugas akademik dan non akademik', 'P009'),
(44, 'G043', 'Lebih suka berteman dengan anak yang berusia signifikan di bawahnya', 'P009'),
(45, 'G044', 'Perkembangan kemampuan membaca lambat dan sering terjadi kesalahan dalam membaca', 'P010'),
(46, 'G045', 'Kalau menyalin tulisan sering terlambat selesai', 'P010'),
(47, 'G046', 'Tulisannya banyak salah/ terbalik/huruf hilang', 'P010'),
(48, 'G047', 'Sulit membedakan tanda-tanda +, -, x, :, =', 'P010'),
(49, 'G048', 'Sering salah membilang dengan urut', 'P010'),
(50, 'G049', 'Kesulitan dalam mengisap, mengunyah dan menelan saat makan dan minum', 'P011'),
(51, 'G050', 'Pembendaharaan kata atau kalimat minim', 'P011'),
(52, 'G051', 'Tidak mampu menyusun kalimat sederhana dan terkadang hanya menyebutkan suku kata akhirnya saja', 'P011'),
(53, 'G052', 'Ada kelainan organ wicara, misal celah pada bibir atau sumbing dan kelainan bentuk lidah', 'P011'),
(54, 'G053', 'Bicarnya sulit dimengerti', 'P011'),
(60, 'G054', 'Memiliki tingkat kecerdesan di atas ratarata, kreatif, dan berkomitmen terhadap tungas sangat tinggi', 'P012'),
(61, 'G055', 'Suka mendapat jawaban dari pertanyaan “bagaimana” dan “mengapa” tentang suatu hal', 'P012'),
(62, 'G056', 'Mempunyai energi yang tinggi dalam berhubungan dan memberi respon baik terhadap orang tua, guru, dan orang dewasa', 'P012'),
(63, 'G057', 'Suka mempelajari sesuatu yang baru dan mengerjakan tugas-tugas dengan baik dan efisien', 'P012'),
(64, 'G058', 'Dapat berkonsentrasi untuk jangka waktu panjang, terutama terhadap tugas atau bidang yang diminati', 'P012');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_diagnosa`
--

CREATE TABLE `hasil_diagnosa` (
  `id` int(11) NOT NULL,
  `id_anak` int(11) NOT NULL,
  `code_diagnosa` varchar(250) DEFAULT NULL,
  `nama_diagnosa` text DEFAULT NULL,
  `hasil_diagnosa` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil_diagnosa`
--

INSERT INTO `hasil_diagnosa` (`id`, `id_anak`, `code_diagnosa`, `nama_diagnosa`, `hasil_diagnosa`) VALUES
(9, 6, 'G001,G002,G003,G005,G016,G017,G018,G047,G057', 'Mata tampak merah| Bola mata tampak keruh (putih-putih ditengah), dan kadang-kadang seperti mata kucing (bersinar)| Bola mata bergerak sangat cepat| Melihat objek, menonton televisi, membaca buku atau melihat gambar di buku sangat dekat| Anggota gerak tubuh kaku/ lemah/ lumpuh| Kesulitan dalam gerakan| Terdapat bagian anggota gerak yang tidak lengkap/ tidak sempurna/ lebih kecil dari biasa| Sulit membedakan tanda-tanda +, -, x, :, =| Suka mempelajari sesuatu yang baru dan mengerjakan tugas-tugas dengan baik dan efisien', NULL),
(10, 7, 'G003,G009,G010,G011,G047,G048,G049,G050', 'Bola mata bergerak sangat cepat| Tidak mampu mengetahui arah bunyi| Sering mengalami infeksi di telinga| Kepala kecil/besar/datar| Sulit membedakan tanda-tanda +, -, x, :, =| Sering salah membilang dengan urut| Kesulitan dalam mengisap, mengunyah dan menelan saat makan dan minum| Pembendaharaan kata atau kalimat minim', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kebutuhan_kusus`
--

CREATE TABLE `kebutuhan_kusus` (
  `id` int(11) NOT NULL,
  `code` varchar(25) NOT NULL,
  `jenis_kebutuhan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kebutuhan_kusus`
--

INSERT INTO `kebutuhan_kusus` (`id`, `code`, `jenis_kebutuhan`) VALUES
(2, 'P001', 'Anak disabilitas penglihatan'),
(3, 'P002', 'Anak disabilitas pendengaran'),
(4, 'P003', 'Anak disabilitas intelektual'),
(5, 'P004', 'Anak disabilitas fisik'),
(6, 'P005', 'Anak disabilitas sosial'),
(7, 'P006', 'Anak dengan gangguan pemusatan perhatian dan hiperaktivitas (GPPH) atau attention deficit and hyperactivity disorder (ADHD)'),
(8, 'P007', 'Anak dengan gangguan spektrum autisma atau autism spectrum disorders (ASD)'),
(9, 'P008', 'Anak dengan gangguan ganda'),
(10, 'P009', 'Anak lamban belajar atau slow learner'),
(11, 'P010', 'Anak dengan kesulitan belajar khusus atau spesific learning disabilities'),
(12, 'P011', 'Anak dengan gangguan kemampuan komunikasi'),
(15, 'P012', 'Anak dengan potensi kecerdasan dan/ atau bakat istimewa');

-- --------------------------------------------------------

--
-- Table structure for table `wali`
--

CREATE TABLE `wali` (
  `id` int(11) NOT NULL,
  `wali` varchar(250) NOT NULL,
  `telfon` varchar(14) NOT NULL,
  `alamat` text NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wali`
--

INSERT INTO `wali` (`id`, `wali`, `telfon`, `alamat`, `username`, `password`) VALUES
(7, 'James Adam', '0123456789', 'Amurang', 'james', '8cb2237d0679ca88db6464eac60da96345513964');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anak`
--
ALTER TABLE `anak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_wali` (`id_wali`);

--
-- Indexes for table `diagnosa`
--
ALTER TABLE `diagnosa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code_diagnosa`),
  ADD KEY `code_kebutuhan` (`code_kebutuhan`);

--
-- Indexes for table `hasil_diagnosa`
--
ALTER TABLE `hasil_diagnosa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_anak` (`id_anak`);

--
-- Indexes for table `kebutuhan_kusus`
--
ALTER TABLE `kebutuhan_kusus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `wali`
--
ALTER TABLE `wali`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anak`
--
ALTER TABLE `anak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `diagnosa`
--
ALTER TABLE `diagnosa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `hasil_diagnosa`
--
ALTER TABLE `hasil_diagnosa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kebutuhan_kusus`
--
ALTER TABLE `kebutuhan_kusus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wali`
--
ALTER TABLE `wali`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anak`
--
ALTER TABLE `anak`
  ADD CONSTRAINT `anak_ibfk_1` FOREIGN KEY (`id_wali`) REFERENCES `wali` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `diagnosa`
--
ALTER TABLE `diagnosa`
  ADD CONSTRAINT `diagnosa_ibfk_1` FOREIGN KEY (`code_kebutuhan`) REFERENCES `kebutuhan_kusus` (`code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hasil_diagnosa`
--
ALTER TABLE `hasil_diagnosa`
  ADD CONSTRAINT `hasil_diagnosa_ibfk_1` FOREIGN KEY (`id_anak`) REFERENCES `anak` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
