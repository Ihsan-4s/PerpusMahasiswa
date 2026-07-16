<h2>Penerimaan Buku - Order #<?= $order->id ?> (<?= $order->supplier ?>)</h2>

<?php if ($order->status === 'selesai'): ?>
    <p style="color:green;"><strong>Order ini sudah selesai, semua buku telah diterima.</strong></p>
<?php endif; ?>

<form action="<?= base_url('penerimaan/simpan') ?>" method="post">
    <table>
        <tr>
            <td>Pilih Buku</td>
            <td>
                <select name="detail_order_id" required <?= ($order->status === 'selesai') ? 'disabled' : '' ?>>
                    <option value=""> Pilih Buku dalam Order </option>
                    <?php foreach ($detail as $d): ?>
                        <option value="<?= $d->id ?>" <?= ($d->sisa <= 0) ? 'disabled' : '' ?>>
                            <?= $d->judul ?> (sisa: <?= $d->sisa ?> dari <?= $d->quantity ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Jumlah Diterima</td>
            <td>
                <input type="number" name="jumlah_diterima" min="1" required
                    <?= ($order->status === 'selesai') ? 'disabled' : '' ?>>
            </td>
        </tr>
        <tr>
            <td>Tanggal Terima</td>
            <td>
                <input type="date" name="tanggal_terima" required
                    <?= ($order->status === 'selesai') ? 'disabled' : '' ?>>
            </td>
        </tr>
    </table>
    <br>
    <button type="submit" <?= ($order->status === 'selesai') ? 'disabled' : '' ?>>Simpan</button>
    <a href="<?= base_url('order/detail/'.$order->id) ?>"><button>Kembali</button></a>
</form>
