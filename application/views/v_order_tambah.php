<h2>Tambah Order Pembelian</h2>

<form action="<?= base_url('order/simpan') ?>" method="post">
    <table>
        <tr>
            <td>Supplier</td>
            <td><input type="text" name="supplier" required></td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td><input type="date" name="tanggal" required></td>
        </tr>
    </table>
    <br>
    <button type="submit">Simpan & Lanjut Isi Buku</button>
</form>
<a href="<?= base_url('order') ?>"><button>Batal</button></a>
