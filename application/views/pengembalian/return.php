<form action="<?= base_url('pengembalian/update') ?>" method="post">

	<input type="hidden" name="peminjaman_id" value="<?= $barang->id ?>">
	<input type="hidden" name="buku_id" value="<?= $barang->buku_id ?>">

	<label>Nama</label><br>
	<input type="text" value="<?= $barang->nama ?>" readonly>

	<br><br>

	<label>NIM</label><br>
	<input type="text" value="<?= $barang->nim ?>" readonly>

	<br><br>

	<label>Judul Buku</label><br>
	<input type="text" value="<?= $barang->judul ?>" readonly>

	<br><br>

	<label>Tanggal Pengembalian :</label><br>
	<input type="date" name="tanggal_kembali" value="<?= date('Y-m-d') ?>" required>
	<br><br>

	<label>Kondisi Buku</label><br>
	<select name="kondisi_buku" required>
		<option value="" selected disabled>-- Pilih Kondisi --</option>
		<option value="baik">Baik</option>
		<option value="rusak">Rusak</option>
	</select>

	<br><br>

	<button type="submit">Kembalikan</button>

</form>
