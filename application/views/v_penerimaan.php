<h2>Riwayat Penerimaan Buku</h2>
<a href="<?= base_url('pustakawan/dashboard') ?>">Kembali</a>
<table border="1" cellpadding="10">
<tr>
    <th>Tanggal</th>
    <th>Order</th>
    <th>Buku</th>
    <th>Jumlah Diterima</th>
</tr>
<?php foreach ($penerimaan as $p): ?>
<tr>
    <td><?= $p->tanggal_terima ?></td>
    <td><?= $p->supplier ?> (#<?= $p->order_id ?>)</td>
    <td><?= $p->judul ?></td>
    <td><?= $p->jumlah_diterima ?></td>
</tr>
<?php endforeach; ?>
</table>
