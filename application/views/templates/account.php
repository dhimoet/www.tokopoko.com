<div class="container">
	<div class="row">
		<div class="span3">
			<ul class="nav nav-list">
				<li class="nav-header">Profile</li>
				<li class="<?=URI::segment(2)=='profile'?'active':''?>"><a href="/account/profile">Edit Profile</a></li>
				<li class="nav-header">Social Network</li>
				<li class="<?=URI::segment(2)=='facebook'?'active':''?>"><a href="/account/facebook">Facebook</a></li>
			</ul>
		</div>
		<div class="span9">
			<?=View::make($body, $data)?>
		</div>
	</div>
</div>