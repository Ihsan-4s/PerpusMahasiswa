<h2>Dashboard Pustakawan</h2>
<p>Halo, <?= html_escape($this->session->userdata('nama')) ?> | <a href="<?= base_url('auth/logout') ?>">Logout</a></p>

<div style="display:flex; flex-wrap:wrap; gap:15px;">

	<div style="border:1px solid #ccc; padding:15px; min-width:200px;">
		<h4>Buku</h4>
		<p>Total Judul: <b><?= $total_judul_buku ?></b></p>
		<p>Total Stok: <b><?= $total_stok_buku ?></b></p>
		<a href="<?= base_url('buku') ?>">Kelola Buku &raquo;</a>
	</div>

	<div style="border:1px solid #ccc; padding:15px; min-width:200px;">
		<h4>Keanggotaan</h4>
		<p>Calon Anggota: <b><?= $calon_anggota ?></b> menunggu aktivasi</p>
		<p>Anggota Aktif: <b><?= $anggota_aktif ?></b></p>
		<a href="<?= base_url('pustakawan/calon_anggota') ?>">Kelola Anggota &raquo;</a>
		<a href="<?= base_url('pustakawan/register_mahasiswa') ?>">Register Mahasiswa &raquo;</a>
	</div>

	<div style="border:1px solid #ccc; padding:15px; min-width:200px;">
		<h4>Order Pembelian</h4>
		<!-- <p>Order Pending: <b><?= $order_pending ?></b></p> -->
		<a href="<?= base_url('order') ?>">Kelola Order &raquo;</a>
	</div>

	<div style="border:1px solid #ccc; padding:15px; min-width:200px;">
		<h4>Peminjaman</h4>

		<!-- <p>Sedang Dipinjam: <b><?= $peminjaman_aktif ?></b></p> -->
		<a href="<?= base_url('peminjaman') ?>">Kelola Peminjaman &raquo;</a>
		<!-- <a href="<?= base_url('peminjaman') ?>">Detail Peminjaman &raquo;</a> -->
		<h4>Denda</h4>
		<a href="<?= base_url('peminjaman') ?>">Kelola Denda &raquo;</a>
	</div>

	<!-- <div style="border:1px solid #ccc; padding:15px; min-width:200px;">
		<h4>Denda</h4> -->
	<!-- <p>Belum Dibayar: <b><?= $denda_belum_bayar ?></b> transaksi</p> -->
	<!-- <p>Total: <b>Rp <?= number_format($total_nominal_denda, 0, ',', '.') ?></b></p> -->
	<!-- </div> -->

</div>

