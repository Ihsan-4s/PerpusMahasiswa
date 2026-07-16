<h2>Edit Buku</h2>

<form action="<?= base_url('buku/update/'.$buku->id) ?>" method="post">
    <table>
        <tr>
            <td>Judul</td>
            <td>
                <input type="text" name="judul" value="<?= $buku->judul ?>" required>
            </td>
        </tr>
        <tr>
		<td>Lokasi Rak</td>
		<td>
			<input type="text" name="lokasi_rak" value="<?= $buku->lokasi_rak ?>" required>
		</td>
	</tr>
        <tr>
            <td>Stok</td>
            <td>
                <?= $buku->stok ?> (Hanya berubah lewat Penerimaan Buku)
            </td>
        </tr>
    </table>
    <br>
    <button type="submit">Update</button>
    <a href="<?= base_url('buku') ?>">Batal</a>
</form>
