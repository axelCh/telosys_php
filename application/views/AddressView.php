<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset="utf-8">
	<title>Address DETAILS PAGE</title>
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
				<td><?php echo $address->code; ?></td>
			</tr>
			<tr>
				<td valign="top">ADDRESS LIGNE1</td>
				<td><?php echo $address->address_ligne1; ?></td>
			</tr>
			<tr>
				<td valign="top">ADDRESS LIGNE2</td>
				<td><?php echo $address->address_ligne2; ?></td>
			</tr>
			<tr>
				<td valign="top">CITY ZIP CODE</td>
				<td><?php echo $address->city_zip_code; ?></td>
			</tr>
			<tr>
				<td valign="top">COUNTRY CODE</td>
				<td><?php echo $address->country_code; ?></td>
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