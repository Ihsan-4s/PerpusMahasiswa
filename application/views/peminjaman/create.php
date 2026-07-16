<h2>Tambah Peminjaman Buku</h2>
    <a href="<?= base_url('pustakawan/dashboard') ?>">Kembali</a>
    <form action="<?= base_url('peminjaman/store') ?>" method="post">
        
        <label>Mahasiswa:</label><br>
        <select name="mahasiswa_id" required>
            <option value="">-- Pilih Mahasiswa --</option>
            <?php foreach($mahasiswa as $m) : ?>
                <option value="<?= $m->id ?>">
                    <?= $m->nim ?> - <?= $m->nama ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label>Buku:</label><br>
        <select name="buku_id" required>
            <option value="">-- Pilih Buku --</option>
            <?php foreach($buku as $b) : ?>
                <option value="<?= $b->id ?>">
                    <?= $b->judul ?> (Stok: <?= $b->stok ?>)
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label>Tanggal Pinjam:</label><br>
        <input type="date" name="tanggal_pinjam" value="<?= date('Y-m-d') ?>" required>
        <br><br>

        <button type="submit">Pinjam Sekarang</button>
        <br><br>
        <a href="<?= base_url('peminjaman') ?>">Kembali</a>
        
    </form>
