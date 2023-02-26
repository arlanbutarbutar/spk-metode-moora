-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Feb 2023 pada 10.10
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_moora`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(11) NOT NULL,
  `kriteria` varchar(30) NOT NULL,
  `type` varchar(25) NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `kriteria`, `type`, `bobot`) VALUES
(1, 'C1', 'Nilai Raport', 'benefit', 1),
(2, 'C2', 'Presensi Kehadiran', 'benefit', 0.75),
(3, 'C3', 'Pekerjaan Orang Tua', 'cost', 0.65),
(4, 'C4', 'Penghasilan Orang Tua', 'benefit', 0.5),
(5, 'C5', 'Jumlah Tanggungan', 'benefit', 0.1),
(6, 'C6', 'Kondisi Keluarga', 'benefit', 0.5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_hasil`
--

CREATE TABLE `tabel_hasil` (
  `id_hasil` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `nilai` double NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_nilai`
--

CREATE TABLE `tabel_nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tabel_nilai`
--

INSERT INTO `tabel_nilai` (`id_nilai`, `id_kriteria`, `id_siswa`, `nilai`) VALUES
(1, 1, 5, 0),
(2, 2, 5, 85),
(3, 3, 5, 0),
(4, 4, 5, 0),
(5, 5, 5, 9),
(6, 5, 5, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_siswa`
--

CREATE TABLE `tabel_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `jenis_kelamin` varchar(25) NOT NULL,
  `ttl` date NOT NULL,
  `nilai_raport` varchar(25) NOT NULL,
  `presensi_kehadiran` varchar(20) NOT NULL,
  `pekerjan_orang_tua` varchar(25) NOT NULL,
  `penghasilan_orang_tua` varchar(25) NOT NULL,
  `jumlah_tanggungan` varchar(25) NOT NULL,
  `kondisi_keluarga` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tabel_siswa`
--

INSERT INTO `tabel_siswa` (`id_siswa`, `nama`, `jenis_kelamin`, `ttl`, `nilai_raport`, `presensi_kehadiran`, `pekerjan_orang_tua`, `penghasilan_orang_tua`, `jumlah_tanggungan`, `kondisi_keluarga`) VALUES
(2, 'IREN B. PASU', 'P', '2023-02-21', 'Nilai : 9-10', '85%-100%', 'Buruh', '<500.000', '9-10', 'Yatim'),
(3, 'arlan', 'L', '2023-02-22', 'Nilai : 7-8', '65%-80%', 'Pedagang', '800.000-900.000', '7-8', 'Yatim Piatu'),
(4, 'Evi', 'P', '2023-02-21', 'Nilai : 9-10', '85%-100%', 'Petani', '<500.000', '9-10', 'Yatim Piatu'),
(5, 'Evi', 'P', '2023-02-21', 'Nilai : 9-10', '85%-100%', 'Petani', '<500.000', '9-10', 'Yatim Piatu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_sub_kriteria`
--

CREATE TABLE `tabel_sub_kriteria` (
  `id_sub_kriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `sub_kriteria` varchar(25) NOT NULL,
  `nilai_sub` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tabel_sub_kriteria`
--

INSERT INTO `tabel_sub_kriteria` (`id_sub_kriteria`, `id_kriteria`, `sub_kriteria`, `nilai_sub`) VALUES
(1, 1, 'Nilai : 9-10', 6),
(5, 1, 'Nilai : 7-8', 5),
(6, 1, 'Nilai 6-7', 4),
(7, 1, 'Nilai: 5-6', 3),
(8, 1, 'Nilai: 4-5', 2),
(9, 1, 'Nilai: 2-3', 1),
(10, 2, '85%-100%', 6),
(11, 2, '65%-80%', 5),
(12, 2, '45%-60%', 4),
(23, 2, '35%-40%', 3),
(24, 2, '15%-30%', 2),
(25, 2, '5%-10%', 1),
(26, 3, 'Petani', 6),
(27, 3, 'Buruh', 5),
(28, 3, 'Nelayan', 4),
(29, 3, 'Pedagang', 3),
(30, 3, 'Swasta', 2),
(31, 3, 'PNS', 1),
(32, 4, '<500.000', 6),
(33, 4, '600.000-700.000', 5),
(34, 4, '800.000-900.000', 4),
(35, 4, '1.000.000-3.000.000', 3),
(36, 4, '2.000.000-4.000.000', 2),
(37, 4, '5.000.000-10.000.000', 1),
(38, 5, '9-10', 6),
(39, 5, '7-8', 5),
(40, 5, '5-6', 4),
(42, 5, '4-5', 3),
(43, 5, '2-3', 2),
(44, 5, '1', 1),
(45, 6, 'Yatim Piatu', 4),
(46, 6, 'Yatim', 3),
(47, 6, 'Piatu', 2),
(48, 6, 'Lengkap', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `id_role`, `username`, `email`, `password`) VALUES
(5, 1, 'evi', 'admin@gmail.com', '12345678'),
(6, 2, 'TU', 'tu@gmail.com', '12345678');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_role`
--

CREATE TABLE `users_role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users_role`
--

INSERT INTO `users_role` (`id_role`, `nama_role`) VALUES
(1, 'Admin'),
(2, 'Tata Usaha'),
(3, 'Kepala Sekolah');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `tabel_hasil`
--
ALTER TABLE `tabel_hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indeks untuk tabel `tabel_nilai`
--
ALTER TABLE `tabel_nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indeks untuk tabel `tabel_siswa`
--
ALTER TABLE `tabel_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indeks untuk tabel `tabel_sub_kriteria`
--
ALTER TABLE `tabel_sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`);

--
-- Indeks untuk tabel `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id_role`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tabel_hasil`
--
ALTER TABLE `tabel_hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tabel_nilai`
--
ALTER TABLE `tabel_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tabel_siswa`
--
ALTER TABLE `tabel_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tabel_sub_kriteria`
--
ALTER TABLE `tabel_sub_kriteria`
  MODIFY `id_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tabel_nilai`
--
ALTER TABLE `tabel_nilai`
  ADD CONSTRAINT `tabel_nilai_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`),
  ADD CONSTRAINT `tabel_nilai_ibfk_3` FOREIGN KEY (`id_siswa`) REFERENCES `tabel_siswa` (`id_siswa`);

--
-- Ketidakleluasaan untuk tabel `tabel_sub_kriteria`
--
ALTER TABLE `tabel_sub_kriteria`
  ADD CONSTRAINT `tabel_sub_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `users_role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
