<h1>Daftar Peminjaman Buku</h1>
<a href="<?= base_url('peminjaman/create') ?>">+ Tambah Peminjaman Baru</a>
<br><br>

<table border="1" cellpadding="10">
	<thead>
		<tr>
			<th>NIM Mahasiswa</th>
			<th>Nama Mahasiswa</th>
			<th>Judul Buku</th>
			<th>Tanggal Pinjam</th>
			<th>Status</th>
			<th>Kondisi Buku</th>
			<th>Nominal Denda</th>
			<th>Ubah Denda</th>
			<th>Pengembalian</th>
			<th>Bayar</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($peminjaman as $p): ?>
			<tr>
				<td><?= $p->nim ?></td>
				<td><?= $p->nama ?></td>
				<td><?= $p->judul ?></td>
				<td><?= $p->tanggal_pinjam ?></td>
				<td>

					<?php if ($p->status == 'dipinjam'): ?>
						<span style="color: red; font-weight: bold;">Dipinjam</span>
					<?php else: ?>
						<span style="color: green; font-weight: bold;">Dikembalikan</span>
					<?php endif; ?>
				</td>
				<td><?= $p->kondisi_buku ?></td>
				<td>
					<?php if ($p->kondisi_buku == "rusak"): ?>
						Rp. <?= number_format($p->nominal, 0, ',', '.') ?>
					</td>
				<?php endif; ?>
				<td>
					<?php if ($p->kondisi_buku == "rusak"): ?>
						<a href="<?= base_url('denda/index/' . $p->id) ?>">Edit Denda</a>
					<?php endif; ?>
				</td>
				<td>
					<?php if ($p->status == "dipinjam"): ?>
						<a href="<?= base_url('pengembalian/index/' . $p->id) ?>">+ kembalikan</a>
					<?php endif; ?>
				</td>
				<td>
					<?php if ($p->status == "dikembalikan"): ?>
						<form action="<?= base_url('denda/bayar') ?>" method="post" style="display:inline;">
							<input type="hidden" name="id" value="<?= $p->pengembalian_id ?>">
							<button type="submit">Sudah Bayar</button>
						</form>
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
