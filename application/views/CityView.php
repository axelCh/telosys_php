<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset="utf-8">
	<title>City DETAILS PAGE</title>
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
				<td width="30%">ZIP CODE</td>
				<td><?php echo $city->zip_code; ?></td>
			</tr>
			<tr>
				<td valign="top">OPTIONAL PLUS4</td>
				<td><?php echo $city->optional_plus4; ?></td>
			</tr>
			<tr>
				<td valign="top">NAME</td>
				<td><?php echo $city->name; ?></td>
			</tr>
			<tr>
				<td valign="top">COUNTRY CODE</td>
				<td><?php echo $city->country_code; ?></td>
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