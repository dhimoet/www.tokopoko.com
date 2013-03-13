<div class="container">
	<div class="row">
		<h1>Login</h1>
		<br />
	</div>
	<div class="row">
		<form name="login" id="login" class="form-horizontal" method="post" action="/auth/login">
			<div class="control-group">
				<label for="username" class="control-label">Username: </label>
				<div class="controls">
					<input type="text" name="username" id="username" class="span4" value="" />
				</div>
			</div>
			<div class="control-group">
				<label for="password" class="control-label">Password: </label>
				<div class="controls">
					<input type="password" name="password" id="password" class="span4" value="" />
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<input type="submit" class="btn btn-primary btn-large span2" value="Login" />
				</div>
			</div>
		</form>
	</div>
</div>