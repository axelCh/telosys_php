<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset="utf-8">
	<title>BookOrder EDITION PAGE</title>
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
				<td width="30%">ID</td>
				<td><input type="text" name="id" disabled="disable" class="text" value="<?php echo set_value('id'); ?>"/></td>
				<input type="hidden" name="id" value="<?php echo set_value('id', $this->form_data->id); ?>"/>
			</tr>
			<tr>
				<td valign="top">DATE<span style="color:red;">*</span></td>
				<td><input type="text" name="date" class="text" value="<?php echo set_value('date', $this->form_data->date); ?>"/>
					<?php echo form_error('date'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">STATE<span style="color:red;">*</span></td>
				<td><input type="text" name="state" class="text" value="<?php echo set_value('state', $this->form_data->state); ?>"/>
					<?php echo form_error('state'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">CUSTOMER CODE<span style="color:red;">*</span></td>
				<td><input type="text" name="customer_code" class="text" value="<?php echo set_value('customer_code', $this->form_data->customer_code); ?>"/>
					<?php echo form_error('customer_code'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">SHOP CODE<span style="color:red;">*</span></td>
				<td><input type="text" name="shop_code" class="text" value="<?php echo set_value('shop_code', $this->form_data->shop_code); ?>"/>
					<?php echo form_error('shop_code'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">EMPLOYEE CODE<span style="color:red;">*</span></td>
				<td><input type="text" name="employee_code" class="text" value="<?php echo set_value('employee_code', $this->form_data->employee_code); ?>"/>
					<?php echo form_error('employee_code'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">DISCOUNT<span style="color:red;">*</span></td>
				<td><input type="text" name="discount" class="text" value="<?php echo set_value('discount', $this->form_data->discount); ?>"/>
					<?php echo form_error('discount'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">TOTAL PRICE<span style="color:red;">*</span></td>
				<td><input type="text" name="total_price" class="text" value="<?php echo set_value('total_price', $this->form_data->total_price); ?>"/>
					<?php echo form_error('total_price'); ?>
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