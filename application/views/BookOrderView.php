<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset="utf-8">
	<title>BookOrder DETAILS PAGE</title>
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
				<td><?php echo $book_order->id; ?></td>
			</tr>
			<tr>
				<td valign="top">DATE</td>
				<td><?php echo $book_order->date; ?></td>
			</tr>
			<tr>
				<td valign="top">STATE</td>
				<td><?php echo $book_order->state; ?></td>
			</tr>
			<tr>
				<td valign="top">CUSTOMER CODE</td>
				<td><?php echo $book_order->customer_code; ?></td>
			</tr>
			<tr>
				<td valign="top">SHOP CODE</td>
				<td><?php echo $book_order->shop_code; ?></td>
			</tr>
			<tr>
				<td valign="top">EMPLOYEE CODE</td>
				<td><?php echo $book_order->employee_code; ?></td>
			</tr>
			<tr>
				<td valign="top">DISCOUNT</td>
				<td><?php echo $book_order->discount; ?></td>
			</tr>
			<tr>
				<td valign="top">TOTAL PRICE</td>
				<td><?php echo $book_order->total_price; ?></td>
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