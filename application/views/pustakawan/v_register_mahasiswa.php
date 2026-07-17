<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register Mahasiswa</title>
</head>
<body>
	<h2>Register Mahasiswa</h2>
	<a href="<?= base_url('pustakawan/dashboard') ?>">Kembali</a>
	<form method="post" action="<?= base_url('pustakawan/register_mahasiswa') ?>">
        <label>Nama</label><br>
        <input type="text" id="nama"><br><br>

        <label>Email</label><br>
        <input type="email" id="email"><br><br>

        <label>Password</label><br>
        <input type="password" id="password"><br><br>

        <label>NIM</label><br>
        <input type="text" id="nim"><br><br>

        <label>Jurusan</label><br>
        <input type="text" id="jurusan"><br><br>

        <button type="submit" id="btnSave">Daftarkan Akun</button>

		<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				document.getElementById('btnSave'). addEventListener('click', function(e){
					$.ajax({
						url: '<?= base_url("pustakawan/simpan_mahasiswa") ?>',
						type: 'POST',
						dataType: 'json',
						data: {
							nama: $('#nama').val(),
							email: $('#email').val(),
							password: $('#password').val(),
							nim: $('#nim').val(),
							jurusan: $('#jurusan').val()
						},
						success: function(response)
						{
							if(response.error === false){
								alert(response.message);
								$('#nama, #email, #password, #nim, #jurusan').val('');
							}else{
								alert(response.message);
							}
						}
					})
				})
			})
		</script>
    </form>
</body>
</html>
