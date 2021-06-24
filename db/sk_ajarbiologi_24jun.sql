-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 24, 2021 at 05:08 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sk_ajarbiologi`
--

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `kelas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `kelas`) VALUES
(1, 'X IPA 1'),
(2, 'X IPA 2');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `id_tema`, `id_siswa`, `nilai`) VALUES
(3, 3, 8, 100),
(4, 3, 10, 50),
(5, 3, 9, 62.5);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL DEFAULT '12345',
  `level` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'siswa', 'siswa', 'siswa'),
(3, 'kepsek', 'kepsek', 'kepsek'),
(4, 'wakepsek', 'wakepsek', 'wakepsek'),
(5, 'guru', 'guru', 'guru'),
(8, '1211', '12345', 'siswa'),
(9, '1212', '12345', 'siswa'),
(10, '1213', '12345', 'siswa'),
(11, '1214', '12345', 'siswa'),
(12, '1215', '12345', 'siswa'),
(13, '1216', '12345', 'siswa'),
(14, '1217', '12345', 'siswa'),
(15, '1218', '12345', 'siswa'),
(16, '1219', '12345', 'siswa'),
(17, '1220', '12345', 'siswa'),
(18, '1221', '12345', 'siswa'),
(19, '1222', '12345', 'siswa'),
(20, '1223', '12345', 'siswa'),
(21, '1224', '12345', 'siswa'),
(22, '1225', '12345', 'siswa'),
(23, '1226', '12345', 'siswa'),
(24, '1227', '12345', 'siswa'),
(25, '1228', '12345', 'siswa'),
(26, '1229', '12345', 'siswa'),
(27, '1230', '12345', 'siswa');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nis` varchar(10) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nama_siswa`, `tempat_lahir`, `tgl_lahir`, `alamat`, `jenis_kelamin`, `id_kelas`) VALUES
(1, '1211', 'Astuti Tuti', 'Sanggau', '2005-03-23', 'Jalan Pancasila No 12', 'Perempuan', 1),
(2, '1212', 'Bunga', 'Bengkayang', '2004-01-04', 'Jalan Reformasi No 91', 'Perempuan', 1),
(3, '1213', 'Budiman', 'Singkawang', '2003-07-15', 'Jalan Batu Gede No 43', 'Laki-laki', 1),
(4, '1214', 'Chandra', 'Pontianak', '2004-11-26', 'Jalan Suka Jati No 123', 'Laki-laki', 1),
(5, '1215', 'Caca Amelia', 'Sanggau', '2004-07-17', 'Jalan Jati No 198', 'Perempuan', 1),
(6, '1216', 'Ditta Karmila', 'Pontianak', '2004-05-08', 'Jalan Perdamaian No 5', 'Perempuan', 1),
(7, '1217', 'Echa ', 'Bengkayang', '2004-01-19', 'Jalan Karung No 39', 'Perempuan', 1),
(8, '1218', 'Deddy', 'Bengkayang', '2004-03-10', 'Jalan Perdamaian No 54', 'Laki-laki', 1),
(9, '1219', 'Gilang', 'Jakarta', '2004-09-21', 'Jalan Pantai No 98', 'Laki-laki', 1),
(10, '1220', 'Toto Kucai', 'Pontianak', '2005-01-13', 'Jalan Gusti Indah 1 No 45', 'Laki-laki', 1),
(11, '1221', 'Amanda Indah', 'Bengkayang', '2004-12-02', 'Jalan Gusti Indah 2 No 76', 'Perempuan', 2),
(12, '1222', 'Bobo Purnama', 'Singkawang', '2003-02-25', 'Jalan Matahari No 101', 'Laki-laki', 2),
(13, '1223', 'Daniel', 'Pontianak', '2005-01-13', 'Jalan Agung Sejahtera No 98', 'Laki-laki', 2),
(14, '1224', 'Herlambang', 'Sanggau', '2004-12-24', 'Jalan Purnama No 23', 'Laki-laki', 2),
(15, '1225', 'Joko Supratman', 'Sanggau', '2004-01-19', 'Jalan Indah Permai No 35', 'Laki-laki', 2),
(16, '1226', 'Mamat', 'Bengkayang', '2004-09-28', 'Jalan Danau Pelosok No 105', 'Laki-laki', 2),
(17, '1227', 'Putri ', 'Singkawang', '2004-06-21', 'Jalan Batu Gede No 92', 'Perempuan', 2),
(18, '1228', 'Sumapo', 'Pontianak', '2005-07-03', 'Jalan Gusti Indah 1 No 18', 'Laki-laki', 2),
(19, '1229', 'Tika Atusari', 'Sanggau', '2004-01-05', 'Jalan Perdamaian No 83', 'Perempuan', 2),
(20, '1230', 'Yaya Lestari', 'Pontianak', '2003-02-17', 'Jalan Agung Sejahtera No 64', 'Perempuan', 2);

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `opsi_a` varchar(255) NOT NULL,
  `opsi_b` varchar(255) NOT NULL,
  `opsi_c` varchar(255) NOT NULL,
  `opsi_d` varchar(255) NOT NULL,
  `opsi_e` varchar(255) NOT NULL,
  `jawaban` varchar(255) NOT NULL,
  `deskripsi_materi` text DEFAULT NULL,
  `content_materi` varchar(255) DEFAULT NULL,
  `id_tema` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id`, `pertanyaan`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `jawaban`, `deskripsi_materi`, `content_materi`, `id_tema`) VALUES
(17, 'Makhluk hidup serta faktor biotik yang terdapat di dalam sebuah lingkungan merupakan suatu kesatuan yang utuh. Peryataan tersebut merupakan definisi dari istilah …', 'Populasi', 'Ekosistem', 'Bioma', 'Genetika', 'Mutasi', 'opsi_b', '', '', 3),
(18, 'Kandungan gas karbondioksida dimanfaatkan untuk … dalam daur karbon. Jawaban yang tepat untuk mengisi ruang rumpang di atas ialah …', 'Bernapas', 'Respirasi', 'Katabolisme', 'Fotosintesis', 'Menarik Oksigen', 'opsi_d', '', '', 3),
(19, 'Berikut ini yang merupakan detrivor pada ekosistem ialah …', 'Rumput – kambing – harimau – bakteri', 'Daun – belalang – burung – ular', 'Bangkai – ulat – ayam – elang', 'Padi – ayam – ular – elang', 'Jagung – burung – elang – ular', 'opsi_a', '', '', 3),
(20, 'Organisme yang hidup di dalam ekosistem perairan dapat berupa...', 'Nekton', 'Plankton', 'Perifiton', 'Neuston', 'Bentos', 'opsi_a', 'Perairan sawah', '1624160331867Ke07adMOyL7Ys7WQ32MIixcOM5qGDO.jpg', 3),
(21, 'Kesimpulan yang tepat untuk gamar piramida energi diatas adalah....', 'Ketika puncak piramid dicapai, jumlah individu menurun tapi jumlah energinya meningkat', 'Ketika puncak piramid dicapai, jumlah individu meningkat, dan jumlah energi sama', 'Pada dasar piramid, jumlah individu dan jumlah energi yang terlibat adalah paling besar', 'Pada dasar piramid, jumlah individu dan jumlah energi yang terlibat adalah paling rendah', 'Pada semua tingkat, jumlah individu dan jumlah energi yang terlibat adalah sama', 'opsi_c', 'Perhatikan gambar diatas.', '1624160446736R8L2J7o2bRJdtB1NlpY16HrUG3xMDG.webp', 3),
(22, 'Berdasarkan data diatas udara cadangan inspirasi adalah sebanyak...', '625 ml', '750 ml', '1500 ml', '3625  ml', '4625 ml', 'opsi_b', 'Perhatikan data hasil pengukuran volume udara pernapasan di bawah ini, pada seorang wanita, usia 20 tahun, posisi duduk, tinggi badan: 150 cm, berat badan: 44 kg, suhu kamar: 25°C.', '1624160552060c1S7ExHx5P6zu7QnlBdbLhBLwNULKK.webp', 3),
(23, 'Pemakaian pestisida yang berlebihan akan mengakibatkan...', 'Menyuburkan tanah', 'Memperbanyak humus', 'Mematikan mikroba', 'Mematikan ular', 'Menyuburkan rasa sayang ke gebetan', 'opsi_c', 'Petani sedang menggunakan mobil besar untuk menyebar pestisida secara merata.', '1624160975824mUQ5Ou97WKIRZ2kaZp51p3jFO7bFsT.jpg', 3),
(24, 'Pada jaring-jaring makanan tersebut terdapat beberapa rantai makanan di antaranya adalah sebagai berikut.', 'padi –&gt; tikus –&gt; elang –&gt; pengurai', 'padi –&gt; tikus –&gt; musang –&gt; elang –&gt; pengurai', 'padi –&gt; burung –&gt; musang –&gt; elang –&gt; pengurai', 'padi –&gt; burung –&gt; elang –&gt; pengurai', 'pengurai –&gt; padi –&gt; elang –&gt; burung', 'opsi_a', 'Perhatikan gambar diatas.', '1624161135088fuJ5qFE6nrZy1EO9CzWNY7tRVu88zM.png', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tema`
--

