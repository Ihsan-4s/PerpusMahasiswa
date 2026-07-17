<form id="formReturn" method="post">

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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	$("#formReturn").submit(function (e) {
    e.preventDefault(); 
    $.ajax({
        url: "<?= base_url('pengembalian/update') ?>",
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
