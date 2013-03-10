<h1>Connect to Facebook</h1>
<br />
<p>Connect to your Facebook account and page to automatically include the Facebook posts on our main page.</p>
<table class="table table-striped">
	<tr>
		<td>Facebook Login</td>
		<td>
			<?if(!$status) {?>
				<form name="facebook" id="facebook" method="post" action="/facebook/login">
					<input type="submit" class="btn btn-primary" value="Login Now" />
				</form>
			<?} else {?>
				Logged in as <strong><?=$username?></strong>
			<?}?>
		</td>
	</tr>
	<?if($status) {?>
		<tr>
			<td>Facebook Page</td>
			<td>
				<form name="facebook_page_connect" id="facebook_page_connect" class="form-inline" method="post" action="/facebook/page">
					<?if(empty($page)) {?>
						<label for="facebook_page">http://www.facebook.com/</label>
						<input type="text" name="facebook_page" id="facebook_page" class="input-small" />
						<input type="submit" class="btn btn-primary" value="Connect" />
					<?} else {?>
						<a href="http://www.facebook.com/<?=$page?>" target="_blank">http://www.facebook.com/<?=$page?></a>&nbsp;
						<input type="submit" class="btn btn-danger btn-small" value="Disconnect" />
					<?}?>	
				</form>
			</td>
		</tr>
		<tr>
			<td>Facebook Logout</td>
			<td>
				<form name="facebook" id="facebook" class="form-inline" method="post" action="/facebook/logout">
					<input type="submit" class="btn btn-danger" value="Logout Now" />
				</form>
			</td>
		</tr>
	<?}?>
</table>
