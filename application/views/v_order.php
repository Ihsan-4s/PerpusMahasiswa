<h2>Daftar Order Pembelian</h2>
<a href="<?= base_url('pustakawan/dashboard') ?>">Kembali</a>
<a href="<?= base_url('order/tambah') ?>">+ Tambah Order</a>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Supplier</th>
    <th>Tanggal</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
<?php foreach ($order as $o): ?>
<tr>
    <td><?= $o->id ?></td>
    <td><?= $o->supplier ?></td>
    <td><?= $o->tanggal_order ?></td>
    <td><?= $o->status ?></td>
    <td><a href="<?= base_url('order/detail/'.$o->id) ?>">Detail</a></td>
</tr>
<?php endforeach; ?>
</table>
