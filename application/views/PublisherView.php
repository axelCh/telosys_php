<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset="utf-8">
	<title>Publisher DETAILS PAGE</title>
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
				<td><?php echo $publisher->code; ?></td>
			</tr>
			<tr>
				<td valign="top">NAME</td>
				<td><?php echo $publisher->name; ?></td>
			</tr>
			<tr>
				<td valign="top">EMAIL</td>
				<td><?php echo $publisher->email; ?></td>
			</tr>
			<tr>
				<td valign="top">PHONE</td>
				<td><?php echo $publisher->phone; ?></td>
			</tr>
			<tr>
				<td valign="top">CONTACT</td>
				<td><?php echo $publisher->contact; ?></td>
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