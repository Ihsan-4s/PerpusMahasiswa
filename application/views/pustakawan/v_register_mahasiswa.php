<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register Mahasiswa</title>
</head>
<body>
	<h2>Register Mahasiswa</h2>
	<?php if($this->session->flashdata('success')): ?>
		<div class="alert alert-success">
			<?php echo $this->session->flashdata('success'); ?>
		</div>
	<?php endif; ?>
	<?php if($this->session->flashdata('error')): ?>
		<div class="alert alert-danger">
			<?php echo $this->session->flashdata('error'); ?>
		</div>
	<?php endif; ?>
	<!-- <?= validation_errors('<div class="alert alert-danger">', '</div>') ?> -->

	<form method="post" action="<?= site_url('pustakawan/register_mahasiswa') ?>">

        <label>Nama</label><br>
        <input type="text" name="nama" value="<?= set_value('nama') ?>"><br><br>

        <label>Email</label><br>
        <input type="email" name="email" value="<?= set_value('email') ?>"><br><br>

        <label>Password</label><br>
        <input type="password" name="password"><br><br>

        <label>NIM</label><br>
        <input type="text" name="nim" value="<?= set_value('nim') ?>"><br><br>

        <label>Jurusan</label><br>
        <input type="text" name="jurusan" value="<?= set_value('jurusan') ?>"><br><br>

        <button type="submit">Daftarkan Akun</button>

    </form>
</body>
</html>
