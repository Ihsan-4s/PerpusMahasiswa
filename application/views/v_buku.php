<h2>Daftar Buku</h2>
<a href="<?= base_url('pustakawan/dashboard') ?>">Kembali</a>
<a href="<?= base_url('buku/tambah') ?>">+ Tambah Buku</a>

<table border="1" cellpadding="10">
<tr>
    <th>Judul</th>
    <th>Rak</th>
    <th>Stok</th>
    <th>Aksi</th>
</tr>
<?php foreach ($buku as $b): ?>
<tr>
    <td><?= $b->judul ?></td>
    <td><?= $b->lokasi_rak ?></td>
    <td><?= $b->stok ?></td>
	<td> 
		<a href="<?= base_url('buku/edit/'.$b->id) ?>"><button>Edit</button></a> 
		&nbsp;|&nbsp; 
		<a href="<?= base_url('buku/hapus/'.$b->id) ?>"><button>Hapus</button></a> 
	</td>

</tr>
<?php endforeach; ?>
</table>
