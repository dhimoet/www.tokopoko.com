<h1>Change Password</h1>
<br />
<p>Change your account password.</p>
<form name="password" id="password" class="form-horizontal" method="post" action="/account/password">
	<div class="control-group">
		<label class="control-label" for="current_password">Current Password:</label>
		<div class="controls">
			<input type="password" name="current_password" id="current_password" />
			<span class="text-error"><?=$passwords && isset($errors['current_password'][0])? $errors['current_password'][0] : ''?></span>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="password">New Password:</label>
		<div class="controls">
			<input type="password" name="password" id="password" />
			<span class="text-error"><?=$passwords && isset($errors['password'][0])? $errors['password'][0] : ''?></span>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="password_confirmation">Confirm Password:</label>
		<div class="controls">
			<input type="password" name="password_confirmation" id="password_confirmation" />
			<span class="text-error"><?=$passwords && isset($errors['password_confirmation'][0])? $errors['password_confirmation'][0] : ''?></span>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<input type="submit" class="btn btn-primary" value="Save" />
		</div>
	</div>
</form>