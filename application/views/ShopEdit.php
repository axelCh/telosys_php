<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset="utf-8">
	<title>Shop EDITION PAGE</title>
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
				<td width="30%">CODE</td>
				<td><input type="text" name="code" disabled="disable" class="text" value="<?php echo set_value('code'); ?>"/></td>
				<input type="text" name="code" value="<?php echo set_value('code', $this->form_data->code); ?>"/>
			</tr>
			<tr>
				<td valign="top">NAME<span style="color:red;">*</span></td>
				<td><input type="text" name="name" class="text" value="<?php echo set_value('name', $this->form_data->name); ?>"/>
					<?php echo form_error('name'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">EMAIL<span style="color:red;">*</span></td>
				<td><input type="text" name="email" class="text" value="<?php echo set_value('email', $this->form_data->email); ?>"/>
					<?php echo form_error('email'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">PHONE<span style="color:red;">*</span></td>
				<td><input type="text" name="phone" class="text" value="<?php echo set_value('phone', $this->form_data->phone); ?>"/>
					<?php echo form_error('phone'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">EXECUTIVE<span style="color:red;">*</span></td>
				<td><input type="text" name="executive" class="text" value="<?php echo set_value('executive', $this->form_data->executive); ?>"/>
					<?php echo form_error('executive'); ?>
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