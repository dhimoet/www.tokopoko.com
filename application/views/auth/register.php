<div class="container">
	<div class="row">
		<h1>Register With Us!</h1>
		<br />
	</div>
	<div class="row">
		<form name="register" id="register" method="post" action="/auth/register">
			<div class="row">
				<label for="type" class="span2">Registration type: </label>
				<select name="register[type]" id="type">
					<option value="individual" <?=$register['type']=='individual'?'selected':''?>>Individual</option>
					<option value="store" <?=$register['type']=='store'?'selected':''?>>Store</option>
				</select>
			</div>
			<div class="row">
				<label for="firstname" class="span2">First Name: </label>
				<input type="text" name="register[firstname]" id="firstname" class="span4" value="<?=$register['firstname']?>" />
				<span class="span6 pull-right text-error"><?=$register && isset($errors['firstname'][0])? $errors['firstname'][0] : ''?></span>
			</div>
			<div class="row">
				<label for="lastname" class="span2">Last Name: </label>
				<input type="text" name="register[lastname]" id="lastname" class="span4" value="<?=$register['lastname']?>" />
				<span class="span6 pull-right text-error"><?=$register && isset($errors['lastname'][0])? $errors['lastname'][0] : ''?></span>
			</div>
			<div class="row">
				<label for="displayname" class="span2">Display Name: </label>
				<input type="text" name="register[displayname]" id="displayname" class="span4" value="<?=$register['displayname']?>" />
				<span class="span6 pull-right text-error"><?=$register && isset($errors['displayname'][0])? $errors['displayname'][0] : ''?></span>
			</div>
			<div class="row">
				<label for="username" class="span2">Username: </label>
				<input type="text" name="register[username]" id="username" class="span4" value="<?=$register['username']?>" />
				<span class="span6 pull-right text-error"><?=$register && isset($errors['username'][0])? $errors['username'][0] : ''?></span>
			</div>
			<div class="row">
				<label for="email" class="span2">Email Address: </label>
				<input type="text" name="register[email]" id="email" class="span4" value="<?=$register['email']?>" />
				<span class="span6 pull-right text-error"><?=$register && isset($errors['email'][0])? $errors['email'][0] : ''?></span>
			</div>
			<div class="row">
				<label for="phone" class="span2">Phone Name: </label>
				<input type="text" name="register[phone]" id="phone" class="span4" value="<?=$register['phone']?>" />
				<span class="span6 pull-right text-error"><?=$register && isset($errors['phone'][0])? $errors['phone'][0] : ''?></span>
			</div>
			<div class="row">
				<label for="password" class="span2">Password: </label>
				<input type="password" name="register[password]" id="password" class="span4" />
				<span class="span6 pull-right text-error"><?=$register && isset($errors['password'][0])? $errors['password'][0] : ''?></span>
			</div>
			<div class="row">
				<label for="password_confirmation" class="span2">Confirm Password: </label>
				<input type="password" name="register[password_confirmation]" id="password_confirmation" class="span4" />
				<span class="span6 pull-right text-error"><?=$register && isset($errors['password_confirmation'][0])? $errors['password_confirmation'][0] : ''?></span>
			</div>
			<div class="row">
				<span class="offset2">
					<input type="submit" value="Submit" class="span2 btn btn-large btn-primary" />
				</span>
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