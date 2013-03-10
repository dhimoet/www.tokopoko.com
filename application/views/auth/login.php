<div class="container">
	<div class="row">
		<h1>Login</h1>
		<br />
	</div>
	<div class="row">
		<form name="login" id="login" method="post" action="/auth/login">
			<div class="row">
				<label for="username" class="span2">Username: </label>
				<input type="text" name="login[username]" id="username" class="span4" value="" />
			</div>
			<div class="row">
				<label for="password" class="span2">Password: </label>
				<input type="password" name="login[password]" id="password" class="span4" value="" />
			</div>
			<div class="row">
				<span class="offset2">
					<input type="submit" class="btn btn-primary btn-large span2" value="Login" />
				</span>
			</div>
		</form>
	</div>
</div>