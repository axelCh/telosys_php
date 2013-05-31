<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset="utf-8">
	<title>PublisherAddressList EDITION PAGE</title>
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
				<td width="30%">PUBLISHER CODE</td>
				<td><input type="text" name="publisher_code" disabled="disable" class="text" value="<?php echo set_value('publisher_code'); ?>"/></td>
				<input type="text" name="publisher_code" value="<?php echo set_value('publisher_code', $this->form_data->publisher_code); ?>"/>
			</tr>
			<tr>
				<td valign="top">ADDRESS CODE<span style="color:red;">*</span></td>
				<td><input type="text" name="address_code" class="text" value="<?php echo set_value('address_code', $this->form_data->address_code); ?>"/>
					<?php echo form_error('address_code'); ?>
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