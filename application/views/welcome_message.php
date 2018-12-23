<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Secret Santa</title>
	<link href="https://fonts.googleapis.com/css?family=Mountains+of+Christmas:700" rel="stylesheet">
	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 14px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
		background-image: url(<?=base_url() ?>images/snow.gif);

	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		font-family: 'Mountains of Christmas', cursive;
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 49px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	.container {
		margin: 20px;
		padding:30px;
		/* border: 1px solid #D0D0D0; */
		box-shadow: 0 0 8px red;
		background: rgba(255,255,255,.7);
	}
	div .text-right {
		/* margin-left : 50px; */
		text-align : right;
	}
	form {
		text-align : center;
	}
	.card {
		position:relative;
		font-size: 1.5em;
		margin: 10px;
		width: 300px;
		height: 100px;
		border: 1px solid silver;
		text-align:center;
		line-height:40px;
		/* background:yellow; */
		background-image: url('<?=base_url() ?>images/nameholder.jpg');
		background-repeat: no-repeat;
		background-position: center;
		background-size: 100%;
		float:left;
	}
	.delete-btn {
		background:red;
		color:white;
		font-weight:700;
		position: absolute;
		top:0px;
		right:0px;
	}

	.clearfix {
		overflow: auto;
	}

	input {
		line-height:30px;
		margin:20px;
		padding:5px;
		font-size: 16px;
	}

	.btn {
		width:80px;
		height:45px;
		padding: 5px 2px;
		background: red;
		color:white;
	}

	.btn-send {
		width:180px;
		height:45px;
		padding: 5px 2px;
		background: red;
		color:white;
	}

	</style>
</head>
<body>
<div class="container">
<div class="clearfix">
<h1>Secret Santa List $5 - $50</h1>
<form action="<?= base_url() ?>welcome/postParticipant" method="POST">
<label for="name">Name</label>
	<input id="name" name="name"/>
	<label for="email">Email</label>
	<input id="email" size="40" name="email"/>
	<!-- <label for="limit">Limit</label> -->
	<!-- <input id="limit" size="8" name="limit"/> -->
	<input class="btn" type="submit" value="+add">
</form>
	<?php if($data): ?>
		<?php foreach($data as $p): ?>
			<div class="card">
			<form action="<?= base_url() ?>welcome/delete/<?= $p->id ?>" method="POST">
			<button class="delete-btn" type="submit">x</button>
			</form>
				<h4><?= $p->name; ?> </h4>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
	</div>
	</div>

	<div>
		<form action="<?= base_url() ?>welcome/sendEmail" method="POST">
			<input class="btn-send" disabled="disabled" type="submit" value="Send Secret Santa!">
		</form>
	</div>
</body>
</html> 