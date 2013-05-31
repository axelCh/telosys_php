<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset="utf-8">
	<title>Book EDITION PAGE</title>
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
				<td valign="top">ISBN<span style="color:red;">*</span></td>
				<td><input type="text" name="ISBN" class="text" value="<?php echo set_value('ISBN', $this->form_data->ISBN); ?>"/>
					<?php echo form_error('ISBN'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">TITLE<span style="color:red;">*</span></td>
				<td><input type="text" name="title" class="text" value="<?php echo set_value('title', $this->form_data->title); ?>"/>
					<?php echo form_error('title'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">SYNOPSIS<span style="color:red;">*</span></td>
				<td><input type="text" name="synopsis" class="text" value="<?php echo set_value('synopsis', $this->form_data->synopsis); ?>"/>
					<?php echo form_error('synopsis'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">AUTHOR ID<span style="color:red;">*</span></td>
				<td><input type="text" name="author_id" class="text" value="<?php echo set_value('author_id', $this->form_data->author_id); ?>"/>
					<?php echo form_error('author_id'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">PUBLISHER CODE<span style="color:red;">*</span></td>
				<td><input type="text" name="publisher_code" class="text" value="<?php echo set_value('publisher_code', $this->form_data->publisher_code); ?>"/>
					<?php echo form_error('publisher_code'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">COVER<span style="color:red;">*</span></td>
				<td><input type="text" name="cover" class="text" value="<?php echo set_value('cover', $this->form_data->cover); ?>"/>
					<?php echo form_error('cover'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">BEST SELLER<span style="color:red;">*</span></td>
				<td><input type="text" name="best_seller" class="text" value="<?php echo set_value('best_seller', $this->form_data->best_seller); ?>"/>
					<?php echo form_error('best_seller'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">AVAILABILITY<span style="color:red;">*</span></td>
				<td><input type="text" name="availability" class="text" value="<?php echo set_value('availability', $this->form_data->availability); ?>"/>
					<?php echo form_error('availability'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">PRICE<span style="color:red;">*</span></td>
				<td><input type="text" name="price" class="text" value="<?php echo set_value('price', $this->form_data->price); ?>"/>
					<?php echo form_error('price'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">SPECIAL OFFER<span style="color:red;">*</span></td>
				<td><input type="text" name="special_offer" class="text" value="<?php echo set_value('special_offer', $this->form_data->special_offer); ?>"/>
					<?php echo form_error('special_offer'); ?>
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