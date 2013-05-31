<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset="utf-8">
	<title>City EDITION PAGE</title>
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
				<td width="30%">ZIP CODE</td>
				<td><input type="text" name="zip_code" disabled="disable" class="text" value="<?php echo set_value('zip_code'); ?>"/></td>
				<input type="text" name="zip_code" value="<?php echo set_value('zip_code', $this->form_data->zip_code); ?>"/>
			</tr>
			<tr>
				<td valign="top">OPTIONAL PLUS4<span style="color:red;">*</span></td>
				<td><input type="text" name="optional_plus4" class="text" value="<?php echo set_value('optional_plus4', $this->form_data->optional_plus4); ?>"/>
					<?php echo form_error('optional_plus4'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">NAME<span style="color:red;">*</span></td>
				<td><input type="text" name="name" class="text" value="<?php echo set_value('name', $this->form_data->name); ?>"/>
					<?php echo form_error('name'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">COUNTRY CODE<span style="color:red;">*</span></td>
				<td><input type="text" name="country_code" class="text" value="<?php echo set_value('country_code', $this->form_data->country_code); ?>"/>
					<?php echo form_error('country_code'); ?>
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