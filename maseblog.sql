-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 13, 2025 at 03:59 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maseblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `idblog` int NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `tanggalbuat` date NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `idkategori` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`idblog`, `penulis`, `tanggalbuat`, `judul`, `isi`, `idkategori`) VALUES
(1, 'Admin Blog', '2025-06-01', 'Tren Terbaru dalam Teknologi AI di Tahun 2025', 'Kecerdasan Buatan (AI) terus berkembang pesat, membawa inovasi luar biasa di berbagai sektor. Tahun 2025 menjadi saksi munculnya tren AI yang lebih canggih, seperti AI generatif yang semakin mirip manusia, peningkatan penggunaan AI di bidang kesehatan untuk diagnostik dini, serta integrasi AI dalam kehidupan sehari-hari melalui asisten virtual yang lebih cerdas. Tantangan etika dan privasi data juga menjadi sorotan utama dalam pengembangan AI ke depan.', 1),
(2, 'Penulis A', '2025-06-02', 'Gaya Hidup Minimalis: Lebih Sedikit, Lebih Bahagia', 'Konsep gaya hidup minimalis semakin populer di kalangan masyarakat modern. Dengan fokus pada kepemilikan yang lebih sedikit dan pengalaman yang lebih banyak, minimalisme menawarkan jalan menuju kebahagiaan yang lebih otentik. Artikel ini membahas tips praktis untuk memulai hidup minimalis, mulai dari decluttering rumah hingga mengubah pola pikir konsumtif, yang pada akhirnya dapat mengurangi stres dan meningkatkan kualitas hidup.', 2),
(3, 'Chef Bima', '2025-06-03', 'Resep Soto Medan Autentik: Kenikmatan Kuah Rempah', 'Soto Medan adalah salah satu kuliner khas Sumatera Utara yang kaya akan rempah. Aroma harum dan kuahnya yang gurih menjadi daya tarik utama. Dalam resep ini, kami akan memandu Anda langkah demi langkah untuk menciptakan Soto Medan autentik di dapur Anda sendiri, lengkap dengan tips memilih bahan-bahan segar dan cara membuat sambal yang pedas menggigit.', 3),
(4, 'Edukator C', '2025-06-04', 'Pentingnya Pendidikan Karakter di Era Digital', 'Di tengah gempuran informasi digital, pendidikan karakter menjadi semakin krusial. Selain mengajarkan ilmu pengetahuan, sekolah dan keluarga perlu menanamkan nilai-nilai moral, etika, dan empati pada anak-anak. Artikel ini membahas strategi efektif untuk mengembangkan karakter positif pada generasi muda, mempersiapkan mereka menghadapi tantangan dunia yang terus berubah.', 4),
(5, 'Admin Blog', '2025-06-05', 'Revolusi Kendaraan Listrik: Masa Depan Transportasi', 'Kendaraan listrik bukan lagi sekadar konsep, melainkan realitas yang semakin mendominasi pasar otomotif. Dengan nol emisi dan biaya operasional yang lebih rendah, mobil listrik menawarkan solusi berkelanjutan untuk masalah polusi udara. Kami mengulas perkembangan terbaru, tantangan infrastruktur pengisian daya, dan prospek kendaraan listrik di masa depan.', 1),
(6, 'Penulis D', '2025-06-06', 'Manfaat Yoga untuk Kesehatan Mental dan Fisik', 'Yoga telah dikenal selama ribuan tahun sebagai praktik yang menyatukan pikiran, tubuh, dan jiwa. Lebih dari sekadar latihan fisik, yoga terbukti efektif mengurangi stres, meningkatkan fleksibilitas, dan memperbaiki kualitas tidur. Pelajari berbagai pose dasar yoga dan manfaatnya untuk kesehatan menyeluruh Anda.', 2),
(7, 'Chef Emily', '2025-06-07', 'Inovasi Kuliner Nusantara: Fusion Food yang Menggoda Selera', 'Kuliner Indonesia tidak pernah berhenti berinovasi. Tren fusion food kini menghadirkan perpaduan cita rasa tradisional dengan sentuhan modern dari berbagai belahan dunia. Dari rendang pasta hingga nasi goreng paella, temukan kreasi-kreasi unik yang memanjakan lidah dan membuka wawasan kuliner Anda.', 3),
(8, 'Edukator F', '2025-06-08', 'Peran Orang Tua dalam Mendukung Pembelajaran Jarak Jauh', 'Pembelajaran jarak jauh menjadi norma baru di banyak tempat. Peran aktif orang tua sangat penting untuk memastikan anak-anak tetap termotivasi dan efektif dalam belajar dari rumah. Artikel ini memberikan tips bagi orang tua tentang cara menciptakan lingkungan belajar yang kondusif dan cara menjaga komunikasi yang baik dengan guru.', 4),
(9, 'Admin Blog', '2025-06-09', 'Cybersecurity di Era Post-Kuantum: Ancaman dan Solusi', 'Dengan kemajuan komputasi kuantum, sistem enkripsi tradisional mungkin tidak lagi aman di masa depan. Cybersecurity di era post-kuantum menjadi tantangan baru yang harus dihadapi. Kami membahas potensi ancaman dan solusi-solusi kriptografi baru yang sedang dikembangkan untuk melindungi data dari serangan kuantum.', 1),
(10, 'Penulis G', '2025-06-10', 'Self-Care di Tengah Kesibukan: Pentingnya Menjaga Diri', 'Di dunia yang serba cepat ini, mudah sekali melupakan pentingnya self-care. Menjaga diri bukan berarti egois, melainkan investasi untuk kesehatan fisik dan mental jangka panjang. Temukan ide-ide self-care sederhana yang bisa Anda praktikkan setiap hari, bahkan di tengah jadwal yang padat.', 2),
(11, 'Chef Kevin', '2025-06-11', 'Rahasia Membuat Kopi ala Barista di Rumah', 'Tidak perlu ke kafe untuk menikmati kopi berkualitas. Dengan beberapa peralatan dasar dan teknik yang tepat, Anda bisa menyeduh kopi nikmat ala barista di rumah. Artikel ini membagikan tips memilih biji kopi, cara menyeduh dengan berbagai metode, dan trik untuk latte art sederhana.', 3),
(12, 'Edukator H', '2025-06-12', 'Membangun Kebiasaan Membaca Sejak Dini pada Anak', 'Membaca adalah gerbang ilmu. Membangun kebiasaan membaca sejak dini pada anak sangat penting untuk perkembangan kognitif dan imajinasi mereka. Kami berbagi tips praktis untuk menumbuhkan minat baca pada anak-anak, mulai dari membacakan dongeng hingga menciptakan pojok baca yang nyaman di rumah.', 4),
(13, 'Admin Blog', '2025-06-13', 'Big Data dan Analitik: Memahami Pola di Balik Angka', 'Big Data telah mengubah cara bisnis beroperasi, memungkinkan pengambilan keputusan yang lebih cerdas. Dengan analitik data yang canggih, perusahaan dapat mengidentifikasi pola, memprediksi tren, dan mengoptimalkan strategi. Pelajari bagaimana Big Data membentuk masa depan industri.', 1),
(14, 'Penulis I', '2025-06-14', 'Tren Fashion Berkelanjutan: Tampil Stylish Tanpa Merusak Bumi', 'Kesadaran akan dampak lingkungan mendorong lahirnya tren fashion berkelanjutan. Dari bahan daur ulang hingga proses produksi etis, fashion berkelanjutan menawarkan cara untuk tampil modis sekaligus bertanggung jawab. Jelajahi merek-merek lokal dan global yang berkomitmen pada praktik berkelanjutan.', 2),
(15, 'Chef Laura', '2025-06-15', 'Kreasi Dessert Kekinian: Dari Matcha Lava Cake hingga Dalgona Coffee', 'Dunia dessert terus berinovasi dengan munculnya kreasi-kreasi baru yang menarik perhatian. Resep-resep ini akan membantu Anda membuat dessert kekinian yang viral, seperti Matcha Lava Cake yang lumer di mulut atau Dalgona Coffee yang creamy dan lezat.', 3),
(16, 'Edukator J', '2025-06-16', 'Strategi Belajar Efektif untuk Ujian Akhir', 'Menghadapi ujian akhir seringkali menjadi tantangan. Namun, dengan strategi belajar yang tepat, Anda bisa mempersiapkan diri dengan lebih baik. Artikel ini menyajikan tips tentang manajemen waktu, teknik mencatat, dan cara mengatasi kecemasan ujian untuk hasil yang maksimal.', 4),
(17, 'Admin Blog', '2025-06-17', 'Internet of Things (IoT): Menghubungkan Dunia Nyata ke Digital', 'IoT terus memperluas jangkauannya, menghubungkan perangkat sehari-hari ke internet dan menciptakan ekosistem cerdas. Dari rumah pintar hingga kota pintar, IoT mengubah cara kita berinteraksi dengan lingkungan. Pahami potensi dan implikasi IoT di masa depan.', 1),
(18, 'Penulis K', '2025-06-18', 'Tips Produktivitas: Maksimalkan Hari Anda dengan Cerdas', 'Merasa waktu tidak pernah cukup? Kunci produktivitas bukan hanya bekerja keras, tetapi juga bekerja cerdas. Temukan tips dan trik manajemen waktu, teknik fokus, dan cara menghindari prokrastinasi untuk mencapai lebih banyak dalam sehari.', 2),
(19, 'Chef Mario', '2025-06-19', 'Mengolah Seafood Segar: Panduan Lengkap untuk Pemula', 'Mengolah seafood bisa menjadi tantangan, tetapi juga sangat memuaskan. Dari memilih bahan segar hingga teknik memasak yang tepat, panduan ini akan membantu pemula menciptakan hidangan seafood yang lezat dan aman untuk dikonsumsi.', 3),
(20, 'Edukator L', '2025-06-20', 'Pendidikan Inklusif: Menjamin Hak Belajar untuk Semua', 'Setiap anak berhak mendapatkan pendidikan berkualitas, terlepas dari latar belakang atau kondisi fisik mereka. Pendidikan inklusif bertujuan menciptakan lingkungan belajar yang mendukung semua siswa. Artikel ini membahas prinsip-prinsip dan manfaat pendidikan inklusif.', 4),
(21, 'Admin Blog', '2025-06-21', 'Masa Depan Metaverse: Interaksi Virtual yang Imersif', 'Konsep metaverse, dunia virtual yang imersif dan interaktif, semakin mendekati kenyataan. Dari hiburan hingga pekerjaan, metaverse berpotensi mengubah cara kita hidup dan berinteraksi. Jelajahi teknologi di balik metaverse dan kemungkinan masa depannya.', 1),
(22, 'Penulis M', '2025-06-22', 'Kesehatan Mental Remaja: Mengatasi Stres dan Kecemasan', 'Masa remaja adalah periode penting yang penuh perubahan, seringkali disertai dengan stres dan kecemasan. Artikel ini memberikan panduan bagi remaja dan orang tua tentang cara mengenali tanda-tanda masalah kesehatan mental dan strategi untuk mengelola emosi dengan sehat.', 2),
(23, 'Chef Nora', '2025-06-23', 'Kuliner Sehat dan Lezat: Resep Makanan Bergizi Seimbang', 'Makanan sehat tidak harus membosankan. Resep-resep ini membuktikan bahwa Anda bisa menikmati hidangan yang lezat sekaligus bergizi seimbang. Temukan ide-ide untuk sarapan, makan siang, dan makan malam yang akan membuat tubuh Anda bugar.', 3),
(24, 'Edukator O', '2025-06-24', 'Peran Teknologi dalam Transformasi Pendidikan', 'Teknologi telah menjadi katalis utama dalam transformasi pendidikan. Dari e-learning hingga realitas virtual, alat-alat digital membuka peluang baru untuk pembelajaran yang lebih interaktif dan personal. Mari kita selami bagaimana teknologi membentuk masa depan pendidikan.', 4),
(25, 'Admin Blog', '2025-06-25', 'Membuat Aplikasi Mobile Tanpa Coding: Platform Low-Code/No-Code', 'Impian membuat aplikasi sendiri kini bisa terwujud tanpa perlu menguasai bahasa pemrograman. Platform low-code/no-code memungkinkan siapa saja membangun aplikasi fungsional dengan antarmuka visual. Pelajari bagaimana platform ini mendemokratisasi pengembangan aplikasi.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int NOT NULL,
  `namakategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `namakategori`) VALUES
(1, 'Teknologi'),
(2, 'Gaya Hidup'),
(3, 'Kuliner'),
(4, 'Pendidikan');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `uname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `uname`, `email`, `password`, `role`) VALUES
(1, 'mase', 'mase', '$2y$10$KGqjQGZCYKpiqzQC2k4ZTuXye2axKoUqLsjjzp1/fR.UMR6vknHym', 1),
(2, 'admin', 'admin', '$2y$10$s6cL7YgsoPIqWBZbaFtKc.fAsL.tpQbln22MJU9.XI5BfW9267Aaa', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`idblog`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `idblog` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
