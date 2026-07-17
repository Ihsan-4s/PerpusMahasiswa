<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daftar Calon Anggota Perpustakaan</title>
</head>
<body>

    <h2>Calon Anggota Perpustakaan</h2>
	<a href="<?= base_url('pustakawan/dashboard') ?>">Kembali</a>
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
				<tr id="row-<?= $m->id ?>">
					<td><?= $m->nama ?></td>
					<td><?= $m->email ?></td>
					<td><?= $m->nim ?></td>
					<td><?= $m->jurusan ?></td>
					<td>
						<button type="button" class="btn-aktivasi" data-id="<?= $m->id ?>" data-nama="<?= $m->nama ?>">
							Registrasi Anggota
						</button>
					</td>
				</tr>
				<?php endforeach; ?>
            </tbody>
        </table>
		<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script type="text/javascript">
			$(document).ready(function(){
				$('.btn-aktivasi').click(function(){
					var id = $(this).data('id');
					var nama = $(this).data('nama');
					if (!confirm('Registrasi ' + nama + ' sebagai anggota perpus?')) {
						return;
					}

					$.ajax({
						url: "<?= base_url('pustakawan/aktivasi_anggota') ?>",
						type: "POST",
						dataType:'json',
						data: {'mahasiswa_id': id,},
						success: function(response){
							alert(response.message);
							if(response.error === false){
								$('#row-' + id).remove();
							}
						}
					})
				})
			})
		</script>
</body>
</html>
