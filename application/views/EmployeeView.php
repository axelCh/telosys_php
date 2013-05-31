<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset="utf-8">
	<title>Employee DETAILS PAGE</title>
	<link href="<?php echo base_url(); ?>application/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
	<h1 id="CI-h1">Bookstore</h1>
	<div id="body">
	<div class="content">
		<h1><?php echo $title; ?></h1>
		<div class="data">
		<table>
			<tr>
				<td width="30%">CODE</td>
				<td><?php echo $employee->code; ?></td>
			</tr>
			<tr>
				<td valign="top">LAST NAME</td>
				<td><?php echo $employee->last_name; ?></td>
			</tr>
			<tr>
				<td valign="top">FIRST NAME</td>
				<td><?php echo $employee->first_name; ?></td>
			</tr>
			<tr>
				<td valign="top">MANAGER</td>
				<td><?php echo $employee->manager; ?></td>
			</tr>
			<tr>
				<td valign="top">SHOP CODE</td>
				<td><?php echo $employee->shop_code; ?></td>
			</tr>
		</table>
		</div>
		<br />
		<?php echo $link_back; ?>
	</div>
	</div>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
</body>
</html>