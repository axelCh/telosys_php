<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset="utf-8">
	<title>Review EDITION PAGE</title>
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
				<td width="30%">CUSTOMER CODE</td>
				<td><input type="text" name="customer_code" disabled="disable" class="text" value="<?php echo set_value('customer_code'); ?>"/></td>
				<input type="text" name="customer_code" value="<?php echo set_value('customer_code', $this->form_data->customer_code); ?>"/>
			</tr>
			<tr>
				<td width="30%">BOOK ID</td>
				<td><input type="text" name="book_id" disabled="disable" class="text" value="<?php echo set_value('book_id'); ?>"/></td>
				<input type="text" name="book_id" value="<?php echo set_value('book_id', $this->form_data->book_id); ?>"/>
			</tr>
			<tr>
				<td valign="top">BODY<span style="color:red;">*</span></td>
				<td><input type="text" name="body" class="text" value="<?php echo set_value('body', $this->form_data->body); ?>"/>
					<?php echo form_error('body'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">NOTE<span style="color:red;">*</span></td>
				<td><input type="text" name="note" class="text" value="<?php echo set_value('note', $this->form_data->note); ?>"/>
					<?php echo form_error('note'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">CREATION DATE<span style="color:red;">*</span></td>
				<td><input type="text" name="creation_date" class="text" value="<?php echo set_value('creation_date', $this->form_data->creation_date); ?>"/>
					<?php echo form_error('creation_date'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">LAST UPDATE<span style="color:red;">*</span></td>
				<td><input type="text" name="last_update" class="text" value="<?php echo set_value('last_update', $this->form_data->last_update); ?>"/>
					<?php echo form_error('last_update'); ?>
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