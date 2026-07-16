<h2>Detail Order #<?= $order->id ?> - <?= $order->supplier ?></h2>
<p>Tanggal: <?= $order->tanggal_order ?> | Status: <?= $order->status ?></p>

<h3>Daftar Buku dalam Order</h3>
<table border="1">
<tr>
    <th>Judul</th>
    <th>Quantity Pesan</th>
    <th>Sudah Diterima</th>
    <th>Sisa</th>
    <th>Aksi</th>
</tr>
<?php foreach ($detail as $d): ?>
<tr>
    <td><?= $d->judul ?></td>
    <td><?= $d->quantity ?></td>
    <td><?= $d->total_diterima ?></td>
    <td><?= $d->sisa ?></td>
    <td>
        <a href="<?= base_url('order/hapus_detail/'.$d->id.'/'.$order->id) ?>">Hapus</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<h3>Tambah Buku ke Order</h3>
<form action="<?= base_url('order/simpan_detail') ?>" method="post">
    <input type="hidden" name="order_id" value="<?= $order->id ?>">

    <select name="buku_id" required>
        <option value="">-- Pilih Buku --</option>
        <?php foreach ($buku as $b): ?>
            <option value="<?= $b->id ?>"><?= $b->judul ?></option>
        <?php endforeach; ?>
    </select>

    <input type="number" name="quantity" placeholder="Jumlah" min="1" required>

    <button type="submit">Tambah</button>
</form>

<br>
<a href="<?= base_url('penerimaan/tambah/'.$order->id) ?>">+ Input Penerimaan Buku untuk Order Ini</a>
<br><br>
<a href="<?= base_url('order') ?>">Kembali ke Daftar Order</a>
