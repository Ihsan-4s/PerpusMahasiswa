<h1> Daftar mahasiswa</h1>
<table border="1">
	<tr>
		<th>NIM</th>
		<th>NAMA</th>
		<th>JURUSAN</th>
		<th>JUDUL</th>
		<th>STATUS</th>
		<th>TGL DIPINJAM</th>
		
	</tr>

	<?php foreach ($daftar as $a): ?>
		<tr>
			<td><?= $a->nim ?></td>
			<td><?= $a->nama ?></td>
			<td><?= $a->jurusan ?></td>
			<td><?= $a->judul ?></td>
			<td><?= $a->status ?></td>
			<td><?= $a->tanggal_pinjam ?></td>
			
		</tr>
	<?php endforeach ?>
</table>
