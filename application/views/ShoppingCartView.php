<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset="utf-8">
	<title>ShoppingCart DETAILS PAGE</title>
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
				<td width="30%">BOOK ORDER ID</td>
				<td><?php echo $shopping_cart->book_order_id; ?></td>
			</tr>
			<tr>
				<td valign="top">BOOK ID</td>
				<td><?php echo $shopping_cart->book_id; ?></td>
			</tr>
			<tr>
				<td valign="top">QUANTITY</td>
				<td><?php echo $shopping_cart->quantity; ?></td>
			</tr>
			<tr>
				<td valign="top">PRICE</td>
				<td><?php echo $shopping_cart->price; ?></td>
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