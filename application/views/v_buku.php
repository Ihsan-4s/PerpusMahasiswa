<h2>Daftar Buku</h2>
<a href="<?= base_url('buku/tambah') ?>">+ Tambah Buku</a>

<table border="1">
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
        <a href="<?= base_url('buku/edit/'.$b->id) ?>">Edit</a> |
        <a href="<?= base_url('buku/hapus/'.$b->id) ?>">Hapus</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
