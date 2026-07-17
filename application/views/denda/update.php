<a href="<?= base_url('pustakawan/dashboard') ?>">Kembali</a>
<h3>Edit Nominal Denda</h3>
	
    <div class="form-container">
        <form action="<?= base_url('denda/proses_update') ?>" method="post">
            <input type="hidden" name="denda_id" value="<?= $denda->id ?>">
            
            <label>Nominal Denda (Rp):</label>
            <input type="number" name="nominal" value="<?= $denda->nominal ?>" required>
            
            <button type="submit">Update Nominal</button>
            <a href="<?= base_url('peminjaman') ?>" class="btn-batal">Batal</a>
        </form>
    </div>
