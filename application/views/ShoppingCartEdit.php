<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset="utf-8">
	<title>ShoppingCart EDITION PAGE</title>
	<link href="<?php echo base_url(); ?>application/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
	<h1 id="CI-h1">Bookstore</h1>
	<div id="body">
	<div class="content">
		<h1><?php echo $title; ?></h1>
		<?php echo $message; ?>
		<form method="post" action="<?php echo $action; ?>">
		<div class="data">
		<table>
			<tr>
				<td width="30%">BOOK ORDER ID</td>
				<td><input type="text" name="book_order_id" disabled="disable" class="text" value="<?php echo set_value('book_order_id'); ?>"/></td>
				<input type="text" name="book_order_id" value="<?php echo set_value('book_order_id', $this->form_data->book_order_id); ?>"/>
			</tr>
			<tr>
				<td valign="top">BOOK ID<span style="color:red;">*</span></td>
				<td><input type="text" name="book_id" class="text" value="<?php echo set_value('book_id', $this->form_data->book_id); ?>"/>
					<?php echo form_error('book_id'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">QUANTITY<span style="color:red;">*</span></td>
				<td><input type="text" name="quantity" class="text" value="<?php echo set_value('quantity', $this->form_data->quantity); ?>"/>
					<?php echo form_error('quantity'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">PRICE<span style="color:red;">*</span></td>
				<td><input type="text" name="price" class="text" value="<?php echo set_value('price', $this->form_data->price); ?>"/>
					<?php echo form_error('price'); ?>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" value="Save"/></td>
			</tr>
		</table>
		</div>
		</form>
		<br />
		<?php echo $link_back; ?>
	</div>
	</div>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
</body>
</html>