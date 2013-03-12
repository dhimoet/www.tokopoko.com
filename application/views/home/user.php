<div class="container">
	<div class="row">
		<div class="hero-unit">
			<h1><?=$user->display_name?></h1>
			<p><?=$user->description?></p>
		</div>
	</div>
	<?if($user->picture_url) {?>
	<div class="row">
		<div class="user-picture img-polaroid">
			<img src="<?=Config::get('shortcuts.user_picture') . $user->picture_url?>" title="<?=$user->display_name?>" alt="user-picture" />
		</div>
	</div>
	<?}?>
	<div class="row form-actions">
		<div class="span6">
			<table class="table">
				<tr>
					<th colspan="2">Contact Information</th>
				</tr>
				<tr>
					<td>Name</td>
					<td><?=$user->display_name?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><a href="mailto:<?=$user->email?>"><?=$user->email?></a></td>
				</tr>
				<tr>
					<td>Phone</td>
					<td><?=$user->phone?></td>
				</tr>
			</table>
			<table class="table">
				<tr>
					<th colspan="2">Social Media</th>
				</tr>
				<tr>
					<td>Facebook Profile</td>
					<td>
						<?if(isset($user_facebook->uid)) {?>
						<a href="http://www.facebook.com/<?=$user_facebook->uid?>" target="_blank"><?=$user_facebook->uid?></a>
						<?}?>
					</td>
				</tr>
				<tr>
					<td>Facebook Page</td>
					<td>
						<?if(isset($user_facebook->uid)) {?>
						<a href="http://www.facebook.com/<?=$user_facebook->page_name?>" target="_blank"><?=$user_facebook->page_name?></a>
						<?}?>
					</td>
				</tr>
				<tr>
					<td>Instagram</td>
					<td>- Feature is not available yet -</td>
				</tr>
				<tr>
					<td>Twitter</td>
					<td>- Feature is not available yet -</td>
				</tr>
			</table>
		</div>
		<div class="span5">
			<table class="table">
				<tr>
					<th colspan="2">Recent Activities</th>
				</tr>
				<tr>
					<td>Last Login</td>
					<td><?=simple_date($user->last_login)?></td>
				</tr>
			</table>
		</div>
	</div>
</div>