CREATE TABLE `tema` (
  `id` int(11) NOT NULL,
  `nama_tema` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tema`
--

INSERT INTO `tema` (`id`, `nama_tema`) VALUES
(3, 'Ekosistem'),
(6, 'Aliran Energi'),
(7, 'Daur Materi'),
(8, 'Rantai Makanan'),
(9, 'Jaring-jaring Makanan');

-- --------------------------------------------------------

--
-- Table structure for table `temp_data_nilai`
--

CREATE TABLE `temp_data_nilai` (
  `id` int(11) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `score` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `temp_data_nilai`
--

INSERT INTO `temp_data_nilai` (`id`, `id_tema`, `id_siswa`, `id_soal`, `score`) VALUES
(201, 3, 8, 17, 1),
(202, 3, 8, 18, 1),
(203, 3, 8, 19, 1),
(204, 3, 8, 20, 1),
(205, 3, 8, 21, 1),
(206, 3, 8, 22, 1),
(207, 3, 8, 23, 1),
(208, 3, 8, 24, 1),
(209, 3, 9, 17, 1),
(210, 3, 9, 18, 0),
(211, 3, 9, 19, 0),
(212, 3, 9, 20, 1),
(213, 3, 9, 21, 1),
(214, 3, 10, 17, 0),
(215, 3, 10, 18, 0),
(216, 3, 10, 19, 1),
(217, 3, 10, 20, 1),
(218, 3, 10, 21, 0),
(219, 3, 10, 22, 0),
(220, 3, 10, 23, 1),
(221, 3, 9, 22, 1),
(222, 3, 10, 24, 1),
(223, 3, 9, 23, 0),
(224, 3, 9, 24, 1),
(225, 3, 12, 17, 1),
(226, 3, 12, 18, 1),
(227, 3, 12, 19, 0),
(228, 3, 15, 17, 0),
(229, 3, 15, 18, 0),
(230, 3, 12, 20, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_data_nilai`
--
ALTER TABLE `temp_data_nilai`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tema`
--
ALTER TABLE `tema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `temp_data_nilai`
--
ALTER TABLE `temp_data_nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
