<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daftar Calon Anggota Perpustakaan</title>
</head>
<body>

    <h2>Calon Anggota Perpustakaan</h2>
	<a href="<?= base_url('pustakawan/dashboard') ?>">Kembali</a>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (empty($mahasiswa)): ?>
        <p>Tidak ada calon anggota saat ini.</p>
    <?php else: ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>NIM</th>
                    <th>Jurusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mahasiswa as $m): ?>
                    <tr>
                        <td><?= html_escape($m->nama) ?></td>
                        <td><?= html_escape($m->email) ?></td>
                        <td><?= html_escape($m->nim) ?></td>
                        <td><?= html_escape($m->jurusan) ?></td>
                        <td>
                            <?= form_open('pustakawan/aktivasi_anggota') ?>
                                <input type="hidden" name="mahasiswa_id" value="<?= $m->id ?>">
                                <button type="submit"
                                    onclick="return confirm('Registrasi <?= html_escape($m->nama) ?> sebagai anggota perpus?')">
                                    Registrasi Anggota
                                </button>
                            <?= form_close() ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html>
