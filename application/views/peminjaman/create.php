<h2>Tambah Peminjaman Buku</h2>

<form id="formPinjam">
	<label>Mahasiswa:</label><br>
	<select name="mahasiswa_id" required>
		<option value="">-- Pilih Mahasiswa --</option>
		<?php foreach ($mahasiswa as $m): ?>
			<option value="<?= $m->id ?>">
				<?= $m->nim ?> - <?= $m->nama ?>
			</option>
		<?php endforeach; ?>
	</select>
	<br><br>

	<label>Buku:</label><br>
	<select name="buku_id" required>
		<option value="">-- Pilih Buku --</option>
		<?php foreach ($buku as $b): ?>
			<option value="<?= $b->id ?>">
				<?= $b->judul ?> (Stok: <?= $b->stok ?>)
			</option>
		<?php endforeach; ?>
	</select>
	<br><br>

	<label>Tanggal Pinjam:</label><br>
	<input type="date" name="tanggal_pinjam" value="<?= date('Y-m-d') ?>" required>
	<br><br>

	<button type="submit">Pinjam Sekarang</button>
	<br><br>
	<a href="<?= base_url('peminjaman') ?>"> ← Kembali</a>

</form>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	$("#formPinjam").submit(function (e) {
    e.preventDefault(); 
    $.ajax({
        url: "<?= base_url('peminjaman/store') ?>",
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
