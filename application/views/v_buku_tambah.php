<?php if ($this->session->flashdata('error')): ?>
    <p style="color:red;"><?= $this->session->flashdata('error') ?></p>
<?php endif; ?>

<h2>Tambah Buku</h2>

<form action="<?= base_url('buku/simpan') ?>" method="post">
    <table>
        <tr>
            <td>Judul</td>
            <td>
                <input type="text" name="judul" required>
            </td>
        </tr>
        <tr>
		<td>Lokasi Rak</td>
		<td>
			<input type="text" name="lokasi_rak" required>
		</td>
	</tr>
    </table>
    <br>
    <button type="submit">Simpan</button>
</form>
<a href="<?= base_url('buku') ?>"><button>Batal</button></a>
