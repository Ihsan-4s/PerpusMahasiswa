<h1>Daftar Peminjaman Buku</h1>
<a href="<?= base_url('pustakawan/dashboard') ?>">← Kembali</a>
<br><br>
<a href="<?= base_url('peminjaman/create') ?>">+ Tambah Peminjaman Baru</a>
<br><br>
<a href="<?= base_url('peminjaman/sudah_diterima') ?>">Detail pengembalian</a>

<table border="1" cellpadding="10">
	<thead>
		<tr>
			<th>NIM Mahasiswa</th>
			<th>Nama Mahasiswa</th>
			<th>Judul Buku</th>
			<th>Rak Buku</th>
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
				<td><?= $p->lokasi_rak ?></td>
				<td><?= $p->tanggal_pinjam ?></td>
				<td>

					<?php if ($p->status == 'dipinjam'): ?>
						<span style="color: red; font-weight: bold;">Dipinjam</span>
					<?php elseif ($p->status == 'dikembalikan' && $p->kondisi_buku == 'rusak'): ?>
						<span style="color: orange; font-weight: bold;">Buku rusak</span>
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
						<form id="bayarDenda" method="post" style="display:inline;">
							<input type="hidden" name="id" value="<?= $p->pengembalian_id ?>">
							<button type="submit">Sudah Bayar</button>
						</form>
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	$("#bayarDenda").submit(function (e) {
    e.preventDefault(); 
    $.ajax({
        url: "<?= base_url('denda/bayar') ?>",
        type: "POST",
        data: $(this).serialize(),
        dataType: "json",
        success: function (response) {
            if (response.status) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: response.message,
                    timer: 1500,
                    showConfirmButton: false
                }).then(function() {
                    window.location.href = "<?= base_url('peminjaman/index') ?>";
                });
            } else {
                Swal.fire('Gagal', response.message, 'error');
            }
        }
    });
});

</script>

