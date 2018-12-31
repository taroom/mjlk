<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?= $apps_title ?></title>
	<?php $this->load->view($apps_head_assets) ?>
	<?php if(isset($apps_head_custom)){ $this->load->view($apps_head_custom); } ?>
	<style type="text/css">
	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }
	</style>
</head>
<body>

<?php $this->load->view($apps_pages) ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			Halaman dirender dalam <strong>{elapsed_time}</strong> detik.		
		</div>
	</div>
</div>

<?php $this->load->view($apps_foot_assets) ?>
<?php if(isset($apps_foot_custom)){ $this->load->view($apps_foot_custom); } ?>
</body>
</html>