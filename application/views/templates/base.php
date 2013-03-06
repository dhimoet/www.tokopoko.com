<!DOCTYPE html>
<html lang="en">
<head>
	<title><?=$title?> - JualBeli</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="/js/underscore-min.js"></script>
	<script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap-responsive.min.css">
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container">
				<a href="/" class="brand">JualBeli</a>
				<ul class="nav">
					<?if(!Auth::check()) {?>
					<li><a href="/auth/register">Sign Up</a></li>
					<li><a href="/auth/login">Log In</a></li>
					<?} else {?>
					<li><a href="/auth/logout">Log Out</a></li>
					<li><a href="/account/profile">My Account</a></li>
					<?}?>
					<li><a href="">Help</a></li>
				</ul>
			</div>
		</div>
	</div>
	<?if(Session::get('error')) {?>
	<div class="container">
		<div class="row">
			<div class="alert span5">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<?=Session::get('error')?>
			</div>
		</div>
	</div>
	<?}?>
	<?=View::make($body, $data)?>

</body>
</html>
