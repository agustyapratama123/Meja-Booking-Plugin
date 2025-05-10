<!DOCTYPE html>
<html>
<head>
	<title>Dashboard Resto</title>
	<style>
		body {
			font-family: sans-serif;
			background: #f9f9f9;
			padding: 30px;
			margin: 0;
		}
		.header {
			display: flex;
			justify-content: space-between;
			align-items: center;
			background: #fff;
			padding: 20px;
			border-bottom: 1px solid #ddd;
			margin: -30px -30px 30px -30px;
		}
		.logout-btn {
			background: #d33;
			color: white;
			padding: 8px 16px;
			text-decoration: none;
			border-radius: 4px;
			font-size: 14px;
		}
		.logout-btn:hover {
			background: #b22;
		}
		table {
			width: 100%;
			border-collapse: collapse;
			background: #fff;
		}
		th, td {
			border: 1px solid #ddd;
			padding: 10px;
			text-align: left;
		}
		th {
			background: #eee;
		}
	</style>
</head>
<body>
	<div class="header">
		<h2>Dashboard Booking</h2>
		<a class="logout-btn" href="<?php echo wp_logout_url(home_url('/login-resto')); ?>">Logout</a>
	</div>

	<table id="booking-table">
		<thead>
			<tr>
				<th>Nama</th>
				<th>Tanggal</th>
				<th>Jam</th>
				<th>Jumlah</th>
				<th>Status</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</body>
</html>
