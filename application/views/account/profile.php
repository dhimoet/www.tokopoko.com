<h1>Edit Profile</h1>
<br />
<p>Edit your profile information. <a href="/home/user/<?=Auth::user()->username?>">(View)</a></p>
<form name="profile" id="profile" class="form-horizontal" method="post" action="/account/profile" enctype="multipart/form-data">
	<div class="control-group">
		<label class="control-label" for="display_name">Display Name:</label>
		<div class="controls">
			<input type="text" name="display_name" id="display_name" value="<?=$user->display_name?>" />
			<span class="text-error"><?=$inputs && isset($errors['display_name'][0])? $errors['display_name'][0] : ''?></span>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="password">Password:</label>
		<div class="controls">
			<label class="control-label text-left"><a href="/account/password">Change Password</a></label>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Email:</label>
		<div class="controls">
			<input type="text" name="email" id="email" value="<?=$user->email?>" />
			<span class="text-error"><?=$inputs && isset($errors['email'][0])? $errors['email'][0] : ''?></span>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="phone">Phone:</label>
		<div class="controls">
			<input type="text" name="phone" id="phone" value="<?=$user->phone?>" />
			<span class="text-error"><?=$inputs && isset($errors['phone'][0])? $errors['phone'][0] : ''?></span>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="description">Description:</label>
		<div class="controls">
			<textarea name="description" id="description"><?=$user->description?></textarea>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="picture">Picture:</label>
		<div class="controls">
			<?=$user->picture_url?>&nbsp;<input type="file" name="picture" id="picture"/>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<input type="submit" class="btn btn-primary" value="Save" />
		</div>
	</div>
</form>