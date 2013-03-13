<div class="container">
	<div class="row">
		<h1>Register With Us!</h1>
		<br />
	</div>
	<div class="row">
		<form name="register" id="register" class="form-horizontal" method="post" action="/auth/register">
			<div class="control-group">
				<label for="username"  class="control-label">Username: </label>
				<div class="controls">
					<input type="text" name="register[username]" id="username" class="span4" value="<?=$register['username']?>" />
					<span class="span6 pull-right text-error"><?=$register && isset($errors['username'][0])? $errors['username'][0] : ''?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="password" class="control-label">Password: </label>
				<div class="controls">
					<input type="password" name="register[password]" id="password" class="span4" />
					<span class="span6 pull-right text-error"><?=$register && isset($errors['password'][0])? $errors['password'][0] : ''?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="password_confirmation" class="control-label">Confirm Password: </label>
				<div class="controls">
					<input type="password" name="register[password_confirmation]" id="password_confirmation" class="span4" />
					<span class="span6 pull-right text-error"><?=$register && isset($errors['password_confirmation'][0])? $errors['password_confirmation'][0] : ''?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="displayname" class="control-label">Display Name: </label>
				<div class="controls">
					<input type="text" name="register[displayname]" id="displayname" class="span4" value="<?=$register['displayname']?>" />
					<span class="span6 pull-right text-error"><?=$register && isset($errors['displayname'][0])? $errors['displayname'][0] : ''?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="email" class="control-label">Email Address: </label>
				<div class="controls">
					<input type="text" name="register[email]" id="email" class="span4" value="<?=$register['email']?>" />
					<span class="span6 pull-right text-error"><?=$register && isset($errors['email'][0])? $errors['email'][0] : ''?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="phone" class="control-label">Phone Number: </label>
				<div class="controls">
					<input type="text" name="register[phone]" id="phone" class="span4" value="<?=$register['phone']?>" />
					<span class="span6 pull-right text-error"><?=$register && isset($errors['phone'][0])? $errors['phone'][0] : ''?></span>
				</div>
			</div>
			<div class="control-group">
				<label for="description" class="control-label">Description: </label>
				<div class="controls">
					<textarea name="register[description]" id="description" class="span4"><?=$register['description']?></textarea>
					<span class="span6 pull-right text-error"><?=$register && isset($errors['description'][0])? $errors['description'][0] : ''?></span>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<input type="submit" value="Submit" class="span2 btn btn-large btn-primary" />
				</div>
			</div>
		</form>
	</div>
</div>

<script>
	// document on load
	$(document).ready(function() {
		// toggle name inputs
		toggle_name_inputs($('#type').val());
		// toggle name inputs on change
		$('#type').change(function() {
			toggle_name_inputs($('#type').val());
		});
	});
	// function declarations
	function toggle_name_inputs(type)
	{
		// store
		if(type == 'store') {
			// hide first and last name inputs
			$('#firstname, #lastname').parent().hide();
			// show display name input
			$('#displayname').parent().show();
		}
		// individual
		if(type == 'individual') {
			// hide display name input
			$('#displayname').parent().hide();
			// show first and last name input
			$('#firstname, #lastname').parent().show();
		}
	}
</script>