<h1>Connect to Instagram</h1>
<br />
<p>Connect to your Instagram account to automatically include the Instagram photos on our main page.</p>
<table class="table table-striped">
	<?if(!$status) {?>
		<tr>
			<td>Instagram Login</td>
			<td>
				<form name="instagram" id="instagram" class="form-inline" method="post" action="/instagram/login">
					<input type="submit" class="btn btn-primary" value="Login Now" />
				</form>
			</td>
		</tr>
	<?} else {?>
		<tr>
			<td>Instagram Logout</td>
			<td>
				<form name="instagram_logout" id="instagram_logout" class="form-inline" method="post" action="/instagram/logout">
					<input type="submit" class="btn btn-danger" value="Logout Now" />
				</form>
			</td>
		</tr>
	<?}?>
</table>
