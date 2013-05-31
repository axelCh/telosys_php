<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset="utf-8">
	<title>Book DETAILS PAGE</title>
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
				<td width="30%">ID</td>
				<td><?php echo $book->id; ?></td>
			</tr>
			<tr>
				<td valign="top">ISBN</td>
				<td><?php echo $book->ISBN; ?></td>
			</tr>
			<tr>
				<td valign="top">TITLE</td>
				<td><?php echo $book->title; ?></td>
			</tr>
			<tr>
				<td valign="top">SYNOPSIS</td>
				<td><?php echo $book->synopsis; ?></td>
			</tr>
			<tr>
				<td valign="top">AUTHOR ID</td>
				<td><?php echo $book->author_id; ?></td>
			</tr>
			<tr>
				<td valign="top">PUBLISHER CODE</td>
				<td><?php echo $book->publisher_code; ?></td>
			</tr>
			<tr>
				<td valign="top">COVER</td>
				<td><?php echo $book->cover; ?></td>
			</tr>
			<tr>
				<td valign="top">BEST SELLER</td>
				<td><?php echo $book->best_seller; ?></td>
			</tr>
			<tr>
				<td valign="top">AVAILABILITY</td>
				<td><?php echo $book->availability; ?></td>
			</tr>
			<tr>
				<td valign="top">PRICE</td>
				<td><?php echo $book->price; ?></td>
			</tr>
			<tr>
				<td valign="top">SPECIAL OFFER</td>
				<td><?php echo $book->special_offer; ?></td>
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