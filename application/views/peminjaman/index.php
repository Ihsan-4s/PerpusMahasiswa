<form action="<?= base_url('peminjaman/detail_peminjaman') ?>" method="post">

	<label>Mahasiswa</label>
	<select name="mahasiswa_id" required>
		<option value="" selected disabled>-- Pilih Mahasiswa --</option>
		<?php foreach ($mahasiswa as $m) { ?>

			<option value="<?= $m->id ?>">
				<?= $m->nama ?> - <?= $m->nim ?>
			</option>
		<?php } ?>
	</select>

	<br><br>

	<label>Buku</label>
	<select name="buku_id" required>
		  <option value="" selected disabled>-- Pilih Buku --</option>

		<?php foreach ($buku as $b) { ?>
			<option value="<?= $b->id ?>">
				<?= $b->judul ?>
			</option>
		<?php } ?>
	</select>

	<br><br>

	<button type="submit">Pinjam</button>

</form>
