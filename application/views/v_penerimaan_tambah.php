<h2>Penerimaan Buku - Order #<?= $order->id ?> (<?= $order->supplier ?>)</h2>

<form action="<?= base_url('penerimaan/simpan') ?>" method="post">
    <table>
        <tr>
            <td>Pilih Buku</td>
            <td>
                <select name="detail_order_id" required>
                    <option value="">-- Pilih Buku dalam Order --</option>
                    <?php foreach ($detail as $d): ?>
                        <option value="<?= $d->id ?>">
                            <?= $d->judul ?> (pesan: <?= $d->quantity ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Jumlah Diterima</td>
            <td><input type="number" name="jumlah_diterima" min="1" required></td>
        </tr>
        <tr>
            <td>Tanggal Terima</td>
            <td><input type="date" name="tanggal_terima" required></td>
        </tr>
    </table>
    <br>
    <button type="submit">Simpan</button>
    <a href="<?= base_url('order/detail/'.$order->id) ?>">Batal</a>
</form>
