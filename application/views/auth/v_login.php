<!DOCTYPE html>
<html>
<head><title>Login - Perpustakaan Mahasiswa</title></head>
<body>

<h2>Login</h2>
<!-- <?php echo password_hash('kampus12345', PASSWORD_BCRYPT); ?> -->
<?php if ($this->session->flashdata('error')): ?>
    <p style="color:red;"><?= $this->session->flashdata('error') ?></p>
<?php endif; ?>

<form method="post" action="<?= site_url('auth') ?>">
    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

</body>
</html>
