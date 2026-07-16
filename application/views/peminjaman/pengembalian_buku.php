<form action="<?= base_url('pengembalian/detail_pengembalian') ?>" method="post">

    <input type="hidden" name="peminjaman_id" value="<?= $pinjam->id ?>">
    <input type="hidden" name="buku_id" value="<?= $pinjam->buku_id ?>">

    <label>Nama</label><br>
    <input type="text" value="<?= $pinjam->nama ?>" readonly>

    <br><br>

    <label>NIM</label><br>
    <input type="text" value="<?= $pinjam->nim ?>" readonly>

    <br><br>

    <label>Judul Buku</label><br>
    <input type="text" value="<?= $pinjam->judul ?>" readonly>

    <br><br>

    <label>Kondisi Buku</label><br>
    <select name="kondisi_buku" required>
        <option value="" selected disabled>-- Pilih Kondisi --</option>
        <option value="baik">Baik</option>
        <option value="rusak">Rusak</option>
    </select>

    <br><br>

    <button type="submit">Kembalikan</button>

</form>
