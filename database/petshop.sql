-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11 Jan 2019 pada 14.29
-- Versi Server: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petshop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_tanggal`
--

CREATE TABLE `detail_tanggal` (
  `id_detail_tanggal` int(8) NOT NULL,
  `id_kandang` int(8) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_tanggal`
--

INSERT INTO `detail_tanggal` (`id_detail_tanggal`, `id_kandang`, `tanggal`) VALUES
(77860, 1, '2019-01-12'),
(77861, 1, '2019-01-13'),
(77862, 1, '2019-01-14'),
(77863, 1, '2019-01-15'),
(77864, 1, '2019-01-16'),
(77865, 1, '2019-01-17'),
(77866, 1, '2019-01-18'),
(77867, 2, '2019-01-12'),
(77868, 2, '2019-01-13'),
(77869, 2, '2019-01-14'),
(77870, 2, '2019-01-15'),
(77871, 2, '2019-01-16'),
(77872, 2, '2019-01-17'),
(77873, 2, '2019-01-18'),
(77874, 1, '2019-01-25'),
(77875, 1, '2019-01-10'),
(77876, 1, '2019-01-11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_grooming`
--

CREATE TABLE `jadwal_grooming` (
  `id_jadwal` int(8) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal_grooming`
--

INSERT INTO `jadwal_grooming` (`id_jadwal`, `jam_mulai`, `jam_selesai`) VALUES
(1, '09:00:00', '10:00:00'),
(2, '10:00:00', '11:00:00'),
(3, '11:00:00', '12:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfirmasi_pembayaran`
--

CREATE TABLE `konfirmasi_pembayaran` (
  `id_konfirmasi` int(8) NOT NULL,
  `id_transaksi` int(8) NOT NULL,
  `nama_pengirim` varchar(20) NOT NULL,
  `nama_bank` varchar(20) NOT NULL,
  `no_rek_pengirim` varchar(20) NOT NULL,
  `jumlah_transfer` int(10) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `id_customer` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `konfirmasi_pembayaran`
--

INSERT INTO `konfirmasi_pembayaran` (`id_konfirmasi`, `id_transaksi`, `nama_pengirim`, `nama_bank`, `no_rek_pengirim`, `jumlah_transfer`, `gambar`, `id_customer`) VALUES
(1, 88, 'ahmad', 'BCA', '0988-0099-8777', 20000, 'Jellyfish.jpg  ', 1),
(2, 88, 'ahmad', 'BCA', '0988-0099-8777', 20000, 'Lighthouse.jpg  ', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket_grooming`
--

CREATE TABLE `paket_grooming` (
  `id_paket_grooming` int(8) NOT NULL,
  `nama_paket` varchar(20) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `deskripsi` varchar(150) NOT NULL,
  `harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `paket_grooming`
--

INSERT INTO `paket_grooming` (`id_paket_grooming`, `nama_paket`, `gambar`, `deskripsi`, `harga`) VALUES
(1, 'Paket 1', '1.jpg', 'Potong Kuku + Keramas', 30000),
(2, 'Paket 2', '2.jpg', 'Mandi + Gosok Gigi', 50000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket_penitipan`
--

CREATE TABLE `paket_penitipan` (
  `id_paket_penitipan` int(8) NOT NULL,
  `nama_paket` varchar(20) DEFAULT NULL,
  `gambar` varchar(50) NOT NULL,
  `deskripsi` varchar(50) DEFAULT NULL,
  `harga` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `paket_penitipan`
--

INSERT INTO `paket_penitipan` (`id_paket_penitipan`, `nama_paket`, `gambar`, `deskripsi`, `harga`) VALUES
(1, 'Penitipan 1', 'penitipan1.jpg', 'Kamar kelas 1 + Makan', 20000),
(2, 'Penitipan 2', 'penitipan2.jpg', 'Kamar kelas 2 + Makan', 15000),
(3, 'Penitipan 3', 'Tulips.jpg', 'Kamar Kelas 4 + makan malam', 10000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_customer`
--

CREATE TABLE `tb_customer` (
  `id_customer` int(8) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_customer`
--

INSERT INTO `tb_customer` (`id_customer`, `username`, `password`, `nama_lengkap`, `alamat`, `email`, `telepon`, `status`) VALUES
(1, 'ahmad', 'ahmad', 'ahmad sopyan', 'cikupa', 'ahmad@ahmad.com', '098899', 0),
(2, 'isti', 'isti', 'isti anah', 'cikupa', 'isti@isti.com', '098877', 0),
(3, 'febrian', 'febrian', 'febrian al', 'cikupa', 'febrian@febrian.com', '09882828', 0),
(4, 'shelly', 'shelly', 'shelly herpiani', 'cikupa', 'shelly@gmail.com', '098872888', 0),
(5, 'acep', 'acep', 'acep rohendi', 'cikupa', 'acep@gmail.com', '098999', 0),
(6, 'tomi', 'tomi', 'tomi k', 'cikupa', 'tomi@tomi.com', '099999', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kandang`
--

CREATE TABLE `tb_kandang` (
  `id_kandang` int(8) NOT NULL,
  `nama_kandang` varchar(30) NOT NULL,
  `keterangan` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kandang`
--

INSERT INTO `tb_kandang` (`id_kandang`, `nama_kandang`, `keterangan`) VALUES
(1, 'melati', '--'),
(2, 'mawar', '--');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_petugas`
--

CREATE TABLE `tb_petugas` (
  `id_petugas` int(8) NOT NULL,
  `nama_petugas` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `telepon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_petugas`
--

INSERT INTO `tb_petugas` (`id_petugas`, `nama_petugas`, `alamat`, `telepon`) VALUES
(1, 'acil', 'cikupa', '09881777'),
(2, 'oki', 'cerewet', '098878899');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(8) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `nama_lengkap` varchar(30) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama_lengkap`, `alamat`, `email`, `telepon`, `level`) VALUES
(1, 'tika', 'tika', 'tika devi', 'cikupa', 'tika@tika.com', '0874888', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_grooming`
--

CREATE TABLE `transaksi_grooming` (
  `id_transaksi_grooming` int(8) NOT NULL,
  `id_customer` int(8) NOT NULL,
  `tanggal` date NOT NULL,
  `status` int(8) NOT NULL,
  `status_order` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi_grooming`
--

INSERT INTO `transaksi_grooming` (`id_transaksi_grooming`, `id_customer`, `tanggal`, `status`, `status_order`) VALUES
(22, 6, '2019-01-11', 1, 'sedang di proses'),
(23, 6, '2019-01-11', 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_grooming_detail`
--

CREATE TABLE `transaksi_grooming_detail` (
  `id_trans_grooming_detail` int(8) NOT NULL,
  `id_transaksi_grooming` int(8) NOT NULL,
  `id_customer` int(8) NOT NULL,
  `id_paket_grooming` int(8) NOT NULL,
  `id_jadwal` int(10) NOT NULL,
  `subtotal` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `id_petugas` int(8) NOT NULL,
  `nama_hewan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi_grooming_detail`
--

INSERT INTO `transaksi_grooming_detail` (`id_trans_grooming_detail`, `id_transaksi_grooming`, `id_customer`, `id_paket_grooming`, `id_jadwal`, `subtotal`, `tanggal`, `id_petugas`, `nama_hewan`) VALUES
(49, 22, 6, 1, 1, 30000, '2019-01-11', 1, 'ss'),
(50, 22, 6, 1, 2, 30000, '2019-01-11', 1, '11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_penitipan`
--

CREATE TABLE `transaksi_penitipan` (
  `id_transaksi_penitipan` int(8) NOT NULL,
  `id_customer` int(8) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` int(8) DEFAULT NULL,
  `status_order` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi_penitipan`
--

INSERT INTO `transaksi_penitipan` (`id_transaksi_penitipan`, `id_customer`, `tanggal`, `status`, `status_order`) VALUES
(12, 6, '2019-01-11', 1, 'menunggu pembayaran'),
(13, 6, '2019-01-11', 1, 'menunggu pembayaran'),
(14, 6, '2019-01-11', 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_penitipan_detail`
--

CREATE TABLE `transaksi_penitipan_detail` (
  `id_trans_penitipan_detail` int(8) NOT NULL,
  `id_transaksi_penitipan` int(8) DEFAULT NULL,
  `id_customer` int(8) DEFAULT NULL,
  `id_paket_penitipan` int(8) DEFAULT NULL,
  `id_kandang` int(8) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `jumlah_hari` int(10) NOT NULL,
  `subtotal` int(10) DEFAULT NULL,
  `nama_hewan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi_penitipan_detail`
--

INSERT INTO `transaksi_penitipan_detail` (`id_trans_penitipan_detail`, `id_transaksi_penitipan`, `id_customer`, `id_paket_penitipan`, `id_kandang`, `tanggal_masuk`, `tanggal_keluar`, `jumlah_hari`, `subtotal`, `nama_hewan`) VALUES
(75, 12, 6, 1, 1, '2019-01-11', '2019-01-18', 7, 140000, 'nn'),
(76, 12, 6, 1, 2, '2019-01-11', '2019-01-18', 7, 140000, 'cc'),
(77, 13, 6, 1, 1, '2019-01-24', '2019-01-25', 1, 20000, 'qq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_tanggal`
--
ALTER TABLE `detail_tanggal`
  ADD PRIMARY KEY (`id_detail_tanggal`);

--
-- Indexes for table `jadwal_grooming`
--
ALTER TABLE `jadwal_grooming`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `konfirmasi_pembayaran`
--
ALTER TABLE `konfirmasi_pembayaran`
  ADD PRIMARY KEY (`id_konfirmasi`);

--
-- Indexes for table `paket_grooming`
--
ALTER TABLE `paket_grooming`
  ADD PRIMARY KEY (`id_paket_grooming`);

--
-- Indexes for table `paket_penitipan`
--
ALTER TABLE `paket_penitipan`
  ADD PRIMARY KEY (`id_paket_penitipan`);

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `tb_kandang`
--
ALTER TABLE `tb_kandang`
  ADD PRIMARY KEY (`id_kandang`);

--
-- Indexes for table `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `transaksi_grooming`
--
ALTER TABLE `transaksi_grooming`
  ADD PRIMARY KEY (`id_transaksi_grooming`);

--
-- Indexes for table `transaksi_grooming_detail`
--
ALTER TABLE `transaksi_grooming_detail`
  ADD PRIMARY KEY (`id_trans_grooming_detail`);

--
-- Indexes for table `transaksi_penitipan`
--
ALTER TABLE `transaksi_penitipan`
  ADD PRIMARY KEY (`id_transaksi_penitipan`);

--
-- Indexes for table `transaksi_penitipan_detail`
--
ALTER TABLE `transaksi_penitipan_detail`
  ADD PRIMARY KEY (`id_trans_penitipan_detail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_tanggal`
--
ALTER TABLE `detail_tanggal`
  MODIFY `id_detail_tanggal` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77877;

--
-- AUTO_INCREMENT for table `jadwal_grooming`
--
ALTER TABLE `jadwal_grooming`
  MODIFY `id_jadwal` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `konfirmasi_pembayaran`
--
ALTER TABLE `konfirmasi_pembayaran`
  MODIFY `id_konfirmasi` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paket_grooming`
--
ALTER TABLE `paket_grooming`
  MODIFY `id_paket_grooming` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paket_penitipan`
--
ALTER TABLE `paket_penitipan`
  MODIFY `id_paket_penitipan` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `id_customer` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_kandang`
--
ALTER TABLE `tb_kandang`
  MODIFY `id_kandang` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_petugas`
--
ALTER TABLE `tb_petugas`
  MODIFY `id_petugas` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi_grooming`
--
ALTER TABLE `transaksi_grooming`
  MODIFY `id_transaksi_grooming` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `transaksi_grooming_detail`
--
ALTER TABLE `transaksi_grooming_detail`
  MODIFY `id_trans_grooming_detail` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `transaksi_penitipan`
--
ALTER TABLE `transaksi_penitipan`
  MODIFY `id_transaksi_penitipan` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `transaksi_penitipan_detail`
--
ALTER TABLE `transaksi_penitipan_detail`
  MODIFY `id_trans_penitipan_detail` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
