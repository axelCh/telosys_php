<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset="utf-8">
	<title>Address EDITION PAGE</title>
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
				<td valign="top">ADDRESS LIGNE1<span style="color:red;">*</span></td>
				<td><input type="text" name="address_ligne1" class="text" value="<?php echo set_value('address_ligne1', $this->form_data->address_ligne1); ?>"/>
					<?php echo form_error('address_ligne1'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">ADDRESS LIGNE2<span style="color:red;">*</span></td>
				<td><input type="text" name="address_ligne2" class="text" value="<?php echo set_value('address_ligne2', $this->form_data->address_ligne2); ?>"/>
					<?php echo form_error('address_ligne2'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">CITY ZIP CODE<span style="color:red;">*</span></td>
				<td><input type="text" name="city_zip_code" class="text" value="<?php echo set_value('city_zip_code', $this->form_data->city_zip_code); ?>"/>
					<?php echo form_error('city_zip_code'); ?>
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