<h1>Detail Pengembalian Buku</h1>
<a href="<?= base_url('peminjaman/index') ?>">← Kembali</a>
<br><br>

<table border="1" cellpadding="10">
	<thead>
		<tr>
			<th>NIM Mahasiswa</th>
			<th>Nama Mahasiswa</th>
			<th>Judul Buku</th>
			<th>Rak Buku</th>
			<th>Tanggal Pinjam</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($peminjaman1 as $p): ?>
			<tr>
				<td><?= $p->nim ?></td>
				<td><?= $p->nama ?></td>
				<td><?= $p->judul ?></td>
				<td><?= $p->lokasi_rak ?></td>
				<td><?= $p->tanggal_pinjam ?></td>
				<td>
					<?php if ($p->status == 'dikembalikan' && $p->kondisi_buku == 'baik'): ?>
						<span style="color: green; font-weight: bold;">Dikembalikan</span>
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
