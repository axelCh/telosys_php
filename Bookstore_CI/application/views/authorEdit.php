<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset="utf-8">
	<title>AUTHOR EDITION PAGE</title>
	<link href="<?php echo base_url(); ?>res/css/style.css" rel="stylesheet" type="text/css" />
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
				<td width="30%">ID</td>
				<td><input type="text" name="id" disabled="disable" class="text" value="<?php echo set_value('id'); ?>"/></td>
				<input type="hidden" name="id" value="<?php echo set_value('id', $this->form_data->id); ?>"/>
			</tr>
			<tr>
				<td valign="top">Last Name<span style="color:red;">*</span></td>
				<td><input type="text" name="last_name" class="text" value="<?php echo set_value('last_name', $this->form_data->last_name); ?>"/>
					<?php echo form_error('last_name'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">First Name<span style="color:red;">*</span></td>
				<td><input type="text" name="first_name" class="text" value="<?php echo set_value('first_name', $this->form_data->first_name); ?>"/>
					<?php echo form_error('first_name'); ?>
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