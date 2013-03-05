<h1>Connect to Facebook</h1>
<br />
<p>Connect to your Facebook account to automatically include your Facebook posts on our homepage.</p>
<?if(!$status) {?>
	<form name="facebook" id="facebook" method="post" action="/facebook/login">
		<input type="submit" class="btn btn-primary btn-large" value="Login Now" />
	</form>
<?} else {?>
	<p>You are currently logged in on Facebook as <strong><?=$user['name']?></strong>.</p>
		
	<p>You can include your Facebook page posts by entering the page name below.</p>
	<?if(empty($page)) {?>
		<form name="facebook_page_connect" id="facebook_page_connect" method="post" action="/facebook/page">
			<div>
				<label for="facebook_page" class="span2">http://www.facebook.com/</label>&nbsp;
				<input type="text" name="facebook_page" id="facebook_page" class="span3" />	
			</div>
			<div>
				<input type="submit" class="btn btn-primary btn-large" value="Connect Facebook Page" />
			</div>
		</form>
	<?} else {?>
		<p>http://www.facebook.com/<?=$page?> (<a href="/facebook/page">disconnect</a>)</p>
	<?}?>
	<p>Click the button below if you wish to stop us from accessing Facebook account temporarily.</p>
	<form name="facebook" id="facebook" method="post" action="/facebook/logout">
		<input type="submit" class="btn btn-danger btn-large" value="Logout Now" />
	</form>
<?}?>