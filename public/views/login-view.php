<!DOCTYPE html>
<html>
<head>
	<title>Login Resto</title>
	<style>
		body { font-family: sans-serif; background: #f6f6f6; padding: 40px; }
		.login-box { max-width: 400px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,.1); }
	</style>
</head>
<body>
	<div class="login-box">
		<h2>Login Admin Resto</h2>
		<?php if (!empty($error)) echo '<p style="color:red;">' . esc_html($error) . '</p>'; ?>
		<form method="post">
			<p><input type="text" name="log" placeholder="Username" required></p>
			<p><input type="password" name="pwd" placeholder="Password" required></p>
			<p><label><input type="checkbox" name="rememberme"> Ingat saya</label></p>
			<p><button type="submit">Login</button></p>
		</form>
	</div>
</body>
</html>
