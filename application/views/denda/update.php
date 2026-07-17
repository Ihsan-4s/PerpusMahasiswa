<a href="<?= base_url('pustakawan/dashboard') ?>">Kembali</a>
<h3>Edit Nominal Denda</h3>
<<<<<<< HEAD

<div class="form-container">
	<form id="formDenda" method="post">
		<input type="hidden" name="denda_id" value="<?= $denda->id ?>">
		<label>Nominal Denda (Rp):</label>
		<input type="number" name="nominal" value="<?= $denda->nominal ?>" required>
		<button type="submit">Update Nominal</button>
		<a href="<?= base_url('peminjaman') ?>" class="btn-batal">Batal</a>
	</form>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	
	$("#formDenda").submit(function (e) {
		e.preventDefault();
		$.ajax({
			url: "<?= base_url('denda/proses_update') ?>",
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
					}).then(function () {
						window.location.href = "<?= base_url('peminjaman/index') ?>";
					});
				} else {
					Swal.fire('Gagal', response.message, 'error');
				}
			}
		});
	});

</script>
=======
	
    <div class="form-container">
        <form action="<?= base_url('denda/proses_update') ?>" method="post">
            <input type="hidden" name="denda_id" value="<?= $denda->id ?>">
            
            <label>Nominal Denda (Rp):</label>
            <input type="number" name="nominal" value="<?= $denda->nominal ?>" required>
            
            <button type="submit">Update Nominal</button>
            <a href="<?= base_url('peminjaman') ?>" class="btn-batal">Batal</a>
        </form>
    </div>
>>>>>>> b7385b754d74cac4e74aa21d0125ca72526bad1a
