<!DOCTYPE html>
<html>
<head><title>Dashboard Mahasiswa</title></head>
<body>

<h2>Halo, <?= $this->session->userdata('nama') ?></h2>
<p>NIM: <?= $mahasiswa->nim ?> | Jurusan: <?=$mahasiswa->jurusan ?></p>
<p><a href="<?= base_url('auth/logout') ?>">Logout</a></p>

<h3>Buku yang Dipinjam</h3>
<?php if (empty($peminjaman)): ?>
    <p>Belum ada riwayat peminjaman.</p>
<?php else: ?>
<table border="1" cellpadding="8">
    <tr>
        <th>Judul</th>
        <th>Lokasi Rak</th>
        <th>Tanggal Pinjam</th>
        <th>Status</th>
    </tr>
    <?php foreach ($peminjaman as $p): ?>
    <tr>
        <td><?= html_escape($p->judul) ?></td>
        <td><?= html_escape($p->lokasi_rak) ?></td>
        <td><?= $p->tanggal_pinjam ?></td>
        <td><?= $p->status === 'dipinjam' ? 'Sedang Dipinjam' : 'Sudah Dikembalikan' ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>

<h3>Denda</h3>
<?php if (empty($denda)): ?>
    <p>Tidak ada denda.</p>
<?php else: ?>
<table border="1" cellpadding="8">
    <tr>
        <th>Buku</th>
        <th>Tanggal Kembali</th>
        <th>Nominal</th>
        <th>Status</th>
    </tr>
    <?php foreach ($denda as $d): ?>
    <tr>
        <td><?= html_escape($d->judul) ?></td>
        <td><?= $d->tanggal_kembali ?></td>
        <td>Rp <?= number_format($d->nominal, 0, ',', '.') ?></td>
        <td><?= $d->status_bayar === "t" ? 'Lunas' : 'Belum Bayar' ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>

</body>
</html>
