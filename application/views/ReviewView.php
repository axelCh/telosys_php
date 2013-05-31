<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset="utf-8">
	<title>Review DETAILS PAGE</title>
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
				<td width="30%">CUSTOMER CODE</td>
				<td><?php echo $review->customer_code; ?></td>
			</tr>
			<tr>
				<td width="30%">BOOK ID</td>
				<td><?php echo $review->book_id; ?></td>
			</tr>
			<tr>
				<td valign="top">BODY</td>
				<td><?php echo $review->body; ?></td>
			</tr>
			<tr>
				<td valign="top">NOTE</td>
				<td><?php echo $review->note; ?></td>
			</tr>
			<tr>
				<td valign="top">CREATION DATE</td>
				<td><?php echo $review->creation_date; ?></td>
			</tr>
			<tr>
				<td valign="top">LAST UPDATE</td>
				<td><?php echo $review->last_update; ?></td>
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