<!DOCTYPE html>
<html>
<head><title>Login - Perpustakaan Mahasiswa</title></head>
<body>

<h2>Login</h2>

    <label>Email</label><br>
    <input type="email" id="email" required><br><br>

    <label>Password</label><br>
    <input type="password" id="password" required><br><br>
    <button type="submit" id="login-btn">Login</button>

	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			document.getElementById('login-btn').addEventListener('click', function(){
				$.ajax({
					url: "<?= base_url('auth/proses_login') ?>",
					type: 'POST',
					dataType: 'json',
					data: {
						email: $('#email').val(),
						password: $('#password').val()
					},
					success: function(response) {
						if (response.error === false) {
							window.location.href = response.redirect;
						} else {
							alert(response.message);
						}
					}
				})
			})
		})
	</script>
</body>
</html>
