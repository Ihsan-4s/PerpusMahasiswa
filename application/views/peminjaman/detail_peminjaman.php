<h1> Daftar mahasiswa</h1>
<a href="<?= base_url('pustakawan/dashboard') ?>">Kembali</a>
<table border="1">
	<tr>
		<th>NIM</th>
		<th>NAMA</th>
		<th>JURUSAN</th>
		<th>JUDUL</th>
		<th>LOKASI_RAK</th>
		<th>STATUS</th>
		<th>TGL DIPINJAM</th>
		<th>AKSI</th>
		<th>NOMINAL DENDA</th>
		<th>BAYAR DENDA</th>

	</tr>

	<?php foreach ($daftar as $a): ?>
		<tr>
			<td><?= $a->nim ?></td>
			<td><?= $a->nama ?></td>
			<td><?= $a->jurusan ?></td>
			<td><?= $a->judul ?></td>
			<td><?= $a->lokasi_rak ?></td>
			<td><?= $a->status ?></td>
			<td><?= $a->tanggal_pinjam ?></td>
			<td>
				<?php if($a->status == "dipinjam") : ?>
				<a href="<?= base_url('pengembalian/pengembalian_buku/' . $a->id) ?>">
					Kembalikan
				</a>
				<?php endif; ?>
			</td>
			<td>Rp. <?= number_format($a->nominal, 0, ',', '.') ?></td>
			<td>
				<?php if($a->status_bayar == true) : ?>
				<form action="<?= base_url('denda/bayar') ?>" method="post" style="display:inline;">
					<input type="hidden" name="id" value="<?= $a->pengembalian_id ?>">
					<button type="submit">Sudah Bayar</button>
				</form>
				<?php endif;?>
			</td>
			<td></td>
		</tr>
	<?php endforeach ?>
</table>
